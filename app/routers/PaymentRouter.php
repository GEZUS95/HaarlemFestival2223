<?php
namespace routers;

$router->setNamespace('controllers');

//Payment Routes
$router->post('/payments/webhook', 'PaymentController@webhook');
