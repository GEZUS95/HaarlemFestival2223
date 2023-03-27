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

    //Call this functionality to send an email with attachments
    //Make sure that $attachments is an array of attachments where each attachment has a pdfFile of type TCPDF
    //and a name (String)
    public function sendEmailWithAttachments($addressFrom, $addressTo, $subject, $message, $attachments): void
    {
        // Initialize an empty array to hold the attachment data
        $attachmentData = array();

        // Loop through each Attachment object and extract the necessary information
        foreach ($attachments as $attachment) {
            $attachmentFile = $attachment->getAttachmentFile();
            $attachmentName = $attachment->getAttachmentName();

            // Build an array of attachment data and add it to the $attachmentData array
            $attachmentData[] = array(
                'data' => $attachmentFile,
                'name' => $attachmentName,
                'mime' => 'application/pdf'
            );
        }

        // Add the data to the Email
        $email = (new Email())
            ->from($addressFrom)
            ->to($addressTo)
            ->subject($subject)
            ->text($message);

        // Loop through the $attachmentData array and add each attachment to the email
        foreach ($attachmentData as $attachment) {
            $email->attach($attachment['data'], $attachment['name'] . ".pdf", $attachment['mime']);
        }

        //Use the previously made mailer to send the mail
        $this->mailer->send($email);
    }

    //Use this function to send HTML emails, instead of a message, html needs to be provided
    //For usage see testcontroller -> testHTMLEmail()
    public function sendHTMLEmail($addressFrom, $addressTo, $subject, $html){
        //Add the data to the Email
        $email = (new Email())
            ->from($addressFrom)
            ->to($addressTo)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
            ->html($html)
        ;
        //Use the previously made mailer to send the mail
        $this->mailer->send($email);
    }
}
