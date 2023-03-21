<?php

namespace controllers;

use helpers\RedirectHelper;
use services\OrderService;

class CartController
{
    private OrderService $orderService;
    private RedirectHelper $redirectHelper;

    public function __construct()
    {
        $this->orderService = new OrderService();
        $this->redirectHelper = new RedirectHelper();
    }


    public function index()
    {
        $order = $this->orderService->getOneOrderFromUserId($_SESSION['user']['id']);
        $orderItems = $this->orderService->getAllOrderLinesFromOrderId($order->getId());
        require __DIR__ . '/../views/cart/index.php';
    }

    public function deleteItem(int $itemId)
    {
        $this->orderService->deleteOrdeLine($itemId);
    }

    public function updateQuantity(int $itemId)
    {
        $this->orderService->updateOrderLineQuantity($itemId, $_POST['quantity']);
    }
}
