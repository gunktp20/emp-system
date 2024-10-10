<?php
session_start();

// ถ้ายังไม่ได้ Login ให้กลับไปหน้า Login
if (empty($_SESSION['logged_in'])) {
    return header("location: ../employee/view_employee_login.php");
}
// หากเข้าสู่ระบบแล้วแต่ไม่ได้เป็น manager ให้ไปหน้าดูข้อมูลส่วนตัวของพนักงาน
if (isset($_SESSION['logged_in']) && isset($_SESSION['is_employee'])) {
    return header("location: ../employee/view_employee_info.php");
}

include_once "../../model/connect.php";
include_once "../../model/method_stmt.php";

$obj = new method_stmt();;

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
            align-items: center;
            justify-content: center;
        }

        .form {
            width: 450px;
            padding-top: 2rem;
        }
    </style>
</head>

<body>
    <form action="../../controller/manager/add_announce_controller.php" method="POST" class="form">
        <div class="title">
            ประกาศข่าวสาร
        </div>
        <div class="note">
            เพิ่มข่าวสารสำหรับพนักงานของคุณ
        </div>
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
        <label for="announce">ประกาศข่าวสาร</label>
        <input placeholder="ประกาศข่าวสาร" name="announce" id="announce" class="form-input" type="text">

        <button class="login-submit-btn" type="submit" name="add_announce">
            ยืนยันการเพิ่มข่าวสาร
        </button>
    </form>

</body>

</html>