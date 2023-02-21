<?php
namespace controllers;

use http\Env\Request;
use services\EmailService;

class EmailController
{
    public function index()
    {
        require __DIR__ . '/../views/tests/emailtest.php';
    }
}