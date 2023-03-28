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
        $restaurant = $this->restaurantService->postRestaurant($_POST);
        $restaurantCuisines = $this->cuisineService->postCuisines($_POST);

        $this->restaurantService->insertOne($restaurant);
        $restaurant = $this->restaurantService->getOneByName($restaurant->getName());
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
        $restaurant = $this->restaurantService->postRestaurant($_POST);
        $restaurantCuisines = $this->cuisineService->postCuisines($_POST);

        $this->cuisineService->updateAllForRestaurant($restaurantId, $restaurantCuisines);
        $this->restaurantService->updateOne($restaurant);
        $this->redirectHelper->redirect("/admin/restaurants");
    }

    public function deleteRestaurant(int $restaurantId) {
        $this->restaurantService->deleteOne($restaurantId);
        $this->redirectHelper->redirect("/admin/restaurants");
    }
}
