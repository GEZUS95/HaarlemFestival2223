<?php

namespace controllers;

use services\OrderService;

class CartController
{
    private OrderService $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService();
    }


    public function index()
    {
        $order = $this->orderService->getOneOrderFromUserId($_SESSION['user']['id']);
        $orderItems = $this->orderService->getAllOrderLinesFromOrderId($order->getId());
        require __DIR__ . '/../views/cart/index.php';
    }
}
