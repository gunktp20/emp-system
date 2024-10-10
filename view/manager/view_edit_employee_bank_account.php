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
    <form action="../../controller/manager/edit_employee_bank_account_controller.php" method="POST" class="form">
        <div class="title">
            แก้ไขข้อมูลบัญชีธนาคาร
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

        <label for="bank_account">บัญชีธนาคารของ</label>
        <input placeholder="บัญชีธนาคารของ" name="bank_account" id="bank_account" class="form-input" type="text" value="<?php echo $employee['bank_account']; ?>">

        <label for="bank_account_number">เลขบัญชีธนาคาร</label>
        <input placeholder="เลขบัญชีธนาคาร" name="bank_account_number" id="bank_account_number" class="form-input" type="text" value="<?php echo $employee['bank_account_number']; ?>">

        <button class="login-submit-btn" type="submit" name="edit_employee">
            ยืนยันการแก้ไข
        </button>
    </form>

</body>

</html>