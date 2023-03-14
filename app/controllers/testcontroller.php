<?php
namespace controllers;

use helpers\PDFHelper;
use helpers\UuidHelper;

class TestController
{
    public function testTicket()
    {
        $customerName = 'John Doe';
        $eventName = 'Ratatouille';
        $eventDate = '07-03-2023';
        $ticketAmount = '4';
        $ticketuuid = (new UuidHelper)->generateUUID();
        (new PDFHelper)->generateTicket($customerName, $eventName, $eventDate, $ticketAmount, $ticketuuid);
    }

    public function testInvoice(){
        $customerName = 'John Doe';
        $orderNumber = (new UuidHelper)->generateUUID();
        $orderDate = '07-03-2023';
        $items = array(
            array(
                "name" => "Taco Night at La Cantina",
                "quantity" => 2,
                "price" => 15.50,
                "taxRate" => (rand(0, 1) == 0) ? 0.09 : 0.21 // Random tax rate of either 9% or 21%
            ),
            array(
                "name" => "Jazz Night at The Blue Note",
                "quantity" => 1,
                "price" => 45.00,
                "taxRate" => (rand(0, 1) == 0) ? 0.09 : 0.21 // Random tax rate of either 9% or 21%
            ),
            array(
                "name" => "Dinner at Le Cirque",
                "quantity" => 4,
                "price" => 100.00,
                "taxRate" => (rand(0, 1) == 0) ? 0.09 : 0.21 // Random tax rate of either 9% or 21%
            ),
            array(
                "name" => "Hip Hop Show at The Fillmore",
                "quantity" => 3,
                "price" => 25.75,
                "taxRate" => (rand(0, 1) == 0) ? 0.09 : 0.21 // Random tax rate of either 9% or 21%
            ),
            array(
                "name" => "Tapas and Wine at La Rambla",
                "quantity" => 2,
                "price" => 35.00,
                "taxRate" => (rand(0, 1) == 0) ? 0.09 : 0.21 // Random tax rate of either 9% or 21%
            ),
            array(
                "name" => "Sushi and Sake at Nobu",
                "quantity" => 1,
                "price" => 70.25,
                "taxRate" => (rand(0, 1) == 0) ? 0.09 : 0.21 // Random tax rate of either 9% or 21%
            )
        );
        (new PDFHelper)->generateInvoice($customerName, $orderNumber, $orderDate, $items);
    }
}