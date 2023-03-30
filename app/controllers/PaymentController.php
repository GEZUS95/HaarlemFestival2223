<?php

namespace controllers;

use helpers\EmailHelper;
use models\Attachment;
use models\Order;
use Mollie\Api\MollieApiClient;
use repositories\OrderRepository;
use repositories\UserRepository;
use services\OrderService;

class PaymentController
{
    private OrderService $orderService;
    private MollieApiClient $mollie;

    public function __construct()
    {
        $this->orderService = new OrderService();
        $this->mollie = new MollieApiClient();
        $this->mollie->setApiKey("test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8");
    }

    public function pay($value, $orderID)
    {
        try {
            $payment = $this->mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => "$value",
                ],
                "description" => "Order #{$orderID}",
                "redirectUrl" => "https://407a-145-81-192-114.eu.ngrok.io/",
                "webhookUrl" => "https://407a-145-81-192-114.eu.ngrok.io/payments/webhook",
                "metadata" => [
                    "order_id" => $orderID,
                ],
            ]);
            $_SESSION['payment_id'] = $payment->id;

            header("Location: " . $payment->getCheckoutUrl(), true, 303);
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }

    public function webhook()
    {
        $payment = $this->mollie->payments->get($_POST['id']);

        if ($payment->isPaid()) {
            $id = $payment->metadata->order_id;
            $this->orderService->updateOrderStatus($id, 'paid');
            $this->orderService->sendInvoice($id);
            //todo: generate tickets
            $this->orderService->sendTickets($id);

            http_response_code(200);
        } else {
            echo "payment error";
        }
    }
}
