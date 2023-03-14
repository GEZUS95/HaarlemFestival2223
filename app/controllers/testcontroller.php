<?php
namespace controllers;

use helpers\PDFHelper;
use helpers\UuidHelper;

class TestController
{
    public function index()
    {
        $customerName = 'John Doe';
        $eventName = 'Ratatouille';
        $eventDate = '07-03-2023';
        $ticketAmount = '4';
        $ticketuuid = (new UuidHelper)->generateUUID();
        (new PDFHelper)->generateTicket($customerName, $eventName, $eventDate, $ticketAmount, $ticketuuid);
        require_once __DIR__ . '/../views/admin/index.php';
    }
}