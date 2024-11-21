<?php
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Kết nối cơ sở dữ liệu và xóa đơn hàng
    require_once("clsOrder.php");
    $clsOrder = new clsOrder();
    $result = $clsOrder->deleteOrderById($order_id);

    if ($result) {
        header("Location: orders.php?message=Order deleted successfully");
        exit();
    } else {
        header("Location: orders.php?message=Order deleted successfully");
        exit();
    }
} else {
    echo "No order ID provided!";
}
?>
