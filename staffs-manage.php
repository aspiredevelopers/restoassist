<!doctype html>
<html lang="en">

<head>
    <title>Staffs Manage - RestoAssist</title>
    <?php include("contents/head.php"); ?>
</head>

<body>

    <div class="container-fluid">

        <?php include("contents/navbar.php"); ?>

        <div class="main">

            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap w-100 datatable">
                            <thead>
                                <tr>
                                    <th class="fit">Sl No</th>
                                    <th class="fit">Staff ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Phone</th>
                                    <th>Mail</th>
                                    <th class="fit">Created Date</th>
                                    <th class="fit">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $get_ac = "select * from tbl_staffs where user_type='staff' order by id DESC";
                                $run_ac = mysqli_query($con, $get_ac);
                                while ($row_ac = mysqli_fetch_array($run_ac)) {
                                    $staff_id = $row_ac['staff_id'];
                                    $img = $row_ac['img'];
                                    $name = $row_ac['name'];
                                    $desg = $row_ac['desg'];
                                    $phone = $row_ac['phone'];
                                    $mail = $row_ac['mail'];
                                    $date = $row_ac['date'];
                                ?>

                                    <tr>
                                        <td class="fit sl"></td>
                                        <td class="fit"><?php echo $staff_id ?></td>
                                        <td><img src="assets/staffs/<?php echo $img ?>" class="img-fluid" width="50"></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $desg ?></td>
                                        <td><a href="tel:<?php echo $phone ?>" class="d-flex" target="_blank"><i class="bi bi-telephone me-2"></i> <?php echo $phone ?></a></td>
                                        <td><a href="mailto:<?php echo $mail ?>" class="d-flex" target="_blank"><i class="bi bi-envelope me-2"></i> <?php echo $mail ?></a></td>
                                        <td><?php echo $date ?></td>
                                        <td class="fit">
                                            <div class="d-flex">
                                                <form action="edit-staff.php" method="post">
                                                    <input type="hidden" name="staff_id" value="<?php echo $staff_id ?>">
                                                    <button type="submit" name="edit_staff" class="btn btn-primary btn-sm me-1" onclick="return confirm('Are you sure to update this item?');"><i class="bi bi-pencil"></i></button>
                                                </form>
                                                <form action="functions/functions.php" method="post">
                                                    <input type="hidden" name="staff_id" value="<?php echo $staff_id ?>">
                                                    <button type="submit" name="del_staff" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this item?');"><i class="bi bi-trash"></i></button>
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
        changeSubNav("staffs", "staff-manage", "Staffs Manage");
        <?php if (isset($_POST["filter-invoices"])) { ?>

            $("#date-from").val('<?php echo $date_from; ?>');
            $("#date-to").val('<?php echo $date_to; ?>');

        <?php } ?>
    </script>
</body>

</html>