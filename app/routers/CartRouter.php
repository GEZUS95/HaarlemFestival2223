<?php
namespace routers;

//Cart Routes
$router->get('/cart', function() {
    $controller = new controllers\CartController();
    $controller->index();
});
