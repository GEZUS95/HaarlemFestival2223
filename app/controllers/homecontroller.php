<?php

namespace controllers;

class HomeController
{

    public function index()
    {
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
