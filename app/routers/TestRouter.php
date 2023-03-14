<?php

use controllers\TestController;

//Test routes
$router->get('/testInvoice', function () {                                     // Test PDF
    $testController = new TestController();
    $testController->testInvoice();
});
$router->get('/testTicket', function () {                                     // Test PDF
    $testController = new TestController();
    $testController->testTicket();
});