<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login Page</title>
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/templatemo-style.css" />
</head>
<body id="loginPage">
    <div class="container tm-mt-big tm-mb-big" style="height:550px">
        <div class="row">
            <div class="col-12 mx-auto tm-login-col">
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="tm-block-title mb-4">Welcome to Dashboard</h2>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <form action="ctrl_login.php" method="post" class="tm-login-form">
                                <div class="form-group">
                                    <label for="admin_name">Admin Name</label>
                                    <input name="admin_name" type="text" class="form-control validate" id="admin_name" required />
                                </div>
                                <div class="form-group mt-3">
                                    <label for="admin_password">Password</label>
                                    <input name="admin_password" type="password" class="form-control validate" id="admin_password" required />
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" name="login" class="btn btn-primary btn-block text-uppercase">Login</button>
                                </div>
                            </form>

                            <?php if (isset($_GET['login']) && $_GET['login'] === 'false') : ?>
                                <div class="alert alert-danger mt-4">
                                    Sai mật khẩu hoặc tên đăng nhập. Vui lòng thử lại.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
