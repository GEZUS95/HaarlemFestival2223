<?php
namespace repositories;
use models\Restaurant;
use models\Cuisine;
use PDO;
use PDOException;

class CuisineRepository extends Repository {
    public function getAll() {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM restauranttype");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Cuisine::class);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getAllForRestaurant(int $restaurant_id) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM restauranttype WHERE id IN (SELECT restaurant_type_id FROM restauranttypelink WHERE restaurant_id = ?)");
            $stmt->bindParam(1, $restaurant_id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Cuisine::class);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneById(int $id) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM restauranttype WHERE id = ? LIMIT 1");
            $stmt->bindParam('i', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Cuisine::class);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneByName(string $cuisine_name)  {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM restauranttype WHERE name = ? LIMIT 1");
            $stmt->bindParam('s', $cuisine_name);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Cuisine::class);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(Cuisine $cuisine) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO restauranttype (name) VALUES (?)");
            $stmt->bindParam('s', $cuisine->getName());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateOne(Cuisine $cuisine) {
        try {
            $stmt = $this->connection->prepare("UPDATE restauranttype SET name = ? WHERE id = ?");
            $stmt->bindParam('si', $cuisine->getName(), $cuisine->getId());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateAllForRestaurant(int $restaurantId, array $cuisines) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM restauranttypelink WHERE restaurant_id = ?");
            $stmt->bindValue(1, $restaurantId, PDO::PARAM_INT);
            $stmt->execute();
            foreach ($cuisines as $cuisine) {
                $stmt = $this->connection->prepare("INSERT INTO restauranttypelink (restaurant_id, restaurant_type_id) VALUES (?, ?)");
                $cuisineId = $cuisine;
                $stmt->bindParam(1, $restaurantId);
                $stmt->bindParam(2, $cuisineId);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteOne(Cuisine $cuisine) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM restauranttype WHERE id = ?");
            $stmt->bindParam('i', $cuisine->getId());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
