<?php
namespace routers;

$router->setNamespace('controllers');

//Payment Routes
$router->get('/changePaymentStatus', 'PaymentController@changePaymentStatus');
