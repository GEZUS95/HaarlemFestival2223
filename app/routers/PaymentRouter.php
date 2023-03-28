<?php
namespace routers;

$router->setNamespace('controllers');

//Payment Routes
$router->get('/payments/changePaymentStatus', 'PaymentController@changePaymentStatus');
