<?php
include_once("../models/users.php");

function trim_value(&$value)
{
    $value = trim($value);    // this removes whitespace and related characters from the beginning and end of the string
    $value = stripslashes($value);
}

class ChangePasswordController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Users();
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
else if ( !isset($_POST['submitButton']) ) {
	$message = "Controller called from bogus source! Exiting...";
	include '../views/loginView.php';
	return;
}
else
{   
	$controller = new ChangePasswordController();
    $message = "Processing your request...";

    array_filter($_POST, 'trim_value');
    $postfilter =    // set up the filters to be used with the trimmed post array
    array(
        'newPassword1' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'newPassword2' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH), 
        'submitButton' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH)
    );

    $post_array = filter_var_array($_POST, $postfilter);    // must be referenced via a variable which is now an array that takes the place of $_POST[]

	    $p1 = $post_array['newPassword1'];
		$p2 = $post_array['newPassword2'];

		if($p1 != $p2) {
			$alert = "Passwords must match. Please try again!";
			include '../views/changePasswordView.php';
			return;
		}

		if ($controller->model->updatePassword($p1,$p2))  {
			$message = "Password successfully updated!";
			$controller->loadViewWithMessage($message);
		}
		else {
			$alert = "We had a problem while updating your password! Please try again. If the problem persists, contact the system's administrator";
			include '../views/changePasswordView.php';
			return;
		}
         
}

?>