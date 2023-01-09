<!doctype html>
<html lang="en">

<head>
    <title>Settings - RestoAssist</title>
    <?php include("contents/head.php"); ?>
</head>

<body>

    <div class="container-fluid">

        <?php include("contents/navbar.php"); ?>

        <div class="main">
            <div class="row">
                <?php if ($user_type == "admin") { ?>
                    <div class="col-12 mb-2">
                        <a href="account">
                            <div class="card">
                                <div class="card-body">
                                    <p class="m-0"><i class="bi bi-key text-theme"></i> Change password <i class="bi bi-caret-right-fill arrow float-end"></i></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
                <div class="col-12">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <div class="card">
                            <div class="card-body">
                                <p class="m-0"><i class="bi bi-box-arrow-right text-theme"></i> Logout <i class="bi bi-caret-right-fill arrow float-end"></i></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <?php include("contents/footer.php"); ?>

    </div>
    </div>
    </div>

    <?php include("contents/scripts.php"); ?>
    <script>
        changeNav("settings", "Settings");
    </script>
</body>

</html>