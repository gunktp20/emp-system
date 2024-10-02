<!DOCTYPE html>
<?php
    session_start();

    if(isset($_SESSION['logged_in']) && isset($_SESSION['is_employee'])){
        header("location: ./view_employee_info.php");
    }else if(isset($_SESSION['logged_in']) && isset($_SESSION['is_employee'])){
        header("location: ./view_employee_info.php");
    }
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../index.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee-system</title>
</head>

<body>
    <div class="login-manager">
        <div class="form-login">
            <div class="title">
            พนักงาน
            </div>
            <div class="note">ลงชื่อเข้าสู่ระบบสำหรับพนักงาน</div>
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
            <form action="../../controller/employee/login_employee_controller.php" method="POST">
                <input placeholder="รหัสพนักงาน" name="id" class="form-input-login" type="text">
                <input placeholder="รหัสผ่านเข้าสู่ระบบ" name="password" class="form-input-login" type="text">
                <button type="submit" class="login-submit-btn" name="login_employee">เข้าสู่ระบบ</button>
            </form>
            <div class="toggle-endpoint">
                สลับไปยัง การเข้าสู่ระบบของ
                <a href="../manager/view_manager_login.php" class="toggle-login-form"">
                     ผู้จัดการ
                </a>
            </div>
        </div>


    </div>

</body>

</html>