<?php
include_once("../models/service.php");

class MenuDailyActivityController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Service();
    } 

    public function renderMainView()
	{           
					include '../views/dailyActivityView.php';
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
	$controller = new MenuDailyActivityController();
	$controller->renderMainView();
}

?>