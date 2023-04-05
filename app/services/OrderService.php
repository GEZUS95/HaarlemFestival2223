<?php

namespace services;

use helpers\CSVHelper;
use helpers\EmailHelper;
use helpers\PDFHelper;
use helpers\RedirectHelper;
use helpers\UuidHelper;
use models\Attachment;
use repositories\OrderLineRepository;
use repositories\OrderRepository;

class OrderService
{
    private OrderRepository $orderRepository;
    private OrderLineRepository $orderLineRepository;
    private UuidHelper $uuidHelper;
    private RedirectHelper $redirectHelper;
    private PDFHelper $PDFHelper;
    private UserService $userService;
    private EmailHelper $email;
    private CSVHelper $CSVHelper;
    private TicketService $ticketService;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->orderLineRepository = new OrderLineRepository();
        $this->uuidHelper = new UuidHelper();
        $this->redirectHelper = new RedirectHelper();
        $this->PDFHelper = new PDFHelper();
        $this->userService = new UserService();
        $this->email = new EmailHelper();
        $this->CSVHelper = new CSVHelper();
        $this->ticketService = new TicketService();
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

    public function createOrder(int $userid)
    {
        $uuid = $this->uuidHelper->generateUUID();
        $this->orderRepository->insertOne($userid, $uuid, 'open');
    }

    public function addOrderline(int $orderId, string $table, int $itemId, int $quantity, bool $child)
    {
        $this->ticketService->ticketsAvailable($table, $itemId, $quantity);
        $this->orderLineRepository->insertOne($orderId, $table, $itemId, $quantity, $child);
        $this->redirectHelper->redirect('/cart?success=Item added to cart');
    }

    public function updateOrderStatus(int $id, string $status, string $payedAt = '00-00-0000 00:00:00')
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
        $orderline = $this->orderLineRepository->getOneFromId($id);
        $this->ticketService->ticketsAvailable($orderline->getTable(), $orderline->getItemId(), $quantity);
        $this->orderLineRepository->updateOne($orderline->getId(), $quantity);
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
        $items = $this->getFullOrder($order->getId());

        $this->PDFHelper->generateInvoiceDownload(
            $user->getName(),
            $order->getShareUuid(),
            $order->getPayedAt(),
            $items
        );
        $this->redirectHelper->redirect('/admin/orders?success=PDF generated!');
    }

    public function sendInvoice(int $orderId)
    {
        $order = $this->getOneOrderFromId($orderId);
        $user = $this->userService->getOneById($order->getUserId());
        $items = $this->getFullOrder($order->getId());
        $userEmail = $user->getEmail();

        //create invoice and convert to attachment
        $attachment1 = new Attachment(
            $this->PDFHelper->generateInvoice(
                $user->getName(),
                $order->getId(),
                $order->getPayedAt(),
                $items
            ),
            "Invoice_Of_Order#" . $orderId
        );

        //put in array for the sendEmailWithAttachments function
        $attachments = array($attachment1);

        //send email
        $this->email->sendEmailWithAttachments(
            'no-reply@haarlemfestival.com',
            $userEmail,
            'Your Invoice of order#' . $orderId,
            "Dear customer,\r\n
            Attached you will find the invoice of the order you just placed.\r\n
            Regards, The Haarlem Festival Team",
            $attachments
        );
    }

    public function sendTickets(int $orderId)
    {
        $order = $this->getOneOrderFromId($orderId);
        $user = $this->userService->getOneById($order->getUserId());
        $items = $this->getFullOrder($order);
        $userEmail = $user->getEmail();
        $attachments = array();


        //create tickets, convert to attachments and add them to an array
        foreach ($items as $item) {
            $tickets = $this->ticketService->getAllTickets($item['id']);
            $i = 1;
            foreach ($tickets as $ticket) {
                $attachment = new Attachment(
                    $this->PDFHelper->generateTicket(
                        $user->getName(),
                        $item['name'],
                        $ticket->getUuid(),
                        $item['start_time']
                    ),
                    "Ticket #$i for " . $item['name']
                );
                $attachments[] = $attachment;
                $i++;
            }
        }

        //send email
        $this->email->sendEmailWithAttachments(
            'no-reply@haarlemfestival.com',
            $userEmail,
            'Your Tickets for order#' . $orderId,
            "Dear customer,\r\n
            Attached you will find the tickets for the order you just placed.\r\n
            Regards, The Haarlem Festival Team",
            $attachments
        );
    }

    public function getFullOrder(int $orderId)
    {
        $orderlines = $this->orderLineRepository->getAllFromOrderId($orderId);
        $temp = array();

        foreach ($orderlines as $orderline) {
            if ($orderline->getTable() === 'reservation') {
                $item = $this->orderLineRepository->getOrderlineFood($orderline->getId());
                if ($orderline->isChild()) {
                    $item['price'] = $item['price_child'];
                }
                $temp[] = $item;
            } else {
                $temp[] = $this->orderLineRepository->getOrderlineNonFood($orderline->getId());
            }
        }
        return $temp;
    }

    public function downloadCSV(bool $id, bool $user_id, bool $share_uuid, bool $status, bool $payed_at, bool $total)
    {
        if ($id === false
            && $user_id === false
            && $share_uuid === false
            && $status === false
            && $payed_at === false
            && $total === false
        ) {
            $this->redirectHelper->redirect(
                '/admin/orders/csv?error=You need to select at least one column to download'
            );
        }

        $header = $this->CSVHelper->generateHeader($id, $user_id, $share_uuid, $status, $payed_at, $total);

        $orders = $this->orderRepository->getAllOrdersCSV($id, $user_id, $share_uuid, $status, $payed_at);
        if ($total === true) {
            for ($i = 1; $i < count($orders) + 1; $i++) {
                $total_price = 0;
                $order = $this->getFullOrder($i);
                foreach ($order as $item) {
                    $total_price += $item['price'] * $item['quantity'] * $_ENV['VAT_MULTIPLY'];
                }
                $orders[$i - 1][] = $total_price;
            }
        }
        $this->CSVHelper->generateCSV($header, $orders);
    }
}
