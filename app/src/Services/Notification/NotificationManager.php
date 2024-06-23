<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Services\Notification;

use Theago\BackendChallange\Utils\Utils;

class NotificationManager
{
    private int $maxRetries = 5;
    private INotificaton $notifier;

    public function __construct(INotificaton $notifier) {
        $this->notifier = $notifier;
    }

    public function sendNotification(string $recipient, string $message): bool {
        $attempt = 0;

        while ($attempt < $this->maxRetries) {
            $sent = $this->notifier->send($recipient, $message);

            if ($sent) {
                return true;
            }

            $attempt++;
            sleep(1);
        }

        $this->logFailure($recipient, $message);
        return false;
    }

    private function logFailure(string $recipient, string $message): void
    {
        Utils::logNotification("Failed to send notification to $recipient: $message");
    }
}
