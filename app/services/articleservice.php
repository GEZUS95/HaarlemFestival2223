<?php
namespace services;
use repositories\ArticleRepository;

class ArticleService {
    public function getAll() {
        $repository = new ArticleRepository();
        return $repository->getAll();
    }
}