<?php

namespace repositories;


use models\ProgramItem;
use PDO;
use PDOException;

class ProgramItemRepository extends Repository
{
    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM programitem');
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, ProgramItem::class);
            $programitems = $stmt->fetchAll();
            return $programitems;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getAllByProgramId(int $program_id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM programitem WHERE program_id = ?');
            $stmt->bindParam(1, $program_id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, ProgramItem::class);
            $programitems = $stmt->fetchAll();
            return $programitems;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM programitem WHERE id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, ProgramItem::class);
            $programitem = $stmt->fetch();
            return $programitem;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function insertOne(int $program_id, int $location_id, int $artist_id, int $special_guest_id, string $title, \DateTime $start_time, \DateTime $end_time, float $price, int $seats_left)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO programitem (program_id, location_id, artist_id, special_guest_id, title, start_time, end_time, price, seats_left) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $start_time = $start_time->format('Y-m-d H:i:s');
            $end_time = $end_time->format('Y-m-d H:i:s');
            $stmt->bindParam(1, $program_id);
            $stmt->bindParam(2, $location_id);
            $stmt->bindParam(3, $artist_id);
            $stmt->bindParam(4, $special_guest_id);
            $stmt->bindParam(5, $title);
            $stmt->bindParam(6, $start_time);
            $stmt->bindParam(7, $end_time);
            $stmt->bindParam(8, $price);
            $stmt->bindParam(9, $seats_left);
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function updateOne(int $id, int $program_id, int $location_id, int $artist_id, int $special_guest_id, string $title, \DateTime $start_time, \DateTime $end_time, float $price, int $seats_left)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE programitem SET program_id = ?, location_id = ?, artist_id = ?, special_guest_id = ?, title = ?, start_time = ?, end_time = ?, price = ?, seats_left = ? WHERE id = ?');
            $start_time = $start_time->format('Y-m-d H:i:s');
            $end_time = $end_time->format('Y-m-d H:i:s');
            $stmt->bindParam(1, $program_id);
            $stmt->bindParam(2, $location_id);
            $stmt->bindParam(3, $artist_id);
            $stmt->bindParam(4, $special_guest_id);
            $stmt->bindParam(5, $title);
            $stmt->bindParam(6, $start_time);
            $stmt->bindParam(7, $end_time);
            $stmt->bindParam(8, $price);
            $stmt->bindParam(9, $seats_left);
            $stmt->bindParam(10, $id);
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function deleteOne(int $id)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM programitem WHERE id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getAllByProgramTitle(int $program_id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM programitem WHERE program_id = :program_id');
            $stmt->bindParam(':program_id', $program_id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, ProgramItem::class);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
