<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Models;

use Exception;
use Theago\BackendChallange\Exceptions\Transfer\TransferException;
use Theago\BackendChallange\Models\AbstractModel;
use Throwable;

class TransferModel extends AbstractModel
{
     /**
     * @throws TransferException
     */
    public function transfer(UserModel $from, UserModel $to, float $value): void
    {
        try {
            $this->conn->beginTransaction();

            $stmtFrom = $this->conn->prepare('UPDATE users SET amount = :amount WHERE id = :id');
            $fromAmount = $from->getAmount() - $value;
            $fromId = $from->getId();
            $stmtFrom->bindParam(':amount', $fromAmount);
            $stmtFrom->bindParam(':id', $fromId);
            $stmtFrom->execute();

            $stmtTo = $this->conn->prepare('UPDATE users SET amount = :amount WHERE id = :id');
            $toAmount = $to->getAmount() + $value;
            $toId = $to->getId();
            $stmtTo->bindParam(':amount', $toAmount);
            $stmtTo->bindParam(':id', $toId);
            $stmtTo->execute();

            $this->conn->commit();
        } catch (Throwable $e) {
            $this->conn->rollBack();

            file_put_contents("/var/log/transferWorker.err.log", $e->getMessage(), FILE_APPEND);
            throw new TransferException();

            // TODO: Observability $e->getStackTrace();
        }
    }
}
