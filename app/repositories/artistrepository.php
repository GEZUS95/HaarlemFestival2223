<?php

namespace repositories;

use models\Artist;

class ArtistRepository extends Repository {
    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM artist');
            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_CLASS, Artist::class);
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
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_CLASS, Artist::class);
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
            $stmt->bindParam(1, $name);
            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_CLASS, Artist::class);
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
            $description = $artist->getDescription();
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $description);
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
            $description = $artist->getDescription();
            $id = $artist->getId();
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $description);
            $stmt->bindParam(3, $id);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function deleteOne(int $id){
        try {
            $stmt = $this->connection->prepare('DELETE FROM artist WHERE id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }
}
