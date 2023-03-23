<?php

namespace controllers;

use services\OrderService;

class PaymentController
{
    public function Pay($value, $orderID)
    {
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey("test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8");
        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => "$value",
            ],
            "description" => "Order #{$orderID}",
            "redirectUrl" => "https://01cc-145-81-192-114.eu.ngrok.io/payments/changePaymentStatus?order_id=$orderID",
            "metadata" => [
                "order_id" => $orderID,
            ],
        ]);
        $_SESSION['payment_id'] = $payment->id;

        header("Location: " . $payment->getCheckoutUrl(), true, 303);
    }


    public function changePaymentStatus(){
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey("test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8");
        $orderService = new OrderService();

        $payment = $mollie->payments->get($_SESSION['payment_id']);

        if($payment->isPaid()){
            $id = $_GET['order_id'];
            $orderService->updateOrderStatus($id, 'paid');
            header('Location: /');
        } else {
            echo "payment error";
        }


    }
}