<?php
namespace controllers;

use helpers\EmailHelper;
use helpers\PDFHelper;
use helpers\UuidHelper;
use models\Attachment;
use repositories\OrderRepository;
use repositories\UserRepository;
use services\OrderService;
use services\UserService;

class TestController
{
    public function testPayment(){
        $paymentHelper = new PaymentController();
        $paymentHelper->pay('20.00', 1);
    }
    public function testTicket()
    {

        $email = new EmailHelper();

        //make pdfs
        $customerName1 = 'John Doe';
        $eventName1 = 'Ratatouille';
        $eventDate1 = '07-03-2023';
        $ticketAmount1 = '4';
        $ticketuuid1 = (new UuidHelper)->generateUUID();
        $pdf1 = (new PDFHelper)->generateTicket($customerName1, $eventName1, $eventDate1, $ticketAmount1, $ticketuuid1);

        $customerName2 = 'John Doe';
        $eventName2 = 'Ratatouille';
        $eventDate2 = '07-03-2023';
        $ticketAmount2 = '4';
        $ticketuuid2 = (new UuidHelper)->generateUUID();
        $pdf2 = (new PDFHelper)->generateTicket($customerName2, $eventName2, $eventDate2, $ticketAmount2, $ticketuuid2);

        //convert to attachments
        $attachment1 = new Attachment($pdf1, "pdf1");
        $attachment2 = new Attachment($pdf2, "pdf2");

        //put them in array
        $attachments = Array($attachment1, $attachment2);

        //send email
        $email->sendEmailWithAttachments('no-reply@haarlemfestival.com','florisbeentjes@ziggo.nl','Your Ticket(s)','Ticket(s) just arrived!',$attachments,'HaarlemFestival_Ticket(s).pdf');
    }

    public function testInvoice(){
        $email = new EmailHelper();
        $customerName = 'John Doe';
        $orderNumber = (new UuidHelper)->generateUUID();
        $orderDate = '07-03-2023';
        $items = array(
            array(
                "name" => "Taco Night at La Cantina",
                "quantity" => 2,
                "price" => 15.50,
                "taxRate" => (rand(0, 1) == 0) ? 0.09 : 0.21 // Random tax rate of either 9% or 21%
            ),
            array(
                "name" => "Jazz Night at The Blue Note",
                "quantity" => 1,
                "price" => 45.00,
                "taxRate" => (rand(0, 1) == 0) ? 0.09 : 0.21 // Random tax rate of either 9% or 21%
            ),
            array(
                "name" => "Dinner at Le Cirque",
                "quantity" => 4,
                "price" => 100.00,
                "taxRate" => (rand(0, 1) == 0) ? 0.09 : 0.21 // Random tax rate of either 9% or 21%
            ),
            array(
                "name" => "Hip Hop Show at The Fillmore",
                "quantity" => 3,
                "price" => 25.75,
                "taxRate" => (rand(0, 1) == 0) ? 0.09 : 0.21 // Random tax rate of either 9% or 21%
            ),
            array(
                "name" => "Tapas and Wine at La Rambla",
                "quantity" => 2,
                "price" => 35.00,
                "taxRate" => (rand(0, 1) == 0) ? 0.09 : 0.21 // Random tax rate of either 9% or 21%
            ),
            array(
                "name" => "Sushi and Sake at Nobu",
                "quantity" => 1,
                "price" => 70.25,
                "taxRate" => (rand(0, 1) == 0) ? 0.09 : 0.21 // Random tax rate of either 9% or 21%
            )
        );
        $pdf = (new PDFHelper)->generateInvoice($customerName, $orderNumber, $orderDate, $items);
        $email->sendEmailWithAttachments('no-reply@haarlemfestival.com','florisbeentjes@ziggo.nl','Your Invoice','Invoice has arrived!',array(new Attachment($pdf, "pdf1")),'HaarlemFestival_Invoice.pdf');
    }

    public function testHTMLEmail(){
        $email = new EmailHelper();

        //this is the name that will be seen in the email
        $name = 'Hendrik';

        //Read the PHP template file and render its contents as HTML, passing in the variables
        ob_start(); // This will Start output buffering
        include __DIR__ . '/../views/templates/emailtemplates/example.php'; // This will load the template (in this case example.php)
        $html = ob_get_clean(); // This will get the contents of the output buffer and clear it

        $email->sendHTMLEmail('no-reply@haarlemfestival.com','florisbeentjes@ziggo.nl','Your HTML email',$html);
    }

    public function testOrder()
    {
        $service = new OrderService();
        $orders = $service->getFullOrder(1);
        print_r($orders);
    }
}
