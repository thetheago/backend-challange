<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Services\Notification;

use Theago\BackendChallange\Services\Notification\INotificaton;
use Theago\BackendChallange\Utils\Utils;

class MailNotification implements INotificaton
{
    public function send(string $recipient, string $message): bool
    {
        // if ($Foo) {
            Utils::logNotification("SMS sended to $recipient: $message");
            return true;
        // }

        // return false;
    }
}
