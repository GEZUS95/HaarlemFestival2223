<?php

$router->setNamespace('controllers');

//Home Routes
$router->get('/', 'HomeController@index');
$router->get('/home', 'HomeController@index');
$router->get('/index', 'HomeController@index');
