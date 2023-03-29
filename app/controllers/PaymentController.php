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
                "redirectUrl" => "https://7cc1-145-81-192-114.eu.ngrok.io/payments/changePaymentStatus?order_id=$orderID",
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


    public function changePaymentStatus()
    {
        $payment = $this->mollie->payments->get($_SESSION['payment_id']);

        if ($payment->isPaid()) {
            $id = $_GET['order_id'];
            $dateTime = new \DateTime();
            $this->orderService->updateOrderStatus($id, 'paid', $dateTime->format('Y-m-d H:i:s'));
            $this->orderService->sendInvoice($id);
            $this->orderService->sendTickets($id);

            header('Location: /');
        } else {
            echo "payment error";
        }
    }
}
