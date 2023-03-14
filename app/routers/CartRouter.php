<?php
namespace routers;

$router->setNamespace('controllers');

//Cart Routes
$router->get('/cart', 'CartController@index');
