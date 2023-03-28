<?php
$router->setNamespace('controllers');

$router->get('/api', 'ApiController@index');
$router->get('/api/orders', 'ApiController@getAllOrders');
$router->get('/api/reservations', 'ApiController@getAllReservations');
$router->get('/api/reservations/{id}', 'ApiController@getOneReservation');
$router->put('/api/reservations/{id}', 'ApiController@putOneReservation');

