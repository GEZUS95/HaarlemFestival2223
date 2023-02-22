<?php
require_once __DIR__ . '/../repositories/repository.php';

class SessionRepository extends Repository {
    public function getAllFromRestaurant(int $restaurantId) {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM session WHERE restaurant_id = ?');
            $stmt->bindParam('i', $restaurantId);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneById(int $id) {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM session WHERE id = ? LIMIT 1');
            $stmt->bindParam('i', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(int $restaurantId, DateTime $startTime, DateTime $endTime) {
        try {
            $stmt = $this->connection->prepare('INSERT INTO session (restaurant_id, start_time, end_time) VALUES (?, ?, ?)');
            $stmt->bindParam('i', $restaurantId);
            $stmt->bindParam('s', $startTime->format('Y-m-d H:i:s'));
            $stmt->bindParam('s', $endTime->format('Y-m-d H:i:s'));
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateOne(int $id, int $restaurantId, DateTime $startTime, DateTime $endTime) {
        try {
            $stmt = $this->connection->prepare('UPDATE session SET restaurant_id = ?, start_time = ?, end_time = ? WHERE id = ?');
            $stmt->bindParam('i', $restaurantId);
            $stmt->bindParam('s', $startTime->format('Y-m-d H:i:s'));
            $stmt->bindParam('s', $endTime->format('Y-m-d H:i:s'));
            $stmt->bindParam('i', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteOne(int $id) {
        try {
            $stmt = $this->connection->prepare('DELETE FROM session WHERE id = ?');
            $stmt->bindParam('i', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
