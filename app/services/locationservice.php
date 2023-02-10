<?php

require __DIR__ . '/../repositories/locationrepository.php';
class LocationService
{
    private LocationRepository $REPOSITORY;
    public function __construct()
    {
        $this->REPOSITORY = new LocationRepository();
    }

    public function getAll() {
        return $this->REPOSITORY->getAll();
    }
    public function updateOne(Location $location){
        $this->REPOSITORY->updateOne($location);
    }
    public function insertOne(Location $location){
        $this->REPOSITORY->insertOne($location);
    }
    public function getOneById(int $id){
        return $this->REPOSITORY->getOneById($id);
    }
    public function getOneByName(string $name){
        return $this->REPOSITORY->getOneByName($name);
    }
    public function getByCity(string $city){
        return $this->REPOSITORY->getByCity($city);
    }
    public function getByStage(string $stage){
        return $this->REPOSITORY->getByStage($stage);
    }
}