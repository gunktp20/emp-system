<?php 
    session_start();
    if(!isset($_SESSION['logged_in'])){
        header("location: ./view/manager/view_manager_login.php");
        return;
    }

    if(isset($_SESSION['logged_in']) && isset($_SESSION['is_manager'])){
        header("location: ./view/manager/view_employees.php");
        return;
    }

    if(isset($_SESSION['logged_in']) && isset($_SESSION['is_employee'])){
        header("location: ./view/employee/view_employee_info.php");
        return;
    }
?>