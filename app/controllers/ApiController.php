<?php

namespace controllers;

use services\ApiService;
use services\OrderService;
use services\ReservationService;

class ApiController
{
    private ApiService $service;
    private OrderService $orderService;
    private ReservationService $reservationService;

    public function __construct()
    {
        $this->service = new ApiService();
        $this->orderService = new OrderService();
        $this->reservationService = new ReservationService();
        if (!isset(getallheaders()['Token']) || !$this->service->verifyToken(getallheaders()['Token'])) {
            $this->returnJSON(array(
                'status' => 'error',
                'message' => 'No token provided or token is invalid'
            ));
        }
    }

    public function index()
    {
        $this->returnJSON(array(
            'status' => 'success',
            'message' => 'Welcome to the API'
        ));
    }

    public function getAllOrders()
    {
        $orders = $this->orderService->getAllOrders();
        $data = array();
        foreach ($orders as $order) {
            $data[] = [
                'id' => $order->getId(),
                'user_id' => $order->getUserId(),
                'share_uuid' => $order->getShareUuid(),
                'status' => $order->getStatus()
            ];
        }
        $this->returnJSON(array(
            'status' => 'success',
            'message' => 'All orders',
            'data' => $data
        ));
    }

    public function getAllReservations()
    {
        $reservations = $this->reservationService->getAll();
        $data = array();
        foreach ($reservations as $reservation) {
            $data[] = [
                'id' => $reservation->getId(),
                'session_id' => $reservation->getSessionId(),
                'remarks' => $reservation->getRemarks(),
                'status' => $reservation->getStatus()
            ];
        }
        $this->returnJSON(array(
            'status' => 'success',
            'message' => 'All reservations',
            'data' => $data
        ));
    }

    public function getOneReservation(int $id)
    {
        $reservation = $this->reservationService->getOneById($id);
        if (!$reservation) {
            $this->returnJSON(array(
                'status' => 'error',
                'message' => 'Reservation not found'
            ));
        } else {
            $this->returnJSON(array(
                'status' => 'success',
                'message' => 'Reservation found',
                'data' => [
                    'id' => $reservation->getId(),
                    'session_id' => $reservation->getSessionId(),
                    'remarks' => $reservation->getRemarks(),
                    'status' => $reservation->getStatus()
                ]
            ));
        }
    }

    public function putOneReservation(int $id)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $reservation = $this->reservationService->getOneById($id);
        if (!$reservation) {
            $this->returnJSON(array(
                'status' => 'error',
                'message' => 'Reservation not found'
            ));
        } else {
            $reservation->setRemarks($data['remarks']);
            $reservation->setStatus($data['status']);
            $this->reservationService->updateOne($reservation);
            $this->returnJSON(array(
                'status' => 'success',
                'message' => 'Reservation updated',
                'data' => [
                    'id' => $reservation->getId(),
                    'session_id' => $reservation->getSessionId(),
                    'remarks' => $reservation->getRemarks(),
                    'status' => $reservation->getStatus()
                ]
            ));
        }
    }

    private function returnJSON($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}
