<?php

namespace controllers\admin;

use helpers\RedirectHelper;
use models\Location;
use services\LocationService;
use services\UserService;

class LocationController {

    private RedirectHelper $redirectHelper;
    private LocationService $locationService;
    private UserService $userService;

    public function __construct() {
        $this->redirectHelper = new RedirectHelper();
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

    public function showLocations(){
        $model = $this->locationService->getAll();
        require_once __DIR__ . '/../../views/admin/location/locations.php';
    }

    public function newLocation(){
        require_once __DIR__ . '/../../views/admin/location/newlocation.php';
    }

    public function newLocationPost() {
        $location = $this->locationService->postLocation($_POST);
        $this->locationService->insertOne($location);
        $this->redirectHelper->redirect("/admin/locations");
    }

    public function updateLocation(int $locationId){
        $location = $this->locationService->getOneById($locationId);
        require_once __DIR__ . '/../../views/admin/location/updatelocation.php';
    }

    public function updateLocationPost(int $locationId){
        $location = $this->locationService->postLocation($_POST);
        $location->setId($locationId);
        $this->locationService->updateOne($location);
        $this->redirectHelper->redirect("/admin/locations");
    }

    public function deleteLocation(int $locationId) {
        $this->locationService->deleteOne($locationId);
        $this->redirectHelper->redirect("/admin/locations");
    }
}
