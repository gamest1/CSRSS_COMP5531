<?php
include_once("../models/users.php");

class LogoutController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Users();
    } 

    public function logout()
	{
		$this->model->logout(); 
		 $message = "Thank you for using our store! :)";
		 include '../views/loginView.php';
		 return;
	}

}

session_start();

if (!isset($_SESSION['employeeID'])) {
    $message = "You must login first in order to logout! Hehe...";
	include '../views/loginView.php';
	return;
}
else {
	$controller = new LogoutController();
	$controller->logout();
}

?>