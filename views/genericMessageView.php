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
      <div class="hero-unit">
        <h1>Thank you!</h1>
        <p><? echo $message; ?></p>
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
