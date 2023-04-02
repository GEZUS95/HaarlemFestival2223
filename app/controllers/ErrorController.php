<?php

namespace controllers;

class ErrorController
{
    public function pageNotFound(){
        require __DIR__ . '/../views/error/pageNotFound.php';
    }
}