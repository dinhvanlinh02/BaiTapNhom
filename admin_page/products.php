<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Product Page - Admin HTML Template</title>
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
                    <th scope="col">PRODUCT NAME</th>
                    <th scope="col">PRODUCT ID</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">PRICE</th>
                    
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
  <?php
  require_once("clsSanpham.php");
  $sanpham = new clsSanpham();
  $rows = $sanpham->getListProduct();
  if ($rows == null) {
      die("<p>ERROR IN DATABASE</p>");
  }
  foreach ($rows as $row) {
      ?>
      <tr>
          <td class="tm-product-name"><?= isset($row["title"]) ? $row["title"] : "N/A" ?></td>
          <td><?= isset($row["id"]) ? $row["id"] : "N/A" ?></td>
          <td><?= isset($row["title"]) ? $row["title"] : "N/A" ?></td>

          <td><?= isset($row["price"]) ? $row["price"] : "N/A" ?></td>
          


          <td>
              <a href="fix_product.php?id=<?= $row["id"] ?>" class="tm-product-delete-link">
                  <i class="fas fa-wrench tm-product-delete-icon"></i>
              </a>
          </td>
          <td>
              <a onclick="return confirm('DO YOU WANT TO DELETE PRODUCT?');" href="delete_process.php?id=<?= $row["id"] ?>" class="tm-product-delete-link">
                  <i class="far fa-trash-alt tm-product-delete-icon"></i>
              </a>
          </td>

      </tr>
      <?php
  }
  ?>
</tbody>

              </table>
            </div>
            <!-- table container -->
            <a
              href="add_product.php"
              class="btn btn-primary btn-block text-uppercase mb-3">Add new product</a>
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
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
      $(function() {
        $(".tm-product-name").on("click", function() {
          window.location.href = "edit-product.html";
        });
      });
    </script>
  </body>
</html>