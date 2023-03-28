<?php

namespace controllers;

use Mollie\Api\MollieApiClient;
use services\OrderService;

class PaymentController
{
    private OrderService $orderService;
    private MollieApiClient $mollie;

    public function __construct()
    {
        $this->orderService = new OrderService();
        $this->mollie = new MollieApiClient();
    }

    public function pay($value, $orderID)
    {
        $this->mollie->setApiKey("test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8");
        $payment = $this->mollie->payments->create([
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


    public function changePaymentStatus()
    {
        $this->mollie->setApiKey("test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8");

        $payment = $this->mollie->payments->get($_SESSION['payment_id']);

        if ($payment->isPaid()) {
            $id = $_GET['order_id'];
            $this->orderService->updateOrderStatus($id, 'paid');
            header('Location: /');
        } else {
            echo "payment error";
        }
    }
}
