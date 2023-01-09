<!doctype html>
<html lang="en">

<head>
    <title>New Order - RestoAssist</title>
    <?php include("contents/head.php"); ?>
</head>

<body>

    <div class="container-fluid">

        <?php include("contents/navbar.php"); ?>

        <div class="main">

            <form action="functions/functions.php" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body p-4">
                        <p class="fw-bold"><span class="text-theme">Customer</span> Details : </p>

                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="date" class="form-label m-0">Date</label>
                                        <input type="date" class="form-control br-0" id="date" name="date" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="table" class="form-label m-0">Table</label>
                                        <select name="table" id="table" class="form-control br-0" required>
                                            <option value="">Select Table</option>
                                            <?php

                                            $table_sql = "select * from tbl_tables order by title";
                                            $run_table = mysqli_query($con, $table_sql);
                                            while ($row_table = mysqli_fetch_array($run_table)) {
                                                $table = $row_table["title"];
                                            ?>
                                                <option value="<?php echo $table ?>"><?php echo $table ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="name" class="form-label m-0">Name</label>
                                        <input type="text" class="form-control br-0" id="name" name="name" placeholder="Enter Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone" class="form-label m-0">Phone</label>
                                        <input type="number" class="form-control br-0" id="phone" name="phone" placeholder="Enter Phone">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="place" class="form-label m-0">Place</label>
                                        <input type="number" class="form-control br-0" id="place" name="place" placeholder="Enter Place">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body p-4">
                        <p class="fw-bold"><span class="text-theme">Item</span> Details : </p>
                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-12">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <label for="item" class="form-label m-0">Item</label>
                                        <select name="item" class="form-control br-0" id="item">
                                            <option value="">Select Item</option>
                                            <?php

                                            $item_sql = "select * from tbl_items order by id";
                                            $run_item = mysqli_query($con, $item_sql);
                                            while ($row_item = mysqli_fetch_array($run_item)) {
                                                $title = $row_item["title"];
                                            ?>
                                                <option value="<?php echo $title ?>"><?php echo $title ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="price" class="form-label m-0">Price</label>
                                        <input type="number" class="form-control br-0" id="price" name="price" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="qty" class="form-label m-0">Qty</label>
                                        <input type="number" class="form-control br-0" id="qty" name="qty">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success btn-sm br-0" id="add" onclick="testUpdate();">Add Item</button>
                                    </div>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div class="col-md-8 mt-3">
                                <div class="table-responsive">
                                    <table id="cbTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sl No</th>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div class="col-md-12">
                                <div class="row justify-content-end">
                                    <div class="col-md-4">
                                        <div class="row justify-content-end">
                                            <div class="col-md-12">
                                                <div class="mb-3 row">
                                                    <label for="st" class="col-sm-3 col-form-label text-end">Subtotal :</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control br-0" id="st" name="subtotal" value="0.00" readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="dis" class="col-sm-3 col-form-label text-end">Discount :</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control br-0" id="dis" name="discount" value="0.00">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="gt" class="col-sm-3 col-form-label text-end">Grand Total :</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control br-0" id="gt" name="grandtotal" value="0.00" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success float-end br-0" id="add-order" name="add_order">Add Order</button>
                            </div>
                        </div>
                    </div>
            </form>

        </div>

        <?php include("contents/footer.php"); ?>

    </div>
    </div>
    </div>

    <?php include("contents/scripts.php"); ?>
    <script>
        changeNav("new-order", "New Order");
    </script>
</body>

</html>