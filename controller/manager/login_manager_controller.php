<?php

    session_start();
    include_once '../../model/connect.php';
    include_once '../../model/method_stmt.php';
    
    $obj = new method_stmt();

    if(isset($_POST['login_manager'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if(empty($username)){
            $_SESSION['error'] = "กรุณากรอก username";
            header("location: ../../view/manager/view_manager_login.php"); 
            return;
        }else if(empty($password)){
            $_SESSION['error'] = "กรุณากรอก password";
            header("location: ../../view/manager/view_manager_login.php"); 
            return;
        }else{
            $result = $obj->loginManager($username,$password);
            if($result == true){
                $_SESSION['logged_in'] = true;
                $_SESSION['is_manager'] = true;
                header("location: ../../view/manager/view_employees.php"); 
            }else{
                header("location: ../../view/manager/view_employees.php"); 
            }
        }

       
    }else{
        header("location: ../../index.php");
    }
?>