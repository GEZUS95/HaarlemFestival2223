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
            $stmt = $this->connection->prepare('SELECT reservation.id, reservation.session_id, reservation.remarks, reservation.status FROM reservation INNER JOIN session ON reservation.session_id = session.id WHERE session.restaurant_id = ?');
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

    public function insertOne (Reservation $reservation) {
        try {
            $stmt = $this->connection->prepare('INSERT INTO reservation (session_id, remarks, status) VALUES (?, ?, ?)');
            $session_id = $reservation->getSessionId();
            $remarks = $reservation->getRemarks();
            $status = $reservation->getStatus();
            $stmt->bindParam(1, $session_id);
            $stmt->bindParam(2, $remarks);
            $stmt->bindParam(3, $status);
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function updateOne (Reservation $reservation) {
        try {
            $stmt = $this->connection->prepare('UPDATE reservation SET session_id = ?, remarks = ?, status = ? WHERE id = ?');
            $session_id = $reservation->getSessionId();
            $remarks = $reservation->getRemarks();
            $status = $reservation->getStatus();
            $id = $reservation->getId();
            $stmt->bindParam(1, $session_id);
            $stmt->bindParam(2, $remarks);
            $stmt->bindParam(3, $status);
            $stmt->bindParam(4, $id);
            $stmt->execute();
            return $reservation->getId();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }
}
