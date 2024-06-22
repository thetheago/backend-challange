<?php

declare(strict_types=1);

namespace Theago\Beanstalkd;

use Pheanstalk\Values\Job;
use Pheanstalk\Values\TubeName;
use Theago\BackendChallange\BeanstalkdJobs\Payment\PaymentAuthenticator;
use Theago\BackendChallange\Controllers\TransferController;
use Theago\BackendChallange\Exceptions\ServiceIndisponibleException;
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
            } else {
                // Send notification of unauthorized.
                $this->log('/var/log/exception_payment_worker.log', 'Não autorizado.');
            }
        } catch (TransferException $e) {
            $this->log('/var/log/exception_payment_worker.log', $e->getMessage());
        } catch (ServiceIndisponibleException $e) {
            // Send notification of error.
            $this->log('/var/log/exception_payment_worker.log', $e->getMessage());
        }

        // Poderia mandar para outro worker que tentará
        // processar a solicitação novamente em alguns segundos/minutos.
        $this->queue->delete($job);
    }
}
