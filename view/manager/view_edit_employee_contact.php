<?php
session_start();

if (empty($_SESSION['logged_in']) || empty($_SESSION['is_manager'])) {
    header("location: ./view_manager_login.php");
}


include_once "../../model/connect.php";
include_once "../../model/method_stmt.php";

$obj = new method_stmt();;

$employee_id = $_GET['id'];

$employee = $obj->getEmployeeById($employee_id);

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
    <form action="../../controller/manager/edit_employee_contact_controller.php" method="POST" class="form">
        <div class="title">
            แก้ไขข้อมูลการติดต่อพนักงาน
        </div>
        <div class="note">แก้ไขข้อมูลสำหรับพนักงานของคุณ</div>
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

        <input placeholder="ไอดี" name="id" id="id" class="form-input hidden" value="<?= $employee_id ?>">

        <label for="fname">ชื่อ</label>
        <input placeholder="ชื่อ" name="fname" id="fname" class="form-input" value="<?php echo $employee['fname']; ?>">

        <label for="lname">นามสกุล</label>
        <input placeholder="นามสกุล" name="lname" id="lname" class="form-input" value="<?php echo $employee['lname']; ?>">

        <label for="nick_name">ชื่อเล่น</label>
        <input placeholder="ชื่อเล่น" name="nick_name" id="nick_name" class="form-input" value="<?php echo $employee['nick_name']; ?>">

        <label for="phone_number">เบอร์ติดต่อ</label>
        <input placeholder="เบอร์ติดต่อ" name="phone_number" id="phone_number" class="form-input" type="text" value="<?php echo $employee['phone_number']; ?>">

        <label for="line">LINE</label>
        <input placeholder="LINE" name="line" id="line" class="form-input" type="text" value="<?php echo $employee['line']; ?>">

        <label for="email">E-mail</label>
        <input placeholder="E-mail" name="email" id="email" class="form-input" type="text" value="<?php echo $employee['email']; ?>">

        <button class="login-submit-btn" type="submit" name="edit_employee">
            ยืนยันการแก้ไข
        </button>
    </form>

</body>

</html>