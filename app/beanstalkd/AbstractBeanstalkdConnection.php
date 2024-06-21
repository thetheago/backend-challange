<?php

declare(strict_types=1);

namespace Theago\Beanstalkd;

use Pheanstalk\Pheanstalk;
use Pheanstalk\Values\TubeName;

abstract class AbstractBeanstalkdConnection
{
    protected Pheanstalk $queue;

    public function __construct(TubeName $tube)
    {
        $this->queue = Pheanstalk::create(host: 'beanstalkd', port: 11300);
    }
}
