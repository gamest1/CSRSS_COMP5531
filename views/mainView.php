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

$partNames = '<option value=""></option>';
$partIds = '<option value=""></option>';

for($i=0;$i<count($parts['ids']);$i++) {
   $partNames .= '<option value="' . $parts['ids'][$i] . '">' . $parts['names'][$i] . '</option>' . "\n";
   $partIds .= '<option value="' . $parts['ids'][$i] . '">' . $parts['ids'][$i] . '</option>' . "\n";
}

?>


<div class="container-fluid">
  
  <div class="row-fluid">
    <div class="span2">
      <!--Sidebar content-->
      <?  $activeIndex = 0;
          include("viewmenu.php"); ?>


    </div>
    <div class="span10">
      <!--Body content-->

<form action="../controllers/serviceController.php" method="post">

     <div class="row-fluid">
     <div class="span6">
      
     <div id="selected-column-1" class="span6 droppedFields">
      
      <div class="droppedField"><br /></div>

      <div class="droppedField">
      <label class="control-label">SELECT THE TYPE OF SERVICE</label>
      <select class="ctrl-combobox" name="serviceType" id="serviceType" onchange="mainViewCheckServiceType();">
        <option value=""></option>        
        <option value="sale">Sale</option>
        <option value="upgrade">Upgrade</option>
        <option value="repair">Repair</option>
      </select>
      </div>

      <div class="droppedField" id="deviceControl" style="display: none;">
       <label class="control-label">Select Device</label>
        <select class="ctrl-combobox" id="deviceSelect" name="deviceSelect" onchange="mainViewCheckDeviceName();">
          <option value=""></option>
          <option value="0">New Device</option>
          <option value="d_name1">Device 2</option>
          <option value="d_name2">Device 3</option>
        </select>
      </div>    

      <div class="droppedField" id="nameControl" style="display: none;">
        <p>The following information will help us identify this device later:</p>
        <label class="control-label">Device Name</label>
        <input type="text" placeholder="Device name here" class="ctrl-textbox" name="newDeviceName">
        <input type="text" placeholder="Device description" class="ctrl-textbox" name="newDeviceDescription">
        <input type="text" placeholder="Device owner" class="ctrl-textbox" name="newDeviceOwner">
      </div>

     </div>
     </div>

     <div class="span6">
    
    <div id="selected-column-2" class="span6 droppedFields">

      <div class="radiogroup droppedField" id="radioSearch" style="display: none;">
        <label class="control-label" style="vertical-align:top">Search part by</label>
        <div style="display: inline-block;" class="ctrl-radiogroup">
          <label class="radio">Name<input type="radio" name="partSelector" id="partSelector" value="byName" onchange="mainViewCheckSearchType('Name');"></label>
          <label class="radio">ID<input type="radio" name="partSelector" id="partSelector" value="byPart" onchange="mainViewCheckSearchType('Part');"></label>
        </div>
      </div>
      
      <div class="droppedField" id="searchID" style="display: none;">
        <label class="control-label">Part ID</label>
        <select class="ctrl-combobox" name="partID" id="partID" onchange="mainViewCheckPartPrice('ID');">
          <? echo $partIds; ?>
        </select>
      </div>

      <div class="droppedField" id="searchName" style="display: none;">
       <label class="control-label">Part Name</label>
        <select class="ctrl-combobox" name="partName" id="partName" onchange="mainViewCheckPartPrice('Name');">
          <? echo $partNames; ?>
        </select>
      </div>

      <div class="droppedField" id="partCost" style="display: none;">
        <label class="control-label">Part Cost</label>
        <input type="text" placeholder="Enter the cost of this type of service" class="ctrl-textbox" id="partCostVal" name="partCostVal">
      </div>


    </div>

    </div>

     </div><!--/row-->

    <div class="row-fluid">
     <div class="span12">
     <!-- Action bar - Suited for buttons on form -->
    <div id="selected-action-column" class="span12 action-bar droppedFields" style="min-height: 80px;">
      
      <div class="droppedField" id="serviceCost" style="display: none;">
        <label class="control-label">Service Cost</label>
        <input type="text" placeholder="Enter the cost of this type of service" class="ctrl-textbox" id="serviceCostVal" name="serviceCostVal">
      </div>

<!--      <div>
        <label class="control-label">Service Date</label>
        <div class="input-append date" id="mainViewPicker" data-date="<? echo $today; ?>" data-date-format="yyyy-mm-dd">
        <input class="span12" size="16" type="text" value="<? echo $today; ?>" readonly="" name="serviceDate">
        <span class="add-on"><i class="icon-calendar"></i></span>
        </div>
      </div> -->

      <div id="ajaxLoad" style="display: none;">
            <label class="control-label">Please wait while we run your query...</label>
            <img src="../assets/img/ajax-loader.gif" alt="Please wait..." height="32" width="32">
      </div>
      
      <div class="droppedField">
        <label class="control-label">Details of this Service</label>
       <textarea rows="4" cols="290" name="serviceDetail" style="width: 450px"></textarea>
      </div>

      <div class="droppedField" id="checkboxDIV" style="display: none;">
       <label class="control-label">Mock an online sale</label>
       <input type="checkbox" name="onlineCheckbox" id="onlineCheckbox" value="online">This is a on-line sale<br>
      </div>     

      <div id="onlineSaleDIV" style="display: none;">

      <div class="droppedField">
        <label class="control-label">City</label>
        <input type="text" placeholder="Destination city" class="ctrl-textbox" id="city" name="city">
      </div>

      <div class="droppedField">
        <label class="control-label">Province</label>
        <input type="text" placeholder="Destination province" class="ctrl-textbox" id="province" name="province">
      </div>

      <div class="droppedField">
        <label class="control-label">Country</label>
        <input type="text" placeholder="Destination country" class="ctrl-textbox" id="country" name="country">
      </div>

      <div class="droppedField">
        <label class="control-label">Address</label>
       <textarea rows="2" cols="240" name="address" style="width: 450px"></textarea>
      </div>

      <div class="droppedField">
            <label class="control-label">Date shipped:</label>
             <div class="input-append date" id="dateShippedPicker" data-date="<? echo $today; ?>" data-date-format="yyyy-mm-dd">
                <input class="span12" size="16" type="text" value="<? echo $today; ?>" readonly="" name="dateShipped" id="dateShipped">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
      </div>

      </div>

      <div class="droppedField">
        <button class="btn btn-primary ctrl-btn" name="createServiceButton" style="float:right;" type="submit">Create this Service Instance</button>
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
