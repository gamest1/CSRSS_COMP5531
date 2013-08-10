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

$employeeIds = '<option value="" selected></option>';

$keys = array_keys($employees);
for($i=0;$i<count($keys);$i++) {
   $employeeIds .= '<option value="' . $keys[$i] . '">' . $keys[$i] . " | " . $employees[$keys[$i]]['username'] . '</option>' . "\n";
}

?>

<div class="container-fluid">
  
  <div class="row-fluid">
    <div class="span2">
      <!--Sidebar content-->
      <? 
          $activeIndex = 13;
          include("viewmenu.php"); ?>


    </div>
    <div class="span10">
      <!--Body content-->

      <div class="row-fluid marketing">
        <div class="span12">
          
          <div class="span6">
            <h4>Please choose a date interval</h4>
          <div>
            <label class="control-label">Period begin date:</label>
             <div class="input-append date" id="intervalPickerBegin" data-date="<? echo $today; ?>" data-date-format="yyyy-mm-dd">
                <input class="span12" size="16" type="text" value="<? echo $today; ?>" readonly="" name="intervalBegin" id="intervalBegin">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
         </div>

          <div>
            <label class="control-label">Period end date:</label>
             <div class="input-append date" id="intervalPickerEnd" data-date="<? echo $today; ?>" data-date-format="yyyy-mm-dd">
                <input class="span12" size="16" type="text" value="<? echo $today; ?>" readonly="" name="intervalEnd" id="intervalEnd">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
         </div>

          <div class="droppedField">
          <label class="control-label">Employee ID</label>
          <select class="ctrl-combobox" name="employeeID" id="employeeID" onchange="checkEmployeeSelection(this);">
            <? echo $employeeIds; ?>
          </select>
         </div>

          </div>

         <div class="span6">

           <div class="droppedField" id="submitButton" style="display: none; align: bottom;">
            <button class="btn btn-primary ctrl-btn" name="fetchDailyActivityButton" onclick="fetchEmployeeReport();">
              Generate employee report</button>
          </div>

            <div id="ajaxLoad" style="display: none;">
              <label class="control-label">Please wait while we run your query...</label>
              <img src="../assets/img/ajax-loader.gif" alt="Please wait..." height="32" width="32">
            </div>
        </div>
        
        </div><!-- span12 -->
      </div><!-- row -->

      <hr>

      <div class="row-fluid marketing">
        <div class="span12">
          
          <div id="employeeReport"></div>
        
        </div><!-- span12 -->
      </div><!-- row -->
     
   </div><!--/span10-->  
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
