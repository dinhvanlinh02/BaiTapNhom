<?php
// Kết nối cơ sở dữ liệu
$host = 'localhost';
$dbname = 'project2';
$username = 'root';
$password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Cập nhật thông tin tài khoản
        $stmt = $conn->prepare("UPDATE user SET user_name = :user_name, password = :password, fullname = :fullname, email = :email, phone_number = :phone_number, address = :address WHERE id = :id");

        // Ràng buộc tham số
        $stmt->bindParam(':user_name', $user_name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':id', $id);

        // Thực thi truy vấn
        $stmt->execute();

        // Chuyển hướng về trang account.php sau khi cập nhật thành công
        header("Location: account.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
