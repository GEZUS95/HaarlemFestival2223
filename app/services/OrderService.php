<?php

namespace services;

use helpers\EmailHelper;
use helpers\PDFHelper;
use helpers\RedirectHelper;
use helpers\UuidHelper;
use models\Attachment;
use models\Order;
use repositories\OrderLineRepository;
use repositories\OrderRepository;
use repositories\UserRepository;

class OrderService
{
    private OrderRepository $orderRepository;
    private OrderLineRepository $orderLineRepository;
    private UuidHelper $uuidHelper;
    private RedirectHelper $redirectHelper;
    private PDFHelper $PDFHelper;
    private UserService $userService;
    private UserRepository $userRepository;
    private EmailHelper $email;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->orderLineRepository = new OrderLineRepository();
        $this->uuidHelper = new UuidHelper();
        $this->redirectHelper = new RedirectHelper();
        $this->PDFHelper = new PDFHelper();
        $this->userService = new UserService();
        $this->userRepository = new UserRepository();
        $this->email = new EmailHelper();
    }

    public function getAllOrders(int $limit, int $offset)
    {
        return $this->orderRepository->getAll($limit, $offset);
    }

    public function getAllOrderLines()
    {
        return $this->orderLineRepository->getAll();
    }

    public function getOneOrderFromId(int $id)
    {
        return $this->orderRepository->getOneFromId($id);
    }

    public function getOneOrderFromUserId(int $id)
    {
        $order = $this->orderRepository->getOneFromUserId($id);
        if (!$order) {
            $this->createOrder($id);
            $order = $this->orderRepository->getOneFromUserId($id);
        }
        return $order;
    }

    public function getAllOrderLinesFromOrderId(int $id)
    {
        return $this->orderLineRepository->getAllFromOrderId($id);
    }

    public function createOrder(int $userid)
    {
        $uuid = $this->uuidHelper->generateUUID();
        $this->orderRepository->insertOne($userid, $uuid, 'open');
    }

    public function addOrderline(int $orderId, string $table, int $itemId, int $quantity, bool $child)
    {
        $this->ticketsAvailable($orderId, $quantity);
        $this->orderLineRepository->insertOne($orderId, $table, $itemId, $quantity, $child);
        $this->redirectHelper->redirect('/cart?success=Item added to cart');
    }

    public function updateOrderStatus(int $id, string $status, string $payedAt = null)
    {
        $this->orderRepository->updateStatus($id, $status, $payedAt);
    }

    public function deleteOrder(int $id)
    {
        $orderlines = $this->orderLineRepository->getAllFromOrderId($id);
        foreach ($orderlines as $line) {
            $this->orderLineRepository->deleteOne($line->getId());
        }
        $this->orderRepository->deleteOne($id);
    }

    public function deleteOrdeLine(int $id)
    {
        $this->orderLineRepository->deleteOne($id);
        $this->redirectHelper->redirect('/cart?success=Item Deleted');
    }

    public function updateOrderLineQuantity(int $id, int $quantity)
    {
        $this->ticketsAvailable($id, $quantity);
        $this->orderLineRepository->updateOne($id, $quantity);
        $this->redirectHelper->redirect('/cart?success=Quantity updated');
    }

    public function updateStatusAdmin(int $id)
    {
        $order = $this->orderRepository->getOneFromId($id);
        if ($order->getStatus() === 'open') {
            $this->updateOrderStatus($id, 'paid');
            $this->redirectHelper->redirect("/admin/orders?success=Order $id has been changed to paid");
        } elseif ($order->getStatus() === 'paid') {
            $this->updateOrderStatus($id, 'open');
            $this->redirectHelper->redirect("/admin/orders?success=Order $id has been changed to open");
        } else {
            $this->redirectHelper->redirect('/admin/orders?error=There was some problem with order status');
        }
    }

    public function downloadInvoice(int $orderId)
    {
        $order = $this->getOneOrderFromId($orderId);
        $user = $this->userService->getOneById($order->getUserId());

        $items = $this->getOrderItemsNiceNamed($order);

        $date = new \DateTime();

        $this->PDFHelper->generateInvoiceDownload(
            $user->getName(),
            $order->getShareUuid(),
            $date->format('d-m-Y'),
            $items
        );
        $this->redirectHelper->redirect('/admin/orders?success=PDF generated!');
    }

    public function sendInvoice(int $orderId)
    {
        $order = $this->getOneOrderFromId($orderId);
        $user = $this->userService->getOneById($order->getUserId());
        $items = $this->getOrderItemsNiceNamed($order);
        $userEmail = $user->getEmail();
        $date = new \DateTime();

        //create invoice and convert to attachment
        $attachment1 = new Attachment(
            $this->PDFHelper->generateInvoice(
                $user->getName(),
                $order->getId(),
                $date->format('d-m-Y'),
                $items
            ),
            "Invoice_Of_Order#" . $orderId
        );

        //put in array for the sendEmailWithAttachments function
        $attachments = array($attachment1);

        //send email
        $this->email->sendEmailWithAttachments('no-reply@haarlemfestival.com', $userEmail, 'Your Invoice of order#' . $orderId, "Dear customer,\r\nAttached you will find the invoice of the order you just placed.\r\nRegards, The Haarlem Festival Team", $attachments);
    }

    public function sendTickets(int $orderId)
    {
        $order = $this->getOneOrderFromId($orderId);
        $user = $this->userService->getOneById($order->getUserId());
        $items = $this->getOrderItemsNiceNamed($order);
        $userEmail = $user->getEmail();
        $attachments = array();

        //create tickets, convert to attachments and add them to an array
        foreach ($items as $item) {
            $attachment1 = new Attachment(
                $this->PDFHelper->generateTicket(
                    $user->getName(),
                    $item['name'],
                    $item['quantity'],
                    $order->getShareUuid()
                ),
                "Your ticket for " . $item['name']
            );
            $attachments[] = $attachment1;
        }

        //send email
        $this->email->sendEmailWithAttachments('no-reply@haarlemfestival.com', $userEmail, 'Your Tickets for order#' . $orderId, "Dear customer,\r\nAttached you will find the tickets for the order you just placed.\r\nRegards, The Haarlem Festival Team", $attachments);
    }

    public function getOrderItemsNiceNamed(Order $order) :array
    {
        $items = $this->getAllOrderLinesFromOrderId($order->getId());

        $newItems = array();

        foreach ($items as $item) {
            $object = $this->orderRepository->getItemFromDB($item->getTable(), $item->getItemId());
            if ($item->isChild()) {
            $newItems[] = array(
                "id" => $item->getId(),
                "name" => $object['title'],
                "quantity" => $item->getQuantity(),
                "isChild" => 'yes',
                "price" => $object['price_child'],
                "taxRate" => 0.21
            );
            } else {
                $newItems[] = array(
                    "id" => $item->getId(),
                    "name" => $object['title'],
                    "quantity" => $item->getQuantity(),
                    "isChild" => 'no',
                    "price" => $object['price'],
                    "taxRate" => 0.21
                );
            }
        }

        return $newItems;
    }

    private function ticketsAvailable(int $id, int $quantity)
    {
        $order = $this->orderLineRepository->getOneFromId($id);
        $item = $this->orderRepository->getItemFromDB($order->getTable(), $order->getItemId());
        $ticketsAvailable = $item['seats_left'];
        if ($ticketsAvailable >= $quantity) {
            $ticketsAvailable = $ticketsAvailable - $quantity;

            $this->orderRepository->updateTicketsAvailable($order->getTable(), $order->getItemId(), $ticketsAvailable);
        } else {
            $this->redirectHelper->redirect('/cart?error=Not enough tickets available');
        }
    }
}
