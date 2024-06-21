<?php

declare(strict_types=1);

namespace Theago\BackendChallange\BeanstalkdJobs\Payment;

use Pheanstalk\Values\TubeName;
use Theago\BackendChallange\BeanstalkdJobs\AbstractJob;

class PaymentJob extends AbstractJob
{
    public function __construct()
    {
        parent::__construct(new TubeName('payment'));
    }
}
