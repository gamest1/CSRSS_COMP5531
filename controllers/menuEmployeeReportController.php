<?php
include_once("../models/employees.php");

class MenuEmployeeReportController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Employees();
    } 

    public function renderMainView()
	{           
					$employees = $this->model->getAllEmployeesInfo();
					include '../views/employeeReportView.php';
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
	$controller = new MenuEmployeeReportController();
	$controller->renderMainView();
}

?>