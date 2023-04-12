<?php
// Event Routes
$router->get('/item/{id}', 'EventController@showProgramItem');
$router->get('/event/{id}/{program}', 'EventController@showProgram');
$router->get('/event/{id}', 'EventController@showEvent');

$router->post('/item/{id}', 'EventController@addProgramItemToCart');