<?php

    session_start();
    include_once '../../model/connect.php';
    include_once '../../model/method_stmt.php';

    if(empty($_SESSION['logged_in']) || empty($_SESSION['is_manager'])){
        header("location: ../../view/manager/view_manager_login.php");
    }
    
    $obj = new method_stmt();

    if(isset($_POST['add_announce'])){
        $announce = $_POST['announce'];

        if(empty($announce)){
            $_SESSION['error'] = "กรุณากรอก ข่าวสาร";
            header("location: ../../view/manager/view_add_announce.php"); 
            return;
        }

        $result = $obj->addAnnounce($announce);
        if($result === true){
            header("location: ../../view/manager/view_announces.php"); 
        }
    
    }else{
        header("location: ../../index.php");
    }
?>