<?php
namespace controllers;
use models\Restaurant;
use services\UserService;
use services\RestaurantService;
use services\SessionService;
use services\CuisineService;

class AdminController
{
    private UserService $userService;
    private RestaurantService $restaurantService;
    private SessionService $sessionService;
    private CuisineService $cuisineService;

    function __construct()
    {
        $this->userService = new UserService();
        $this->restaurantService = new RestaurantService();
        $this->sessionService = new SessionService();
        $this->cuisineService = new CuisineService();
    }
    public function index(){
        require __DIR__ . '/../views/admin/index.php';
    }
    public function users(){
        $model = $this->userService->getAll();
        require __DIR__ . '/../views/admin/users.php';
    }

    public function restaurants(){
        $error = "";
        $confirmation = "";
        $model = $this->restaurantService->getAll();
        $allCuisines = $this->cuisineService->getAll();

        require __DIR__ . '/../views/admin/restaurant/restaurants.php';
    }

    public function updateRestaurantPost(int $restaurantId) {
        $restaurant = new Restaurant();
        var_dump($_POST);
        $restaurant->setName($_POST["name-restaurant"]);
        $restaurant->setDescription($_POST["description-restaurant"]);
        $restaurant->setStars($_POST["stars-restaurant"]);
        $restaurant->setSeats($_POST["seats-restaurant"]);
        $restaurant->setPrice($_POST["price-restaurant"]);
        $restaurant->setPriceChild($_POST["price-child-restaurant"]);
        $restaurant->setAccessibility($_POST["accessibility-restaurant"]);
        $restaurantCuisines = explode('', $_POST["cuisines-restaurant"]);
        $restaurant->setRestaurantCuisines($restaurantCuisines);
        $restaurant->setLocationId($_POST["location-id-restaurant"]);

        $this->restaurantService->insertOne($restaurant);

        $confirmation = "Restaurant has been saved";
    }

    public function newrestaurant(){
        require __DIR__ . '/../views/admin/restaurant/newrestaurant.php';
    }

    public function updaterestaurant(int $restaurantId){
        $model = $this->restaurantService->getOneById($restaurantId);
        require __DIR__ . '/../views/admin/restaurant/updaterestaurant.php';
    }

    public function newsession(){
        $model = $this->restaurantService->getAll();
        require __DIR__ . '/../views/admin/session/newsession.php';
    }

    public function sessions(){
        $model = $this->sessionService->getOneById(1);// temp id!!!!!!!!
        require __DIR__ . '/../views/admin/session/sessions.php';
    }

    private function restaurantDeleteBtnClicked()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW); // werkt niet, ander filter

        $this->restaurantService->deleteOne($_POST["id-restaurant"]);

        $confirmation = "Restaurant has been deleted";

        header("Refresh:0");    }
}
