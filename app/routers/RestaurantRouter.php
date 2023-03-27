<?php

$router->setNamespace('controllers');

// Restaurant Routes
$router->get('/restaurant/{id}', 'RestaurantController@showRestaurant');
$router->post('/reservation/{id}', 'RestaurantController@makeReservation');
