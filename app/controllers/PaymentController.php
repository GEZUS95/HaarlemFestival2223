<?php

namespace controllers;

use helpers\EmailHelper;
use models\Attachment;
use models\Order;
use Mollie\Api\MollieApiClient;
use repositories\OrderRepository;
use repositories\UserRepository;
use services\OrderService;
use services\TicketService;

class PaymentController
{
    private OrderService $orderService;
    private MollieApiClient $mollie;
    private TicketService $ticketService;

    public function __construct()
    {
        $this->orderService = new OrderService();
        $this->ticketService = new TicketService();
        $this->mollie = new MollieApiClient();
        $this->mollie->setApiKey($_ENV['MOLLIE_API_KEY']);
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
                "redirectUrl" => $_ENV['BASE_URL'],
                "webhookUrl" => $_ENV['BASE_URL'] . "/payments/webhook",
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
            $date = new \DateTime();
            $this->orderService->updateOrderStatus($id, 'paid', $date->format('d-m-Y H:i:s'));
            $this->ticketService->updateTicketsAvailable($id);
            $this->orderService->sendInvoice($id);
            $this->ticketService->generateTickets($id);
            $this->orderService->sendTickets($id);

            http_response_code(200);
        } else {
            echo "payment error";
        }
    }
}
