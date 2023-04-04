<?php

namespace repositories;
use models\Event;
use PDO;
use PDOException;

class EventRepository extends Repository
{
    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM event');
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Event::class);
            $events = $stmt->fetchAll();
            return $events;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM event WHERE id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Event::class);
            $event = $stmt->fetch();
            return $event;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneByName(string $name)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM restaurant WHERE name = ? LIMIT 1');
            $stmt->bindParam(1, $name);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Event::class);
            $event = $stmt->fetch();
            return $event;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneByTitle(string $title)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM event WHERE title = ? LIMIT 1');
            $stmt->bindParam(1, $title);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Event::class);
            $event = $stmt->fetch();
            return $event;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function insertOne(string $title, string $description)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO event (title, description) VALUES (?, ?)');
            $stmt->bindParam(1, $title);
            $stmt->bindParam(2, $description);
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function updateOne(string $title, string $description, int $id)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE event SET title = ?, description = ? WHERE id = ?');
            $stmt->bindParam(1, $title);
            $stmt->bindParam(2, $description);
            $stmt->bindParam(3, $id);
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function deleteOne(int $eventId)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM event WHERE id = ?');
            $stmt->bindParam(1, $eventId);
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }
}
