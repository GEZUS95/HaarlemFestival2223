<?php

$router->setNamespace('controllers');

$router->get('/admin', 'AdminController@index');

$router->get('/admin/users', 'AdminController@showUsers');
$router->get('/admin/users/update/{id}', 'AdminController@updateUser');
$router->post('/admin/users/update/{id}', 'AdminController@updateUserPost');
$router->get('/admin/users/create', 'AdminController@createUser');
$router->post('/admin/users/create', 'AdminController@createUserPost');
$router->get('/admin/users/delete/{id}', 'AdminController@deleteUser');

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

$router->get('/admin/api', 'AdminController@showApiKeys');
$router->get('/admin/api/create', 'AdminController@createApiKey');
$router->post('/admin/api/create', 'AdminController@addApiKey');
$router->get('/admin/api/delete/{uuid}', 'AdminController@deleteApiKey');
$router->get('/admin/api/email/{uuid}', 'AdminController@emailApiKey');
$router->post('/admin/api/email/{uuid}', 'AdminController@emailApiKeyPost');

$router->get('/admin/content', 'AdminController@showPages');
$router->get('/admin/content/create', 'AdminController@createPage');
$router->post('/admin/content/create', 'AdminController@addPage');
$router->get('/admin/content/update/{id}', 'AdminController@updatePage');
$router->post('/admin/content/update/{id}', 'AdminController@updatePagePost');
$router->get('/admin/content/delete/{id}', 'AdminController@deletePage');
