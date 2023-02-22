<?php
namespace services;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Transport\Smtp\Auth\LoginAuthenticator;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\SmtpTransport;
use Symfony\Component\Mime\Email;

Class EmailService
{
    public MailerInterface $mailer;
    public function __construct(){
        //Code for making the mailer (secure)
        $transport = Transport::fromDsn('smtp://no-reply@haarlemfestival.com:no-reply2022@mail.axc.nl:465');
        $this->mailer = new Mailer($transport);
    }
    public function sendEmail(string $addressFrom, string $addressTo, string $subject, String $message): void
    {
        $email = (new Email())
            ->from($addressFrom)
            ->to($addressTo)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
            ->text($message)//->html('<p>See Twig integration for better HTML integration!</p>')
        ;
        $this->mailer->send($email);
    }
}
