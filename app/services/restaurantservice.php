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

    public function insertOne(Restaurant $restaurant){
        $this->repository->insertOne($restaurant);
    }

    public function updateOne(Restaurant $restaurant){
        $this->repository->updateOne($restaurant);
    }

    public function deleteOne(int $id){
        $this->repository->deleteOne($id);
    }
}
