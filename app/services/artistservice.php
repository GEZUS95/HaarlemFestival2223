<?php

namespace services;
use models\Artist;
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

    public function deleteOne(int $id){
        return $this->artistRepository->deleteOne($id);
    }

    public function postArtist(){
        $artist = new Artist();
        $artist->setName($_POST["name"]);
        $artist->setDescription($_POST["description"]);
        return $artist;
    }
}
