<!doctype html>
<html lang="en">

<head>
    <title>Designations - RestoAssist</title>
    <?php include("contents/head.php"); ?>
</head>

<body>

    <div class="container-fluid">

        <?php include("contents/navbar.php"); ?>

        <div class="main">
            <div class="card mt-3">
                <div class="card-body">
                    <form action="functions/functions.php" method="post">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-1 text-end">
                                <label for="desg" class="form-label m-0">Designation:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control br-0" id="desg" name="desg" placeholder="Enter Designation" required>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-theme btn-sm br-0" name="add_desg">Add New</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap w-100 datatable">
                            <thead>
                                <tr>
                                    <th class="fit">Sl No</th>
                                    <th>Designation</th>
                                    <th class="fit">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $get_ac = "select * from tbl_desgs";
                                $run_ac = mysqli_query($con, $get_ac);
                                while ($row_ac = mysqli_fetch_array($run_ac)) {
                                    $id = $row_ac['id'];
                                    $desg = $row_ac['desg'];
                                ?>

                                    <tr>
                                        <td class="fit sl"></td>
                                        <td>
                                            <form action="functions/functions.php" method="post" class="d-flex">
                                                <input type="text" name="desg" value="<?php echo $desg ?>" class="form-control blank-input desg-input" readonly required>
                                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                                <button type="submit" name="update_desg" class="btn btn-success btn-sm br-0 ms-2 me-2 update-btn d-none" onclick="return confirm('Are you sure to update this item?');">update</button>
                                                <button type="button" class="btn btn-danger btn-sm remove-desg br-0 d-none"><i class="bi bi-x"></i></button>
                                            </form>
                                        </td>
                                        <td class="fit">
                                            <div class="d-flex">
                                                <button class="btn btn-primary btn-sm me-1 edit-desg"><i class="bi bi-pencil"></i></button>
                                                <form action="functions/functions.php" method="post">
                                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                                    <button type="submit" name="del_desg" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this item?');"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php include("contents/footer.php"); ?>

    </div>
    </div>
    </div>

    <?php include("contents/scripts.php"); ?>
    <script>
        changeSubNav("staffs", "designations", "Designations");
        <?php if (isset($_POST["filter-invoices"])) { ?>

            $("#date-from").val('<?php echo $date_from; ?>');
            $("#date-to").val('<?php echo $date_to; ?>');

        <?php } ?>
    </script>
</body>

</html>