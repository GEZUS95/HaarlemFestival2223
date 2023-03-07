<?php

namespace services;
use repositories\ArtistRepository;

class ArtistService {
    private ArtistRepository $artistRepository;

    function __construct()
    {
        $this->artistRepository = new ArtistRepository();
    }

    public function getAll(){
        return $this->artistRepository->getAll();
    }

    public function getOneById(int $id){
        return $this->artistRepository->getOneById($id);
    }

    public function getOneByName(string $name){
        return $this->artistRepository->getOneByName($name);
    }

    public function insertOne(Artist $artist){
        return $this->artistRepository->insertOne($artist);
    }

    public function updateOne(Artist $artist){
        return $this->artistRepository->updateOne($artist);
    }

    public function deleteOne(Artist $artist){
        return $this->artistRepository->deleteOne($artist);
    }
}
