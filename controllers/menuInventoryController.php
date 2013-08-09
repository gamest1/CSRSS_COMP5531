<?php
include_once("../models/parts.php");

class MenuInventoryController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Parts();
    } 

    public function renderMainView()
	{           
					$inventory = $this->model->getInventory();
					include '../views/inventoryView.php';
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
	$controller = new MenuInventoryController();
	$controller->renderMainView();
}

?>
