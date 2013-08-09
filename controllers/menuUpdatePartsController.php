<?php
include_once("../models/parts.php");

class MenuUpdatePartsController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Parts();
    } 

    public function renderMainView()
	{           
					$parts = $this->model->getAllParts();
					include '../views/updatePartsView.php';
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
	$controller = new MenuUpdatePartsController();
	$controller->renderMainView();
}

?>
