<?php

    session_start();
    include_once '../../model/connect.php';
    include_once '../../model/method_stmt.php';
    
    $obj = new method_stmt();

    if(isset($_POST['login_employee'])){
        $id = $_POST['id'];
        $password = $_POST['password'];
        
        if(empty($id)){
            $_SESSION['error'] = "กรุณากรอก รหัสพนักงาน";
            header("location: ../../view/employee/view_employee_login.php"); 
            return;
        }else if(empty($password)){
            $_SESSION['error'] = "กรุณากรอก รหัสผ่าน";
            header("location: ../../view/employee/view_employee_login.php"); 
            return;
        }else{
            $result = $obj->loginEmployee($id,$password);
            if($result == true){
                $_SESSION['logged_in'] = true;
                $_SESSION['is_employee'] = $id;
                header("location: ../../view/employee/view_employee_info.php"); 
            }else{
                header("location: ../../view/employee/view_employee_login.php"); 
            }
        }

       
    }else{
        header("location: ../../index.php");
    }
?>