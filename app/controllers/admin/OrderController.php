<?php

namespace controllers\admin;

use helpers\RedirectHelper;
use services\OrderService;
use services\UserService;

class OrderController
{
    private UserService $userService;
    private RedirectHelper $redirectHelper;
    private OrderService $orderService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->redirectHelper = new RedirectHelper();
        $this->orderService = new OrderService();

        if (
            (!$this->userService->checkPermissions("admin"))
            &&
            (!$this->userService->checkPermissions("super-admin"))
        ) {
            $this->redirectHelper->redirect('/?error=You do not have the permission to do this');
        }
    }

    public function showOrders()
    {
        $orders = $this->orderService->getAllOrders();
        require_once __DIR__ . '/../../views/admin/orders/orders.php';
    }

}
