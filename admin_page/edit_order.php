<style>
    /* Reset mặc định cho các phần tử */
body, h1, h2, h3, h4, h5, h6, p, form, label, input, select, button {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
}

/* Tổng quan body */
body {
    background-color: #f4f4f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 20px;
}

/* Form container */
form {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 30px;
    width: 100%;
    max-width: 400px;
}

/* Nhãn của input */
form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

/* Input và select */
form input[type="text"], 
form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    color: #333;
    background-color: #f9f9f9;
    transition: all 0.3s ease;
}

form input[type="text"]:focus, 
form select:focus {
    border-color: #007bff;
    outline: none;
    background-color: #fff;
}

/* Button */
form button {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #0056b3;
}

/* Thêm khoảng cách giữa các thành phần */
form label + input,
form label + select {
    margin-top: 10px;
}

</style>
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
