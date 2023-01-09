<?php

session_start();
include 'includes/db.php';

if (isset($_SESSION['restoassist_user'])) {
    header("Location: index");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RestoAssist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="h-vh bg-white">

    <div class="row justify-content-center align-items-center h-vh">
        <div class="col-md-9">
            <div class="login-bg">
                <img src="assets/img/logo white.png" class="img-fluid" width="400">
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 br-0">
                <div class="card-body">
                    <div class="text-center">
                        <img src="assets/img/logo full.png" alt="logo" width="250">
                    </div>
                    <?php
                    if (isset($_GET['error'])) {

                        $error = strip_tags($_GET['error']);
                        echo "<div class='alert alert-danger mt-3'>$error</div>";
                    }
                    ?>
                    <form action="functions/functions.php" method="post" class="mt-3">
                        <div class="input">
                            <label for="username" class="fw-bold">Username</label>
                            <input type="text" class="form-control br-0" name="username" id="username" placeholder="Enter Username" required>
                        </div>
                        <div class="input mt-3">
                            <label for="password" class="fw-bold">Password</label>
                            <input type="password" class="form-control br-0" name="password" id="password" placeholder="Enter Password" required>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-theme mt-3 w-100 br-0" name="login" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>