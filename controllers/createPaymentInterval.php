<?php
include_once("../models/employees.php");

function trim_value(&$value)
{
    $value = trim($value);    // this removes whitespace and related characters from the beginning and end of the string
    $value = stripslashes($value);
}

class CreatePaymentInterval {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Employees();
    } 

    public function loadViewWithMessage($message)
	{
		 $message .= "";
		 include '../views/genericMessageView.php';
		 return;
	}

}

session_start();

if (!isset($_SESSION['employeeID'])) {
    $message = "You must login first!";
	include '../views/loginView.php';
	return;
}
else if (!isset($_POST['createPaymentButton']) ) {
	$message = "Controller called from bogus source! Exiting...";
	include '../views/loginView.php';
	return;
}
else
{   
	  $controller = new CreatePaymentInterval();
    
    array_filter($_POST, 'trim_value');
    $postfilter =    // set up the filters to be used with the trimmed post array
    array(
        'employeeID' => array('filter' => FILTER_SANITIZE_NUMBER_INT), 
        'paymentBeginDate' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'paymentEndDate' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'createPaymentButton' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
    );

    $post_array = filter_var_array($_POST, $postfilter);    // must be referenced via a variable which is now an array that takes the place of $_POST[]
 
    $employee = $post_array['employeeID'];
    $date_start = $post_array['paymentBeginDate'];
    $date_end = $post_array['paymentEndDate'];
    //Do something to create the payment interval and return a message!

    if($controller->model->createPaymentForEmployee($employee,$date_start,$date_end)) {
      $message = "Your payment interval instance was created! Go on the Payments section to view the changes";
    }
    else {
      $message = "We had a problem while creating your payment interval instance! Go back to the Payments section and try again...";
    }

    //Done!
    $controller->loadViewWithMessage($message);
  return;  
}

?>