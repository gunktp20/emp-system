<?php

session_start();

if (empty($_SESSION['logged_in']) || empty($_SESSION['is_employee'])) {
  header("location: ./view_manager_login.php");
}

include_once "../../model/connect.php";
include_once "../../model/method_stmt.php";

$obj = new method_stmt();;

$employee_id = $_SESSION["is_employee"];

$employee = $obj->getEmployeeById($employee_id);

$announces = $obj->getAllAnnounces();
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
      justify-content: center
    }

    .announce-btn {
      position: absolute;
      top: 20px;
      background-color: #fff;
      right: 30px;
      border: none;
      width: 50px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 50px;
      border-radius: 100%;
      box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
    }

    .announce-btn img {
      width: 30px;
      height: 30px;
    }

    /* Modal Styles */
    .modal {
      display: none;
      /* Hidden by default */
      position: fixed;
      /* Stay in place */
      left: 0;
      top: 0;
      width: 100%;
      /* Full width */
      height: 100%;
      /* Full height */
      background-color: rgba(0, 0, 0, 0.5);
      /* Black background with opacity */
      justify-content: center;
      align-items: center;
      z-index: 3;
    }

    .modal-content {
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      width: 400px;
      position: relative;
    }

    .close {
      position: absolute;
      top: 5px;
      right: 15px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
    }
    .close:hover {
      position: absolute;
      top: 5px;
      right: 15px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
      background-color: #ffffff85;
    }

    .announce {
      font-size: 14px;
      margin-top: 15px;
      color:#000;
    }
  </style>
</head>

<body>
  <div id="myModal" class="modal">
    <div class="modal-content">
      <h2>ข่าวสารทั้งหมด</h2>
      <span class="close" id="closeModalBtn">x</span>
      <?php
      foreach ($announces as $row) {
      ?>
        <div class="announce">
          <?= $row["announce"] ?>
        </div>
      <?php
      }
      ?>
    </div>
  </div>

  <div>
    <button id="openModalBtn" class="announce-btn">
      <img src="../../images/marketing.png">
    </button>
  </div>
  <div class="employee-info">
    <div class="employee-information-container">
      <div class="title2">
        <div>Employee System</div>
      </div>
      <div class="emp-info">
        <div class="emp-key">รหัสพนักงาน</div>
        <div><?php echo $employee['id']; ?></div>
      </div>

      <div class="emp-info">
        <div class="emp-key">ชื่อ-นามสกุล</div>
        <div><?php echo $employee['fname']; ?>-<?php echo $employee['lname']; ?></div>
      </div>

      <div class="emp-info">
        <div class="emp-key">ชื่อเล่น </div>
        <div><?php echo $employee['nick_name']; ?></div>
      </div>

      <div class="emp-info">
        <div class="emp-key">ค่าแรงต่อวัน</div>
        <div><?php echo $employee['wage_per_date']; ?></div>
      </div>

      <div class="emp-info">
        <div class="emp-key">จำนวนวันทำงาน</div>
        <div><?php echo $employee['num_of_work_date']; ?></div>
      </div>

      <div class="emp-info">
        <div class="emp-key">ค่ากะ</div>
        <div><?php echo $employee['shift_fee']; ?></div>
      </div>

      <div class="emp-info">
        <div class="emp-key">OT ต่อชั่วโมง</div>
        <div><?php echo $employee['ot_per_hour']; ?></div>
      </div>

      <div class="emp-info">
        <div class="emp-key">จำนวน OT ที่ทำงาน</div>
        <div><?php echo $employee['num_of_ot_hours']; ?></div>
      </div>

      <div class="emp-info">
        <div class="emp-key">ยอดเงิน OT ที่ได้รับ</div>
        <div><?php echo $employee['ot_summary']; ?></div>
      </div>

      <div class="emp-info">
        <div class="emp-key">ยอดรวมทั้งหมด</div>
        <div><?php echo $employee['ot_summary']; ?></div>
      </div>

      <a class="logout-menu" href="../../controller/logout_controller.php">
        ออกจากระบบ
      </a>
    </div>
  </div>


  <script>
    // Get the modal
    const modal = document.getElementById("myModal");

    // Get the button that opens the modal
    const openModalBtn = document.getElementById("openModalBtn");

    // Get the <span> element that closes the modal
    const closeModalBtn = document.getElementById("closeModalBtn");

    // When the user clicks the button, open the modal
    openModalBtn.onclick = function() {
      modal.style.display = "flex";
      modal.style.flexDirection = "column";
    }

    // When the user clicks on the close button, close the modal
    closeModalBtn.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
</body>

</html>