<?php

namespace repositories;

class PerformerRepository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM performer");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Performer');
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(Performer $performer)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO performer ('name', 'description')");
            $name = $performer->getName(); //todo: blijkbaar werkt het niet als deze statement direct in de bindparam zit
            $stmt->bindParam('ss', $name, $performer->getDescription());

            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM performer WHERE id = ? LIMIT 1");
            $stmt->bindParam('i', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Performer');
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneByName(string $name)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM performer WHERE name = ? LIMIT 1");
            $stmt->bindParam('s', $name);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Performer');
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateOne(Performer $performer)
    {
        try {
            $stmt = $this->connection->prepare("
                UPDATE performer 
                SET name = ?, description = ?
                WHERE id = ?");
            $name = $performer->getName();
            $stmt->bindParam('ssi', $name, $performer->getDescription(), $performer->getId());
            return $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
        }
    }


}