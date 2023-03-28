<?php

$router->setNamespace('controllers');

// Restaurant Routes
$router->get('/restaurant/{id}', 'RestaurantController@showRestaurant');
$router->get('/reservation/{id}', 'RestaurantController@makeReservation');
