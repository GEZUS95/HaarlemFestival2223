<?php

$router->setNamespace('controllers');

$router->get('/admin', 'AdminController@index');


$router->get('/admin/restaurants', 'AdminController@restaurants');
$router->get('/admin/restaurants/update/{id}', 'AdminController@updateRestaurant');
$router->post('/admin/restaurants/update/{id}', 'AdminController@updateRestaurantPost');
$router->get('/admin/newrestaurant', 'AdminController@newrestaurant');
$router->post('/admin/newrestaurant', 'AdminController@newrestaurantPost');
$router->get('/admin/restaurants/delete/{id}', 'AdminController@deleteRestaurant');

$router->get('/admin/sessions', 'AdminController@sessions');
$router->get('/admin/newsession', 'AdminController@newsession');
$router->post('/admin/newsession', 'AdminController@newsessionPost');
$router->get('/admin/sessions/update/{id}', 'AdminController@updateSession');
$router->post('/admin/sessions/update/{id}', 'AdminController@updateSessionPost');
$router->get('/admin/sessions/delete/{id}', 'AdminController@deleteSession');

$router->get('/admin/reservations', 'AdminController@reservations');
$router->get('/admin/reservations/update/{id}', 'AdminController@updateReservation');
$router->get('/admin/newreservation', 'AdminController@newreservation');
$router->post('/admin/newreservation', 'AdminController@newreservationPost');

$router->get('/admin/locations', 'AdminController@locations');
$router->get('/admin/newlocation', 'AdminController@newlocation');
$router->post('/admin/newlocation', 'AdminController@newLocationPost');
$router->get('/admin/locations/update/{id}', 'AdminController@updateLocation');
$router->post('/admin/locations/update/{id}', 'AdminController@updateLocationPost');
$router->get('/admin/locations/delete/{id}', 'AdminController@deleteLocation');

$router->get('/admin/artists', 'AdminController@artists');
$router->get('/admin/newartist', 'AdminController@newartist');
$router->post('/admin/newartist', 'AdminController@newArtistPost');
$router->get('/admin/artists/update/{id}', 'AdminController@updateArtist');
$router->post('/admin/artists/update/{id}', 'AdminController@updateArtistPost');
$router->get('/admin/artists/delete/{id}', 'AdminController@deleteArtist');



$router->get('/admin/users', 'admin\UserController@showUsers');
$router->get('/admin/users/update/{id}', 'admin\UserController@updateUser');
$router->post('/admin/users/update/{id}', 'admin\UserController@updateUserPost');
$router->get('/admin/users/create', 'admin\UserController@createUser');
$router->post('/admin/users/create', 'admin\UserController@createUserPost');
$router->get('/admin/users/delete/{id}', 'admin\UserController@deleteUser');

$router->get('/admin/api', 'admin\ApiController@showApiKeys');
$router->get('/admin/api/create', 'admin\ApiController@createApiKey');
$router->post('/admin/api/create', 'admin\ApiController@addApiKey');
$router->get('/admin/api/delete/{uuid}', 'admin\ApiController@deleteApiKey');
$router->get('/admin/api/email/{uuid}', 'admin\ApiController@emailApiKey');
$router->post('/admin/api/email/{uuid}', 'admin\ApiController@emailApiKeyPost');

$router->get('/admin/content', 'admin\ContentController@showPages');
$router->get('/admin/content/create', 'admin\ContentController@createPage');
$router->post('/admin/content/create', 'admin\ContentController@addPage');
$router->get('/admin/content/update/{id}', 'admin\ContentController@updatePage');
$router->post('/admin/content/update/{id}', 'admin\ContentController@updatePagePost');
$router->get('/admin/content/delete/{id}', 'admin\ContentController@deletePage');

$router->get('/admin/orders', 'admin\OrderController@showAllOrders');
$router->get('/admin/order/{id}', 'admin\OrderController@showOrder');
