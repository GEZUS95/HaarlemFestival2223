<?php
use Bramus\Router\Router;
use controllers\AdminController;
use controllers\HomeController;
use controllers\LoginController;
use controllers\TestController;
use controllers\UserController;

$router = new Router();

//Home Routes
$router->get('/home', function () {
    $homeController = new HomeController();
    $homeController->index();
});
$router->get('/index', function () {
    $homeController = new HomeController();
    $homeController->index();
});
$router->get('/', function () {
    $homeController = new HomeController();
    $homeController->index();
});


//User routes
$router->get('/login', function () {
    $loginController = new LoginController();
    $loginController->login();
});
$router->post('/login', function () {
    $loginController = new LoginController();
    $loginController->loginPost();
});
$router->get('/logout', function () {
    $loginController = new LoginController();
    $loginController->logout();
});
$router->get('/register', function () {
    $userController = new UserController();
    $userController->register();
});
$router->post('/register', function () {
    $userController = new UserController();
    $userController->registerPost();
});
$router->get('/resetpassword', function () {
    $userController = new UserController();
    $userController->requestResetPassword();
});
$router->post('/resetpassword', function () {
    $userController = new UserController();
    $userController->requestResetPasswordPost();
});
$router->get('/resetpassword/{uuid}', function ($uuid) {
    $userController = new UserController();
    $userController->resetPasswordPage($uuid);
});
$router->post('/resetpassword/{uuid}', function ($uuid) {
    $userController = new UserController();
    $userController->resetPasswordPost($uuid);
});
$router->get('/user/update', function () {
    $userController = new UserController();
    $userController->showUserUpdate();
});
$router->post('/user/update/{id}', function ($id) {
    $userController = new UserController();
    $userController->userUpdate($id);
});

    //Cart Routes
    $router->get('/cart', function() {
        $controller = new controllers\CartController();
        $controller->index();
    });

    //User routes
    $router->get('/login', function() {
    $controller = new controllers\LoginController();
    $controller->index();
    });

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
    $controller = new controllers\AdminController();
    $controller->restaurants();
    });
    $router->get('/admin/restaurants/update/(\d+)', function ($restaurantId) {
        $controller = new controllers\AdminController();
        $controller->updateRestaurant($restaurantId);
    });
    $router->post('/admin/restaurants/update/(\d+)', function ($restaurantId) {
        $controller = new controllers\AdminController();
        $controller->updateRestaurantPost($restaurantId);
    });
    $router->get('/admin/newrestaurant', function() {
    $controller = new controllers\AdminController();
    $controller->newrestaurant();
    });
    $router->post('/admin/newrestaurant', function() {
    $controller = new controllers\AdminController();
    $controller->newrestaurantPost();
    });
    $router->get('/admin/restaurants/delete/(\d+)', function ($restaurantId) {
        $controller = new controllers\AdminController();
        $controller->deleteRestaurant($restaurantId);
    });
    $router->get('/admin/sessions', function() {
    $controller = new controllers\AdminController();
    $controller->sessions();
    });
    $router->get('/admin/newsession', function() {
    $controller = new controllers\AdminController();
    $controller->newsession();
    });
$router->post('/admin/newsession', function() {
    $controller = new controllers\AdminController();
    $controller->newsessionPost();
});
$router->get('/admin/sessions/update/(\d+)', function ($sessionId) {
    $controller = new controllers\AdminController();
    $controller->updateSession($sessionId);
});
$router->post('/admin/sessions/update/(\d+)', function ($sessionId) {
    $controller = new controllers\AdminController();
    $controller->updateSessionPost($sessionId);
});
$router->get('/admin/sessions/delete/(\d+)', function ($sessionId) {
    $controller = new controllers\AdminController();
    $controller->deleteSession($sessionId);
});
$router->get('/admin/reservations', function() {
    $controller = new controllers\AdminController();
    $controller->reservations();
    });
$router->get('/admin/reservations/update/(\d+)', function ($reservationId) {
    $controller = new controllers\AdminController();
    $controller->updateReservation($reservationId);
});
$router->get('/admin/newreservation', function() {
    $controller = new controllers\AdminController();
    $controller->newreservation();
});
$router->post('/admin/newreservation', function() {
    $controller = new controllers\AdminController();
    $controller->newreservationPost();
});
$router->get('/admin/locations', function() {
    $controller = new controllers\AdminController();
    $controller->locations();
});
$router->get('/admin/newlocation', function() {
    $controller = new controllers\AdminController();
    $controller->newlocation();
});
$router->post('/admin/newlocation', function() {
    $controller = new controllers\AdminController();
    $controller->newLocationPost();
});
$router->get('/admin/locations/update/(\d+)', function ($locationId) {
    $controller = new controllers\AdminController();
    $controller->updateLocation($locationId);
});
$router->post('/admin/locations/update/(\d+)', function ($locationId) {
    $controller = new controllers\AdminController();
    $controller->updateLocationPost($locationId);
});
$router->get('/admin/locations/delete/(\d+)', function ($locationId) {
    $controller = new controllers\AdminController();
    $controller->deleteLocation($locationId);
});
$router->get('/admin/artists', function() {
    $controller = new controllers\AdminController();
    $controller->artists();
});
$router->get('/admin/newartist', function() {
    $controller = new controllers\AdminController();
    $controller->newartist();
});
$router->post('/admin/newartist', function() {
    $controller = new controllers\AdminController();
    $controller->newArtistPost();
});
$router->get('/admin/artists/update/(\d+)', function ($artistId) {
    $controller = new controllers\AdminController();
    $controller->updateArtist($artistId);
});
$router->post('/admin/artists/update/(\d+)', function ($artistId) {
    $controller = new controllers\AdminController();
    $controller->updateArtistPost($artistId);
});
$router->get('/admin/artists/delete/(\d+)', function ($artistId) {
    $controller = new controllers\AdminController();
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


//Test routes
$router->get('/testInvoice', function () {                                     // Test PDF
    $testController = new TestController();
    $testController->testInvoice();
});
$router->get('/testTicket', function () {                                     // Test PDF
    $testController = new TestController();
    $testController->testTicket();
});
