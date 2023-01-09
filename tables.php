<!doctype html>
<html lang="en">

<head>
    <title>Tables - RestoAssist</title>
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
                            <div class="col-md-4">
                                <label for="title" class="form-label m-0">Table:</label>
                                <input type="text" class="form-control br-0" id="title" name="table" placeholder="Enter Table" required>
                            </div>
                            <div class="col-md-4">
                                <label for="price" class="form-label m-0">Seats:</label>
                                <input type="number" class="form-control br-0" id="price" name="seats" placeholder="Enter Seats" required>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-theme btn-sm br-0" name="add_table">Add New</button>
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
                                    <th>Table</th>
                                    <th>Seats</th>
                                    <th class="fit">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $get_ac = "select * from tbl_tables order by id DESC";
                                $run_ac = mysqli_query($con, $get_ac);
                                while ($row_ac = mysqli_fetch_array($run_ac)) {
                                    $id = $row_ac['id'];
                                    $title = $row_ac['title'];
                                    $seats = $row_ac['seats'];
                                ?>

                                    <tr>
                                        <td class="fit sl"></td>
                                        <form action="functions/functions.php" method="post" class="d-flex">
                                            <td>
                                                <input type="text" name="table" value="<?php echo $title ?>" class="form-control blank-input title-input" readonly required>
                                            </td>
                                            <td class="d-flex">
                                                <input type="number" name="seats" value="<?php echo $seats ?>" class="form-control blank-input price-input" readonly required>
                                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                                <button type="submit" name="update_table" class="btn btn-success btn-sm br-0 ms-2 me-2 update-btn d-none" onclick="return confirm('Are you sure to update this item?');">update</button>
                                                <button type="button" class="btn btn-danger btn-sm remove-item br-0 d-none"><i class="bi bi-x"></i></button>
                                            </td>
                                        </form>
                                        <td class="fit">
                                            <div class="d-flex">
                                                <button class="btn btn-primary btn-sm me-1 edit-item"><i class="bi bi-pencil"></i></button>
                                                <form action="functions/functions.php" method="post">
                                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                                    <button type="submit" name="del_table" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this item?');"><i class="bi bi-trash"></i></button>
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
        changeNav("tables", "Tables");
    </script>
</body>

</html>