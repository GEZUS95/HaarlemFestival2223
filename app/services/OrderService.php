<?php

namespace services;

use helpers\RedirectHelper;
use helpers\UuidHelper;
use repositories\OrderLineRepository;
use repositories\OrderRepository;

class OrderService
{
    private OrderRepository $orderRepository;
    private OrderLineRepository $orderLineRepository;
    private UuidHelper $uuidHelper;
    private RedirectHelper $redirectHelper;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->orderLineRepository = new OrderLineRepository();
        $this->uuidHelper = new UuidHelper();
        $this->redirectHelper = new RedirectHelper();
    }

    public function getAllOrders()
    {
        return $this->orderRepository->getAll();
    }

    public function getAllOrderLines()
    {
        return $this->orderLineRepository->getAll();
    }

    public function getOneOrderFromId(int $id)
    {
        return $this->orderRepository->getOneFromId($id);
    }

    public function getAllOrderLinesFromOrderId(int $id)
    {
        return $this->orderLineRepository->getAllFromOrderId($id);
    }

    public function createOrder(int $userid)
    {
        $uuid = $this->uuidHelper->generateUUID();
        $this->orderRepository->insertOne($userid, $uuid, 'open');
    }

    public function addOrderline(int $orderId, string $table, int $itemId, int $quantity)
    {
        $this->orderLineRepository->insertOne($orderId, $table, $itemId, $quantity);
    }

    public function updateOrderStatus(int $id, string $status)
    {
        $this->orderRepository->updateStatus($id, $status);
    }

    public function deleteOrder(int $id)
    {
        $orderlines = $this->orderLineRepository->getAllFromOrderId($id);
        foreach ($orderlines as $line) {
            $this->orderLineRepository->deleteOne($line->getId());
        }
        $this->orderRepository->deleteOne($id);
    }

    public function deleteOrdeLine(int $id)
    {
        $this->orderLineRepository->deleteOne($id);
    }

    public function updateOrderLineQuantity(int $id, int $quantity)
    {
        $this->orderLineRepository->updateOne($id, $quantity);
    }

    public function updateStatus(int $id)
    {
        $order = $this->orderRepository->getOneFromId($id);
        if ($order->getStatus() === 'open') {
            $this->updateOrderStatus($id, 'paid');
            $this->redirectHelper->redirect("/admin/orders?success=Order $id has been changed to paid");
        } elseif ($order->getStatus() === 'paid') {
            $this->updateOrderStatus($id, 'open');
            $this->redirectHelper->redirect("/admin/orders?success=Order $id has been changed to open");
        } else {
            $this->redirectHelper->redirect('/admin/orders?error=There was some problem with order status');
        }
    }
}
