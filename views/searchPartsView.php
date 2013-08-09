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

// $partNames = '<option value=""></option>';
// $partIds = '<option value=""></option>';

// for($i=0;$i<count($parts['ids']);$i++) {
//    $partNames .= '<option value="' . $parts['ids'][$i] . '">' . $parts['names'][$i] . '</option>' . "\n";
//    $partIds .= '<option value="' . $parts['ids'][$i] . '">' . $parts['ids'][$i] . '</option>' . "\n";
// }

$categories = '<option value=""></option>';

for($i=0;$i<4;$i++) {
   switch ($i) {
     case 0:
       if($part_type == "hardware") $categories .= '<option value="hardware" selected>Hardware</option>' . "\n";
       else $categories .= '<option value="hardware">Hardware</option>' . "\n";
       break;
     case 1:
       if($part_type == "software") $categories .= '<option value="software" selected>Software</option>' . "\n";
       else $categories .= '<option value="software">Software</option>' . "\n";
       break;
     case 2:
       if($part_type == "desktop") $categories .= '<option value="desktop" selected>Desktop</option>' . "\n";
       else $categories .= '<option value="desktop">Desktop</option>' . "\n";
       break;
     case 3:
       if($part_type == "laptop") $categories .= '<option value="laptop" selected>Laptop</option>' . "\n";
       else $categories .= '<option value="laptop">Laptop</option>' . "\n";
       break;  
   }
}

if($partID != "") $options = "<option value=\"$partID\" selected>$partID</option>";
else $options = "";

?>

<div class="container-fluid">
  
  <div class="row-fluid">
    <div class="span2">
      <!--Sidebar content-->
      <? 
          $activeIndex = 1;
          include("viewmenu.php"); ?>


    </div>
    <div class="span10">
      <!--Body content-->

      <div class="row-fluid marketing">
        <div class="span12">

      <div class="droppedField" id="searchCategory">
       <label class="control-label">Choose a category to start your search</label>
        <select class="ctrl-combobox" name="partCategory" id="partCategory" onchange="mainViewCheckPartCategory();">
          <? echo $categories; ?>
        </select>
      </div>

      <div class="radiogroup droppedField" id="radioSearch" <? if($partID == "") echo "style=\"display: none;\""; echo ""; ?>>
        <label class="control-label" style="vertical-align:top">Search part by</label>
        <div style="display: inline-block;" class="ctrl-radiogroup">
          <label class="radio">Name<input type="radio" name="partSelector" id="partSelector" value="byName" onchange="mainViewCheckSearchType('Name');"></label>
          <label class="radio">ID<input type="radio" name="partSelector" id="partSelector" value="byPart" onchange="mainViewCheckSearchType('Part');" <? if($partID != "") echo "checked=\"checked\""; echo ""; ?>></label>
        </div>
      </div>

        </div>
      </div>

      <div class="row-fluid marketing">
        <div class="span12">
          
          <div class="span6">

      <div class="droppedField" id="searchID" <? if($partID == "") echo "style=\"display: none;\""; echo ""; ?>>
        <label class="control-label">Part ID</label>
        <select class="ctrl-combobox" name="partID" id="partID" onchange="mainViewCheckPartInfo('ID');">
          <? echo $options; ?>
        </select>
      </div>

      <div class="droppedField" id="searchName" style="display: none;">
       <label class="control-label">Part Name</label>
        <select class="ctrl-combobox" name="partName" id="partName" onchange="mainViewCheckPartInfo('Name');">
        </select>
      </div>

          </div>


         <div class="span6" id="ajaxLoad" style="display: none;">
            <label class="control-label">Please wait while we run your query...</label>
            <img src="../assets/img/ajax-loader.gif" alt="Please wait..." height="32" width="32">
        </div>
        
        </div><!-- span12 -->
      </div><!-- row -->

    

      <div class="jumbotron" id="partMain" style="display: none;">
        <h2></h2>
        <p class="lead"></p>
      </div>

      <hr>

      <div class="row-fluid marketing">
        <div class="span12" id="partPrice" style="display: none;">
          <h3></h3>
        </div>
      </div>

      <div class="row-fluid marketing">
        
        <div class="span6" id="partInfo1" style="display: none;">
           <h4></h4>
           <p></p> 
        </div>

        <div class="span6" id="partInfo2" style="display: none;">
           <h4></h4>
           <p></p>           
        </div>

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
  if($partID != "") echo "<script>mainViewCheckPartInfo('ID');</script>"; echo ""; 
}
?>
