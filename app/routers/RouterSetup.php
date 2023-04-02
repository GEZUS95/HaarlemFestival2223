<?php
$router->setNamespace('controllers');

//custom 404
$router->set404('ErrorController@pageNotFound');