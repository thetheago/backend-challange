<?php

declare(strict_types=1);

namespace Theago\Tests\Unit\Controller;

use Theago\BackendChallange\Controllers\TransferController;
use Theago\BackendChallange\Exceptions\ValidationException;
use Theago\BackendChallange\Responses\JsonResponse;
use Theago\Tests\AbstractTestCase;

class TransferControllerTest extends AbstractTestCase
{
    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function testTransferWithInexistentPayer(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Payer 22 does not exist');
        $this->expectExceptionCode(400);

        $controller = new TransferController(
            [
                "value" => 100.20,
                "payer" => 22,
                "payee" => 15
            ]
        );
        $controller->post();
    }

    public function testTrasnferWithInexistentPayee(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Payee 40 does not exist');
        $this->expectExceptionCode(400);

        $controller = new TransferController(
            [
                "value" => 100.20,
                "payer" => 4,
                "payee" => 40
            ]
        );
        $controller->post();
    }

    public function testIfShopkeeperCanDoTransfer(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Shopkeepers cannot do transfers.');
        $this->expectExceptionCode(400);

        $controller = new TransferController(
            [
                "value" => 100.20,
                "payer" => 1,
                "payee" => 15
            ]
        );
        $controller->post();
    }

    public function testTransferSuccefully(): void
    {
        $payerId = 15;
        $payeeId = 1;

        $controller = new TransferController(
            [
                "value" => 50.34,
                "payer" => $payerId,
                "payee" => $payeeId
            ]
        );
        $request = $controller->post();
        $expectedResponse = new JsonResponse(status: 200, data: [
            'message' => 'Your transfer will be processed in a few seconds.'
        ]);

        $this->assertEquals($request, $expectedResponse);
    }
}
