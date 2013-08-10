<?php
include_once("../models/users.php");

class ChangePasswordController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Users();
    } 

    public function renderMainView()
	{           
					include '../views/changePasswordView.php';
					return;
	}

}

session_start();

if (!isset($_SESSION['employeeID'])) {
    $message = "You must login first";
    include '../views/loginView.php';
    return;
}
else {
	$controller = new ChangePasswordController();
	$controller->renderMainView();
}

?>