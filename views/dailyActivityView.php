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

?>

<div class="container-fluid">
  
  <div class="row-fluid">
    <div class="span2">
      <!--Sidebar content-->
      <? 
          $activeIndex = 12;
          include("viewmenu.php"); ?>


    </div>
    <div class="span10">
      <!--Body content-->

      <div class="row-fluid marketing">
        <div class="span12">
          
          <div class="span6">

          <div>
            <p></p>
            <label class="control-label">Please choose a date:</label>
             <div class="input-append date" id="dailyActivityPicker" data-date="<? echo $today; ?>" data-date-format="yyyy-mm-dd">
                <input class="span12" size="16" type="text" value="<? echo $today; ?>" readonly="" name="dailyActivityDay" id="dailyActivityDay">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
         </div>

          </div>

         <div class="span6">

           <div class="droppedField">
            <button class="btn btn-primary ctrl-btn" name="fetchDailyActivityButton" onclick="fetchDailyActivity();">
              Show daily activity</button>
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
          
          <div id="dailyReport"></div>
        
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
