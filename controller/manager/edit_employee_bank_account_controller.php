<?php

session_start();
include_once '../../model/connect.php';
include_once '../../model/method_stmt.php';

if(empty($_SESSION['logged_in']) || empty($_SESSION['is_manager'])){
    header("location: ../../view/manager/view_manager_login.php");
}

$obj = new method_stmt();

if (isset($_POST['edit_employee'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $nick_name = $_POST['nick_name'];
    $bank_account = isset($_POST['bank_account']) ? $_POST['bank_account'] : 0;
    $bank_account_number = isset($_POST['bank_account_number']) ? $_POST['bank_account_number'] : 0;

    if (empty($fname)) {
        $_SESSION['error'] = "กรุณากรอก ชื่อจริง";
        header("location: ../../view/manager/view_edit_employee_bank_account.php?id=". $id);
        return;
    } else if (empty($lname)) {
        $_SESSION['error'] = "กรุณากรอก นามสกุล";
        header("location: ../../view/manager/view_edit_employee_bank_account.php?id=". $id);
        return;
    } else if (empty($nick_name)) {
        $_SESSION['error'] = "กรุณากรอก ชื่อเล่น";
        header("location: ../../view/manager/view_edit_employee_bank_account.php?id=". $id);
        return;
    } 

    $result = $obj->editEmployeeBankAccount($id,$fname, $lname, $nick_name, $bank_account , $bank_account_number);
    if ($result === true) {
        header("location: ../../view/manager/view_employees_bank.php");
    }

} else {
    header("location: ../../index.php");
}
?>