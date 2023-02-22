<?php
namespace services;
use Ramsey\Uuid\Rfc4122\UuidV4;
use TCPDF2DBarcode;

Class QRService
{
    public function generateQRCodeFromUUID($uuid)
    {
        //Convert UUID to a string
        $uuidString = $uuid->toString();

        //Return the QRCode
        return (new TCPDF2DBarcode($uuidString, 'QRCODE,H'));
    }

    public function generateQRCodeFromString($qrContent)
    {
        //Generate and return the QRCode
        return (new TCPDF2DBarcode($qrContent, 'QRCODE,H'));
    }
}


