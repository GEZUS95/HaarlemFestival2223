<?php
//Cart Routes
$router->get('/cart', 'CartController@index');
$router->get('/cart/delete/{itemId}', 'CartController@deleteItem');
$router->post('/cart/update/{itemId}', 'CartController@updateQuantity');
$router->get('/cart/pay/{orderId}', 'CartController@payOrder');