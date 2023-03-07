<?php

namespace repositories;

use models\Artist;

class ArtistRepository extends Repository {
    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM artist');
            $stmt->execute();
            $artists = $stmt->fetchAll();
            return $artists;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM artist WHERE id = ? LIMIT 1');
            $stmt->bindParam('i', $id);
            $stmt->execute();
            $artist = $stmt->fetch();
            return $artist;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneByName(string $name)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM artist WHERE name = ? LIMIT 1');
            $stmt->bindParam('s', $name);
            $stmt->execute();
            $artist = $stmt->fetch();
            return $artist;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function insertOne(Artist $artist){
        try {
            $stmt = $this->connection->prepare('INSERT INTO artist (name, description) VALUES (?, ?)');
            $name = $artist->getName();
            $stmt->bindParam('ss', $name, $artist->getDescription());
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function updateOne(Artist $artist){
        try {
            $stmt = $this->connection->prepare('UPDATE artist SET name = ?, description = ? WHERE id = ?');
            $name = $artist->getName();
            $stmt->bindParam('si', $name, $artist->getDescription(), $artist->getId());
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function deleteOne(Artist $artist){
        try {
            $stmt = $this->connection->prepare('DELETE FROM artist WHERE id = ?');
            $id = $artist->getId();
            $stmt->bindParam('i', $id);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }
}
