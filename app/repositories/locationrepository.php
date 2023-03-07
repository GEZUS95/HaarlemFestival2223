<?php

namespace repositories;

class LocationRepository extends Repository{
    function getAll() {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM location");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Location');
            return $stmt->fetchAll();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function insertOne(Location $location)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO location ('name', 'city', 'address', 'stage', 'seats')");
            $name = $location->getName(); //todo: blijkbaar werkt het niet als deze statement direct in de bindparam zit
            $stmt->bindParam('ssssi', $name, $location->getCity(), $location->getAddress(), $location->getStage(), $location->getSeats());

            return $stmt->execute();
        }
        catch (PDOException $e){
            echo $e;
        }
    }
    public function updateOne(Location $location)
    {
        try {
            $stmt = $this->connection->prepare("
                UPDATE location 
                SET name = ?, city =?, address = ?, stage = ?, seats = ?
                WHERE id = ?");
            $name = $location->getName();
            $stmt->bindParam('ssssii', $name, $location->getCity(), $location->getAddress(), $location->getStage(), $location->getSeats(), $location->getId());
            return $stmt->execute();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }
    public function getOneByName(string $name)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM location WHERE name = ? LIMIT 1");
            $stmt->bindParam('s', $name);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Location');
            return $stmt->fetchAll();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }
    public function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM location WHERE id = ? LIMIT 1");
            $stmt->bindParam('i', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Location');
            return $stmt->fetchAll();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }
    public function getByCity(string $city)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM location WHERE city = ?");
            $stmt->bindParam('i', $city);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Location');
            return $stmt->fetchAll();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }
    public function getByStage(string $stage)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM location WHERE stage = ?");
            $stmt->bindParam('i', $stage);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Location');
            return $stmt->fetchAll();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }


}