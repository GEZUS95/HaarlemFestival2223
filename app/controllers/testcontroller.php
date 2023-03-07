<?php
namespace controllers;

use services\PDFService;
use services\UuidService;

class TestController
{
    public function index()
    {
        $customerName = 'John Doe';
        $eventName = 'Ratatouille';
        $eventDate = '07-03-2023';
        $ticketAmount = '4';
        $ticketuuid = (new UuidService)->generateUUID();
        (new PDFService)->generateTicket($customerName, $eventName, $eventDate, $ticketAmount, $ticketuuid);
        require_once __DIR__ . '/../views/admin/index.php';
    }
}