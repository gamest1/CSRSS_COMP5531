<?php
include_once("../models/service.php");

class MenuDeviceHistoryController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Service();
    } 

    public function renderMainView()
	{           
					$devices = $this->model->getAllDevices();
					include '../views/deviceHistoryView.php';
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
	$controller = new MenuDeviceHistoryController();
	$controller->renderMainView();
}

?>
