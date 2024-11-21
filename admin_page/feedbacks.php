<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feedback Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
                    <div class="tm-product-table-container">
                        <table class="table table-hover tm-table-small tm-product-table">
                            <thead>
                                <tr>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">FULL NAME</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">PHONE NUMBER</th>
                                    <th scope="col">SUBJECT</th>
                                    <th scope="col">NOTE</th>
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

                                    // Truy vấn dữ liệu
                                    $stmt = $conn->prepare("SELECT fullname, email, phone_number, subject_name, note FROM feedback");
                                    $stmt->execute();

                                    // Hiển thị dữ liệu
                                    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    if (!empty($feedbacks)) {
                                        foreach ($feedbacks as $row) {
                                            echo "<tr>
                                                <td></td>
                                                <td class='tm-product-name'>" . htmlspecialchars($row['fullname']) . "</td>
                                                <td>" . htmlspecialchars($row['email']) . "</td>
                                                <td>" . htmlspecialchars($row['phone_number']) . "</td>
                                                <td>" . htmlspecialchars($row['subject_name']) . "</td>
                                                <td>" . htmlspecialchars($row['note']) . "</td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>No feedback found.</td></tr>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<tr><td colspan='6' class='text-center'>Lỗi: " . $e->getMessage() . "</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- table container -->
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
