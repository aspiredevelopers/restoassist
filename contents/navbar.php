<div class="row">
    <div class="col-10 col-md-2 p-0 d-none d-sm-block" id="sidebar-div">
        <div class="sidebar">
            <div class="logo ">
                <img src="assets/img/logo full.png" alt="logo" class="img-fluid" width="200">
            </div>

            <ul class="sidebar-navs">
                <a href="/">
                    <li class="dashboard"><i class="bi bi-house"></i> Dashboard</li>
                </a>
                <a href="new-order">
                    <li class="new-order"><i class="bi bi-plus-square"></i> New Order</li>
                </a>
                <?php if ($user_type == "admin") { ?>
                    <a href="tables">
                        <li class="tables"><i class="bi bi-egg"></i> Tables</li>
                    </a>
                    <a href="items">
                        <li class="items"><i class="bi bi-box"></i> Items</li>
                    </a>
                    <div class="nav-dropdown">
                        <a href="#">
                            <li class="staffs drop"><i class="bi bi-person-badge"></i> Staffs <i class="bi bi-caret-right-fill arrow float-end"></i></li>
                        </a>
                        <div class="nav-subdropdown d-none">
                            <a href="add-staff">
                                <li class="add-staff">Add Staff</li>
                            </a>
                            <a href="staffs-manage">
                                <li class="staffs-manage">Manage Staffs</li>
                            </a>
                            <a href="designations">
                                <li class="designations">Designations</li>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                <a href="reports">
                    <li class="reports"><i class="bi bi-file-spreadsheet"></i> Reports</li>
                </a>
                <a href="settings">
                    <li class="settings"><i class="bi bi-gear"></i> Settings</li>
                </a>
            </ul>
        </div>
    </div>

    <div class="col-12 col-md-10 p-3">

        <div class="row">
            <div class="col-md-12 topbar-col">
                <div class="topbar">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-7 col-md-8 d-flex align-items-center">
                            <div class="me-2 arrow-buttons d-none d-sm-block">
                                <a href="#" id="back-button" onclick="goBack();"><i class="bi bi-arrow-left-circle"></i></a>
                                <a href="#" id="next-button" onclick="goNext();"><i class="bi bi-arrow-right-circle"></i></a>
                            </div>
                            <h4 class="title"></h4>
                        </div>
                        <div class="col-3 col-md-4 ms-auto">
                            <div class="d-flex align-items-center">

                                <div class="dropdown ms-auto">
                                    <div class="user float-end dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="text-end me-3 d-none d-sm-block">
                                            <p class="m-0 fw-bold"><?php echo $user ?></p>
                                            <p class="m-0 desg">(<?php echo $username ?>)</p>
                                        </div>
                                        <img src="assets/img/avatar.jpg" alt="avatar" class="img-fluid rounded me-2">
                                    </div>
                                    <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuButton1">
                                        <?php if ($user_type == "admin") { ?>
                                            <li><a class="dropdown-item" href="account">My Account</a></li>
                                        <?php } ?>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET['error'])) {

            $error = strip_tags($_GET['error']);
            echo "<div class='alert alert-danger mt-3' id='alert'>$error</div>";
        }

        if (isset($_GET['success'])) {

            $success = strip_tags($_GET['success']);
            echo "<div class='alert alert-success mt-3' id='alert'>$success</div>";
        }

        ?>