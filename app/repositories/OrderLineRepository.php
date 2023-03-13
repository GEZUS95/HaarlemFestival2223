<?php

namespace repositories;

use models\OrderLine;
use PDO;
use PDOException;

class OrderLineRepository extends Repository
{
    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM orderline');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, OrderLine::class);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(string $uuid, int $orderId, int $eventId, int $programId, int $programItemId, int $sessionId)
    {
        try {
            $stmt = $this->connection->prepare("
                    INSERT INTO `orderline` (uuid, order_id, event_id, program_id, programitem_id, session_id)
                    VALUES (:uuid, :oid, :eid, :pid, :piid, :sid)
                    ");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->bindParam(':oid', $orderId);
            $stmt->bindParam(':eid', $eventId);
            $stmt->bindParam(':pid', $programId);
            $stmt->bindParam(':piid', $programItemId);
            $stmt->bindParam(':sid', $sessionId);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteOne(string $uuid)
    {
        try {
            $stmt = $this->connection->prepare("
                    DELETE FROM orderline WHERE uuid = :uuid
                    ");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneFromId(string $uuid)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM orderline WHERE uuid = :uuid LIMIT 1");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_CLASS, OrderLine::class);

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getAllFromOrderId(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM orderline WHERE order_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, OrderLine::class);

        } catch (PDOException $e) {
            echo $e;
        }
    }
}
