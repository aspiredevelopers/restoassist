<?php

session_start();
include '../includes/db.php';

date_default_timezone_set("Asia/Kolkata");

if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($con, $_POST['username']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);

    $passhash = hash("sha256", $pass);

    $query = "select * from tbl_staffs where user='$user' and pass='$passhash'";
    $run = mysqli_query($con, $query);
    $count = mysqli_num_rows($run);

    if ($count == 1) {
        $_SESSION['restoassist_user'] = $user;
        header("location:../");
    } else {
        header("location:../login?error=Invalid credentials!");
    }
}

if (isset($_POST["logout"])) {
    unset($_SESSION["restoassist_user"]);
    header("location: ../");
}

if (isset($_POST["add_staff"])) {

    $nlquery = "SELECT * FROM tbl_staffs WHERE id=(SELECT MAX(id) FROM tbl_staffs);";
    $nlrun = mysqli_query($con, $nlquery);
    $nlcount = mysqli_num_rows($nlrun);
    if ($nlcount > 0) {
        $nlrow = mysqli_fetch_array($nlrun);
        if ($nlrow["staff_id"] == null) {
            $staff_id = "RA-0056";
        } else {
            $lastcid = $nlrow["staff_id"];
            $lastcid_no = (int)str_replace("RA-", "", $lastcid) + 1;
            $digitlen = strlen((string)$lastcid_no);

            if ($digitlen < 4) {
                $digbl = 4 - (int)$digitlen;
                $zero = str_repeat("0", $digbl);
                $staff_id = "RA-" . $zero . (string)$lastcid_no;
            } else {
                $staff_id = "RA-" . (string)$lastcid_no;
            }
        }
    } else {
        $staff_id = "RA-0056";
    }

    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $desg = mysqli_real_escape_string($con, $_POST["desg"]);
    $phone = mysqli_real_escape_string($con, $_POST["phone"]);
    $mail = mysqli_real_escape_string($con, $_POST["mail"]);
    $dob = mysqli_real_escape_string($con, $_POST["dob"]);
    $user = mysqli_real_escape_string($con, $_POST["username"]);
    $pass = mysqli_real_escape_string($con, $_POST["password"]);
    $pass_hash = hash("sha256", $pass);

    $file_name = $_FILES['img']['name'];
    $file_temp = $_FILES['img']['tmp_name'];

    $new_file_name = $name . $file_name;

    $file_loc = '../assets/staffs/' . $new_file_name;

    move_uploaded_file($file_temp, $file_loc);

    $query = $con->query("insert into tbl_staffs(staff_id, img, name, phone, mail, desg, dob, user, pass, user_type) values('$staff_id', '$new_file_name', '$name', '$phone', '$mail', '$desg', '$dob', '$user', '$pass_hash', 'staff')");

    if ($query === TRUE) {
        header("location:../add-staff?success=New staff added successfully");
    } else {
        header("location:../add-staff?error=Failed to add new staff!");
    }
}

if (isset($_POST["update_staff"])) {

    $sid = mysqli_real_escape_string($con, $_POST["staff_id"]);
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $desg = mysqli_real_escape_string($con, $_POST["desg"]);
    $phone = mysqli_real_escape_string($con, $_POST["phone"]);
    $mail = mysqli_real_escape_string($con, $_POST["mail"]);
    $dob = mysqli_real_escape_string($con, $_POST["dob"]);
    $user = mysqli_real_escape_string($con, $_POST["username"]);
    $pass = mysqli_real_escape_string($con, $_POST["password"]);

    $new_file_name = "";
    if ($_FILES["img"]["size"] == 0) {
        $new_file_name = mysqli_real_escape_string($con, $_POST["old_img"]);
    } else {
        $file_name = $_FILES['img']['name'];
        $file_temp = $_FILES['img']['tmp_name'];

        $new_file_name = $name . $file_name;

        $file_loc = '../assets/staffs/' . $new_file_name;
        move_uploaded_file($file_temp, $file_loc);
    }

    if ($pass == "") {
        $check_pass = "select * from tbl_staffs where staff_id='$sid'";
        $run_pass = mysqli_query($con, $check_pass);
        $row_pass = mysqli_fetch_assoc($run_pass);
        $pass_hash = $row_pass["pass"];
    } else {
        $pass_hash = hash("sha256", $pass);
    }

    $query = $con->query("update tbl_staffs set img='$new_file_name', name='$name', desg='$desg', phone='$phone', mail='$mail', dob='$dob', user='$user', pass='$pass_hash' where staff_id='$sid'");

    if ($query === TRUE) {
        header("location:../staffs-manage?success=Staff updated successfully");
    } else {
        header("location:../staffs-manage?error=Failed to update staff!");
    }
}


if (isset($_POST["del_staff"])) {

    $id = mysqli_real_escape_string($con, $_POST['staff_id']);
    $query = $con->query("update tbl_staffs set status='Removed' where staff_id='id'");

    if ($query === TRUE) {
        header("location:../staff-manage?success=Staff deleted successfully");
    } else {
        header("location:../staff-manage?error=Failed to delete staff!");
    }
}

if (isset($_POST["change-pass"])) {

    $opass = mysqli_real_escape_string($con, $_POST["opass"]);
    $npass = mysqli_real_escape_string($con, $_POST["npass"]);
    $rnpass = mysqli_real_escape_string($con, $_POST["rnpass"]);
    if ($npass == $rnpass) {
        $opasshash = hash("sha256", $opass);
        $npasshash = hash("sha256", $npass);

        $query = "select * from tbl_staffs where user_type='admin' and pass='$opasshash'";
        $run = mysqli_query($con, $query);
        $count = mysqli_num_rows($run);

        if ($count == 1) {
            $query = $con->query("update tbl_staffs set pass='$npasshash' where user_type='admin'");
            if ($query == TRUE) {
                header("location:../account?success=Password changed successfully");
            } else {
                header("location:../account?error=Failed to change password!");
            }
        } else {
            header("location:../account?error=Old password is incorrect!");
        }
    } else {
        header("location:../account?error=New passwords are does not match!");
    }
}

if (isset($_POST['add_desg'])) {

    $desg = mysqli_real_escape_string($con, $_POST['desg']);
    $query = $con->query("insert into tbl_desgs(desg) values('$desg')");

    if ($query === TRUE) {
        header("location:../designations?success=New designation added successfully");
    } else {
        header("location:../designations?error=Failed to add new designation!");
    }
}

if (isset($_POST["update_desg"])) {

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $title = mysqli_real_escape_string($con, $_POST['desg']);
    $query = $con->query("update tbl_desgs set desg = '$title' where id='$id'");

    if ($query === TRUE) {
        header("location:../designations?success=Designation updated successfully");
    } else {
        header("location:../designations?error=Failed to update designation!");
    }
}


if (isset($_POST["del_desg"])) {

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $query = $con->query("delete from tbl_desgs where id = '$id'");

    if ($query === TRUE) {
        header("location:../designations?success=Designation deleted successfully");
    } else {
        header("location:../designations?error=Failed to delete designation!");
    }
}


if (isset($_POST['add_item'])) {

    $title = mysqli_real_escape_string($con, $_POST['title']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $query = $con->query("insert into tbl_items(title, price) values('$title', '$price')");

    if ($query === TRUE) {
        header("location:../items?success=New item added successfully");
    } else {
        header("location:../items?error=Failed to add new item!");
    }
}

if (isset($_POST["update_item"])) {

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $query = $con->query("update tbl_items set title = '$title', price='$price' where id='$id'");

    if ($query === TRUE) {
        header("location:../items?success=Item updated successfully");
    } else {
        header("location:../items?error=Failed to update item!");
    }
}


if (isset($_POST["del_item"])) {

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $query = $con->query("delete from tbl_items where id = '$id'");

    if ($query === TRUE) {
        header("location:../items?success=Item deleted successfully");
    } else {
        header("location:../items?error=Failed to delete item!");
    }
}

if (isset($_POST['add_table'])) {
    $table = mysqli_real_escape_string($con, $_POST['table']);
    $seats = mysqli_real_escape_string($con, $_POST['seats']);
    $query = $con->query("insert into tbl_tables(title, seats) values('$table', '$seats')");

    if ($query === TRUE) {
        header("location:../tables?success=New table added successfully");
    } else {
        header("location:../tables?error=Failed to add new table!");
    }
}

if (isset($_POST["update_table"])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $table = mysqli_real_escape_string($con, $_POST['table']);
    $seats = mysqli_real_escape_string($con, $_POST['seats']);
    $query = $con->query("update tbl_tables set title = '$table', seats='$seats' where id='$id'");

    if ($query === TRUE) {
        header("location:../tables?success=Table updated successfully");
    } else {
        header("location:../tables?error=Failed to update table!");
    }
}


if (isset($_POST["del_table"])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $query = $con->query("delete from tbl_tables where id = '$id'");

    if ($query === TRUE) {
        header("location:../tables?success=Table deleted successfully");
    } else {
        header("location:../tables?error=Failed to delete table!");
    }
}


if (isset($_POST["search_item"])) {

    $val = $_POST["item"];
    $sql = "select * from tbl_items where title LIKE '%$val%'";

    $run = mysqli_query($con, $sql);
    $count = mysqli_num_rows($run);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($run);
        $price = $row['price'];
        echo $price;
    } else {
        echo "0.00";
    }
}


if (isset($_POST["add_order"])) {
    $staff = $_SESSION["restoassist_user"];
    $date = mysqli_real_escape_string($con, $_POST["date"]);
    $table = mysqli_real_escape_string($con, $_POST["table"]);
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $phone = mysqli_real_escape_string($con, $_POST["phone"]);
    $place = mysqli_real_escape_string($con, $_POST["place"]);
    $st = mysqli_real_escape_string($con, $_POST["subtotal"]);
    $dis = mysqli_real_escape_string($con, $_POST["discount"]);
    $gt = mysqli_real_escape_string($con, $_POST["grandtotal"]);

    $sql = "insert into tbl_orders(name, phone, place, order_table, subtotal, discount, grandtotal, date, staff) values('$name', '$phone', '$place', '$table', '$st', '$dis', '$gt', '$date', '$staff')";
    $run = mysqli_query($con, $sql);

    $order_id = mysqli_insert_id($con);

    $particular = $_POST["item"];
    $price = $_POST["price"];
    $qty = $_POST["qty"];
    $total = $_POST["total"];

    foreach ($particular as $key => $n) {
        $prt = $n;
        $pri = $price[$key];
        $qt = $qty[$key];
        $tot = $total[$key];

        $con->query("insert into tbl_order_details(item, price, qty, total, order_id) values('$prt', '$pri', '$qt', '$tot', '$order_id')");
    }

    if ($run === TRUE) {
        header("location:../new-order?success=Order added successfully");
    } else {
        header("location:../new-order?error=Failed to add order!");
    }
}
