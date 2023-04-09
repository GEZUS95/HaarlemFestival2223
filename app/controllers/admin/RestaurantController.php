<?php

namespace controllers\admin;

use helpers\RedirectHelper;
use models\Restaurant;
use services\RestaurantService;
use services\CuisineService;
use services\LocationService;
use services\UserService;

class RestaurantController {
    private RedirectHelper $redirectHelper;
    private RestaurantService $restaurantService;
    private CuisineService $cuisineService;
    private LocationService $locationService;
    private UserService $userService;

    public function __construct() {
        $this->redirectHelper = new RedirectHelper();
        $this->restaurantService = new RestaurantService();
        $this->cuisineService = new CuisineService();
        $this->locationService = new LocationService();
        $this->userService = new UserService();

        if (
            (!$this->userService->checkPermissions("admin"))
            &&
            (!$this->userService->checkPermissions("super-admin"))
        ) {
            $this->redirectHelper->redirect('/?error=You do not have the permission to do this');
        }
    }

    public function showRestaurants(){
        $model = $this->restaurantService->getAll();
        $allCuisines = $this->cuisineService->getAll();

        require_once __DIR__ . '/../../views/admin/restaurant/restaurants.php';
    }

    public function newRestaurant(){
        $cuisines = $this->cuisineService->getAll();
        $locations = $this->locationService->getAll();
        require_once __DIR__ . '/../../views/admin/restaurant/newrestaurant.php';
    }

    public function newRestaurantPost() {
        $restaurantCuisines = $this->cuisineService->postCuisines();

        $this->restaurantService->insertOne($_POST['name'], $_POST['description'], $_POST['stars'], $_POST['seats'], $_POST['price'], $_POST['price_child'], $_POST['accessibility'], $_POST['location_id']);
        $restaurant = $this->restaurantService->getOneByName($_POST['name']);
        $this->cuisineService->updateAllForRestaurant($restaurant->getId(), $restaurantCuisines);
        $this->redirectHelper->redirect("/admin/restaurants");
    }

    public function updateRestaurant(int $restaurantId){
        $restaurant = $this->restaurantService->getOneById($restaurantId);
        $cuisines = $this->cuisineService->getAll();
        $locations = $this->locationService->getAll();
        require_once __DIR__ . '/../../views/admin/restaurant/updaterestaurant.php';
    }

    public function updateRestaurantPost(int $restaurantId) {
        $restaurantCuisines = $this->cuisineService->postCuisines();

        $this->cuisineService->updateAllForRestaurant($restaurantId, $restaurantCuisines);
        $this->restaurantService->updateOne($_POST['name'], $_POST['description'], $_POST['stars'], $_POST['seats'], $_POST['price'], $_POST['price_child'], $_POST['accessibility'], $_POST['location_id'], $restaurantId);
        $this->redirectHelper->redirect("/admin/restaurants");
    }

    public function deleteRestaurant(int $restaurantId) {
        $this->restaurantService->deleteOne($restaurantId);
        $this->redirectHelper->redirect("/admin/restaurants");
    }
}
