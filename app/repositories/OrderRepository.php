<?php

namespace repositories;

use models\Order;
use PDO;
use PDOException;

class OrderRepository extends Repository
{
    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM orders');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, Order::class);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(int $userId, string $uuid, string $status)
    {
        try {
            $stmt = $this->connection->prepare("
                    INSERT INTO `orders` (user_id, share_uuid, status)
                    VALUES (:user_id, :shareUuid, :status)
                    ");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':shareUuid', $uuid);
            $stmt->bindParam(':status', $status);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteOne(int $id)
    {
        try {
            $stmt = $this->connection->prepare("
                    DELETE FROM orders WHERE id = :id
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
            $stmt = $this->connection->prepare("SELECT * FROM orders WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Order::class);
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneFromUserId(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM orders WHERE user_id = :id AND status = 'open' LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Order::class);
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateStatus(int $id, string $status)
    {
        try {
            $stmt = $this->connection->prepare("
        UPDATE orders
        SET status = :status
        WHERE id = :id");
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getItemFromDB(string $table, int $itemId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM " . $table . " WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $itemId);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateTicketsAvailable(string $table, int $itemId, int $ticketsAvailable)
    {
        try {
            $stmt = $this->connection->prepare(
                "UPDATE " . $table . "
                SET seats_left = :ticketsAvailable
                WHERE id = :id");
            $stmt->bindParam(':ticketsAvailable', $ticketsAvailable);
            $stmt->bindParam(':id', $itemId);
            $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
        }
    }
}
