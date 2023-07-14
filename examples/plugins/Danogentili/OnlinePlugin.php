<?php declare(strict_types=1);

use danog\MadelineProto\EventHandler\Attributes\Cron;
use danog\MadelineProto\EventHandler\Filter\FilterCommand;
use danog\MadelineProto\EventHandler\Message;
use danog\MadelineProto\EventHandler\SimpleFilter\FromAdmin;
use danog\MadelineProto\EventHandler\SimpleFilter\Incoming;
use danog\MadelineProto\PluginEventHandler;

class OnlinePlugin extends PluginEventHandler
{
    private bool $isOnline = true;

    public function setOnline(bool $online): void
    {
        $this->isOnline = $online;
    }

    public function isPluginEnabled(): bool
    {
        // Only users can be online/offline
        return $this->getSelf()['bot'] === false;
    }

    #[Cron(period: 60.0)]
    public function cron(): void
    {
        $this->account->updateStatus(offline: !$this->isOnline);
    }

    #[FilterCommand('online')]
    public function toggleOnline(Incoming&Message&FromAdmin $message): void
    {
        $this->isOnline = true;
    }

    #[FilterCommand('offline')]
    public function toggleOffline(Incoming&Message&FromAdmin $message): void
    {
        $this->isOnline = false;
    }
}