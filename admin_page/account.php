<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Account List</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
    <style>
        /* Thêm border cho nút Add */
        .btn-add {
            border: 2px solid #28a745;
            /* Đổi màu border thành màu xanh lá */
            border-radius: 8px;
            /* Bo góc */
            padding: 10px 20px;
            /* Điều chỉnh padding */
        }

        /* Đưa các nút Edit và Delete vào cùng một hàng */
        .action-buttons {
            display: flex;
            gap: 10px;
            /* Khoảng cách giữa các nút */
        }

        .action-buttons form {
            display: inline-block;
            /* Đảm bảo mỗi form hiển thị trên một dòng */
        }
    </style>
</head>

<body id="reportsPage">
    <!-- navigation bar -->
    <?php
    require("Views_admin/header.php");
    ?>
    <!-- navigation bar -->
    <div class="container mt-5">
        <div class="row tm-content-row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-products">
                    <h2 class="tm-block-title">Account List</h2>
                    <!-- Nút thêm tài khoản -->
                    <a href="add_account.php" class="btn btn-success mb-3 btn-add">Add Account</a>

                    <div class="tm-product-table-container">
                        <table class="table table-hover tm-table-small tm-product-table">
                            <thead>
                                <tr>
                                    <th scope="col">USER NAME</th>
                                    <th scope="col">PASSWORD</th>
                                    <th scope="col">FULL NAME</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">PHONE NUMBER</th>
                                    <th scope="col">ADDRESS</th>
                                    <th scope="col">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Kết nối cơ sở dữ liệu
                                $host = 'localhost';
                                $dbname = 'project2';
                                $username = 'root';
                                $password = '';

                                try {
                                    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    // Truy vấn dữ liệu từ bảng user
                                    $stmt = $conn->prepare("SELECT id, user_name, password, fullname, email, phone_number, address FROM user");
                                    $stmt->execute();

                                    // Hiển thị dữ liệu
                                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    if (!empty($users)) {
                                        foreach ($users as $row) {
                                            echo "<tr>
                                                <td class='tm-product-name'>" . htmlspecialchars($row['user_name']) . "</td>
                                                <td>" . htmlspecialchars($row['password']) . "</td>
                                                <td>" . htmlspecialchars($row['fullname']) . "</td>
                                                <td>" . htmlspecialchars($row['email']) . "</td>
                                                <td>" . htmlspecialchars($row['phone_number']) . "</td>
                                                <td>" . htmlspecialchars($row['address']) . "</td>
                                                <td class='action-buttons'>
                                                    <!-- Edit button -->
                                                    <form action='edit_account.php' method='GET'>
                                                        <button type='submit' class='btn btn-warning btn-sm' name='id' value='" . $row['id'] . "' style='border-radius: 10px;'>
                                                            Edit
                                                        </button>
                                                    </form>
                                                    <!-- Delete button -->
                                                    <form action='delete_account.php' method='POST'>
                                                        <button type='submit' class='btn btn-danger btn-sm' name='id' value='" . $row['id'] . "' style='border-radius: 10px;' onclick='return confirm(\"Are you sure you want to delete this account?\");'>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center'>No accounts found.</td></tr>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<tr><td colspan='7' class='text-center'>Error: " . $e->getMessage() . "</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
    require("Views_admin/footer.php");
    ?>
    <!-- Footer -->

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>