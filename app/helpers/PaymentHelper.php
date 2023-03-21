<?php

namespace helpers;

use Mollie\Api\MollieApiClient;

class PaymentHelper
{
    public function Pay(){
        $mollie = new MollieApiClient();
        $mollie->setApiKey("test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8");

        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => "10.00"
            ],
            "description" => "My first API payment",
            "redirectUrl" => "https://iris.inholland.nl/",
            "webhookUrl"  => "https://webshop.example.org/mollie-webhook/",
        ]);

        header("Location: " . $payment->getCheckoutUrl(), true, 303);
    }
}