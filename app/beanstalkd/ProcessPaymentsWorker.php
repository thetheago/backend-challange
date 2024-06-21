<?php

declare(strict_types=1);

namespace Theago\Beanstalkd;

use Pheanstalk\Values\Job;
use Pheanstalk\Values\TubeName;

class ProcessPaymentsWorker extends Worker
{
    public function __construct()
    {
        parent::__construct(new TubeName('payment'));
    }

    public function run(Job $job): void
    {
        // Processa o payment

        $this->queue->delete($job);
    }
}
