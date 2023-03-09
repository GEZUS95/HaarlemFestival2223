<?php

namespace controllers;

use services\ContentService;

class HomeController
{

    private ContentService $contentService;

    public function __construct()
    {
        $this->contentService = new ContentService();
    }

    public function index()
    {
        //$page = $this->contentService->getOneFromTitle('home');
        require_once __DIR__ . '/../views/home/index.php';
    }

    public function about()
    {
        require_once __DIR__ . '/../views/home/about.php';
    }
    public function login()
    {
        require_once __DIR__ . '/../views/home/login.php';
    }
}
