<?php

declare(strict_types=1);

namespace Theago\Beanstalkd;

use Pheanstalk\Values\Job;
use Pheanstalk\Values\TubeName;

abstract class Worker extends AbstractBeanstalkdConnection
{
    public function __construct(TubeName $tube)
    {
        try {
            echo 'Initializing worker...' . PHP_EOL;
            parent::__construct($tube);
            $this->queue->watch($tube);
        } catch (\Exception $e) {
            echo 'Erro no watch';
//            echo $e->getMessage();
        }
    }

    public function runWorker(callable $callback): void
    {
        try {
            while ($job = $this->queue->reserve()) {
                $this->logJob($job);
                $callback($job);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    abstract public function run(Job $job): void;

    private function logJob(Job $job): void
    {
        $name = explode('\\', get_called_class());
        $logFileName = end($name);

        file_put_contents(
            filename: "/var/log/$logFileName.log",
            data: "\nJOB " . $job->getId() . " - Data: " . $job->getData(),
            flags: FILE_APPEND
        );
    }

    protected function log(string $path, string $data): void
    {
        file_put_contents(
            filename: $path,
            data: $data,
            flags: FILE_APPEND
        );
    }
}
