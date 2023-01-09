<!doctype html>
<html lang="en">

<head>
    <title>Account - RestoAssist</title>
    <?php include("contents/head.php"); ?>
</head>

<body>

    <div class="container-fluid">

        <?php include("contents/navbar.php"); ?>

        <div class="main">
            <form action="functions/functions.php" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <p class="fw-bold"><span class="text-theme">Change</span> Password : </p>
                                <div class="mb-3">
                                    <label for="op" class="form-label m-0">Old Password <span class="text-theme">*</span></label>
                                    <input type="password" class="form-control br-0" id="op" name="opass" placeholder="Enter Old Password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="np" class="form-label m-0">New Password <span class="text-theme">*</span></label>
                                    <input type="password" class="form-control br-0" id="np" name="npass" placeholder="Enter New Password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="rnp" class="form-label m-0">Re-Enter New Password <span class="text-theme">*</span></label>
                                    <input type="password" class="form-control br-0" id="rnp" name="rnpass" placeholder="Re-Enter New Password" required>
                                </div>
                                <button type="submit" class="btn btn-theme float-end btn-sm br-0" name="change-pass">Change Password</button>
                            </div>
                        </div>
            </form>
        </div>
    </div>

    </div>

    <?php include("contents/footer.php"); ?>

    </div>
    </div>
    </div>

    <?php include("contents/scripts.php"); ?>
    <script>
        changeNav("account", "My Account");
    </script>
</body>

</html>