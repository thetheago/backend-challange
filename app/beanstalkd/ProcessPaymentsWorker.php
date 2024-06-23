<?php

declare(strict_types=1);

namespace Theago\Beanstalkd;

use Pheanstalk\Values\Job;
use Pheanstalk\Values\TubeName;
use Theago\BackendChallange\BeanstalkdJobs\Payment\PaymentAuthenticator;
use Theago\BackendChallange\Controllers\TransferController;
use Theago\BackendChallange\Exceptions\ServiceIndisponibleException;
use Theago\BackendChallange\Exceptions\Transfer\TransferException;
use Theago\BackendChallange\Models\UserModel;
use Theago\BackendChallange\Services\Notification\MailNotification;
use Theago\BackendChallange\Services\Notification\NotificationManager;
use Theago\BackendChallange\Types\TransferType;

class ProcessPaymentsWorker extends Worker
{
    public function __construct()
    {
        parent::__construct(new TubeName('payment'));
    }

    public function run(Job $job): void
    {
        $data = json_decode(json: $job->getData(), associative: true);

        try {
            $authenticated = PaymentAuthenticator::isAuthenticated();

            if ($authenticated) {
                $transferController = new TransferController();

                $transferController->transfer(
                    new TransferType(
                        value: $data['value'],
                        payer: $data['payer'],
                        payee: $data['payee']
                    )
                );
            } else {
                $this->sendPayerMail(
                    $data['payer'],
                    'Your transfer was not authorized, try again.'
                );
            }
        } catch (TransferException $e) {
            $this->sendPayerMail(
                $data['payer'],
                'Something went wrong with your transfer, try again later.'
            );

            $this->log('/var/log/exception_payment_worker.log', $e->getMessage());
        } catch (ServiceIndisponibleException $e) {
            $this->sendPayerMail(
                $data['payer'],
                'Our authenticator service is indisponible, try again later.'
            );
            $this->log('/var/log/exception_payment_worker.log', $e->getMessage());
        }

        // Poderia mandar para outro worker que tentará
        // processar a solicitação novamente em alguns segundos/minutos.
        $this->queue->delete($job);
    }

    private function sendPayerMail(int $payerId, string $message): void
    {
        $payer = (new UserModel())->findById($payerId);
        (new NotificationManager(new MailNotification()))->sendNotification(
            recipient: $payer->getEmail(),
            message: $message
        );
    }
}
