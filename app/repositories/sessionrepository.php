<?php
namespace repositories;
use models\Session;
use PDO;
use PDOException;

class SessionRepository extends Repository {
    public function getAllFromRestaurant(int $restaurantId) {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM session WHERE restaurant_id = ?');
            $stmt->bindParam(1, $restaurantId);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $sessions = [];
            foreach ($result as $row) {
                $session = new Session($row['start_time'], $row['end_time']);
                $session->setId($row['id']);
                $session->setRestaurantId($row['restaurant_id']);
                $sessions[] = $session;
            }
            return $sessions;
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getAll() {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM session');
            $stmt->execute();
            $result = $stmt->fetchAll();
            $sessions = [];
            foreach ($result as $row) {
                $session = new Session($row['start_time'], $row['end_time']);
                $session->setId($row['id']);
                $session->setRestaurantId($row['restaurant_id']);
                $sessions[] = $session;
            }
            return $sessions;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function getOneById(int $id) {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM session WHERE id = ? LIMIT 1');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $result = $stmt->fetch();
            $session = new Session($result['start_time'], $result['end_time']);
            $session->setId($result['id']);
            $session->setRestaurantId($result['restaurant_id']);
            return $session;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(int $restaurantId, \DateTime $startTime, \DateTime $endTime) {
        try {
            $stmt = $this->connection->prepare('INSERT INTO session (restaurant_id, start_time, end_time) VALUES (?, ?, ?)');
            $startTimeString = $startTime->format('Y-m-d H:i:s');
            $endTimeString = $endTime->format('Y-m-d H:i:s');
            $stmt->bindParam(1, $restaurantId);
            $stmt->bindParam(2, $startTimeString);
            $stmt->bindParam(3, $endTimeString);
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateOne(int $id, int $restaurantId, \DateTime $startTime, \DateTime $endTime) {
        try {
            $stmt = $this->connection->prepare('UPDATE session SET restaurant_id = ?, start_time = ?, end_time = ? WHERE id = ?');
            $startTimeString = $startTime->format('Y-m-d H:i:s');
            $endTimeString = $endTime->format('Y-m-d H:i:s');
            $stmt->bindParam(1, $restaurantId);
            $stmt->bindParam(2, $startTimeString);
            $stmt->bindParam(3, $endTimeString);
            $stmt->bindParam(4, $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteOne(int $id) {
        try {
            $stmt = $this->connection->prepare('DELETE FROM session WHERE id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
