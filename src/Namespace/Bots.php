<?php declare(strict_types=1);
/**
 * This file is automatic generated by build_docs.php file
 * and is used only for autocomplete in multiple IDE
 * don't modify manually.
 */

namespace danog\MadelineProto\Namespace;

interface Bots
{
    /**
     * Sends a custom request; for bots only.
     *
     * @param mixed $params Any JSON-encodable data
     * @param string $custom_method The method name
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return mixed Any JSON-encodable data
     */
    public function sendCustomRequest(mixed $params, string|null $custom_method = '', ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): mixed;

    /**
     * Answers a custom query; for bots only.
     *
     * @param mixed $data Any JSON-encodable data
     * @param int $query_id Identifier of a custom query
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     */
    public function answerWebhookJSONQuery(mixed $data, int|null $query_id = 0, ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): bool;

    /**
     * Set bot command list.
     *
     * @param array{_: 'botCommandScopeDefault'}|array{_: 'botCommandScopeUsers'}|array{_: 'botCommandScopeChats'}|array{_: 'botCommandScopeChatAdmins'}|array{_: 'botCommandScopePeer', peer?: array|int|string}|array{_: 'botCommandScopePeerAdmins', peer?: array|int|string}|array{_: 'botCommandScopePeerUser', peer?: array|int|string, user_id?: array|int|string} $scope Command scope @see https://docs.madelineproto.xyz/API_docs/types/BotCommandScope.html
     * @param string $lang_code Language code
     * @param list<array{_: 'botCommand', command?: string, description?: string}>|array<never, never> $commands Array of Bot commands @see https://docs.madelineproto.xyz/API_docs/types/BotCommand.html
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     */
    public function setBotCommands(array $scope, string|null $lang_code = '', array $commands = [], ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): bool;

    /**
     * Clear bot commands for the specified bot scope and language code.
     *
     * @param array{_: 'botCommandScopeDefault'}|array{_: 'botCommandScopeUsers'}|array{_: 'botCommandScopeChats'}|array{_: 'botCommandScopeChatAdmins'}|array{_: 'botCommandScopePeer', peer?: array|int|string}|array{_: 'botCommandScopePeerAdmins', peer?: array|int|string}|array{_: 'botCommandScopePeerUser', peer?: array|int|string, user_id?: array|int|string} $scope Command scope @see https://docs.madelineproto.xyz/API_docs/types/BotCommandScope.html
     * @param string $lang_code Language code
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     */
    public function resetBotCommands(array $scope, string|null $lang_code = '', ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): bool;

    /**
     * Obtain a list of bot commands for the specified bot scope and language code.
     *
     * @param array{_: 'botCommandScopeDefault'}|array{_: 'botCommandScopeUsers'}|array{_: 'botCommandScopeChats'}|array{_: 'botCommandScopeChatAdmins'}|array{_: 'botCommandScopePeer', peer?: array|int|string}|array{_: 'botCommandScopePeerAdmins', peer?: array|int|string}|array{_: 'botCommandScopePeerUser', peer?: array|int|string, user_id?: array|int|string} $scope Command scope @see https://docs.madelineproto.xyz/API_docs/types/BotCommandScope.html
     * @param string $lang_code Language code
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return list<array{_: 'botCommand', command: string, description: string}> Array of  @see https://docs.madelineproto.xyz/API_docs/types/BotCommand.html
     */
    public function getBotCommands(array $scope, string|null $lang_code = '', ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array|null;

    /**
     * Sets the [menu button action »](https://core.telegram.org/api/bots/menu) for a given user or for all users.
     *
     * @param array{_: 'botMenuButtonDefault'}|array{_: 'botMenuButtonCommands'}|array{_: 'botMenuButton', text?: string, url?: string} $button Bot menu button action @see https://docs.madelineproto.xyz/API_docs/types/BotMenuButton.html
     * @param array|int|string $user_id User ID @see https://docs.madelineproto.xyz/API_docs/types/InputUser.html
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     */
    public function setBotMenuButton(array $button, array|int|string|null $user_id = null, ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): bool;

    /**
     * Gets the menu button action for a given user or for all users, previously set using [bots.setBotMenuButton](https://docs.madelineproto.xyz/API_docs/methods/bots.setBotMenuButton.html); users can see this information in the [botInfo](https://docs.madelineproto.xyz/API_docs/constructors/botInfo.html) constructor.
     *
     * @param array|int|string $user_id User ID or empty for the default menu button. @see https://docs.madelineproto.xyz/API_docs/types/InputUser.html
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return array{_: 'botMenuButtonDefault'}|array{_: 'botMenuButtonCommands'}|array{_: 'botMenuButton', text: string, url: string} @see https://docs.madelineproto.xyz/API_docs/types/BotMenuButton.html
     */
    public function getBotMenuButton(array|int|string|null $user_id = null, ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array;

    /**
     * Set the default [suggested admin rights](https://core.telegram.org/api/rights#suggested-bot-rights) for bots being added as admins to channels, see [here for more info on how to handle them »](https://core.telegram.org/api/rights#suggested-bot-rights).
     *
     * @param array{_: 'chatAdminRights', change_info?: bool, post_messages?: bool, edit_messages?: bool, delete_messages?: bool, ban_users?: bool, invite_users?: bool, pin_messages?: bool, add_admins?: bool, anonymous?: bool, manage_call?: bool, other?: bool, manage_topics?: bool, post_stories?: bool, edit_stories?: bool, delete_stories?: bool} $admin_rights Admin rights @see https://docs.madelineproto.xyz/API_docs/types/ChatAdminRights.html
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     */
    public function setBotBroadcastDefaultAdminRights(array $admin_rights, ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): bool;

    /**
     * Set the default [suggested admin rights](https://core.telegram.org/api/rights#suggested-bot-rights) for bots being added as admins to groups, see [here for more info on how to handle them »](https://core.telegram.org/api/rights#suggested-bot-rights).
     *
     * @param array{_: 'chatAdminRights', change_info?: bool, post_messages?: bool, edit_messages?: bool, delete_messages?: bool, ban_users?: bool, invite_users?: bool, pin_messages?: bool, add_admins?: bool, anonymous?: bool, manage_call?: bool, other?: bool, manage_topics?: bool, post_stories?: bool, edit_stories?: bool, delete_stories?: bool} $admin_rights Admin rights @see https://docs.madelineproto.xyz/API_docs/types/ChatAdminRights.html
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     */
    public function setBotGroupDefaultAdminRights(array $admin_rights, ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): bool;

    /**
     * Set localized name, about text and description of a bot (or of the current account, if called by a bot).
     *
     * @param array|int|string $bot If called by a user, **must** contain the peer of a bot we own. @see https://docs.madelineproto.xyz/API_docs/types/InputUser.html
     * @param string $lang_code Language code, if left empty update the fallback about text and description
     * @param string $name New bot name
     * @param string $about New about text
     * @param string $description New description
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     */
    public function setBotInfo(array|int|string|null $bot = null, string|null $lang_code = '', string|null $name = '', string|null $about = '', string|null $description = '', ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): bool;

    /**
     * Get localized name, about text and description of a bot (or of the current account, if called by a bot).
     *
     * @param array|int|string $bot If called by a user, **must** contain the peer of a bot we own. @see https://docs.madelineproto.xyz/API_docs/types/InputUser.html
     * @param string $lang_code Language code, if left empty this method will return the fallback about text and description.
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return array{_: 'bots.botInfo', name: string, about: string, description: string} @see https://docs.madelineproto.xyz/API_docs/types/bots.BotInfo.html
     */
    public function getBotInfo(array|int|string|null $bot = null, string|null $lang_code = '', ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array;

    /**
     * Reorder usernames associated to a bot we own.
     *
     * @param array|int|string $bot The bot @see https://docs.madelineproto.xyz/API_docs/types/InputUser.html
     * @param list<string>|array<never, never> $order The new order for active usernames. All active usernames must be specified.
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     */
    public function reorderUsernames(array|int|string|null $bot = null, array $order = [], ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): bool;

    /**
     * Activate or deactivate a purchased [fragment.com](https://fragment.com) username associated to a bot we own.
     *
     * @param bool $active Whether to activate or deactivate it
     * @param array|int|string $bot The bot @see https://docs.madelineproto.xyz/API_docs/types/InputUser.html
     * @param string $username Username
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     */
    public function toggleUsername(bool $active, array|int|string|null $bot = null, string|null $username = '', ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): bool;

    /**
     *
     *
     * @param array|int|string $bot @see https://docs.madelineproto.xyz/API_docs/types/InputUser.html
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     */
    public function canSendMessage(array|int|string|null $bot = null, ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): bool;

    /**
     *
     *
     * @param array|int|string $bot @see https://docs.madelineproto.xyz/API_docs/types/InputUser.html
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return array @see https://docs.madelineproto.xyz/API_docs/types/Updates.html
     */
    public function allowSendMessage(array|int|string|null $bot = null, ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array;

    /**
     *
     *
     * @param mixed $params Any JSON-encodable data
     * @param array|int|string $bot @see https://docs.madelineproto.xyz/API_docs/types/InputUser.html
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param bool $postpone If true, will postpone execution of this method until the first method call with $postpone = false, bundling all queued in a single container for higher efficiency. Will not return until the method is queued and a response is received, so this should be used in combination with \Amp\async.
     * @param ?string $queueId Usually, concurrent method calls are executed in arbitrary order: with this option, strict ordering can be enforced by specifying the same queue ID for all methods that require strictly ordered execution.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return mixed Any JSON-encodable data
     */
    public function invokeWebViewCustomMethod(mixed $params, array|int|string|null $bot = null, string|null $custom_method = '', ?int $floodWaitLimit = null, bool $postpone = false, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): mixed;
}
