<?php
namespace helpers;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class EmailHelper
{
    public MailerInterface $mailer;
    public function __construct()
    {
        //Code for making the mailer (secure)
        $transport = Transport::fromDsn('smtp://no-reply@haarlemfestival.com:no-reply2022@mail.axc.nl:465');
        $this->mailer = new Mailer($transport);
    }

    //Call this functionality to send emails
    public function sendEmail(string $addressFrom, string $addressTo, string $subject, String $message): void
    {
        //Add the data to the Email
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
        //Use the previously made mailer to send the mail
        $this->mailer->send($email);
    }
    public function sendEmailWithAttachment($addressFrom, $addressTo, $subject, $message, $attachment, $attachmentName): void
    {
        //Add the data to the Email
        $email = (new Email())
            ->from($addressFrom)
            ->to($addressTo)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
            ->text($message)//->html('<p>See Twig integration for better HTML integration!</p>')
            ->attach($attachment, $attachmentName, 'application/pdf')
        ;
        //Use the previously made mailer to send the mail
        $this->mailer->send($email);
    }
}
