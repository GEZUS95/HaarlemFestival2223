<?php

namespace services;

use helpers\RedirectHelper;
use helpers\UuidHelper;
use repositories\OrderLineRepository;
use repositories\OrderRepository;
use repositories\TicketRepository;

class TicketService
{
    private TicketRepository $ticketRepository;
    private OrderLineRepository $orderLineRepository;
    private UuidHelper $uuidHelper;
    private RedirectHelper $redirectHelper;
    private OrderRepository $orderRepository;

    public function __construct()
    {
        $this->ticketRepository = new TicketRepository();
        $this->orderLineRepository = new OrderLineRepository();
        $this->uuidHelper = new UuidHelper();
        $this->redirectHelper = new RedirectHelper();
        $this->orderRepository = new OrderRepository();
    }

    public function generateTickets($orderId)
    {
        $orderlines = $this->orderLineRepository->getAllFromOrderId($orderId);

        foreach ($orderlines as $item) {
            for ($i = 0; $i < $item->getQuantity(); $i++) {
                $uuid = $this->uuidHelper->generateUUID();
                $this->ticketRepository->createTicket($uuid, $item->getId());
            }
        }
    }

    public function getAllTickets(int $id)
    {
        return $this->ticketRepository->getAllFromOrderlineId($id);
    }

    public function ticketsAvailable(string $table, int $id, int $quantity)
    {
        $item = $this->orderRepository->getItemFromDB($table, $id);
        $ticketsAvailable = $item['seats_left'];
        if (!$ticketsAvailable >= $quantity) {
            $this->redirectHelper->redirect('/cart?error=Not enough tickets available');
        }
    }

    public function updateTicketsAvailable(int $orderId)
    {
        $orderlines = $this->orderLineRepository->getAllFromOrderId($orderId);
        foreach ($orderlines as $orderline) {
            $item = $this->orderRepository->getItemFromDB($orderline->getTable(), $orderline->getItemId());
            $ticketsAvailable = $item['seats_left'] - $orderline->getQuantity();
            $this->orderRepository->updateTicketsAvailable(
                $orderline->getTable(),
                $orderline->getItemId(),
                $ticketsAvailable
            );
        }
    }

}
