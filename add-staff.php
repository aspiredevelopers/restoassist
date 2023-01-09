<!doctype html>
<html lang="en">

<head>
    <title>Add Staff - RestoAssist</title>
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

                        <div class="mb-3">
                            <label for="name" class="form-label m-0">Image</label>
                            <input type="file" class="form-control br-0" id="img" name="img" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label m-0 fw-bold">Name</label>
                                <input type="text" class="form-control br-0" id="name" name="name" placeholder="Enter Name" required>
                            </div>

                            <div class="col-md-6">
                                <label for="desg" class="form-label m-0">Designation</label>
                                <select name="desg" id="desg" class="form-control br-0" required>
                                    <option value="">Select Designation</option>
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
                                <input type="number" class="form-control br-0" id="phone" name="phone" placeholder="Enter Phone Number" required>
                            </div>

                            <div class="col-md-4">
                                <label for="mail" class="form-label m-0">Mail</label>
                                <input type="mail" class="form-control br-0" id="mail" name="mail" placeholder="Enter Mail" required>
                            </div>
                            <div class="col-md-4">
                                <label for="dob" class="form-label m-0">DOB</label>
                                <input type="date" class="form-control br-0" id="dob" name="dob" placeholder="Select DOB" required>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="username" class="form-label m-0">Username</label>
                                <input type="text" class="form-control br-0" id="username" name="username" placeholder="Enter Username" required>
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label m-0">Password</label>
                                <input type="text" class="form-control br-0" id="password" name="password" placeholder="Enter Password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success float-end br-0" name="add_staff">Add Staff</button>

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
        changeSubNav("staffs", "add-staff", "Add Staff");
    </script>
</body>

</html>