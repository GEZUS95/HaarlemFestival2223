<?php

namespace routers;

use controllers\AdminController;

//Admin routes

$router->get('/admin', function () {                                    // Show Admin Panel
    $adminController = new AdminController();
    $adminController->index();
});
$router->get('/admin/users', function () {                              // Show All Users
    $adminController = new AdminController();
    $adminController->showUsers();
});
$router->get('/admin/users/update/(\d+)', function ($userId) {          // Update User Get
    $adminController = new AdminController();
    $adminController->updateUser($userId);
});
$router->post('/admin/users/update/(\d+)', function ($userId) {         // Update User Post
    $adminController = new AdminController();
    $adminController->updateUserPost($userId);
});
$router->get('/admin/users/create', function () {                       // Create User Get
    $adminController = new AdminController();
    $adminController->createUser();
});
$router->post('/admin/users/create', function () {                      // Create User Post
    $adminController = new AdminController();
    $adminController->createUserPost();
});
$router->get('/admin/users/delete/(\d+)', function ($userId) {          // Delete User
    $adminController = new AdminController();
    $adminController->deleteUser($userId);
});
$router->get('/admin/restaurants', function() {
    $controller = new AdminController();
    $controller->restaurants();
});
$router->get('/admin/restaurants/update/(\d+)', function ($restaurantId) {
    $controller = new AdminController();
    $controller->updateRestaurant($restaurantId);
});
$router->post('/admin/restaurants/update/(\d+)', function ($restaurantId) {
    $controller = new AdminController();
    $controller->updateRestaurantPost($restaurantId);
});
$router->get('/admin/newrestaurant', function() {
    $controller = new AdminController();
    $controller->newrestaurant();
});
$router->post('/admin/newrestaurant', function() {
    $controller = new AdminController();
    $controller->newrestaurantPost();
});
$router->get('/admin/restaurants/delete/(\d+)', function ($restaurantId) {
    $controller = new AdminController();
    $controller->deleteRestaurant($restaurantId);
});
$router->get('/admin/sessions', function() {
    $controller = new AdminController();
    $controller->sessions();
});
$router->get('/admin/newsession', function() {
    $controller = new AdminController();
    $controller->newsession();
});
$router->post('/admin/newsession', function() {
    $controller = new AdminController();
    $controller->newsessionPost();
});
$router->get('/admin/sessions/update/(\d+)', function ($sessionId) {
    $controller = new AdminController();
    $controller->updateSession($sessionId);
});
$router->post('/admin/sessions/update/(\d+)', function ($sessionId) {
    $controller = new AdminController();
    $controller->updateSessionPost($sessionId);
});
$router->get('/admin/sessions/delete/(\d+)', function ($sessionId) {
    $controller = new AdminController();
    $controller->deleteSession($sessionId);
});
$router->get('/admin/reservations', function() {
    $controller = new AdminController();
    $controller->reservations();
});
$router->get('/admin/reservations/update/(\d+)', function ($reservationId) {
    $controller = new AdminController();
    $controller->updateReservation($reservationId);
});
$router->get('/admin/newreservation', function() {
    $controller = new AdminController();
    $controller->newreservation();
});
$router->post('/admin/newreservation', function() {
    $controller = new AdminController();
    $controller->newreservationPost();
});
$router->get('/admin/locations', function() {
    $controller = new AdminController();
    $controller->locations();
});
$router->get('/admin/newlocation', function() {
    $controller = new AdminController();
    $controller->newlocation();
});
$router->post('/admin/newlocation', function() {
    $controller = new AdminController();
    $controller->newLocationPost();
});
$router->get('/admin/locations/update/(\d+)', function ($locationId) {
    $controller = new AdminController();
    $controller->updateLocation($locationId);
});
$router->post('/admin/locations/update/(\d+)', function ($locationId) {
    $controller = new AdminController();
    $controller->updateLocationPost($locationId);
});
$router->get('/admin/locations/delete/(\d+)', function ($locationId) {
    $controller = new AdminController();
    $controller->deleteLocation($locationId);
});
$router->get('/admin/artists', function() {
    $controller = new AdminController();
    $controller->artists();
});
$router->get('/admin/newartist', function() {
    $controller = new AdminController();
    $controller->newartist();
});
$router->post('/admin/newartist', function() {
    $controller = new AdminController();
    $controller->newArtistPost();
});
$router->get('/admin/artists/update/(\d+)', function ($artistId) {
    $controller = new AdminController();
    $controller->updateArtist($artistId);
});
$router->post('/admin/artists/update/(\d+)', function ($artistId) {
    $controller = new AdminController();
    $controller->updateArtistPost($artistId);
});
$router->get('/admin/artists/delete/(\d+)', function ($artistId) {
    $controller = new AdminController();
    $controller->deleteArtist($artistId);
});
$router->get('/admin/api', function () {                                // show all api keys
    $adminController = new AdminController();
    $adminController->showApiKeys();
});
$router->get('/admin/api/create', function () {                         // create api key
    $adminController = new AdminController();
    $adminController->createApiKey();
});
$router->post('/admin/api/create', function () {                        // create api key
    $adminController = new AdminController();
    $adminController->addApiKey();
});
$router->get('/admin/api/delete/{uuid}', function ($uuid) {             // delete api key
    $adminController = new AdminController();
    $adminController->deleteApiKey($uuid);
});
$router->get('/admin/api/email/{uuid}', function ($uuid) {              // email api key
    $adminController = new AdminController();
    $adminController->emailApiKey($uuid);
});
$router->post('/admin/api/email/{uuid}', function ($uuid) {             // email api key
    $adminController = new AdminController();
    $adminController->emailApiKeyPost($uuid);
});


$router->get('/admin/content', function () {                            // show all content pages
    $adminController = new AdminController();
    $adminController->showPages();
});
$router->get('/admin/content/create', function () {                     // show add content page
    $adminController = new AdminController();
    $adminController->createPage();
});
$router->post('/admin/content/create', function () {                    // add content page
    $adminController = new AdminController();
    $adminController->addPage();
});
$router->get('/admin/content/update/{id}', function ($id) {             // update content page
    $adminController = new AdminController();
    $adminController->updatePage($id);
});
$router->post('/admin/content/update/{id}', function ($id) {            // update content page
    $adminController = new AdminController();
    $adminController->updatePagePost($id);
});
$router->get('/admin/content/delete/{id}', function ($id) {             // delete content page
    $adminController = new AdminController();
    $adminController->deletePage($id);
});
