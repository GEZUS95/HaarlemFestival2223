<?php

namespace controllers;

use services\OrderService;

class CartController
{
    private OrderService $orderService;
    private PaymentController $paymentController;

    public function __construct()
    {
        $this->orderService = new OrderService();
        $this->paymentController = new PaymentController();
    }

    public function index()
    {
        $order = $this->orderService->getOneOrderFromUserId($_SESSION['user']['id']);
        $orderItems = $this->orderService->getFullOrder($order->getId());
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

    public function payOrder(int $id)
    {
        $order = $this->orderService->getOneOrderFromId($id);
        $orderItems = $this->orderService->getFullOrder($order->getId());
        $total = 0;
        foreach ($orderItems as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $subtotal += $subtotal * 0.21;
            $total += $subtotal;
        }
        $total = number_format($total, 2, '.', '');
        $this->paymentController->pay($total, $id);
    }
}
