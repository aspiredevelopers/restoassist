<!doctype html>
<html lang="en">

<head>
    <title>Dashboard - RestoAssist</title>
    <?php include("contents/head.php"); ?>
</head>

<body>

    <?php

    // $date = date('Y-m-d');
    // $sql = "select * from tbl_schedules where DATE(datetime)='$date' AND status='pending'";
    // $run = mysqli_query($con, $sql);
    // $count = mysqli_num_rows($run);

    // if ($count > 0) {

    //     $nsql = "select * from tbl_notifications where DATE(time)='$date'";
    //     $nrun = mysqli_query($con, $nsql);
    //     $ncount = mysqli_num_rows($nrun);

    //     if ($ncount == 0) {
    //         $ndate = date('Y-m-d');
    //         $con->query("insert into tbl_notifications(content, time, flag) values('You have $count schedules today!', '$ndate', '0')");
    //     }
    // }

    ?>

    <?php include("contents/mobile-nav.php"); ?>

    <div class="container-fluid">

        <?php include("contents/navbar.php"); ?>

        <div class="main">

            <div class="row h-100">

                <div class="col-md-8">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="fw-bold mb-4">Today's <span class="text-theme">Orders</span></h6>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap w-100 datatable">
                                    <thead>
                                        <tr>
                                            <th class="fit">Sl No</th>
                                            <th>Order ID</th>
                                            <th class="fit">Name</th>
                                            <th>Phone</th>
                                            <th>Place</th>
                                            <th>Table</th>
                                            <th>Subtotal</th>
                                            <th>discount</th>
                                            <th>Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $date = date('Y-m-d');
                                        $get_ac = "select * from tbl_orders where date='$date' order by id DESC";

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
                                            </tr>

                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="fw-bold text-center mb-4">Today's <span class="text-theme">Overview</span></h6>
                            <canvas id="myChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="fw-bold text-center mb-4">Monthly <span class="text-theme">Overview</span></h6>
                            <canvas id="myChart2" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="fw-bold text-center mb-4">Total <span class="text-theme">Overview</span></h6>
                            <canvas id="myChart3" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?php include("contents/footer.php"); ?>

    </div>
    </div>
    </div>

    <?php include("contents/scripts.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <script>
        changeNav("dashboard", "Dashboard");

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Staff 1', 'Staff 2', 'Staff 3', 'Staff 4', 'Staff 5', 'Staff 6',],
                datasets: [{
                    label: '# of Votes',
                    data: [10,2,5,8,20,4],
                    backgroundColor: [
                        '#4b6580',
                        '#8e44ad',
                        '#0fb9b1',
                        '#2c3e50',
                        '#e67e22',
                        '#ea2027',
                        '#2980b9',
                        '#27ae60'
                    ],
                    borderColor: [
                        '#4b6580',
                        '#8e44ad',
                        '#0fb9b1',
                        '#2c3e50',
                        '#e67e22',
                        '#ea2027',
                        '#2980b9',
                        '#27ae60'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx2 = document.getElementById('myChart2').getContext('2d');
        const myChart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['01-01', '02-01', '03-01', '04-01', '05-01', '06-01', '07-01', '08-01', '09-01'],
                datasets: [{
                    data: [10,2,5,8,20,4,6,9,50],
                    backgroundColor: [
                        '#4b6580',
                        '#8e44ad',
                        '#0fb9b1',
                        '#2c3e50',
                        '#e67e22',
                        '#ea2027',
                        '#2980b9',
                        '#27ae60'
                    ],
                    borderColor: [
                        '#ffffff',
                        '#ffffff',
                        '#ffffff',
                        '#ffffff',
                        '#ffffff',
                        '#ffffff',
                        '#ffffff',
                        '#ffffff'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            },
        });

        const ctx3 = document.getElementById('myChart3').getContext('2d');
        const myChart3 = new Chart(ctx3, {
            type: 'polarArea',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    data: [110,20,50,80,25,40,60,90,87,50,100,120],
                    backgroundColor: [
                        '#4b6580',
                        '#8e44ad',
                        '#0fb9b1',
                        '#2c3e50',
                        '#e67e22',
                        '#ea2027',
                        '#2980b9',
                        '#27ae60'
                    ],
                    borderColor: [
                        '#ffffff',
                        '#ffffff',
                        '#ffffff',
                        '#ffffff',
                        '#ffffff',
                        '#ffffff',
                        '#ffffff',
                        '#ffffff'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            },
        });
    </script>
</body>

</html>