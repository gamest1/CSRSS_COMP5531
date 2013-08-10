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


?>

<div class="container-fluid">
  
  <div class="row-fluid">
    <div class="span2">
      <!--Sidebar content-->
      <?  $activeIndex = -1; 
          include("viewmenu.php"); ?>


    </div>
    <div class="span10">
      <!--Body content-->
      <form action="../controllers/changePassword.php" method="post">

      <? if(isset($alert)) echo "<div class=\"alert alert-error\" id=\"alert\">$alert</div>" ?> 

      <div class="droppedField">
        <label class="control-label">New Password</label>
        <input type="password" placeholder="Enter your new password" class="ctrl-textbox" id="newPassword1" name="newPassword1">
      </div>

      <div class="droppedField">
        <label class="control-label">Repeat New Password</label>
        <input type="password" placeholder="Repeat your new password" class="ctrl-textbox" id="newPassword2" name="newPassword2">
      </div>

       <div class="droppedField">
        <button class="btn btn-primary ctrl-btn" name="submitButton" type="submit">Change my password</button>
      </div>

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
