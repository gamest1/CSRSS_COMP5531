<?php
include_once("../models/employees.php");

class MenuPaymentsController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Employees();
    } 

    public function renderMainView()
	{           
					$employees = $this->model->getAllEmployees();
					$payments = $this->model->getAllPayments();
					include '../views/paymentsView.php';
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
	$controller = new MenuPaymentsController();
	$controller->renderMainView();
}

?>
