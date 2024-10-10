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

$employee_id = $_GET['id'];
// เรียกดูข้อมูลปัจจุบันของพนักงานก่อน เพื่อจะได้รู้ว่าข้อมูลปัจจุบันเป็นอะไรก่อนจะแก้ไข
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
    <form action="../../controller/manager/edit_employee_controller.php" method="POST" class="form">
        <div class="title">
            แก้ไขข้อมูลพนักงาน
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
        <input placeholder="ไอดี" name="id" class="form-input hidden" value="<?= $employee_id ?>">
        <label>ชื่อ</label>
        <input placeholder="ชื่อ" name="fname" class="form-input" value="<?php echo $employee['fname']; ?>">
        <label>นามสกุล</label>
        <input placeholder="นามสกุล" name="lname" class="form-input" value="<?php echo $employee['lname']; ?>">
        <label>ชื่อเล่น</label>
        <input placeholder="ชื่อเล่น" name="nick_name" class="form-input"
            value="<?php echo $employee['nick_name']; ?>">
        <label>จำนวนวันลา</label>
        <input placeholder="จำนวนวันลา" name="leave_days" class="form-input"
            value="<?php echo $employee['leave_days']; ?>">
        <label>ค่าแรง / วัน</label>
        <input placeholder="ค่าแรง / วัน" name="wage_per_date" class="form-input"
            type="number" value="<?php echo $employee['wage_per_date']; ?>">
        <label>จำนวนวัน</label>
        <input placeholder="จำนวนวัน" name="num_of_work_date" class="form-input"
            type="number" value="<?php echo $employee['num_of_work_date']; ?>">
        <label>บวกค่ากะ</label>
        <input placeholder="บวกค่ากะ" name="shift_fee" class="form-input"
            type="number" value="<?php echo $employee['shift_fee']; ?>">
        <label>OT / ชั่วโมง</label>
        <input placeholder="OT / ชั่วโมง" name="ot_per_hour" class="form-input"
            type="number" value="<?php echo $employee['ot_per_hour']; ?>">
        <label>จำนวนชั่วโมง OT</label>
        <input placeholder="จำนวนชั่วโมง OT" name="num_of_ot_hours" class="form-input"
            type="number" value="<?php echo $employee['num_of_ot_hours']; ?>">

        <button class="login-submit-btn" type="submit" name="edit_employee">
            ยืนยันการแก้ไข
        </button>
    </form>

</body>

</html>