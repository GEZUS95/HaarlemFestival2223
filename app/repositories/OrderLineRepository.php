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

    public function insertOne(int $orderId, string $table, int $itemId, int $quantity, bool $child)
    {
        try {
            $stmt = $this->connection->prepare("
                    INSERT INTO `orderline` (order_id, `table`, item_id, quantity, child)
                    VALUES (:orderid, :table, :itemid, :quantity, :child)
                    ");
            $stmt->bindParam(':orderid', $orderId);
            $stmt->bindParam(':table', $table);
            $stmt->bindParam(':itemid', $itemId);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':child', $child);
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

    public function getAllOrderlinesFood(int $orderId)
    {
        try {
            $stmt = $this->connection->prepare("
                SELECT orderline.id, orderline.quantity, orderline.child,
                reservations.id, reservations.session_id, reservations.remarks, reservations.status,
                sessions.id, sessions.restaurant, sessions.start_time, sessions.end_time, sessions.seats_left,
                restaurant.id, restaurant.name, restaurant.price, restaurant.price_child
                FROM orderline
                INNER JOIN reservations ON orderline.item_id = reservations.id
                INNER JOIN sessions ON reservations.session_id = sessions.id
                INNER JOIN restaurant ON sessions.restaurant = restaurant.id
                WHERE orderline.order_id = :id
                ");
            $stmt->bindParam(':id', $orderId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getAllOrderlinesNonFood(int $orderId)
    {
        try {
            $stmt = $this->connection->prepare("
                SELECT 
                orderline.id, orderline.quantity,
                event.id, event.title, event.description,
                program.id, program.title, program.price,
                programitem.id, programitem.artist_id, programitem.special_guest_id, programitem.title,
                programitem.price, programitem.start_time, programitem.end_time, programitem.seats_left,
                location.id, location.name, location.stage,
                artist.id, artist.name, artist.description,
                specialguest.id, specialguest.name, specialguest.description
                FROM orderline
                INNER JOIN event ON program.event_id = event.id
                INNER JOIN program ON programitem.program_id = program.id
                INNER JOIN programitem ON orderline.item_id = programitem.id
                INNER JOIN location ON programitem.location_id = location.id
                INNER JOIN artist ON programitem.artist_id = artist.id
                INNER JOIN specialguest ON programitem.special_guest_id = artist.id
                WHERE orderline.order_id = :id
                ");
            $stmt->bindParam(':id', $orderId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
