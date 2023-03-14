<?php
namespace services;
use models\Location;
use repositories\LocationRepository;
class LocationService
{
    private LocationRepository $repository;
    public function __construct()
    {
        $this->repository = new LocationRepository();
    }

    public function getAll() {
        return $this->repository->getAll();
    }
    public function updateOne(Location $location){
        $this->repository->updateOne($location);
    }
    public function insertOne(Location $location){
        $this->repository->insertOne($location);
    }
    public function deleteOne(int $id){
        $this->repository->deleteOne($id);
    }
    public function getOneById(int $id){
        return $this->repository->getOneById($id);
    }
    public function getOneByName(string $name){
        return $this->repository->getOneByName($name);
    }
    public function getByCity(string $city){
        return $this->repository->getByCity($city);
    }
    public function getByStage(string $stage){
        return $this->repository->getByStage($stage);
    }
}