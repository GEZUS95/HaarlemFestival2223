<?php
namespace controllers;

use services\RoleService;
use models\Restaurant;
use models\Session;
use models\Cuisine;
use models\Location;
use models\Reservation;
use models\Artist;
use services\UserService;
use services\RestaurantService;
use services\SessionService;
use services\CuisineService;
use services\LocationService;
use services\ReservationService;
use services\ArtistService;
use helpers\RedirectHelper;

class AdminController
{
    private UserService $userService;
    private RestaurantService $restaurantService;
    private SessionService $sessionService;
    private CuisineService $cuisineService;
    private RoleService $roleService;
    private LocationService $locationService;
    private ReservationService $reservationService;
    private ArtistService $artistService;
    private RedirectHelper $redirectHelper;
    private $error;
    private $confirmation;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->restaurantService = new RestaurantService();
        $this->sessionService = new SessionService();
        $this->cuisineService = new CuisineService();
        $this->roleService = new RoleService();
        $this->locationService = new LocationService();
        $this->reservationService = new ReservationService();
        $this->artistService = new ArtistService();
        $this->redirectHelper = new RedirectHelper();
        if (
            (!$this->userService->checkPermissions("admin"))
            &&
            (!$this->userService->checkPermissions("super-admin"))
        ) {
            $this->userService->redirect('/?error=You do not have the permission to do this');
        }
    }

    public function index()
    {
        require_once __DIR__ . '/../views/admin/index.php';
    }

    public function users()
    {
        $model = $this->userService->getAll();
        $roles = $this->roleService->getAll();
        require_once __DIR__ . '/../views/admin/users/index.php';
    }

    public function updateUser($userId)
    {
        $user = $this->userService->getOneById($userId);
        $roles = $this->roleService->getAll();
        require_once __DIR__ . '/../views/admin/users/update.php';
    }

    public function updateUserPost($userId)
    {
        $this->userService->updateUser($userId, $_POST['name'], $_POST['email'], $_POST['role']);
    }

    public function deleteUser($userId)
    {
        $this->userService->deleteOne($userId);
    }

    public function createUser()
    {
        $roles = $this->roleService->getAll();
        require_once __DIR__ . '/../views/admin/users/create.php';
    }

    public function createUserPost()
    {
        $this->userService->createUser($_POST['name'], $_POST['email'], $_POST['role'], $_POST['password']);
    }

    public function restaurants(){
        $error = "";
        $confirmation = "";
        $model = $this->restaurantService->getAll();
        $allCuisines = $this->cuisineService->getAll();

        require __DIR__ . '/../views/admin/restaurant/restaurants.php';
    }

    public function newrestaurant(){
        $cuisines = $this->cuisineService->getAll();
        $locations = $this->locationService->getAll();
        require __DIR__ . '/../views/admin/restaurant/newrestaurant.php';
    }

    public function newRestaurantPost() {
        $restaurant = new Restaurant();
        $restaurant->setName($_POST["name"]);
        $restaurant->setDescription($_POST["description"]);
        $restaurant->setStars($_POST["stars"]);
        $restaurant->setSeats($_POST["seats"]);
        $restaurant->setPrice($_POST["price"]);
        $restaurant->setPriceChild($_POST["price_child"]);
        $restaurant->setAccessibility($_POST["accessibility"]);
        $restaurantCuisines = $_POST["cuisines"];
        $restaurant->setLocationId($_POST["location_id"]);

        $this->restaurantService->insertOne($restaurant);
        $restaurant = $this->restaurantService->getOneByName($restaurant->getName());
        $this->cuisineService->updateAllForRestaurant($restaurant->getId(), $restaurantCuisines);
        $this->redirectHelper->redirect("/admin/restaurants");
    }

    public function updaterestaurant(int $restaurantId){
        $restaurant = $this->restaurantService->getOneById($restaurantId);
        $cuisines = $this->cuisineService->getAll();
        $locations = $this->locationService->getAll();
        require __DIR__ . '/../views/admin/restaurant/updaterestaurant.php';
    }

    public function updateRestaurantPost(int $restaurantId) {
        $restaurant = new Restaurant();
        $restaurant->setId($restaurantId);
        $restaurant->setName($_POST["name"]);
        $restaurant->setDescription($_POST["description"]);
        $restaurant->setStars($_POST["stars"]);
        $restaurant->setSeats($_POST["seats"]);
        $restaurant->setPrice($_POST["price"]);
        $restaurant->setPriceChild($_POST["price_child"]);
        $restaurant->setAccessibility($_POST["accessibility"]);
        $restaurantCuisines = $_POST["cuisines"];
        $restaurant->setLocationId($_POST["location_id"]);

        $this->cuisineService->updateAllForRestaurant($restaurantId, $restaurantCuisines);
        $this->restaurantService->updateOne($restaurant);
        $this->redirectHelper->redirect("/admin/restaurants");
    }

    public function deleteRestaurant(int $restaurantId) {
        $this->restaurantService->deleteOne($restaurantId);
        $this->redirectHelper->redirect("/admin/restaurants");
    }

    public function sessions(){
        $model = $this->sessionService->getAll();
        $restaurants = $this->restaurantService->getAll();
        require __DIR__ . '/../views/admin/session/sessions.php';
    }

    public function newsession(){
        $restaurants = $this->restaurantService->getAll();
        require __DIR__ . '/../views/admin/session/newsession.php';
    }

    public function newSessionPost() {
        $restaurantId = $_POST["restaurant_id"];
        // turn string into DateTime object
        $startTime = new \DateTime($_POST["start_time"]);
        $endTime = new \DateTime($_POST["end_time"]);
        $this->sessionService->insertOne($restaurantId, $startTime, $endTime);
        $this->redirectHelper->redirect("/admin/sessions");
    }

    public function updateSession(int $sessionId){
        $session = $this->sessionService->getOneById($sessionId);
        $restaurants = $this->restaurantService->getAll();
        require __DIR__ . '/../views/admin/session/updatesession.php';
    }

    public function updateSessionPost(int $sessionId) {
        $restaurantId = $_POST["restaurant_id"];
        // turn string into DateTime object
        $startTime = new \DateTime($_POST["start_time"]);
        $endTime = new \DateTime($_POST["end_time"]);
        $session = new Session();
        $session->setId($sessionId);
        $session->setRestaurantId($restaurantId);
        $session->setStartTime($startTime);
        $session->setEndTime($endTime);
        $this->sessionService->updateOne($session);
        $this->redirectHelper->redirect("/admin/sessions");
    }

    public function deleteSession(int $sessionId) {
        $this->sessionService->deleteOne($sessionId);
        $this->redirectHelper->redirect("/admin/sessions");
    }

    public function reservations(){
        $model = $this->reservationService->getAll();
        $restaurants = $this->restaurantService->getAll();
        $sessions = $this->sessionService->getAll();
        require __DIR__ . '/../views/admin/reservation/reservations.php';
    }

    public function newreservation(){
        $restaurants = $this->restaurantService->getAll();
        $sessions = $this->sessionService->getAll();
        require __DIR__ . '/../views/admin/reservation/newreservation.php';
    }

    public function newReservationPost() {
        $reservation = new Reservation();
        $reservation->setSessionId($_POST["session_id"]);
        $reservation->setRemarks($_POST["remarks"]);
        $reservation->setStatus("active");
        $this->reservationService->insertOne($reservation);
        $this->redirectHelper->redirect("/admin/reservations");
    }

    public function updateReservation(int $reservationId){
        $reservation = $this->reservationService->getOneById($reservationId);
        if ($reservation->getStatus() == "active") {
            $reservation->setStatus("inactive");
        } else {
            $reservation->setStatus("active");
        }
        $this->reservationService->updateOne($reservation);
        $this->redirectHelper->redirect("/admin/reservations");
    }

    public function locations(){
        $model = $this->locationService->getAll();
        require __DIR__ . '/../views/admin/location/locations.php';
    }

    public function newlocation(){
        require __DIR__ . '/../views/admin/location/newlocation.php';
    }

    public function newLocationPost() {
        $location = new Location();
        $location->setName($_POST["name"]);
        $location->setCity($_POST["city"]);
        $location->setAddress($_POST["address"]);
        $location->setStage($_POST["stage"]);
        $location->setSeats($_POST["seats"]);
        $this->locationService->insertOne($location);
        $this->redirectHelper->redirect("/admin/locations");
    }

    public function updatelocation(int $locationId){
        $location = $this->locationService->getOneById($locationId);
        require __DIR__ . '/../views/admin/location/updatelocation.php';
    }

    public function updateLocationPost(int $locationId){
        $location = new Location();
        $location->setId($locationId);
        $location->setName($_POST["name"]);
        $location->setCity($_POST["city"]);
        $location->setAddress($_POST["address"]);
        $location->setStage($_POST["stage"]);
        $location->setSeats($_POST["seats"]);
        $this->locationService->updateOne($location);
        $this->redirectHelper->redirect("/admin/locations");
    }

    public function deleteLocation(int $locationId) {
        $this->locationService->deleteOne($locationId);
        $this->redirectHelper->redirect("/admin/locations");
    }

    public function artists(){
        $model = $this->artistService->getAll();
        require __DIR__ . '/../views/admin/artist/artists.php';
    }

    public function newartist(){
        require __DIR__ . '/../views/admin/artist/newartist.php';
    }

    public function newArtistPost() {
        $artist = new Artist();
        $artist->setName($_POST["name"]);
        $artist->setDescription($_POST["description"]);
        $this->artistService->insertOne($artist);
        $this->redirectHelper->redirect("/admin/artists");
    }

    public function updateArtist(int $artistId){
        $artist = $this->artistService->getOneById($artistId);
        require __DIR__ . '/../views/admin/artist/updateartist.php';
    }

    public function updateArtistPost(int $artistId){
        $artist = new Artist();
        $artist->setId($artistId);
        $artist->setName($_POST["name"]);
        $artist->setDescription($_POST["description"]);
        $this->artistService->updateOne($artist);
        $this->redirectHelper->redirect("/admin/artists");
    }

    public function deleteArtist(int $artistId) {
        $this->artistService->deleteOne($artistId);
        $this->redirectHelper->redirect("/admin/artists");
    }
}