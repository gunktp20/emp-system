<?php 

    session_start();
    include_once '../../model/connect.php';
    include_once '../../model/method_stmt.php';

    if(empty($_SESSION['logged_in']) || empty($_SESSION['is_manager'])){
        header("location: ../../view/manager/view_manager_login.php");
    }

    $id = $_GET['id'];

    $obj = new method_stmt();
    $result = $obj->deleteEmployee($id);
    if($result == true){
        header("location: ../../view/manager/view_employees.php");
    }
?>