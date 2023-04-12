<?php
//Test routes
$router->get('/testInvoice', 'TestController@testInvoice');
$router->get('/testTicket', 'TestController@testTicket');
$router->get('/testPayment', 'TestController@testPayment');
$router->get('/testHTMLEmail', 'TestController@testHTMLEmail');
$router->get('/testOrder', 'TestController@testOrder');
$router->get('/testTicketGen', 'TestController@testTicketGen');
$router->get('/testUpdateOrderStatus', 'TestController@testUpdateOrderStatus');
$router->get('/testUpdateTicketsAvailable', 'TestController@testUpdateTicketsAvailable');
$router->get('/testSendTickets', 'TestController@testSendTickets');