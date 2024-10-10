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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee-system</title>
  <style>
    body {
      display: flex;
    }
  </style>
</head>

<body>


  <div class="sidebar">
    <div>
      <div class="title2">
        <!-- Logo -->
        <div>Employee System</div>
      </div>
      <ul class="menu">
        <a
          href="./view_employees.php"
          class="nav-link">
          รายชื่อพนักงาน
        </a>
        <a
          href="./view_add_employee.php"
          class="nav-link">
          เพิ่มข้อมูลพนักงาน
        </a>
        <a
          href="./view_employees_contact.php"
          class="nav-link">
          ช่องทางติดต่อพนักงาน
        </a>
        <a
          href="./view_employees_bank.php"
          class="nav-link active">
          บัญชีธนาคารพนักงาน
        </a>
        <a
          href="./view_announces.php"
          class="nav-link">
          ข่าวสารทั้งหมด
        </a>
        <a
          href="./view_add_announce.php"
          class="nav-link">
          เพิ่มประกาศ
        </a>
      </ul>
    </div>

    <a class="logout-menu" href="../../controller/logout_controller.php">
      ออกจากระบบ
    </a>
  </div>

  <!-- table content -->
  <div class="table-container">
    <?php

    echo "<table id='employee'>
        <tr>
            <th>รหัส</th>
            <th>ชื่อ-นามสกุล</th>
            <th>ชื่อเล่น</th>
            <th>บัญชีธนาคารของ</th>
            <th>เลขบัญชี</th>
            <th>ตัวเลือก</th>
      </tr>
  ";

    foreach ($result2 as $row) {
    ?>
      <tr>
        <td><?= $row["id"] ?></td>
        <td><?= $row["fname"] ?>-<?= $row["lname"] ?></td>
        <td><?= $row["nick_name"] ?></td>
        <td><?php if ($row["bank_account"] !== null) {
              echo $row["bank_account"];
            } else {
              echo "-";
            } ?></td>
        <td><?php if ($row["bank_account_number"] !== null) {
              echo $row["bank_account_number"];
            } else {
              echo "-";
            } ?></td>
        <td class="option-col">
          <a class="edit-btn" href="./view_edit_employee_bank_account.php?id=<?= $row['id'] ?>">
            แก้ไข
          </a>
          <button class="delete-btn" data-id="<?= $row["id"] ?>">ลบ</button>
        </td>
      </tr>

    <?php
      $no++;
    }
    ?>
    </table>

    <a href="./view_add_employee.php" class="add-employee-nav-btn">เพิ่มข้อมูลพนักงาน</a>
  </div>

  <script>
    document.querySelectorAll('.delete-btn').forEach(button => {
      button.addEventListener('click', function() {
        const itemId = this.getAttribute('data-id');

        // Show SweetAlert2 confirmation dialog
        Swal.fire({
          text: "คุณต้องการลบพนักงานคนนี้หรือไม่",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ลบเลย!',
          cancelButtonText: 'ยกเลิก'
        }).then((result) => {
          if (result.isConfirmed) {
            // Send delete request to server
            window.location.href = `../../controller/manager/delete_employee_controller.php?id=${itemId}`;
          }
        });
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>