<?php

namespace services;

use helpers\UuidHelper;
use repositories\OrderLineRepository;
use repositories\OrderRepository;

class OrderService
{
    private OrderRepository $orderRepository;
    private OrderLineRepository $orderLineRepository;
    private UuidHelper $uuidHelper;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->orderLineRepository = new OrderLineRepository();
        $this->uuidHelper = new UuidHelper();
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

    public function createOrder($userid)
    {
        $uuid = $this->uuidHelper->generateUUID();
        $this->orderRepository->insertOne($userid, $uuid, 'open');
    }

    public function addOrderline(int $orderId, int $eventId, int $programId, int $pItemId, int $sessionId)
    {
        $uuid = $this->uuidHelper->generateUUID();
        $this->orderLineRepository->insertOne($uuid, $orderId, $eventId, $programId, $pItemId, $sessionId);
    }

    public function updateOrderStatus(int $id, string $status)
    {
        $this->orderRepository->updateStatus($id, $status);
    }

    public function deleteOrder(int $id)
    {
        $orderlines = $this->orderLineRepository->getAllFromOrderId($id);
        foreach ($orderlines as $line) {
            $this->orderLineRepository->deleteOne($line->getUuid());
        }
        $this->orderRepository->deleteOne($id);
    }

    public function deleteOrdeLine(string $uuid)
    {
        $this->orderLineRepository->deleteOne($uuid);
    }

    public function updateOrderLineQuantity(string $uuid, int $quantity)
    {
        $this->orderLineRepository->updateOne($uuid, $quantity);
    }
}
