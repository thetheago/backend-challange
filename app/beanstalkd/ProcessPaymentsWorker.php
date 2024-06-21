<?php

declare(strict_types=1);

namespace Theago\Beanstalkd;

use Pheanstalk\Values\Job;
use Pheanstalk\Values\TubeName;
use Theago\BackendChallange\BeanstalkdJobs\Payment\PaymentAuthenticator;

class ProcessPaymentsWorker extends Worker
{
    public function __construct()
    {
        parent::__construct(new TubeName('payment'));
    }

    public function run(Job $job): void
    {
        $authenticated = PaymentAuthenticator::isAuthenticated();
        if ($authenticated) {
            // Process Transaction DB Operation
        } else {
            // Send notification of unauthorized.
        }
        $this->queue->delete($job);
    }
}
