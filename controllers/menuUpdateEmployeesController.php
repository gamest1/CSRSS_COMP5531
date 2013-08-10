<?php
include_once("../models/employees.php");

class MenuUpdateEmployeesController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Employees();
    } 

    public function renderMainView($employeeID)
	{           
					$employees = $this->model->getAllEmployeesInfo();
					include '../views/updateEmployeesView.php';
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
	$controller = new MenuUpdateEmployeesController();
	if(isset($_GET['employeeID'])) {	
     	$controller->renderMainView($_GET['employeeID']); 
	}
    else {
		$controller->renderMainView("");
	}
}

?>
