<?php
namespace controllers;
use models\Restaurant;
use services\UserService;
use services\RestaurantService;
use services\SessionService;

class AdminController
{
    private UserService $userService;
    private RestaurantService $restaurantService;
    private SessionService $sessionService;

    function __construct()
    {
        $this->userService = new UserService();
        $this->restaurantService = new RestaurantService();
        $this->sessionService = new SessionService();
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

        // Save btn
        if (isset($_POST["save-restaurant"])) {
            $this->restaurantSaveBtnClicked();
        }

        // Delete btn
        if (isset($_POST["del-restaurant"])) {
            $this->restaurantDeleteBtnClicked();
        }

        require __DIR__ . '/../views/admin/restaurants.php';
    }

    public function newrestaurant(){
        require __DIR__ . '/../views/admin/newrestaurant.php';
    }

    public function newsession(){
        $model = $this->restaurantService->getAll();
        require __DIR__ . '/../views/admin/newsession.php';
    }

    public function sessions(){
        $model = $this->sessionService->getOneById(1);// temp id!!!!!!!!
        require __DIR__ . '/../views/admin/sessions.php';
    }

    public function restaurantInsertBtnClicked()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW); // werkt niet, ander filter

        $restaurant = new Restaurant();
        $restaurant->setName($_POST["name"]);
        $restaurant->setDescription($_POST["description"]);
        $restaurant->setStars($_POST["stars"]);
        $restaurant->setSeats($_POST["seats"]);
        $restaurant->setPrice($_POST["price"]);
        $restaurant->setPriceChild($_POST["price-child"]);
        $restaurant->setAccessibility($_POST["accessibility"]);
        $restaurant->setRestaurantCuisines($_POST["cuisines"]);
        $restaurant->setLocationId($_POST["location-id"]);

        $this->restaurantService->insertOne($restaurant);

        $confirmation = "Restaurant has been saved";
    }

    private function restaurantSaveBtnClicked()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW); // werkt niet, ander filter

        $restaurant = new Restaurant();
        $restaurant->setName($_POST["name"]);
        $restaurant->setDescription($_POST["description"]);
        $restaurant->setStars($_POST["stars"]);
        $restaurant->setSeats($_POST["seats"]);
        $restaurant->setPrice($_POST["price"]);
        $restaurant->setPriceChild($_POST["price-child"]);
        $restaurant->setAccessibility($_POST["accessibility"]);
        $restaurant->setRestaurantCuisines($_POST["cuisines"]);
        $restaurant->setLocationId($_POST["location-id"]);

        $this->restaurantService->updateOne($restaurant);

        $confirmation = "Restaurant has been saved";

        header("Refresh:0");
    }

    private function restaurantDeleteBtnClicked()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW); // werkt niet, ander filter

        $this->restaurantService->deleteOne($_POST["id-restaurant"]);

        $confirmation = "Restaurant has been deleted";

        header("Refresh:0");    }
}
