<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Controllers;

use Theago\BackendChallange\BeanstalkdJobs\Payment\PaymentJob;
use Theago\BackendChallange\Exceptions\InvalidTypeException;
use Theago\BackendChallange\Exceptions\Routing\MissingParameterException;
use Theago\BackendChallange\Exceptions\Transfer\TransferException;
use Theago\BackendChallange\Exceptions\ValidationException;
use Theago\BackendChallange\Models\TransferModel;
use Theago\BackendChallange\Models\UserModel;
use Theago\BackendChallange\Responses\JsonResponse;
use Theago\BackendChallange\Types\TransferType;
use Theago\BackendChallange\Validators\TransferValidators\ValidateIfPayeeExists;
use Theago\BackendChallange\Validators\TransferValidators\ValidateIfPayerExists;
use Theago\BackendChallange\Validators\TransferValidators\ValidateIfPayerIsNotAShopkeeper;
use Theago\BackendChallange\Validators\TransferValidators\ValidateIfPayerHasEnoughAmount;
use Theago\BackendChallange\Validators\TypeValidators\TransferTypeValidator;

class TransferController extends AbstractController
{
    /**
     * @throws MissingParameterException
     * @throws InvalidTypeException
     * @throws ValidationException
     */
    public function post(): JsonResponse
    {
        // TODO: Dependency Injection
        (new TransferTypeValidator())->validate($this->payload);

        $transferType = new TransferType(
            value: $this->payload['value'],
            payer: $this->payload['payer'],
            payee: $this->payload['payee'],
        );

        $transferType->setPayerEntity((new UserModel())->findById($transferType->getPayer()));
        $transferType->setPayeeEntity((new UserModel())->findById($transferType->getPayee()));

        $payerExists          = new ValidateIfPayerExists();
        $payeeExists          = new ValidateIfPayeeExists();
        $isPayerShopkeeper    = new ValidateIfPayerIsNotAShopkeeper();
        $payerHasEnoughAmount = new ValidateIfPayerHasEnoughAmount();

        $payerExists->setNext($payeeExists);
        $payeeExists->setNext($isPayerShopkeeper);
        $isPayerShopkeeper->setNext($payerHasEnoughAmount);

        $isTransferValid = $payerExists->processValidation($transferType);
        if ($isTransferValid) {
            $paymentJob = new PaymentJob();
            $paymentJob->createJob([
                'value' => $transferType->getValue(),
                'payer' => $transferType->getPayer(),
                'payee' => $transferType->getPayee()
            ]);

            return new JsonResponse(status: 200, data: [
                'message' => 'Your transfer will be processed in a few seconds.'
            ]);
        }

        throw new ValidationException();
    }

    /**
     * @throws TransferException
     */
    public function transfer(TransferType $transfer): void
    {
        $payer = (new UserModel())->findById($transfer->getPayer());
        $payee = ((new UserModel())->findById($transfer->getPayee()));
        $value = $transfer->getValue();

        $transferModel = new TransferModel();
        $transferModel->transfer(from: $payer, to: $payee, value: $value);
    }
}
