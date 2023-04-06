<?php
// Event Routes
$router->get('/event/{id}/{program}', 'EventController@showProgram');
$router->get('/event/{id}', 'EventController@showEvent');

$router->post('/event/{id}', 'EventController@addProgramItemToCart');
