<?php
namespace services;
use repositories\RestaurantRepository;
use models\Restaurant;

class RestaurantService {

    private RestaurantRepository $repository;

    public function __construct()
    {
        $this->repository = new RestaurantRepository();
    }

    public function getAll() {
        return $this->repository->getAll();
    }

    public function getOneById(int $id){
        return $this->repository->getOneById($id);
    }

    public function getOneByName(string $name){
        return $this->repository->getOneByName($name);
    }

    public function insertOne(string $title, string $description, int $stars, int $seats, float $price, float $price_child, string $accessibility, int $location_id){
        $this->repository->insertOne($title, $description, $stars, $seats, $price, $price_child, $accessibility, $location_id);
    }

    public function updateOne(string $title, string $description, int $stars, int $seats, float $price, float $price_child, string $accessibility, int $location_id, int $id){
        $this->repository->updateOne($title, $description, $stars, $seats, $price, $price_child, $accessibility, $location_id, $id);
    }

    public function deleteOne(int $id){
        $this->repository->deleteOne($id);
    }

    public function postRestaurant(){
        $restaurant = new Restaurant();
        $restaurant->setName($_POST["name"]);
        $restaurant->setDescription($_POST["description"]);
        $restaurant->setStars($_POST["stars"]);
        $restaurant->setSeats($_POST["seats"]);
        $restaurant->setPrice($_POST["price"]);
        $restaurant->setPriceChild($_POST["price_child"]);
        $restaurant->setAccessibility($_POST["accessibility"]);
        $restaurant->setLocationId($_POST["location_id"]);
        return $restaurant;
    }
}
