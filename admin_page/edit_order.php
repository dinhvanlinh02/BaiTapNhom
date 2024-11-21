<?php
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Kết nối cơ sở dữ liệu và lấy thông tin đơn hàng
    require_once("clsOrder.php");
    $clsOrder = new clsOrder();
    $order = $clsOrder->getOrderById($order_id);

    if ($order) {
        // Hiển thị form chỉnh sửa
        ?>
        <form action="update_order.php" method="POST">
            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
            <label for="fullname">Guest Name:</label>
            <input type="text" name="fullname" value="<?= $order['fullname'] ?>" required>
            <label for="phone_number">Phone:</label>
            <input type="text" name="phone_number" value="<?= $order['phone_number'] ?>" required>
            <label for="status">Status:</label>
            <select name="status"> <!-- Đảm bảo name là 'status' -->
                <option value="0" <?= $order['status'] == 0 ? 'selected' : '' ?>>Pending</option>
                <option value="1" <?= $order['status'] == 1 ? 'selected' : '' ?>>Cancelled</option>
                <option value="2" <?= $order['status'] == 2 ? 'selected' : '' ?>>Confirmed</option>
                <option value="3" <?= $order['status'] == 3 ? 'selected' : '' ?>>Moving</option>
                <option value="4" <?= $order['status'] == 4 ? 'selected' : '' ?>>Paid</option>
            </select>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <?php
    } else {
        echo "Order not found!";
    }
} else {
    echo "No order ID provided!";
}
?>
