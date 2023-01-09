<!doctype html>
<html lang="en">

<head>
    <title>Report - RestoAssist</title>
    <?php include("contents/head.php"); ?>
</head>

<body>

    <div class="container-fluid">

        <?php include("contents/navbar.php"); ?>

        <div class="main">

            <div class="card">
                <div class="card-body px-4">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-3 d-flex justify-content-center me-2 me-md-0">
                            <form action="" method="post">
                                <button type="submit" class="btn btn-primary" name="today-leads">Today</button>
                                <a href="reports" class="btn btn-warning ms-1">Refresh</a>
                            </form>
                        </div>
                        <div class="col-12 col-md-9 float-end mt-2 mt-md-0">
                            <form action="" method="post">
                                <div class="row align-items-center">
                                    <label for="date-from" class="col-12 col-md-1 col-form-label">From :</label>
                                    <div class="col-12 col-md-4 p-0">
                                        <input type="date" class="form-control" id="date-from" name="date-from" required>
                                    </div>
                                    <label for="date-to" class="col-12 col-md-1 col-form-label">To :</label>
                                    <div class="col-12 col-md-4 p-0">
                                        <input type="date" class="form-control" id="date-to" name="date-to" required>
                                    </div>
                                    <div class="col-12 col-md-2 text-center mt-2 mt-md-0">
                                        <button type="submit" name="filter-leads" class="btn btn-success">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (isset($_POST["today-leads"])) {
                $date = date('Y-m-d');
            ?>
                <div class="card mt-2">
                    <div class="card-body text-center">
                        <h6 class="m-0 fw-bold">Today : <span class="text-theme"><?php echo $date ?></span></h6>
                    </div>
                </div>
            <?php } ?>

            <?php if (isset($_POST["filter-leads"])) {
                $date_from = date("Y-m-d", strtotime($_POST["date-from"]));
                $date_to = date("Y-m-d", strtotime($_POST["date-to"]));
            ?>
                <div class="card mt-2">
                    <div class="card-body text-center">
                        <h6 class="m-0 fw-bold">Date : <span class="text-theme"><?php echo $date_from ?></span> - <span class="text-theme"><?php echo $date_to ?></span></h6>
                    </div>
                </div>
            <?php } ?>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap w-100 datatable">
                            <thead>
                                <tr>
                                    <th class="fit">Sl No</th>
                                    <th class="fit">Order No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Place</th>
                                    <th>Table</th>
                                    <th>Subtotal</th>
                                    <th>Discount</th>
                                    <th>Grand Total</th>
                                    <th>Date</th>
                                    <th>Staff</th>
                                    <th class="fit">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                if (isset($_POST["today-leads"])) {
                                    $get_ac = "select * from tbl_orders where date='$date' order by id DESC";
                                } else if (isset($_POST["filter-leads"])) {
                                    $get_ac = "select * from tbl_orders where date between '$date_from' and '$date_to' order by id DESC";
                                } else {
                                    $get_ac = "select * from tbl_orders order by id DESC";
                                }

                                $run_ac = mysqli_query($con, $get_ac);
                                while ($row_ac = mysqli_fetch_array($run_ac)) {
                                    $order_id = $row_ac['id'];
                                    $name = $row_ac['name'];
                                    $phone = $row_ac['phone'];
                                    $place = $row_ac['place'];
                                    $table = $row_ac['order_table'];
                                    $subtotal = $row_ac['subtotal'];
                                    $discount = $row_ac['discount'];
                                    $grandtotal = $row_ac['grandtotal'];
                                    $date = $row_ac['date'];
                                    $staff = $row_ac['staff'];
                                ?>

                                    <tr>
                                        <td class="fit sl"></td>
                                        <td class="fit"><?php echo $order_id ?></td>
                                        <td class="fw-bold"><?php echo $name ?></td>
                                        <td><a href="tel:<?php echo $phone ?>" class="d-flex" target="_blank"><i class="bi bi-telephone me-2"></i> <?php echo $phone ?></a></td>
                                        <td><?php echo $place ?></td>
                                        <td><?php echo $table ?></td>
                                        <td>₹<?php echo $subtotal ?></td>
                                        <td>₹<?php echo $discount ?></td>
                                        <td>₹<?php echo $grandtotal ?></td>
                                        <td><?php echo $date ?></td>
                                        <td><?php echo $staff ?></td>
                                        <td class="fit d-flex">
                                        <button class="btn btn-primary btn-sm me-1" onclick="return confirm('Are you sure to update this item?');"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-danger btn-sm me-1" onclick="return confirm('Are you sure to delete this item?');"><i class="bi bi-trash"></i></button>
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
        changeNav("reports", "Report");
        <?php if (isset($_POST["filter-leads"])) { ?>

            $("#date-from").val('<?php echo $date_from; ?>');
            $("#date-to").val('<?php echo $date_to; ?>');

        <?php } ?>
    </script>
</body>

</html>