<?php
session_start();

if (empty($_SESSION['logged_in'])) {
    return header("location: ../employee/view_employee_login.php");
}

if (isset($_SESSION['logged_in']) && isset($_SESSION['is_employee'])) {
    return header("location: ../employee/view_employee_info.php");
}

include_once "../../model/connect.php";
include_once "../../model/method_stmt.php";

$obj = new method_stmt();
$result2 = $obj->getAllEmployees();
$no = 1
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../index.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee-system</title>
    <style>
        body {
            display: flex;
            justify-content: center;
        }

        .form {
            padding-top: 4rem;
            width: 450px;
        }
    </style>
</head>

<body>
    <form action="../../controller/manager/add_employee_controller.php" method="POST" class="form">

        <div class="title">
            เพิ่มข้อมูลพนักงาน
        </div>
        <div class="note">กรอกข้อมูลเพื่อเพิ่ม ข้อมูลพนักงาน</div>
        <div class="underline"></div>
        <?php
        if (isset($_SESSION['error'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                <p style="">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error'])
                    ?>
                </p>
            </div>
        <?php
        }
        ?>
        <input placeholder="ชื่อ" name="fname" class="form-input"></input>
        <input placeholder="นามสกุล" name="lname" class="form-input"></input>
        <input placeholder="ชื่อเล่น" name="nick_name" class="form-input"></input>
        <input placeholder="**รหัสผ่าน สำหรับพนักงาน" class="form-input" name="password" type="password"></input>
        <button class="login-submit-btn" type="submit" name="add_employee">
            เพิ่มพนักงาน
        </button>
    </form>

</body>

</html>