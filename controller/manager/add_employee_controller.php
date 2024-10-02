<?php

    session_start();
    include_once '../../model/connect.php';
    include_once '../../model/method_stmt.php';

    if(empty($_SESSION['logged_in']) || empty($_SESSION['is_manager'])){
        header("location: ../../view/manager/view_manager_login.php");
    }
    
    $obj = new method_stmt();

    if(isset($_POST['add_employee'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $nick_name = $_POST['nick_name'];
        $password = $_POST['password'];

        if(empty($fname)){
            $_SESSION['error'] = "กรุณากรอก ชื่อจริง";
            header("location: ../../view/manager/view_add_employee.php"); 
            return;
        }else if(empty($lname)){
            $_SESSION['error'] = "กรุณากรอก นามสกุล";
            header("location: ../../view/manager/view_add_employee.php"); 
            return;
        }else if(empty($nick_name)){
            $_SESSION['error'] = "กรุณากรอก ชื่อเล่น";
            header("location: ../../view/manager/view_add_employee.php"); 
            return;
        }else if(empty($password)){
            $_SESSION['error'] = "กรุณากรอก รหัสผ่าน";
            header("location: ../../view/manager/view_add_employee.php"); 
            return;
        }

        $result = $obj->addEmployee($fname,$lname,$nick_name,$password);
        if($result === true){
            header("location: ../../view/manager/view_employees.php"); 
        }
    
    }else{
        header("location: ../../index.php");
    }
?>