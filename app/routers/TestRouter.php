<?php

$router->setNamespace('controllers');

//Test routes
$router->get('/testInvoice', 'TestController@testInvoice');
$router->get('/testTicket', 'TestController@testTicket');
$router->get('/testPayment', 'TestController@testPayment');
$router->get('/testHTMLEmail', 'TestController@testHTMLEmail');
$router->get('/testOrder', 'TestController@testOrder');
