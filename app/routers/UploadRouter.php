<?php
namespace routers;

$router->setNamespace('controllers');

//Upload Routes
$router->post('/upload/uploadImage', 'UploadController@uploadImage');
