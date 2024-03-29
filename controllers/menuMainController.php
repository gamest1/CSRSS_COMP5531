<?php
include_once("../models/parts.php");

class MenuMainController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Parts();
    } 

    public function renderMainView()
	{
					$parts = $this->model->getAllParts();
					include '../views/mainView.php';
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
	$controller = new MenuMainController();
	$controller->renderMainView();
}

?>