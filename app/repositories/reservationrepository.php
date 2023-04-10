<?php

namespace repositories;

use models\Reservation;
use PDO;
use PDOException;

class ReservationRepository extends Repository {

    public function getAll() {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM reservation');
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Reservation::class);
            return $stmt->fetchAll();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneById(int $id) {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM reservation WHERE id = ? LIMIT 1');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Reservation::class);
            return $stmt->fetch();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getAllByRestaurantId(int $id) {
        try {
            $stmt = $this->connection->prepare('SELECT reservation.id,, reservation.user_id, reservation.session_id, reservation.remarks, reservation.status FROM reservation INNER JOIN session ON reservation.session_id = session.id WHERE session.restaurant_id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Reservation::class);
            return $stmt->fetchAll();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getAllBySessionId(int $id) {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM reservation WHERE session_id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Reservation::class);
            return $stmt->fetchAll();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function insertOne (int $userId, int $sessionId, string $remarks, string $status) {
        try {
            $stmt = $this->connection->prepare('INSERT INTO reservation (user_id, session_id, remarks, status) VALUES (?, ?, ?, ?)');
            $stmt->bindParam(1, $userId);
            $stmt->bindParam(2, $sessionId);
            $stmt->bindParam(3, $remarks);
            $stmt->bindParam(4, $status);
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function updateOne (int $id, int $userId, int $sessionId, string $remarks, string $status) {
        try {
            $stmt = $this->connection->prepare('UPDATE reservation SET user_id = ?, session_id = ?, remarks = ?, status = ? WHERE id = ?');
            $stmt->bindParam(1, $userId);
            $stmt->bindParam(2, $sessionId);
            $stmt->bindParam(3, $remarks);
            $stmt->bindParam(4, $status);
            $stmt->bindParam(5, $id);
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }
}
