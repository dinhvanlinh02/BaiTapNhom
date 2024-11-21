<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Accounts - Product Admin Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
   
</head>

<body id="reportsPage">
    <div class="" id="home">
        <!-- navigation bar -->
        <?php
        require("Views_admin/header.php");
        ?>
        <!-- navigation bar -->
        <div class="container tm-mt-big tm-mb-big" style="height:550px">
        <div class="tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                <h2 class="tm-block-title">Orders List</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ORDER ID</th>
                            <th scope="col">GUEST</th>
                            <th scope="col">TELEPHONE</th>
                            <th scope="col">TOTAL MONEY</th>
                            <th scope="col">ORDER DATE</th>
                            <th scope="col">STATUS</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">DETAIL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once("../Models/clsOrder.php");
                        $clsOrder = new clsOrder();
                        $orders = $clsOrder->getAllOrder();
                        foreach ($orders as $row) { ?>
                            <tr>
                                <th scope="row"><b><?= $row["id"] ?></b></th>
                                <td><b><?= $row["fullname"] ?></b></td>
                                <td><b><?= $row["phone_number"] ?></b></td>
                                <td> $<b><?= $row["total_money"] ?></b></td>
                                <td><?= $row["order_date"] ?></td>
                                <?php
                                $status = (int)$row["status"];

                                switch ($status) {
                                    case 0: { ?>
                                            <td>
                                                <div class="tm-status-circle pending">
                                                </div>Pending confirm
                                            </td>
                                       
                                        <?php };
                                        break;
                                    case 1: { ?>
                                            <td>
                                                <div class="tm-status-circle cancelled">
                                                </div>Cancelled
                                            </td>
                                         
                                        <?php };
                                        break;
                                    case 2: { ?>
                                            <td>
                                                <div class="tm-status-circle confirm">
                                                </div>Confirmed
                                            </td>
                                          
                                        <?php };
                                        break;

                                    case 3: { ?>
                                            <td>
                                                <div class="tm-status-circle moving">
                                                </div>Moving
                                         

                                            </td> <?php };
                                                break;
                                            case 4: { ?>
                                            <td>
                                                <div class="tm-status-circle paided">
                                                </div>Paided
                                            </td>
                                           
                                        <?php };
                                                break;
                                            default: { ?> <td></td> <?php };
                                                                        break;
                                                                }
                                                                            ?>
                                <td>
    <form action="edit_order.php" method="GET" style="display: inline;">
        <button type="submit" class="btn btn-warning" name="order_id" value="<?= $row['id'] ?>" style="border-radius: 10px;">
            Edit
        </button>
    </form>
                                </td>
                                <td>
    <form action="delete_order.php" method="POST" style="display: inline;">
        <button type="submit" class="btn btn-danger" name="order_id" value="<?= $row['id'] ?>" style="border-radius: 10px;">
            Delete
        </button>
    </form>
</td>


                                <td><a href="testdata.php?order_id=<?=$row["id"]?>" class="link-info">Detail</a></td>

                            </tr>
                        <?php }
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
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
</body>

</html>