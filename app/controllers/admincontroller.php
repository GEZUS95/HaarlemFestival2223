<?php
require_once __DIR__ . '/../services/userservice.php';
require_once __DIR__ . '/../services/restaurantservice.php';
require_once __DIR__ . '/../services/sessionservice.php';

class AdminController
{
    private $userService;
    private $restaurantService;
    private $sessionService;

    function __construct()
    {
        $this->userService = new UserService();
        $this->restaurantService = new RestaurantService();
        //$this->sessionService = new SessionService();
    }
    public function index(){
        require __DIR__ . '/../views/admin/index.php';
    }
    public function users(){
        $model = $this->userService->getAll();
        require __DIR__ . '/../views/admin/users.php';
    }

    public function restaurants(){
        $model = $this->restaurantService->getAll();
        require __DIR__ . '/../views/admin/restaurants.php';
    }

    public function sessions(){
        //$model = $this->sessionService->getOneById(1);// temp id!!!!!!!!
        //require __DIR__ . '/../views/admin/sessions.php';
    }
}
