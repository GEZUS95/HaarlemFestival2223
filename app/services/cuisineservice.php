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

        public function insertOne(string $cuisineName){
            $this->repository->insertOne($cuisineName);
        }

        public function updateOne(int $id, string $cuisineName){
            $this->repository->updateOne($id, $cuisineName);
        }

        public function updateAllForRestaurant(int $restaurantId, array $cuisines) {
            $this->repository->updateAllForRestaurant($restaurantId, $cuisines);
        }

        public function deleteOne(int $id){
            $this->repository->deleteOne($id);
        }

        public function postCuisines(){
            return $_POST["cuisines"];
        }
}
