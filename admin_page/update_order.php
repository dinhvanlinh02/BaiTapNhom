<?php
// Kết nối cơ sở dữ liệu
require_once("clsOrder.php");

// Lấy dữ liệu từ form
$order_id = $_POST['order_id'] ?? null;
$status_order = $_POST['status'] ?? null;  // Đảm bảo lấy đúng tên là 'status'

// Kiểm tra dữ liệu
if ($order_id && $status_order) {
    $clsOrder = new clsOrder();
    $result = $clsOrder->updateOrderStatus($order_id, $status_order);

    if ($result) {
        header("Location: orders.php?msg=success");
        exit(); // Đảm bảo header được thực thi ngay lập tức
    } else {
        header("Location: orders.php?msg=error");
        exit(); // Đảm bảo header được thực thi ngay lập tức
    }
} else {
    header("Location: orders.php?msg=invalid");
    exit(); // Đảm bảo header được thực thi ngay lập tức
}
?>
