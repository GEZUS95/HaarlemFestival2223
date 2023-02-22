<?php
require_once __DIR__ . '/../repositories/repository.php';
require_once __DIR__ . '/../repositories/cuisinerepository.php';
require_once __DIR__ . '/../models/restaurant.php';
require_once __DIR__ . '/../models/cuisine.php';
class RestaurantRepository extends Repository
{
    private CuisineRepository $cuisineRepository;

    public function __construct()
    {
        parent::__construct();
        $this->cuisineRepository = new CuisineRepository();
    }
    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM restaurant');
            $stmt->execute();
            $restaurants = $stmt->fetchAll();
            foreach ($restaurants as &$restaurant) {
                $restaurant['cuisines'] = $this->cuisineRepository->getAllForRestaurant($restaurant['id']);
            }
            return $restaurants;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM restaurant WHERE id = ? LIMIT 1');
            $stmt->bindParam('i', $id);
            $stmt->execute();
            $restaurant = $stmt->fetch();
            $restaurant['cuisines'] = $this->cuisineRepository->getAllForRestaurant($id);
            return $restaurant;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneByName(string $name)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM restaurant WHERE name = ? LIMIT 1');
            $stmt->bindParam('s', $name);
            $stmt->execute();
            $restaurant = $stmt->fetch();
            $restaurant['cuisines'] = $this->cuisineRepository->getAllForRestaurant($restaurant['id']);
            return $restaurant;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function insertOne(Restaurant $restaurant)
    {
        try {
            $stmt = $this->connection->prepare("
                INSERT INTO restaurant (name, location_id, description, stars, seats, price, price_child, session_time, accessibility)" .
                "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            // todo: werkt niet, fixen
            $stmt->bindParam('s', $restaurant->getName());
            $stmt->bindParam('i', $restaurant->getLocationId());
            $stmt->bindParam('s', $restaurant->getDescription());
            $stmt->bindParam('i', $restaurant->getStars());
            $stmt->bindParam('i', $restaurant->getSeats());
            $stmt->bindParam('d', $restaurant->getPrice());
            $stmt->bindParam('d', $restaurant->getPriceChild());
            $stmt->bindParam('s', $restaurant->getSessionTime());
            $stmt->bindParam('s', $restaurant->getAccessibility());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateOne(Restaurant $restaurant)
    {
        try {
            $stmt = $this->connection->prepare("
                UPDATE restaurant SET name = ?, location_id = ?, description = ?, stars = ?, seats = ?, price = ?, price_child = ?, session_time = ?, accessibility = ? WHERE id = ?");
            $stmt->bindParam('s', $restaurant->getName());
            $stmt->bindParam('i', $restaurant->getLocationId());
            $stmt->bindParam('s', $restaurant->getDescription());
            $stmt->bindParam('i', $restaurant->getStars());
            $stmt->bindParam('i', $restaurant->getSeats());
            $stmt->bindParam('d', $restaurant->getPrice());
            $stmt->bindParam('d', $restaurant->getPriceChild());
            $stmt->bindParam('s', $restaurant->getSessionTime());
            $stmt->bindParam('s', $restaurant->getAccessibility());
            $stmt->bindParam('i', $restaurant->getId());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteOne(int $id)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM restaurant WHERE id = ?');
            $stmt->bindParam('i', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}