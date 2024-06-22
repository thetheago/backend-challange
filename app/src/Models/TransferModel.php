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

            $updateResult1 = $this->collection->updateOne(
                ['id' => $from->getId()],
                ['$set' => ['amount' => ($from->getAmount() - $value)]],
                ['session' => $session]
            );

            $updateResult2 = $this->collection->updateOne(
                ['id' => $to->getId()],
                ['$set' => ['amount' => ($from->getAmount() + $value)]],
                ['session' => $session]
            );

            $matched1 = $updateResult1->getMatchedCount();
            $modified1 = $updateResult1->getModifiedCount();
    
            file_put_contents("/var/log/mongodbtest.log", "Matched1 ".$matched1 ."document(s)\n", FILE_APPEND);
            file_put_contents("/var/log/mongodbtest.log", "Modified1 ".$modified1 ."document(s)\n", FILE_APPEND);

            $matched2 = $updateResult2->getMatchedCount();
            $modified2 = $updateResult2->getModifiedCount();

            file_put_contents("/var/log/mongodbtest.log", "Matched2 ".$matched2 ."document(s)\n", FILE_APPEND);
            file_put_contents("/var/log/mongodbtest.log", "Modified2 ".$modified2 ."document(s)\n", FILE_APPEND);

            $session->commitTransaction();
        } catch (Throwable $e) {
            $session->abortTransaction();
            echo 'ERRO : ' . $e->getMessage();
            file_put_contents("/var/log/transferWorkerMongo.log", $e->getMessage(), FILE_APPEND);
            throw new TransferException();

            // TODO: Observability $e->getStackTrace();
        }
    }
}
