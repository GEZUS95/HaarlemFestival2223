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

    public function insertOne(string $uuid, int $oId, int $eId, int $pId, int $pIId, int $sId, int $quantity)
    {
        try {
            $stmt = $this->connection->prepare("
                    INSERT INTO `orderline` (uuid, order_id, event_id, program_id, programitem_id, session_id, quantity)
                    VALUES (:uuid, :oid, :eid, :pid, :piid, :sid, :quantity)
                    ");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->bindParam(':oid', $oId);
            $stmt->bindParam(':eid', $eId);
            $stmt->bindParam(':pid', $pId);
            $stmt->bindParam(':piid', $pIId);
            $stmt->bindParam(':sid', $sId);
            $stmt->bindParam(':quantity', $quantity);
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
            $stmt->setFetchMode(PDO::FETCH_CLASS, OrderLine::class);
            return $stmt->fetch();

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

    public function updateOne(string $uuid, int $quantity)
    {
        try {
            $stmt = $this->connection->prepare("
                UPDATE orderline
                SET quantity = :quantity
                WHERE uuid = :id");
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':id', $uuid);
            $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
        }
    }
}
