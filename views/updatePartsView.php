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

$partIds = '<option value=""></option>';

for($i=0;$i<count($parts['ids']);$i++) {
   $partIds .= '<option value="' . $parts['ids'][$i] . '">' . $parts['ids'][$i] . '</option>' . "\n";
}

?>

<div class="container-fluid">
  
  <div class="row-fluid">
    <div class="span2">
      <!--Sidebar content-->
      <? 
          $activeIndex = 4;
          include("viewmenu.php"); ?>


    </div>
    <div class="span10">
      <!--Body content-->

      <div class="row-fluid marketing">
        <div class="span12">

      <form action="../controllers/processUpdateController.php" method="post">

      <? if(isset($alert)) echo "<div class=\"alert alert-error\" id=\"alert\">$alert</div>" ?> 

      <div class="radiogroup droppedField" id="radioSearch">
        <p>Do you want to update an existing inventory entry or create a new part?</p>
        <div style="display: inline-block;" class="ctrl-radiogroup">
          <label class="radio">Add new<input type="radio" name="partSelector" id="partSelector" value="new" onchange="updateViewFirstCheck('new');"></label>
          <label class="radio">Update existing<input type="radio" name="partSelector" id="partSelector" value="update" onchange="updateViewFirstCheck('update');"></label>
        </div>
      </div>

      <div class="droppedField" id="partIDDIV" style="display: none;">
        <label class="control-label">Part ID</label>
        <select class="ctrl-combobox" name="partID" id="partID" onchange="updateViewFetchAll();">
          <? echo $partIds; ?>
        </select>
      </div>

      <div class="droppedField" id="typeForUpdate" style="display: none;">
        <input type="hidden" <? if(isset($content['hiddenType'])) echo 'value="' . $content['hiddenType'] . '"'; ?> name="hiddenType" id="hiddenType">
      </div>

      <div class="droppedField" id="newPartIDDIV" style="display: none;">
        <p>Please enter a new 10-digit Part ID:</p>
        <label class="control-label">Part ID</label>
        <input type="text" <? if(isset($content['newPartID'])) echo 'value="' . $content['newPartID'] . '"'; ?> 
        placeholder="Input 10 digits here" class="ctrl-textbox" name="newPartID" id="newPartID"
        onkeydown="checkDigits(10,this);" onpaste="checkDigits(10,this);" oninput="checkDigits(10,this);">
        <input type="button" id="firstButton" onclick="createNewID();" value="Create New Inventory Part" disabled>
      </div>

      <div class="droppedField" id="partCategoryDIV" style="display: none;">
       <label class="control-label">Choose a category for the new item:</label>
        <select class="ctrl-combobox" name="partCategory" id="partCategory" onchange="createNewPartShowAll();">
          <option value=""></option>
          <option value="hardware">Hardware</option>
          <option value="software">Software</option>
          <option value="desktop">Desktop</option>
          <option value="laptop">Laptop</option>
        </select>
      </div>

        <div id="ajaxLoad" style="display: none;">
            <label class="control-label">Please wait while we run your query...</label>
            <img src="../assets/img/ajax-loader.gif" alt="Please wait..." height="32" width="32">
        </div>

        </div>
      </div>

      <hr>

      <div class="row-fluid marketing">
        <div class="span12">
          
          <div class="span6" id="inventoryInfo" style="display: none;">

          <h3>Inventory Information</h3>  
      <div class="droppedField">
        <label class="control-label">Number Sold</label>
        <input type="text" <? if(isset($content['numberSold'])) echo 'value="' . $content['numberSold'] . '"'; ?> placeholder="Items sold so far" class="ctrl-textbox" name="numberSold" id="numberSold">
      </div>

      <div class="droppedField">
        <label class="control-label">Number Available</label>
        <input type="text" <? if(isset($content['numberAvailable'])) echo 'value="' . $content['numberAvailable'] . '"'; ?> placeholder="Available items" class="ctrl-textbox" name="numberAvailable" id="numberAvailable">
      </div>

      <div class="droppedField">
        <label class="control-label">Whole Price</label>
        <input type="text" <? if(isset($content['wholePrice'])) echo 'value="' . $content['wholePrice'] . '"'; ?> placeholder="Unitary purchase price" class="ctrl-textbox" name="wholePrice" id="wholePrice">
      </div>

      <div>
        <label class="control-label">Purchase Date</label>
        <div class="input-append date" id="purchaseDatePicker" data-date="<? echo $today; ?>" data-date-format="yyyy-mm-dd">
        <input class="span12" size="16" type="text" value="<? echo $today; ?>" readonly="" name="purchaseDate">
        <span class="add-on"><i class="icon-calendar"></i></span>
        </div>
      </div>

          </div>

        <div class="span6" id="partInfo" style="display: none;">
         
         <h3>Part Information</h3> 
      <div class="droppedField">
        <label class="control-label">Part Name</label>
        <input type="text" <? if(isset($content['partName'])) echo 'value="' . $content['partName'] . '"'; ?> placeholder="Unique Part Name" class="ctrl-textbox" name="partName" id="partName">
      </div>

      <div class="droppedField">
        <label class="control-label">Public Price</label>
        <input type="text" <? if(isset($content['cost'])) echo 'value="' . $content['cost'] . '"'; ?> placeholder="How much will you sell this for?" class="ctrl-textbox" name="cost" id="cost">
      </div>

      <div class="droppedField">
        <label class="control-label">Installation Cost</label>
        <input type="text" <? if(isset($content['installationCost'])) echo 'value="' . $content['installationCost'] . '"'; ?> placeholder="Will there be an installation cost?" class="ctrl-textbox" name="installationCost" id="installationCost">
      </div>
         
      <div class="droppedField">
        <label class="control-label">Part description</label>
       <textarea rows="4" cols="290" id="description" name="description" style="width: 450px"><? if(isset($content['description'])) echo $content['description']; ?></textarea>
      </div>

        </div>
        
        </div><!-- span12 -->
      </div><!-- row -->

         

      <div class="row-fluid marketing">
         <div class="span12">

        <div class="span6" id="computerInfo" style="display: none;">
              <h3>General Computer Information</h3>

      <div class="droppedField">
        <label class="control-label">Processor</label>
        <input type="text" <? if(isset($content['processor'])) echo 'value="' . $content['processor'] . '"'; ?> placeholder="Enter processor number here" class="ctrl-textbox" name="processor" id="processor">
      </div>

      <div class="droppedField">
        <label class="control-label">Operating System</label>
        <input type="text" <? if(isset($content['os'])) echo 'value="' . $content['os'] . '"'; ?> placeholder="OS Info here" class="ctrl-textbox" name="os" id="os">
      </div>

      <div class="droppedField">
        <label class="control-label">Antivirus Info</label>
        <input type="text" <? if(isset($content['antivirus'])) echo 'value="' . $content['antivirus'] . '"'; ?> placeholder="Antivirus information here" class="ctrl-textbox" name="antivirus" id="antivirus">
      </div>

      <div class="droppedField">
        <label class="control-label">RAM</label>
        <input type="text" <? if(isset($content['ram'])) echo 'value="' . $content['ram'] . '"'; ?> placeholder="Number in MB" class="ctrl-textbox" name="ram" id="ram">
      </div>

      <div class="droppedField">
        <label class="control-label">Memory Specification</label>
        <input type="text" <? if(isset($content['memory_specs'])) echo 'value="' . $content['memory_specs'] . '"'; ?> placeholder="Type of RAM here" class="ctrl-textbox" name="memory_specs" id="memory_specs">
      </div>

      <div class="droppedField">
        <label class="control-label">Hard Disk Capacity</label>
        <input type="text" <? if(isset($content['gb'])) echo 'value="' . $content['gb'] . '"'; ?> placeholder="Enter number in GB" class="ctrl-textbox" name="gb" id="gb">
      </div>

      <div class="droppedField">
        <label class="control-label">Storage Specification</label>
        <input type="text" <? if(isset($content['storage_specs'])) echo 'value="' . $content['storage_specs'] . '"'; ?> placeholder="Hard disk type, etc." class="ctrl-textbox" name="storage_specs" id="storage_specs">
      </div>

      <div class="droppedField">
        <label class="control-label">Other Information about this computer</label>
       <textarea rows="4" cols="290" id="otherInfo" name="otherInfo" style="width: 450px"><? if(isset($content['otherInfo'])) echo $content['otherInfo']; ?></textarea>
      </div>


        </div>


        <div class="span6" id="desktopInfo" style="display: none;">
              <h3>Information for Desktop Computer</h3>

      <div class="droppedField">
        <label class="control-label">Enclosure Information</label>
        <input type="text" <? if(isset($content['enclosure'])) echo 'value="' . $content['enclosure'] . '"'; ?> placeholder="Enter color, and dimensions here" class="ctrl-textbox" name="enclosure" id="enclosure">
      </div>

      <div class="droppedField">
        <label class="control-label">Power Unit Information</label>
        <input type="text" <? if(isset($content['power_unit'])) echo 'value="' . $content['power_unit'] . '"'; ?> placeholder="Kind of power unit" class="ctrl-textbox" name="power_unit" id="power_unit">
      </div>

      <div class="droppedField">
        <label class="control-label">Motherboard Info</label>
        <input type="text" <? if(isset($content['mother_board'])) echo 'value="' . $content['mother_board'] . '"'; ?> placeholder="Enter motherboard info" class="ctrl-textbox" name="mother_board" id="mother_board">
      </div>

      <div class="droppedField">
        <label class="control-label">Monitor</label>
        <input type="text" <? if(isset($content['monitor'])) echo 'value="' . $content['monitor'] . '"'; ?> placeholder="Specs about monitor" class="ctrl-textbox" name="monitor" id="monitor">
      </div>

      <div class="droppedField">
        <label class="control-label">Mouse</label>
        <input type="text" <? if(isset($content['mouse'])) echo 'value="' . $content['mouse'] . '"'; ?> placeholder="Optical, wired, etc." class="ctrl-textbox" name="mouse" id="mouse">
      </div>

      <div class="droppedField">
        <label class="control-label">Keyboard</label>
        <input type="text" <? if(isset($content['keyboard'])) echo 'value="' . $content['keyboard'] . '"'; ?> placeholder="Full, 64 keys, etc." class="ctrl-textbox" name="keyboard" id="keyboard">
      </div>


        </div>


      <div class="span6" id="laptopInfo" style="display: none;">
              <h3>Information for Laptop Computer</h3>

      <div class="droppedField">
        <label class="control-label">Screen Size</label>
        <input type="text" <? if(isset($content['screen_size'])) echo 'value="' . $content['screen_size'] . '"'; ?> placeholder="Enter screen size here" class="ctrl-textbox" name="screen_size" id="screen_size">
      </div>

      <div class="droppedField">
        <label class="control-label">Battery Life</label>
        <input type="text" <? if(isset($content['battery_life'])) echo 'value="' . $content['battery_life'] . '"'; ?> placeholder="Enter number in hours" class="ctrl-textbox" name="battery_life" id="battery_life">
      </div>

      <div class="droppedField">
        <label class="control-label">Battery Specification</label>
        <input type="text" <? if(isset($content['battery_specs'])) echo 'value="' . $content['battery_specs'] . '"'; ?> placeholder="Other infor about the battery" class="ctrl-textbox" name="battery_specs" id="battery_specs">
      </div>

        </div>

        
        </div><!--/span12-->
    </div><!--/row-->


    <input type="submit" name="newButton" id="newButton" value="Submit New Inventory Entity" style="display: none;">
    <input type="submit" name="updateButton" id="updateButton" value="Update Existing Inventory Entity" style="display: none;">
    </form>

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
