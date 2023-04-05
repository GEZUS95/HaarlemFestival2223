<?php
$router->get('/admin', 'AdminController@index');


$router->get('/admin/restaurants', 'admin\RestaurantController@showRestaurants');
$router->get('/admin/restaurants/update/{id}', 'admin\RestaurantController@updateRestaurant');
$router->post('/admin/restaurants/update/{id}', 'admin\RestaurantController@updateRestaurantPost');
$router->get('/admin/newrestaurant', 'admin\RestaurantController@newRestaurant');
$router->post('/admin/newrestaurant', 'admin\RestaurantController@newRestaurantPost');
$router->get('/admin/restaurants/delete/{id}', 'admin\RestaurantController@deleteRestaurant');

$router->get('/admin/cuisines', 'admin\CuisineController@showCuisines');
$router->get('/admin/newcuisine', 'admin\CuisineController@newCuisine');
$router->post('/admin/newcuisine', 'admin\CuisineController@newCuisinePost');
$router->get('/admin/updatecuisine/{id}', 'admin\CuisineController@updateCuisine');
$router->post('/admin/updatecuisine/{id}', 'admin\CuisineController@updateCuisinePost');

$router->get('/admin/sessions', 'admin\SessionController@showSessions');
$router->get('/admin/newsession', 'admin\SessionController@newSession');
$router->post('/admin/newsession', 'admin\SessionController@newSessionPost');
$router->get('/admin/sessions/update/{id}', 'admin\SessionController@updateSession');
$router->post('/admin/sessions/update/{id}', 'admin\SessionController@updateSessionPost');
$router->get('/admin/sessions/delete/{id}', 'admin\SessionController@deleteSession');

$router->get('/admin/reservations', 'admin\ReservationController@showReservations');
$router->get('/admin/reservations/update/{id}', 'admin\ReservationController@updateReservation');
$router->get('/admin/newreservation', 'admin\ReservationController@newReservation');
$router->post('/admin/newreservation', 'admin\ReservationController@newReservationPost');

$router->get('/admin/locations', 'admin\LocationController@showLocations');
$router->get('/admin/newlocation', 'admin\LocationController@newLocation');
$router->post('/admin/newlocation', 'admin\LocationController@newLocationPost');
$router->get('/admin/locations/update/{id}', 'admin\LocationController@updateLocation');
$router->post('/admin/locations/update/{id}', 'admin\LocationController@updateLocationPost');
$router->get('/admin/locations/delete/{id}', 'admin\LocationController@deleteLocation');

$router->get('/admin/artists', 'admin\ArtistController@showArtists');
$router->get('/admin/newartist', 'admin\ArtistController@newArtist');
$router->post('/admin/newartist', 'admin\ArtistController@newArtistPost');
$router->get('/admin/artists/update/{id}', 'admin\ArtistController@updateArtist');
$router->post('/admin/artists/update/{id}', 'admin\ArtistController@updateArtistPost');
$router->get('/admin/artists/delete/{id}', 'admin\ArtistController@deleteArtist');

$router->get('/admin/events', 'admin\EventController@showEvents');
$router->get('/admin/newevent', 'admin\EventController@newEvent');
$router->post('/admin/newevent', 'admin\EventController@newEventPost');
$router->get('/admin/events/update/{id}', 'admin\EventController@updateEvent');
$router->post('/admin/events/update/{id}', 'admin\EventController@updateEventPost');
$router->get('/admin/events/delete/{id}', 'admin\EventController@deleteEvent');

$router->get('/admin/programs/{id}', 'admin\EventController@showPrograms');
$router->get('/admin/newprogram/{id}', 'admin\EventController@newProgram');
$router->post('/admin/newprogram/{id}', 'admin\EventController@newProgramPost');
$router->get('/admin/updateprogram/{id}', 'admin\EventController@updateProgram');
$router->post('/admin/updateprogram/{id}', 'admin\EventController@updateProgramPost');
$router->get('/admin/deleteprogram/{id}', 'admin\EventController@deleteProgram');

$router->get('/admin/newprogramitem/{id}', 'admin\EventController@newProgramItem');
$router->post('/admin/newprogramitem/{id}', 'admin\EventController@newProgramItemPost');
$router->get('/admin/updateprogramitem/{id}', 'admin\EventController@updateProgramItem');
$router->post('/admin/updateprogramitem/{id}', 'admin\EventController@updateProgramItemPost');
$router->get('/admin/deleteprogramitem/{id}', 'admin\EventController@deleteProgramItem');

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
$router->get('/admin/orders/csv', 'admin\OrderController@showGetCSV');
$router->post('/admin/orders/csv', 'admin\OrderController@getCSV');
$router->get('/admin/order/{id}/updatestatus', 'admin\OrderController@orderStatusUpdate');
$router->get('/admin/order/{id}/invoice', 'admin\OrderController@getInvoice');
$router->get('/admin/order/{id}', 'admin\OrderController@showOrder');
