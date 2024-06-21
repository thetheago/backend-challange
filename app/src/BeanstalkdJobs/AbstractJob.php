<?php

declare(strict_types=1);

namespace Theago\BackendChallange\BeanstalkdJobs;

use Pheanstalk\Values\TubeName;
use Theago\Beanstalkd\AbstractBeanstalkdConnection;

abstract class AbstractJob extends AbstractBeanstalkdConnection
{
    public function __construct(TubeName $tube)
    {
        parent::__construct($tube);
        $this->queue->useTube($tube);
    }

    public function createJob(array $data): void
    {
        $this->queue->put(json_encode($data));
    }
}
