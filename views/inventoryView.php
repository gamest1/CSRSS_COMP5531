<?php

session_start();

if (!isset($_SESSION['employeeID'])) {
    $message = "You must login first";
    include '../views/loginView.php';
    return;
}
else {

include("viewheader.php");
include("viewtopbar.php");

$tableView = "<table class=\"table table-striped table-bordered table-hover\">";
$tableView .= "<tr><th>Part ID</th><th>Part Name</th><th>Item Type</th><th>Number Sold</th><th>Number Available</th></tr>";

for($i=0;$i<count($inventory);$i++) {
                $row = "";
                $rowHash = $inventory[$i];
                $partID = $rowHash['partID'];
                $part_type = $rowHash['part_type'];
                $row .= "<tr>";
                $row .= "<td><a href=\"javascript:fetchPurchaseHistory($partID);\">";
                $row .= "$partID</a></td><td>" . $rowHash['partName'] . "</td>";
                $row .= "<td>$part_type</td><td>" . $rowHash['numberSold'] . "</td>";
                $row .= "<td>" . $rowHash['numberAvailable'] . "</td>";
                $row .= "</tr>";
                $tableView .= $row;    
}

$tableView .= "</table>";


?>


<div class="container-fluid">
  
  <div class="row-fluid">
    <div class="span2">
      <!--Sidebar content-->
      <?  $activeIndex = 3;
          include("viewmenu.php"); ?>


    </div>
    <div class="span10">
      <!--Body content-->

      <div id="purchaseHistory" style="display: none;"> 
        <div id="purchaseHistoryTable"></div>
      </div>

      <h2>Inventory</h2>
      
      <div id="ajaxLoad" style="display: none;">
              <label class="control-label">Please wait while we run your query...</label>
              <img src="../assets/img/ajax-loader.gif" alt="Please wait..." height="32" width="32">
      </div>
      
      <hr>
       <? echo $tableView; ?>

    </div>

  </div><!--/row-->

  <hr>

      <footer>
        <p>&copy; Esteban's Computer and Repair Store - 2013</p>
      </footer>

</div><!--/.fluid-container-->

 
 <?
include("viewfooter.php");

}
?>
