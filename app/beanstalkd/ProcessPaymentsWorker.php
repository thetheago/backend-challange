<?php

declare(strict_types=1);

namespace Theago\Beanstalkd;

use Pheanstalk\Values\Job;
use Pheanstalk\Values\TubeName;
use Theago\BackendChallange\BeanstalkdJobs\Payment\PaymentAuthenticator;
use Theago\BackendChallange\Controllers\TransferController;
use Theago\BackendChallange\Exceptions\Transfer\TransferException;
use Theago\BackendChallange\Types\TransferType;

class ProcessPaymentsWorker extends Worker
{
    public function __construct()
    {
        parent::__construct(new TubeName('payment'));
    }

    public function run(Job $job): void
    {
        try {
            $authenticated = PaymentAuthenticator::isAuthenticated();
            if ($authenticated) {
                $transferController = new TransferController();
                $data = json_decode(json: $job->getData(), associative: true);

                $transferController->transfer(
                    new TransferType(
                        value: $data['value'],
                        payer: $data['payer'],
                        payee: $data['payee']
                    )
                );

                $this->queue->delete($job);
            } else {
                // Send notification of unauthorized.
            }
        } catch (TransferException $e) {
            // Send notification of error.
        }
    }
}
