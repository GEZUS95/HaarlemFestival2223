<?php
namespace controllers;

use services\PDFService;

class TestController
{
    public function index()
    {
        $customerName = 'John Doe';
        $orderNumber = '1234';
        $orderDate = '07-03-2023';
        $items = [
            ['name' => 'Item 1', 'quantity' => 2, 'price' => 10.0, 'taxRate' => 0.21],
            ['name' => 'Item 2', 'quantity' => 1, 'price' => 5.0, 'taxRate' => 0.06],
            ['name' => 'Item 3', 'quantity' => 3, 'price' => 8.0, 'taxRate' => 0.21],
            ['name' => 'Item 4', 'quantity' => 1, 'price' => 2.0, 'taxRate' => 0.06]];
        (new PDFService)->generateInvoice($customerName, $orderNumber, $orderDate, $items);
        require_once __DIR__ . '/../views/admin/index.php';
    }
}