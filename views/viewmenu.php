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
              <li class="active"><a href="../controllers/menuMainController.php">New Sale, Upgrade, or Repair</a></li>
              <li><a href="../controllers/menuSearchPartsController.php">Search Part</a></li>
              <li><a href="#">Device History</a></li>
              <li><a href="#">Inventory</a></li>
              <li><a href="#">Update/Add Part</a></li>
              <? 
              if($_SESSION['isAdmin'] == 1) { 
              ?>
              <li class="nav-header">Admin</li>
              <li><a href="#">Payments</a></li>
              <li><a href="#">Update/Add Employees</a></li>
              <li><a href="#">Employee Report</a></li>
              <li><a href="#">Store Report</a></li>
              <? 
              } 
              ?>
            </ul>
          </div><!--/.well -->

<?
}
?>        