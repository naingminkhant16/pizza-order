<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .login {
            max-width: 1000px;
            margin-top: 40px;
            border: 1px #eee solid;
            border-radius: 10px;
            padding: 20px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
    </style>
</head>

<body>
    <div class="login container">
        <h2 class="text-center">Admin Panel Login</h2><br>
        <div class="row row-cols-1 row-cols-sm-2">
            <div class="col">
                <img src="../images/pizza-cartoon-doodle-illustration_1366-924.webp" class="container-fluid">
            </div>
            <div class="col">
                <form action="_actions/login.php" method="POST" class="container mt-5 " style="max-width: 400px;">
                    <?php if (isset($_GET['error'])) : ?>
                        <div class="alert alert-warning" style="font-size:14px">Incorrect password or maybe you don't have access!</div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email :</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password :</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary w-100">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>