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
            $stmt->setFetchMode(PDO::FETCH_CLASS, Session::class);
            $sessions = $stmt->fetchAll();
            return $sessions;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getAll() {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM session');
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Session::class);
            $sessions = $stmt->fetchAll();
            return $sessions;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneById(int $id) {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM session WHERE id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Session::class);
            $session = $stmt->fetch();
            return $session;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getAllFutureSessionsForRestaurant(int $restaurantId) {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM session WHERE restaurant_id = ? AND start_time > NOW()');
            $stmt->bindParam(1, $restaurantId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Session::class);
            $sessions = $stmt->fetchAll();
            return $sessions;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(int $restaurantId, int $programId, \DateTime $startTime, \DateTime $endTime, int $seatsLeft) {
        try {
            $stmt = $this->connection->prepare('INSERT INTO session (restaurant_id, program_id, start_time, end_time, seats_left) VALUES (?, ?, ?, ?, ?)');
            $startTime = $startTime->format('Y-m-d H:i:s');
            $endTime = $endTime->format('Y-m-d H:i:s');
            $stmt->bindParam(1, $restaurantId);
            $stmt->bindParam(2, $programId);
            $stmt->bindParam(3, $startTime);
            $stmt->bindParam(4, $endTime);
            $stmt->bindParam(5, $seatsLeft);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateOne(int $id, int $restaurantId, int $programId, \DateTime $startTime, \DateTime $endTime, int $seatsLeft) {
        try {
            $stmt = $this->connection->prepare('UPDATE session SET restaurant_id = ?, program_id = ?, start_time = ?, end_time = ?, seats_left = ? WHERE id = ?');
            $startTime = $startTime->format('Y-m-d H:i:s');
            $endTime = $endTime->format('Y-m-d H:i:s');
            $stmt->bindParam(1, $restaurantId);
            $stmt->bindParam(2, $programId);
            $stmt->bindParam(3, $startTime);
            $stmt->bindParam(4, $endTime);
            $stmt->bindParam(5, $seatsLeft);
            $stmt->bindParam(6, $id);
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
