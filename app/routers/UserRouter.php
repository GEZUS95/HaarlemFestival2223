<?php
$router->get('/login', 'LoginController@login');
$router->post('/login', 'LoginController@loginPost');
$router->get('/logout', 'LoginController@logout');

$router->get('/register', 'UserController@register');
$router->post('/register', 'UserController@registerPost');

$router->get('/resetpassword', 'UserController@requestResetPassword');
$router->post('/resetpassword', 'UserController@requestResetPasswordPost');
$router->get('/resetpassword/{uuid}', 'UserController@resetPasswordPage');
$router->post('/resetpassword/{uuid}', 'UserController@resetPasswordPost');

$router->get('/user/update', 'UserController@showUserUpdate');
$router->post('/user/update/{id}', 'UserController@userUpdate');