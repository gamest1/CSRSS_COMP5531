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
      <? include("viewmenu.php"); ?>


    </div>
    <div class="span10">
      <!--Body content-->

      <div class="radiogroup droppedField" id="radioSearch">
        <label class="control-label" style="vertical-align:top">Search part by</label>
        <div style="display: inline-block;" class="ctrl-radiogroup">
          <label class="radio">Name<input type="radio" name="partSelector" id="partSelector" value="byName" onchange="mainViewCheckSearchType('Name');"></label>
          <label class="radio">ID<input type="radio" name="partSelector" id="partSelector" value="byPart" onchange="mainViewCheckSearchType('Part');"></label>
          <label class="radio">Category<input type="radio" name="partSelector" id="partSelector" value="byCategory" onchange="mainViewCheckSearchType('Category');"></label>
        </div>
      </div>
      
      <div class="droppedField" id="searchID" style="display: none;">
        <label class="control-label">Part ID</label>
        <select class="ctrl-combobox" name="partID" id="partID" onchange="mainViewCheckPartInfo('ID');">
          <? echo $partIds; ?>
        </select>
      </div>

      <div class="droppedField" id="searchName" style="display: none;">
       <label class="control-label">Part Name</label>
        <select class="ctrl-combobox" name="partName" id="partName" onchange="mainViewCheckPartInfo('Name');">
          <? echo $partNames; ?>
        </select>
      </div>

      <div class="droppedField" id="searchCatagory" style="display: none;">
       <label class="control-label">Category</label>
        <select class="ctrl-combobox" name="partCategory" id="partCategory" onchange="mainViewCheckPartCategory();">
          <option value=""></option>
          <option value="hardware">Hardware</option>
          <option value="software">Software</option>
          <option value="desktop">Desktop</option>
          <option value="laptop">Laptop</option>
        </select>
      </div>

      
      <div class="jumbotron" id="partMain">
        <h2></h2>
        <p class="lead"></p>
      </div>

      <hr>

      <div class="row-fluid marketing">
        <div class="span12" id="partCategory">
          <h3>Category:</h3>
          <p></p>
        </div>
      </div>

      <div class="row-fluid marketing">
        
        <div class="span6" id="partInfo1">
        </div>

        <div class="span6" id="partInfo2">
        </div>

      </div>


      <div class="droppedField" id="partCost" style="display: none;">
        <label class="control-label">Part Cost</label>
        <input type="text" placeholder="Enter the cost of this type of service" class="ctrl-textbox" id="partCostVal" name="partCostVal">
      </div>



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
