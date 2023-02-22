<?php
require __DIR__ . '/../services/userservice.php';

namespace controllers;
use services\UserService;

class AdminController
{
    private UserService $userService;

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
