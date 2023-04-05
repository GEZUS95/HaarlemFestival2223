<?php

namespace controllers\admin;

use helpers\RedirectHelper;
use models\Restaurant;
use services\RestaurantService;
use services\CuisineService;
use services\LocationService;
use services\UserService;

class CuisineController {
    private RedirectHelper $redirectHelper;
    private CuisineService $cuisineService;
    private UserService $userService;

    public function __construct() {
        $this->redirectHelper = new RedirectHelper();
        $this->cuisineService = new CuisineService();
        $this->userService = new UserService();

        if (
            (!$this->userService->checkPermissions("admin"))
            &&
            (!$this->userService->checkPermissions("super-admin"))
        ) {
            $this->redirectHelper->redirect('/?error=You do not have the permission to do this');
        }
    }

    public function showCuisines() {
        $model = $this->cuisineService->getAll();
        require_once __DIR__ . '/../../views/admin/cuisine/cuisines.php';
    }

    public function newCuisine() {
        require_once __DIR__ . '/../../views/admin/cuisine/newcuisine.php';
    }

    public function newCuisinePost() {
        $this->cuisineService->insertOne($_POST['cuisinename']);
        $this->redirectHelper->redirect("/admin/cuisines");
    }

    public function updateCuisine(int $cuisineId) {
        $cuisine = $this->cuisineService->getOneById($cuisineId);
        require_once __DIR__ . '/../../views/admin/cuisine/updatecuisine.php';
    }

    public function updateCuisinePost(int $cuisineId) {
        $this->cuisineService->updateOne($cuisineId, $_POST['cuisinename']);
        $this->redirectHelper->redirect("/admin/cuisines");
    }
}

