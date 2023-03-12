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
            $stmt->setFetchMode(PDO::FETCH_CLASS, Restaurant::class);
            $restaurants = $stmt->fetchAll();
            for ($i = 0; $i < count($restaurants); $i++)
            {
                $restaurants[$i]->setRestaurantCuisines($this->cuisineRepository->getAllForRestaurant($restaurants[$i]->getId()));
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
            $stmt = $this->connection->prepare('SELECT * FROM restaurant WHERE id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Restaurant::class);
            $restaurant = $stmt->fetch();
            $restaurant->setRestaurantCuisines($this->cuisineRepository->getAllForRestaurant($id));
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
            $stmt->bindParam(1, $name);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Restaurant::class);
            $restaurant = $stmt->fetch();
            $restaurant->setRestaurantCuisines($this->cuisineRepository->getAllForRestaurant($restaurant->getId()));
            return $restaurant;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function updateOne(Restaurant $restaurant)
    {
        try {
            $stmt = $this->connection->prepare("
                UPDATE restaurant SET name = :name, location_id = :location_id, description = :description, stars = :stars, seats = :seats, price = :price, price_child = :price_child, accessibility = :accessibility WHERE id = :id");
            $name = $restaurant->getName();
            $location_id = $restaurant->getLocationId();
            $description = $restaurant->getDescription();
            $stars = $restaurant->getStars();
            $seats = $restaurant->getSeats();
            $price = $restaurant->getPrice();
            $price_child = $restaurant->getPriceChild();
            $accessibility = $restaurant->getAccessibility();
            $id = $restaurant->getId();

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':location_id', $location_id);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':stars', $stars);
            $stmt->bindParam(':seats', $seats);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':price_child', $price_child);
            $stmt->bindParam(':accessibility', $accessibility);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(Restaurant $restaurant)
    {
        try {
            $stmt = $this->connection->prepare("
                INSERT INTO restaurant (name, location_id, description, stars, seats, price, price_child, accessibility)
                VALUES (:name, :location_id, :description, :stars, :seats, :price, :price_child, :accessibility)");
            $name = $restaurant->getName();
            $location_id = $restaurant->getLocationId();
            $description = $restaurant->getDescription();
            $stars = $restaurant->getStars();
            $seats = $restaurant->getSeats();
            $price = $restaurant->getPrice();
            $price_child = $restaurant->getPriceChild();
            $accessibility = $restaurant->getAccessibility();

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':location_id', $location_id);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':stars', $stars);
            $stmt->bindParam(':seats', $seats);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':price_child', $price_child);
            $stmt->bindParam(':accessibility', $accessibility);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function deleteOne(int $id)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM restaurant WHERE id = ?');
            $stmt->bindParam(1, $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}