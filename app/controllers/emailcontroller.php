<?php
namespace controllers;

class EmailController
{
    public function index()
    {
        require __DIR__ . '/../views/tests/emailtest.php';
    }
    public function sendEmail(string $addressFrom, string $addressTo, string $subject, String $message)
    {
        $email = (new Email())
            ->from($addressFrom)
            ->to($addressTo)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
            ->text($message)
        //->html('<p>See Twig integration for better HTML integration!</p>')
        ;

        $mailer->send($email);
        }
}