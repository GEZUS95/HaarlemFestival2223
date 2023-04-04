<?php

namespace controllers\admin;

use helpers\PDFHelper;
use helpers\RedirectHelper;
use services\OrderService;
use services\UserService;

class OrderController
{
    private UserService $userService;
    private RedirectHelper $redirectHelper;
    private OrderService $orderService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->redirectHelper = new RedirectHelper();
        $this->orderService = new OrderService();

        if (
            (!$this->userService->checkPermissions("admin"))
            &&
            (!$this->userService->checkPermissions("super-admin"))
        ) {
            $this->redirectHelper->redirect('/?error=You do not have the permission to do this');
        }
    }

    public function showAllOrders()
    {
        $page = $_GET['p'] ?? 0;
        $orders = $this->orderService->getAllOrders($_GET['l'] ?? 15, $page * ($_GET['l'] ?? 15));
        require_once __DIR__ . '/../../views/admin/orders/index.php';
    }

    public function showOrder(int $id)
    {
        $order = $this->orderService->getOneOrderFromId($id);
        $orderItems = $this->orderService->getFullOrder($order->getId());

        require_once __DIR__ . '/../../views/admin/orders/order.php';
    }

    public function orderStatusUpdate(int $id)
    {
        $this->orderService->updateStatusAdmin($id);
    }

    public function getInvoice(int $orderId)
    {
        $this->orderService->downloadInvoice($orderId);
    }

    public function getCSV()
    {
        $id = isset($_POST['id']);
        $user_id = isset($_POST['user_id']);
        $share_uuid = isset($_POST['share_uuid']);
        $status = isset($_POST['status']);
        $payed_at = isset($_POST['payed_at']);
        $total = isset($_POST['total']);

        $this->orderService->downloadCSV($id, $user_id, $share_uuid, $status, $payed_at, $total);
    }

    public function showGetCSV()
    {
        require_once __DIR__ . '/../../views/admin/orders/csv.php';
    }
}
