<?php

namespace repositories;

use PDOException;

class TicketRepository extends Repository
{
    public function createTicket(string $uuid, int $orderlineId)
    {
        try {
            $stmt = $this->connection->prepare("
                    INSERT INTO `tickets` (uuid, orderline_id, used)
                    VALUES (:uuid, :orderline_id, :used)
                    ");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->bindParam(':orderline_id', $orderlineId);
            $false = 0;
            $stmt->bindParam(':used', $false);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getAllFromOrderlineId(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM tickets WHERE orderline_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
