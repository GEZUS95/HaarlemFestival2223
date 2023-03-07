<?php
namespace services;
use repositories\CuisineRepository;

class CuisineService {

        private CuisineRepository $repository;

        public function __construct()
        {
            $this->repository = new CuisineRepository();
        }

        public function getAll() {
            return $this->repository->getAll();
        }

        public function getAllForRestaurant(int $restaurant_id){
            return $this->repository->getAllForRestaurant($restaurant_id);
        }

        public function getOneById(int $id){
            return $this->repository->getOneById($id);
        }

        public function getOneByName(string $name){
            return $this->repository->getOneByName($name);
        }

        public function insertOne(Cuisine $cuisine){
            $this->repository->insertOne($cuisine);
        }

        public function updateOne(Cuisine $cuisine){
            $this->repository->updateOne($cuisine);
        }

        public function deleteOne(Cuisine $cuisine){
            $this->repository->deleteOne($cuisine);
        }
}
