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
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // gets all for restaurant, uses table restauranttypelink with a restaurant_id and restauranttype_id, and table restauranttype with id and cuisine_name
    public function getAllForRestaurant(int $restaurant_id) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM restauranttype WHERE id IN (SELECT restaurant_type_id FROM restauranttypelink WHERE restaurant_id = ?)");
            $stmt->bindParam(1, $restaurant_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneById(int $id) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM cuisine WHERE id = ? LIMIT 1");
            $stmt->bindParam('i', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneByName(string $cuisine_name)  {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM cuisine WHERE name = ? LIMIT 1");
            $stmt->bindParam('s', $cuisine_name);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(Cuisine $cuisine) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO cuisine (name) VALUES (?)");
            $stmt->bindParam('s', $cuisine->getName());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateOne(Cuisine $cuisine) {
        try {
            $stmt = $this->connection->prepare("UPDATE cuisine SET name = ? WHERE id = ?");
            $stmt->bindParam('si', $cuisine->getName(), $cuisine->getId());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteOne(Cuisine $cuisine) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM cuisine WHERE id = ?");
            $stmt->bindParam('i', $cuisine->getId());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
