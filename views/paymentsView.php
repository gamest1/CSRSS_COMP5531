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

$today = date("Y-m-d"); 

$employeeIDs = '<option value=""></option>';
$employeeIDs .= '<option value="all">ALL</option>';

for($i=0;$i<count($employees);$i++) {
   $employeeIDs .= '<option value="' . $employees[$i] . '">' . $employees[$i] . '</option>' . "\n";
}


$tableView = '<table class="table table-striped table-bordered table-hover">';
$tableView .= "<tr><th>Employee ID</th><th>Period Begins</th><th>Period Ends</th><th>Payment Amount</th><th>Payment Code</th><th>Date Processed</th></tr>";

for($i=0;$i<count($payments);$i++) {
                $row = "";
                $rowHash = $payments[$i];

                $row .= "<tr>";
                $row .= '<td id="Employee' . $i . '">' . $rowHash['employeeID'] ;
                $row .= '</td><td><input type="hidden" value="' . $rowHash['period_start_on'] . '" id="PeriodStart' . $i . '">' . $rowHash['period_start_on'];
                $row .= '</td><td><input type="hidden" value="' . $rowHash['period_finish_on'] . '" id="PeriodEnd' . $i . '">' . $rowHash['period_finish_on'];
                $row .= "</td><td>" . $rowHash['amount'] . "</td>";

                $code = $rowHash['payment_code'];
                if ($code == NULL) {

                  $row .= '<td><input type="text" placeholder="input 4-digit payment code here" maxlength="4" class="ctrl-textbox" id="PaymentCode' . "$i\"></td>";
                  $row .= '<td><input type="button" id="PaymentButton" onclick="sendCode(' . $i . ');" value="Process Payment"></td>';
                }
                else {
                  $row .= "<td>" . $code . "</td>";
                  $row .= "<td>" . $rowHash['paid_on'] . "</td>";
                }

                $row .= "</tr>";
                $tableView .= $row;    
}

$tableView .= "</table>";


?>


<div class="container-fluid">
  
  <div class="row-fluid">
    <div class="span2">
      <!--Sidebar content-->
      <?  $activeIndex = 10;
          include("viewmenu.php"); ?>


    </div>
    <div class="span10">
      <!--Body content-->
      <div class="row-fluid">
        <div class="span12">

        <div class="droppedField" id="employeeIDDIV">
          <label class="control-label">Select employee ID</label>
          <select class="ctrl-combobox" name="employeeID" id="employeeID" onchange="paymentViewGetPaymentsForID();">
            <? echo $employeeIDs; ?>
          </select>
        </div>

        <div id="ajaxLoad" style="display: none;">
            <label class="control-label">Please wait while we run your query...</label>
            <img src="../assets/img/ajax-loader.gif" alt="Please wait..." height="32" width="32">
        </div>

        <div id="message"></div>  

        </div>
      </div><!--/row-->    

      <div class="row-fluid" id="allEmployeesTable"  style="display: none;">
        <div class="span12">

        <h2>Payments</h2>

        <? echo $tableView; ?>

       <hr>

        </div>
      </div><!--/row--> 

      <div id="allTables" style="display: none;">

      <div class="row-fluid">
        <div class="span12">
        <div id="message"></div>  

      <h2>Payments</h2>

       <div id="paymentsTable" style="display: none;"></div> 

       <hr>
      <h2>Unpaid services</h2>

       <div id="unpaidTable" style="display: none;"></div>

       <hr>
          <p>In order to process unpaid services, create a payment interval that includes the date when the unpaid service was 
          performed on and click on Generate Payment Instance. A valid payment interval must not overlap any of the intervals 
          shown on the Payments table!</p>
        </div>
      </div><!--/row-->        

      
      <div class="row-fluid" id="calendars" style="display: none;">
      <form action="../controllers/createPaymentInterval.php" method="post">
        <div class="span4">
          <div class="input-append date" id="paymentBeginPicker" data-date="<? echo $today; ?>" data-date-format="yyyy-mm-dd">
          <input class="span12" size="16" type="text" value="<? echo $today; ?>" readonly="" name="paymentBeginDate">
          <span class="add-on"><i class="icon-calendar"></i></span>
          </div>
        </div>
        <div class="span4">
          <div class="input-append date" id="paymentEndPicker" data-date="<? echo $today; ?>" data-date-format="yyyy-mm-dd">
          <input class="span12" size="16" type="text" value="<? echo $today; ?>" readonly="" name="paymentEndDate">
          <span class="add-on"><i class="icon-calendar"></i></span>
          </div>
        </div>
        <div class="span4">
          <div class="droppedField">
            <input type="hidden" name="employeeID" id="hiddenID">
            <button class="btn btn-primary ctrl-btn" name="createPaymentButton" style="float:right;" type="submit">Generate Payment Instance</button>
          </div>
        </div>
      </form>
      </div><!--/row-->

     </div> 

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
