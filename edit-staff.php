<?php

if (!isset($_POST["edit_staff"])) {
    header("Location: /");
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Update Staff - RestoAssist</title>
    <?php include("contents/head.php"); ?>
</head>

<body>

    <div class="container-fluid">

        <?php include("contents/navbar.php"); ?>

        <div class="main">

            <div class="card">
                <div class="card-body p-4">
                    <p class="fw-bold"><span class="text-theme">Staff</span> Details : </p>
                    <form action="functions/functions.php" method="POST" enctype="multipart/form-data">

                        <?php

                        $sid = $_POST["staff_id"];
                        $sql = "select * from tbl_staffs where staff_id='$sid'";
                        $run = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($run);

                        $img = $row["img"];
                        $name = $row["name"];
                        $desg = $row["desg"];
                        $phone = $row["phone"];
                        $mail = $row["mail"];
                        $dob = $row["dob"];
                        $user = $row["user"];
                        $pass = $row["pass"];

                        ?>

                        <div class="mb-3">
                            <label for="name" class="form-label m-0">Image</label>
                            <input type="file" class="form-control br-0" id="img" name="img">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label m-0 fw-bold">Name</label>
                                <input type="text" class="form-control br-0" id="name" name="name" value="<?php echo $name ?>" placeholder="Enter Name" required>
                            </div>

                            <div class="col-md-6">
                                <label for="desg" class="form-label m-0">Designation</label>
                                <select name="desg" id="desg" class="form-control br-0" required>
                                    <option value="<?php echo $desg ?>"><?php echo $desg ?></option>
                                    <?php

                                    $desg_sql = "select * from tbl_desgs order by desg";
                                    $run_desg = mysqli_query($con, $desg_sql);
                                    while ($row_desg = mysqli_fetch_array($run_desg)) {
                                        $desg = $row_desg["desg"];
                                    ?>
                                        <option value="<?php echo $desg ?>"><?php echo $desg ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="phone" class="form-label m-0">Phone</label>
                                <input type="number" class="form-control br-0" id="phone" name="phone" value="<?php echo $phone ?>" placeholder="Enter Phone Number" required>
                            </div>

                            <div class="col-md-4">
                                <label for="mail" class="form-label m-0">Mail</label>
                                <input type="mail" class="form-control br-0" id="mail" name="mail" value="<?php echo $mail ?>" placeholder="Enter Mail" required>
                            </div>
                            <div class="col-md-4">
                                <label for="dob" class="form-label m-0">DOB</label>
                                <input type="date" class="form-control br-0" id="dob" name="dob" value="<?php echo $dob ?>" placeholder="Select DOB" required>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label m-0">Username</label>
                                <input type="text" class="form-control br-0" id="username" name="username" value="<?php echo $user ?>" placeholder="Enter Username" required>
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label m-0">Password</label>
                                <input type="text" class="form-control br-0 mb-2" id="password" name="password" placeholder="Enter Password">
                                <p class="fs-12">* To update password, change password</p>
                            </div>
                        </div>

                        <input type="hidden" name="old_img" value="<?php echo $img ?>">
                        <input type="hidden" name="staff_id" value="<?php echo $sid ?>">
                        <button type="submit" class="btn btn-success float-end" name="update_staff">Update Staff</button>

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
        changeSubNav("staffs", "staffs-manage", "Update Staff");
    </script>
</body>

</html>