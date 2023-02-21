<?php
namespace controllers;

use config;
class EmailController
{
    public function index()
    {
        require __DIR__ . '/../views/tests/emailtest.php';
    }
}