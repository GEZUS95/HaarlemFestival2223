<?php

namespace helpers;

use Ramsey\Uuid\Uuid;
use TCPDF;
use TCPDF2DBarcode;
use const PDF_CREATOR;

class PDFHelper
{
    public function generateTicket($customerName, $eventName, $eventDate, $ticketAmount, $ticketuuid)
    {
        // Define variables with all necessary data
        $uuid = $ticketuuid->toString();
        $style = array(
            'border' => true,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );

        // Instantiate the TCPDF class
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set the document properties
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Haarlem Festival');
        $pdf->SetTitle('Your Ticket(s)');
        $pdf->SetSubject('Ticket(s)');

        // Set the page margins
        $pdf->SetMargins(10, 10, 10);

        // Read the PHP template file and render its contents as HTML, passing in the variables
        ob_start(); // Start output buffering
        include __DIR__ . '/../views/templates/pdftemplates/ticket.php';
        $html = ob_get_clean(); // Get the contents of the output buffer and clear it

        // Write the HTML to the PDF
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->write2DBarcode($uuid, 'QRCODE,H', 55, 150, 100, 100, $style, 'M');

        // Output the generated PDF file
        return $pdf->Output($uuid . 'ticket.pdf', 'S');
    }

    public function generateInvoice($customerName, $orderNumber, $orderDate, $items)
    {
        // Instantiate the TCPDF class
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set the document properties
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Haarlem Festival');
        $pdf->SetTitle('Invoice of order ' . $orderNumber);
        $pdf->SetSubject('Invoice');

        // Set the page margins
        $pdf->SetMargins(10, 10, 10);

        // Read the PHP template file and render its contents as HTML, passing in the variables
        ob_start(); // Start output buffering
        include __DIR__ . '/../views/templates/pdftemplates/invoice.php';
        $html = ob_get_clean(); // Get the contents of the output buffer and clear it

        // Write the HTML to the PDF
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output the generated PDF file
        return $pdf->Output($orderNumber . '_invoice.pdf', 'S');
    }

    public function generateInvoiceDownload($customerName, $orderNumber, $orderDate, $items)
    {
        // Instantiate the TCPDF class
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set the document properties
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Haarlem Festival');
        $pdf->SetTitle('Invoice of order ' . $orderNumber);
        $pdf->SetSubject('Invoice');

        // Set the page margins
        $pdf->SetMargins(10, 10, 10);

        // Read the PHP template file and render its contents as HTML, passing in the variables
        ob_start(); // Start output buffering
        include __DIR__ . '/../views/pdftemplates/invoice.php';
        $html = ob_get_clean(); // Get the contents of the output buffer and clear it

        // Write the HTML to the PDF
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output the generated PDF file
        return $pdf->Output($orderNumber . '_invoice.pdf', 'I');
    }
}
