<?php

namespace repositories;

use models\Location;
use PDO;
use PDOException;

class LocationRepository extends Repository {
    function getAll() {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM location");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Location::class);
            return $stmt->fetchAll();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function insertOne(Location $location)
    {
        try {
            $stmt = $this->connection->prepare("
                INSERT INTO location (name, city, address, stage, seats)
                VALUES (?, ?, ?, ?, ?)");
            $name = $location->getName();
            $city = $location->getCity();
            $address = $location->getAddress();
            $stage = $location->getStage();
            $seats = $location->getSeats();
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $city);
            $stmt->bindParam(3, $address);
            $stmt->bindParam(4, $stage);
            $stmt->bindParam(5, $seats);
            $stmt->execute();
        }
        catch (PDOException $e){
            echo $e;
        }
    }
    public function updateOne(Location $location)
    {
        try {
            $stmt = $this->connection->prepare("
                UPDATE location SET name = ?, city = ?, address = ?, stage = ?, seats = ?
                WHERE id = ?");
            $name = $location->getName();
            $city = $location->getCity();
            $address = $location->getAddress();
            $stage = $location->getStage();
            $seats = $location->getSeats();
            $id = $location->getId();
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $city);
            $stmt->bindParam(3, $address);
            $stmt->bindParam(4, $stage);
            $stmt->bindParam(5, $seats);
            $stmt->bindParam(6, $id);
            $stmt->execute();
        }
        catch (PDOException $e){
            echo $e;
        }
    }

    public function deleteOne(int $id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM location WHERE id = ?");
            $stmt->bindParam(1, $id);
            $stmt->execute();
        }
        catch (PDOException $e){
            echo $e;
        }
    }

    public function getOneByName(string $name)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM location WHERE name = ? LIMIT 1");
            $stmt->bindParam(1, $name);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Location::class);
            return $stmt->fetch();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM location WHERE id = ? LIMIT 1");
            $stmt->bindParam(1, $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Location::class);
            return $stmt->fetch();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getByCity(string $city)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM location WHERE city = ?");
            $stmt->bindParam(1, $city);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Location::class);
            return $stmt->fetch();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getByStage(string $stage)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM location WHERE stage = ?");
            $stmt->bindParam(1, $stage);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Location::class);
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e;
        }
    }
}
