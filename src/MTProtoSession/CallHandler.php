<?php

declare(strict_types=1);

/**
 * CallHandler module.
 *
 * This file is part of MadelineProto.
 * MadelineProto is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * MadelineProto is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU Affero General Public License for more details.
 * You should have received a copy of the GNU General Public License along with MadelineProto.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    Daniil Gentili <daniil@daniil.it>
 * @copyright 2016-2023 Daniil Gentili <daniil@daniil.it>
 * @license   https://opensource.org/licenses/AGPL-3.0 AGPLv3
 * @link https://docs.madelineproto.xyz MadelineProto documentation
 */

namespace danog\MadelineProto\MTProtoSession;

use Amp\DeferredFuture;
use danog\MadelineProto\DataCenterConnection;
use danog\MadelineProto\MTProto\Container;
use danog\MadelineProto\MTProto\MTProtoOutgoingMessage;
use danog\MadelineProto\TL\Exception;
use danog\MadelineProto\WrappedFuture;
use Revolt\EventLoop;

use function Amp\async;
use function Amp\Future\await;

/**
 * Manages method and object calls.
 *
 *
 * @property DataCenterConnection $shared
 * @internal
 */
trait CallHandler
{
    /**
     * Recall method.
     */
    public function methodRecall(int $message_id, bool $postpone = false, ?int $datacenter = null): void
    {
        if ($datacenter === $this->datacenter) {
            $datacenter = null;
        }
        $message = $this->outgoing_messages[$message_id] ?? null;
        $message_ids = $message instanceof Container
            ? $message->getIds()
            : [$message_id];
        foreach ($message_ids as $message_id) {
            if (isset($this->outgoing_messages[$message_id])
                && !$this->outgoing_messages[$message_id]->canGarbageCollect()) {
                if ($datacenter) {
                    /** @var MTProtoOutgoingMessage */
                    $message = $this->outgoing_messages[$message_id];
                    $this->gotResponseForOutgoingMessage($message);
                    $message->setMsgId(null);
                    $message->setSeqNo(null);
                    EventLoop::queue(function () use ($datacenter, $message): void {
                        $this->API->datacenter->waitGetConnection($datacenter)
                            ->sendMessage($message, false);
                    });
                } else {
                    /** @var MTProtoOutgoingMessage */
                    $message = $this->outgoing_messages[$message_id];
                    if (!$message->hasSeqNo()) {
                        $this->gotResponseForOutgoingMessage($message);
                    }
                    EventLoop::queue($this->sendMessage(...), $message, false);
                }
            } else {
                $this->API->logger('Could not resend '.($this->outgoing_messages[$message_id] ?? $message_id));
            }
        }
        if (!$postpone) {
            if ($datacenter) {
                $this->API->datacenter->getDataCenterConnection($datacenter)->flush();
            } else {
                $this->flush();
            }
        }
    }
    /**
     * Call method and wait asynchronously for response.
     *
     * @param string                    $method Method name
     * @param array|(callable(): array) $args   Arguments
     */
    public function methodCallAsyncRead(string $method, array|callable $args)
    {
        $readFuture = $this->methodCallAsyncWrite($method, $args);
        return $readFuture->await();
    }
    /**
     * Call method and make sure it is asynchronously sent (generator).
     *
     * @param string                    $method Method name
     * @param array|(callable(): array) $args   Arguments
     */
    public function methodCallAsyncWrite(string $method, array|callable $args): WrappedFuture
    {
        $cancellation = $args['cancellation'] ?? null;
        $cancellation?->throwIfRequested();
        if (\is_array($args) && isset($args['id']['_']) && isset($args['id']['dc_id']) && ($args['id']['_'] === 'inputBotInlineMessageID' || $args['id']['_'] === 'inputBotInlineMessageID64') && $this->datacenter != $args['id']['dc_id']) {
            return $this->API->methodCallAsyncWrite($method, $args, $args['id']['dc_id']);
        }
        $file = \in_array($method, ['upload.saveFilePart', 'upload.saveBigFilePart', 'upload.getFile', 'upload.getCdnFile'], true);
        if ($file && !$this->isMedia() && $this->API->datacenter->has(-$this->datacenter)) {
            $this->API->logger('Using media DC');
            return $this->API->methodCallAsyncWrite($method, $args, -$this->datacenter);
        }
        if (\is_array($args)) {
            if (isset($args['message']) && \is_string($args['message']) && mb_strlen($args['message'], 'UTF-8') > ($this->API->getConfig())['message_length_max'] && mb_strlen($this->API->parseMode($args)['message'], 'UTF-8') > ($this->API->getConfig())['message_length_max']) {
                $postpone = $args['postpone'] ?? false;
                $peer = $args['peer'];
                $args = $this->API->splitToChunks($args);
                $promises = [];
                $queueId = $method.' '.$this->API->getId($peer);

                $promises = [];
                foreach ($args as $sub) {
                    $sub['queueId'] = $queueId;
                    $sub['postpone'] = true;
                    $promises[] = async($this->methodCallAsyncWrite(...), $method, $sub);
                }

                if (!$postpone) {
                    $this->flush();
                }
                return new WrappedFuture(async(fn () => array_map(
                    fn (WrappedFuture $f) => $f->await(),
                    await($promises)
                )));
            }
            $args = $this->API->botAPIToMTProto($args);
        }
        $methodInfo = $this->API->getTL()->getMethods()->findByMethod($method);
        if (!$methodInfo) {
            throw new Exception("Could not find method $method!");
        }
        $encrypted = $methodInfo['encrypted'];
        if (!$encrypted && $this->shared->hasTempAuthKey()) {
            $encrypted = true;
        }
        $response = new DeferredFuture;
        // Closures only used for upload.saveFilePart
        if (\is_array($args)) {
            $this->methodAbstractions($method, $args);
            if (\in_array($method, ['messages.sendEncrypted', 'messages.sendEncryptedFile', 'messages.sendEncryptedService'], true)) {
                $args['method'] = $method;
                $args = $this->API->getSecretChatController($args['peer'])->encryptSecretMessage($args, $response->getFuture());
            }
        }
        $message = new MTProtoOutgoingMessage(
            body: $args,
            constructor: $method,
            type: $methodInfo['type'],
            subtype: $methodInfo['subtype'] ?? null,
            isMethod: true,
            unencrypted: !$encrypted,
            fileRelated: $file,
            queueId: $args['queueId'] ?? null,
            floodWaitLimit: $args['floodWaitLimit'] ?? null,
            resultDeferred: $response,
            cancellation: $cancellation,
        );
        if (isset($args['madelineMsgId'])) {
            $message->setMsgId($args['madelineMsgId']);
        }
        $this->sendMessage($message, !($args['postpone'] ?? false));
        $this->checker->resume();
        return new WrappedFuture($response->getFuture());
    }
    /**
     * Send object and make sure it is asynchronously sent (generator).
     *
     * @param string $object Object name
     * @param array  $args   Arguments
     */
    public function objectCall(string $object, array $args, bool $flush = true, ?DeferredFuture $promise = null): void
    {
        $this->sendMessage(
            new MTProtoOutgoingMessage(
                body: $args,
                constructor: $object,
                type: '',
                isMethod: false,
                unencrypted: false,
                resultDeferred: $promise
            ),
            $flush
        );
    }
}
