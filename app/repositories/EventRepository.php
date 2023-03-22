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

    public function insertOne(Event $event)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO event (session_id, title, price, description) VALUES (?, ?, ?, ?)');
            $session_id = $event->getSessionId();
            $title = $event->getTitle();
            $price = $event->getPrice();
            $description = $event->getDescription();
            $stmt->bindParam(1, $session_id);
            $stmt->bindParam(2, $title);
            $stmt->bindParam(3, $price);
            $stmt->bindParam(4, $description);
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function updateOne(Event $event)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE event SET session_id = ?, title = ?, price = ?, description = ? WHERE id = ?');
            $session_id = $event->getSessionId();
            $title = $event->getTitle();
            $price = $event->getPrice();
            $description = $event->getDescription();
            $id = $event->getId();
            $stmt->bindParam(1, $session_id);
            $stmt->bindParam(2, $title);
            $stmt->bindParam(3, $price);
            $stmt->bindParam(4, $description);
            $stmt->bindParam(5, $id);
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function deleteOne(Event $event)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM event WHERE id = ?');
            $id = $event->getId();
            $stmt->bindParam(1, $id);
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }
}
