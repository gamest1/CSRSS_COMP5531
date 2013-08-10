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
        <h1>CONCORDIA UNIVERSITY</h1>        
        <h2>COMP 5531 - Final Project</h2>
        <h3>Computer Sales and Repair Store System</h3>
        <p>This project was build entirely by the memebers of this team listed here: <b>Esteban Garro - 9778292</b> </p>
        <p>The system uses <b>Twitter Bootstrap</b> Framework for the layouts and the CSS.<br /> <b>Javascript</b> and <b>JQuery</b> were used to handle user interaction.<br /> 
          All <b>AJAX</b> support relies on JQuery's .post method. The backend is programed on plain <b>PHP</b>, and no framework was used. However, a model-view-controller (<b>MVC</b>) 
          paradigm was used when designing the entire backend structure.<br /> The database system used is <b>MySQL</b> and all calls to the database are handled
          by PHP's native MySQL support.<br />
          No other technology was used on this project.</p>
        <h4>Project completed on August 10th, 2013<h4>  
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
