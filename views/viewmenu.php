<?php

session_start();

if (!isset($_SESSION['employeeID'])) {
    $message = "You must login first";
    include '../views/loginView.php';
    return;
}
else {
?>  
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">General</li>

              <? for($i=0;$i<5;$i++) {

                 if($i==$activeIndex) echo '<li class="active">';
                 else echo '<li>';

                 switch($i) {
                  case 0:
                     echo '<a href="../controllers/menuMainController.php">New Sale, Upgrade, or Repair</a></li>';
                     break;
                  case 1:
                     echo '<a href="../controllers/menuSearchPartsController.php">Search Part</a></li>';
                     break;
                  case 2:
                     echo '<a href="../controllers/menuDeviceHistoryController.php">Device History</a></li>';
                     break; 
                  case 3:
                     echo '<a href="../controllers/menuInventoryController.php">Inventory</a></li>';
                     break;
                  case 4:
                     echo '<a href="../controllers/menuUpdatePartsController.php">Update/Add Part</a></li>';
                     break;        
                 }

              }

              if($_SESSION['isAdmin'] == 1) { 

               echo '<li class="nav-header">Admin</li>';

               for($i=10;$i<15;$i++) {

                 if($i==$activeIndex) echo '<li class="active">';
                 else echo '<li>';

                 switch($i) {
                  case 10:
                     echo '<a href="../controllers/menuPaymentsController.php">Payments</a></li>';
                     break;
                  case 11:
                     echo '<a href="../controllers/menuUpdateEmployeesController.php">Update/Add Employees</a></li>';
                     break;
                  case 12:
                     echo '<a href="../controllers/menuDailyActivityController.php">Daily Activity</a></li>';
                     break;
                  case 13:
                     echo '<a href="../controllers/menuEmployeeReportController.php">Employee Report</a></li>';
                     break; 
                  case 14:
                     echo '<a href="../controllers/menuStoreReportController.php">Store Report</a></li>';
                     break;       
                 }

              }  
              
              } 
              ?>
            </ul>
          </div><!--/.well -->

<?
}
?>        