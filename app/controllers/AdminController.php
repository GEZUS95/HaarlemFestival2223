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








}