<?php

namespace services;

use helpers\PDFHelper;
use helpers\RedirectHelper;
use helpers\UuidHelper;
use models\Order;
use repositories\OrderLineRepository;
use repositories\OrderRepository;
use function Composer\Autoload\includeFile;

class OrderService
{
    private OrderRepository $orderRepository;
    private OrderLineRepository $orderLineRepository;
    private UuidHelper $uuidHelper;
    private RedirectHelper $redirectHelper;
    private PDFHelper $PDFHelper;
    private UserService $userService;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->orderLineRepository = new OrderLineRepository();
        $this->uuidHelper = new UuidHelper();
        $this->redirectHelper = new RedirectHelper();
        $this->PDFHelper = new PDFHelper();
        $this->userService = new UserService();
    }

    public function getAllOrders()
    {
        return $this->orderRepository->getAll();
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

    public function addOrderline(int $orderId, string $table, int $itemId, int $quantity)
    {
        $this->orderLineRepository->insertOne($orderId, $table, $itemId, $quantity);
    }

    public function updateOrderStatus(int $id, string $status)
    {
        $this->orderRepository->updateStatus($id, $status);
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
        $this->orderLineRepository->updateOne($id, $quantity);
        $this->redirectHelper->redirect('/cart?success=Quantity updated');
    }

    public function updateStatus(int $id)
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

    public function createInvoice(int $orderId)
    {
        $order = $this->getOneOrderFromId($orderId);
        $user = $this->userService->getOneById($order->getUserId());

        $items = $this->getOrderItemsNiceNamed($order);

        $date = new \DateTime();

        $this->PDFHelper->generateInvoiceDownload($user->getName(), $orderId, $date->format(DATE_RFC2822), $items);
        $this->redirectHelper->redirect('/admin/orders?success=PDF generated!');
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
}
