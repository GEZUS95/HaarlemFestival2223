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

        return (new TCPDF2DBarcode($uuidString, 'QRCODE,H'));
    }

    public function generateQRCodeFromString($qrContent)
    {
        return (new TCPDF2DBarcode($qrContent, 'QRCODE,H'));
    }
}


