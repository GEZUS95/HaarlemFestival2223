<?php

namespace services;

use setasign\Fpdi\Tcpdf\Fpdi;
use TCPDF;

class PDFService
{
    public function generateTicket()
    {
        //naam klant, naam event, datum event, aantal tickets, uuid
    }

    public function generateInvoice($customername, $ordernumber, $orderdate, $itemlist)
    {
        // Define variables with the necessary data
        $customerName = $customername;
        $orderNumber = $ordernumber;
        $orderDate = $orderdate;
        $items = $itemlist;

        // Instantiate the TCPDF class
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set the document properties
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Haarlem Festival');
        $pdf->SetTitle('Your Invoice');
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
        $pdf->Output('invoice.pdf', 'D');
    }
}