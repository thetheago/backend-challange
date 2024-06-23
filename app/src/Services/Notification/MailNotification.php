<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Services\Notification;

use Theago\BackendChallange\Services\Notification\INotificaton;
use Theago\BackendChallange\Utils\Utils;

class MailNotification implements INotificaton
{
    public function send(string $recipient, string $message): bool
    {
        $ch = curl_init('https://util.devi.tools/api/v1/notify');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);

        $response = curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode == 204) {
            Utils::logNotification("Mail sended to $recipient: $message");
            return true;
        }

        return false;
    }
}
