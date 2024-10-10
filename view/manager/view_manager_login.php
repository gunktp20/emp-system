<!DOCTYPE html>
<?php
    session_start();
    
    // ถ้าผู้ใช้เข้าสู่ระบบอยู่ จะให้ไปหน้าของผู้ หากเป็น พนักงานก็ไปหน้าดูข้อมูลส่วนตัว หากเป็น manager ให้ไปหน้าจัดการข้อมูลพนักงาน
    if(isset($_SESSION['logged_in']) && isset($_SESSION['is_employee'])){
        return header("location: ../employee/view_employee_info.php");
    }
    if(isset($_SESSION['logged_in']) && isset($_SESSION['is_manager'])){
        return header("location: ../manager/view_employees.php");
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
                ผู้จัดการ
            </div>
            <div class="note">ลงชื่อเข้าสู่ระบบสำหรับ ผู้จัดการ</div>
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
            <form action="../../controller/manager/login_manager_controller.php" method="POST">
                <input placeholder="รหัสผู้จัดการ" name="username" class="form-input-login" type="text">
                <input placeholder="รหัสผ่านเข้าสู่ระบบ" name="password" class="form-input-login" type="text">
                <button type="submit" class="login-submit-btn" name="login_manager">เข้าสู่ระบบ</button>
            </form>

            <div class="toggle-endpoint">
                สลับไปยัง การเข้าสู่ระบบของ
                <a href="../employee/view_employee_login.php" class="toggle-login-form">
                     พนักงาน
                </a>
            </div>
        </div>
    </div>

</body>

</html>