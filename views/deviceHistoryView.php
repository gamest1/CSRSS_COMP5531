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

$deviceNames = '<option value=""></option>';

for($i=0;$i<count($devices);$i++) {
   $deviceNames .= '<option value="' . $devices[$i] . '">' . $devices[$i] . '</option>' . "\n";
}

?>


<div class="container-fluid">
  
  <div class="row-fluid">
    <div class="span2">
      <!--Sidebar content-->
      <?  $activeIndex = 2;
          include("viewmenu.php"); ?>


    </div>
    <div class="span10">
      <!--Body content-->

<form action="../controllers/serviceController.php" method="post">

     <div class="row-fluid">
     <div class="span6">
      
     <div id="selected-column-1" class="span6 droppedFields">
      
      <div class="droppedField" id="deviceControl">
       <label class="control-label">Please select the device</label>
        <select class="ctrl-combobox" id="deviceSelect" name="deviceSelect" onchange="deviceHistoryViewGetHistory();">
          <? echo $deviceNames; ?>
        </select>
      </div>

     </div>
     
     </div>

     <div class="span6">
    
     <div id="selected-column-2" class="span6 droppedFields">

        <div id="ajaxLoad" style="display: none;">
            <label class="control-label">Please wait while we run your query...</label>
            <img src="../assets/img/ajax-loader.gif" alt="Please wait..." height="32" width="32">
        </div>
     </div>

    </div>

    </div><!--/row-->

    <hr>

    <div class="row-fluid">
     <div class="span12">
     <!-- Action bar - Suited for buttons on form -->
    <div id="selected-action-column" class="span12 action-bar droppedFields" style="min-height: 80px;">

      <div class="jumbotron" id="deviceMain">
        <h2></h2>
        <h4></h4>
        <p class="lead"></p>
      </div>      

      <div id="historyTable">
      </div>
      

      </div><!--/action-column-->

    </div><!--/span12-->

   </div><!--/row-->
   
   </div><!--/span10-->

  </form>

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
