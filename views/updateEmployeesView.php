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
$employeeIds .= '<option value="all">ALL</option>';

$keys = array_keys($employees);
for($i=0;$i<count($keys);$i++) {
   $employeeIds .= '<option value="' . $keys[$i] . '">' . $keys[$i] . " | " . $employees[$keys[$i]]['username'] . '</option>' . "\n";
}


$tableView = "<table class=\"table table-striped table-bordered table-hover\">";
$tableView .= "<tr><th>Cat.</th><th>Employee ID</th><th>Username</th><th>First Name</th><th>Last Name</th><th>&#37; online</th><th>&#37; services</th><th>Phone</th></tr>";

for($i=0;$i<count($keys);$i++) {
                $row = "";
                $ID = $keys[$i];
                $rowHash =$employees[$employeeID];
                $row .= "<tr>";

                if ($rowHash['isAdmin'] == 1) $row .= "<td>Admin</td>";
                else $row .= "<td>User</td>";
                
                $row .= "<td>$ID</td><td>" . $rowHash['username'] . "</td><td>" . $rowHash['firstName'] . "</td><td>" . $rowHash['lastName'] . "</td>";
                $row .= "<td>" . $rowHash['online_fee'] . "</td><td>" . $rowHash['service_fee'] . "</td>";
                $row .= "<td>" . $rowHash['phone'] . "</td>";
                $row .= "</tr>";
                $tableView .= $row;    
}

$tableView .= "</table>";

if($employeeID != "") {
    $employeeIds = "<option value=\"$employeeID\" selected>$employeeID</option>";
}

?>

<div class="container-fluid">
  
  <div class="row-fluid">
    <div class="span2">
      <!--Sidebar content-->
      <? 
          $activeIndex = 11;
          include("viewmenu.php"); ?>


    </div>
    <div class="span10">
      <!--Body content-->

      <form action="../controllers/processEmployeeUpdate.php" method="post">
      
      <div class="row-fluid marketing" id="Row0">
        <div class="span12">

      <? if(isset($alert)) echo "<div class=\"alert alert-error\" id=\"alert\">$alert</div>" ?> 

      <div class="radiogroup droppedField" id="radioSearch">
        <p>Do you want to view/update an existing employee or do you want to create a new employee?</p>
        <div style="display: inline-block;" class="ctrl-radiogroup">
          <label class="radio">Create new<input type="radio" name="employeeSelector" id="employeeSelector" value="new" onchange="updateViewFirstCheck('new');"></label>
          <label class="radio">View/Update existing<input type="radio" name="employeeSelector" id="employeeSelector" value="update" onchange="updateViewFirstCheck('update');" <? if($employeeID != "") echo "checked=\"checked\""; echo ""; ?>></label>
        </div>
      </div>

      <div class="droppedField" id="employeeIDDIV" <? if($employeeID == "") echo "style=\"display: none;\""; echo ""; ?>>
        <label class="control-label">Employee ID</label>
        <select class="ctrl-combobox" name="employeeID" id="employeeID" onchange="updateEmployeeFetchAll();">
          <? echo $employeeIds; ?>
        </select>
      </div>

      <div class="droppedField" id="newEmployeeIDDIV" style="display: none;">
        <p>Please enter a new 5-digit Employee ID:</p>
        <label class="control-label">Employee ID</label>
        <input type="text" <? if(isset($content['newEmployeeID'])) echo 'value="' . $content['newEmployeeID'] . '"'; ?> 
        placeholder="Input 5 digits here" class="ctrl-textbox" name="newEmployeeID" id="newEmployeeID"
        onkeydown="checkDigits(5,this);" onpaste="checkDigits(5,this);" oninput="checkDigits(5,this);">
        <input type="button" id="firstButton" onclick="createNewID();" value="Create New Employee" disabled>
      </div>

      <div id="ajaxLoad" style="display: none;">
            <label class="control-label">Please wait while we run your query...</label>
            <img src="../assets/img/ajax-loader.gif" alt="Please wait..." height="32" width="32">
      </div>

        </div>
      </div><!-- Row0 -->

      <hr>

      <div class="row-fluid marketing" id="Row1">
        <div class="span12">
          
          <div class="span6" id="employeeInfo" style="display: none;">

          <h3>Employee Information</h3>  
      <div class="droppedField">
        <label class="control-label">First Name</label>
        <input type="text" <? if(isset($content['firstName'])) echo 'value="' . $content['firstName'] . '"'; ?> placeholder="Employee's name" class="ctrl-textbox" name="firstName" id="firstName">
      </div>

      <div class="droppedField">
        <label class="control-label">Last Name</label>
        <input type="text" <? if(isset($content['lastName'])) echo 'value="' . $content['lastName'] . '"'; ?> placeholder="Employee's lastname" class="ctrl-textbox" name="lastName" id="lastName">
      </div>

      <div>
        <label class="control-label">First day of work</label>
        <div class="input-append date" id="firstDayPicker" data-date="<? echo $today; ?>" data-date-format="yyyy-mm-dd">
        <input class="span12" size="16" type="text" value="<? echo $today; ?>" readonly="" name="firstDayWork">
        <span class="add-on"><i class="icon-calendar"></i></span>
        </div>
      </div>

      <div class="droppedField">
        <label class="control-label">Comission for sales online</label>
        <input type="text" <? if(isset($content['online_fee'])) echo 'value="' . $content['online_fee'] . '"'; ?> placeholder="For a 30% comission, enter 30" class="ctrl-textbox" name="online_fee" id="online_fee">
      </div>

      <div class="droppedField" id="serviceFeeDIV">
        <label class="control-label">Comission for services</label>
        <input type="text" <? if(isset($content['service_fee'])) echo 'value="' . $content['service_fee'] . '"'; ?> placeholder="This is calculated based on seniority" class="ctrl-textbox" name="service_fee" id="service_fee">
      </div>

      <div class="droppedField">
        <label class="control-label">Base salary</label>
        <input type="text" <? if(isset($content['base_salary'])) echo 'value="' . $content['base_salary'] . '"'; ?> placeholder="Enter an integer number" class="ctrl-textbox" name="base_salary" id="base_salary">
      </div>

      <div class="droppedField">
        <label class="control-label">Phone number</label>
        <input type="text" <? if(isset($content['phone'])) echo 'value="' . $content['phone'] . '"'; ?> placeholder="10 digits for a regular phone number" class="ctrl-textbox" name="phone" id="phone">
      </div>

      <div class="droppedField">
        <label class="control-label">Address</label>
       <textarea rows="4" cols="290" id="address" name="address" style="width: 450px"><? if(isset($content['address'])) echo $content['address']; ?></textarea>
      </div>

          </div><!-- span6 -->

        <div class="span6" id="loginInfo" style="display: none;">
         
         <h3>Login Information</h3> 
      <div class="droppedField">
        <label class="control-label">Username</label>
        <input type="text" <? if(isset($content['username'])) echo 'value="' . $content['username'] . '"'; ?> placeholder="Unique username" class="ctrl-textbox" name="username" id="username" disabled>
      </div>

      <div class="droppedField" id="lastLoginDIV">
        <label class="control-label">Last Login Date</label>
        <input type="text" <? if(isset($content['last_login'])) echo 'value="' . $content['last_login'] . '"'; ?> placeholder="Last Login Date" class="ctrl-textbox" name="last_login" id="last_login" disabled>
      </div>

      <div class="droppedField">
        <label class="control-label">Does this user has administrative privileges?</label>
        <input type="text" <? if(isset($content['isAdmin'])) echo 'value="' . $content['isAdmin'] . '"'; ?> placeholder="Enter 1 for YES, 0 for NO" class="ctrl-textbox" name="isAdmin" id="isAdmin">
      </div>

      <div class="droppedField">
        <br /><br /><br /><br /><br /><br /><br /><br /><br />
        <input type="submit" name="newButton" id="newButton" value="Submit New Employee Entity" style="display: none;">
        <input type="submit" name="updateButton" id="updateButton" value="Update Existing Employee Entity" style="display: none;">
      </div>

        </div><!-- span6 -->
        
        </div><!-- span12 -->
      </div><!-- Row1 -->

    </form>

      <hr>         

      <div class="row-fluid marketing" id="Row2">
         <div class="span12" id="employeesInfoTable" style="display: none;">
    
            <h3>Information about all the employees</h3>
             <? echo $tableView; ?>
         </div>
      </div><!--/Row2-->
    
    </div><!--/span10 -->



  </div><!--/row-->

  <hr>

      <footer>
        <p>&copy; Esteban's Computer and Repair Store - 2013</p>
      </footer>

</div><!--/.fluid-container-->

 
 <?
  include("viewfooter.php"); 
  if($employeeID != "") echo "<script>updateEmployeeFetchAll();</script>"; echo ""; 
}
?>
