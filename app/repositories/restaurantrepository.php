<?php
namespace repositories;
use repositories\CuisineRepository;
use models\Restaurant;
use models\Cuisine;
use PDO;
use PDOException;

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
            for ($i = 0; $i < count($restaurants); $i++)
            {
                $restaurants[$i]['cuisines'] = $this->cuisineRepository->getAllForRestaurant($restaurants[$i]['id']);
            }
            //var_dump($restaurants);
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
                INSERT INTO restaurant (name, location_id, description, stars, seats, price, price_child, accessibility)" .
                "VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $name = $restaurant->getName();
            $stmt->bindParam('sisiiss', $name, $restaurant->getLocationId(), $restaurant->getDescription(), $restaurant->getStars(), $restaurant->getSeats(), $restaurant->getPrice(), $restaurant->getPriceChild(), $restaurant->getAccessibility());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateOne(Restaurant $restaurant)
    {
        try {
            $stmt = $this->connection->prepare("
                UPDATE restaurant SET name = ?, location_id = ?, description = ?, stars = ?, seats = ?, price = ?, price_child = ?, accessibility = ? WHERE id = ?");
            $name = $restaurant->getName();
            $stmt->bindParam('sisiiissi', $name, $restaurant->getLocationId(), $restaurant->getDescription(), $restaurant->getStars(), $restaurant->getSeats(), $restaurant->getPrice(), $restaurant->getPriceChild(), $restaurant->getAccessibility(), $restaurant->getId());
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