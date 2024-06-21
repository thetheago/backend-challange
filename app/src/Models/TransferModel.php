<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Models;

use Exception;
use Theago\BackendChallange\Exceptions\Transfer\TransferException;
use Theago\BackendChallange\Models\AbstractModel;
use Throwable;

class TransferModel extends AbstractModel
{
    public function __construct()
    {
        parent::__construct();
        $this->collection = $this->database->selectCollection('users');
    }

    /**
     * @throws TransferException
     */
    public function transfer(UserModel $from, UserModel $to, float $value): void
    {
        $session = $this->client->startSession();

        try {
            $session->startTransaction();

            $this->collection->updateOne(
                ['id' => $from->getId()],
                ['$set' => ['amount' => ($from->getAmount() - $value)]],
                ['session' => $session]
            );

            $this->collection->updateOne(
                ['id' => $to->getId()],
                ['$set' => ['amount' => ($from->getAmount() + $value)]],
                ['session' => $session]
            );

            $session->commitTransaction();
        } catch (Throwable $e) {
            $session->abortTransaction();

            throw new TransferException();
            // TODO: Observability $e->getStackTrace();
        }
    }
}
