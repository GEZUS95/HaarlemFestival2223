<?php
// Restaurant Routes
$router->get('/restaurant/{id}', 'RestaurantController@showRestaurant');
$router->get('/reservation/{id}', 'RestaurantController@makeReservation');
$router->post('/reservation/{id}', 'RestaurantController@confirmReservation');