<?php
// Kết nối cơ sở dữ liệu
$host = 'localhost';
$dbname = 'project2';
$username = 'root';
$password = '';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Xóa tài khoản
        $stmt = $conn->prepare("DELETE FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Chuyển hướng về trang account.php sau khi xóa thành công
        header("Location: account.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
