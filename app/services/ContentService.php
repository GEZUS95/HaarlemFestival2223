<?php

namespace services;

use repositories\ContentRepository;

class ContentService
{

    private ContentRepository $repository;

    public function __construct()
    {
        $this->repository = new ContentRepository();
    }

    public function getAll(int $limit, int $offset)
    {
        return $this->repository->getAll($limit, $offset);
    }

    public function getOneFromTitle(string $title)
    {
        return $this->repository->getOneByTitle($title);
    }

    public function getOneFromId(int $id)
    {
        return $this->repository->getOneById($id);
    }

    public function insertOne(string $title, string $body, string $image)
    {
        $this->repository->insertOne($title, $body, $image);
    }

    public function updateOne(int $id, string $title, string $body, string $image)
    {
     $this->repository->updateOne($id, $title, $body, $image);
    }

    public function deleteOne($id)
    {
        $this->repository->deleteOne($id);
    }
}
