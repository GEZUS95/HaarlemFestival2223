<?php
namespace routers;

$router->setNamespace('controllers');

//Upload Routes
$router->post('/uploadImage', 'UploadController@uploadImage');
