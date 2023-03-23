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

    public function insertOne(int $orderId, string $table, int $itemId, int $quantity)
    {
        try {
            $stmt = $this->connection->prepare("
                    INSERT INTO `orderline` (order_id, `table`, item_id, quantity)
                    VALUES (:orderid, :table, :itemid, :quantity)
                    ");
            $stmt->bindParam(':orderid', $orderId);
            $stmt->bindParam(':table', $table);
            $stmt->bindParam(':itemid', $itemId);
            $stmt->bindParam(':quantity', $quantity);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteOne(int $id)
    {
        try {
            $stmt = $this->connection->prepare("
                    DELETE FROM orderline WHERE id = :id
                    ");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneFromId(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM orderline WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
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

    public function updateOne(int $id, int $quantity)
    {
        try {
            $stmt = $this->connection->prepare("
                UPDATE orderline
                SET quantity = :quantity
                WHERE id = :id");
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
        }
    }
}
