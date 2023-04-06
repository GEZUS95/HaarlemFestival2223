<?php
//Home Routes
$router->get('/', 'HomeController@index');
$router->get('/home', 'HomeController@index');
$router->get('/index', 'HomeController@index');


$router->get('/about-haarlem', 'HomeController@about');
$router->get('/artist', 'HomeController@artist');
$router->get('/locations', 'HomeController@locations');
$router->get('/venues', 'HomeController@venues');
