<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Services\Notification;
interface INotificaton
{
    public function send(string $recipient, string $message): bool;
}
