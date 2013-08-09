<?php
include_once("../models/parts.php");

class MenuSearchPartsController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Parts();
    } 

    public function renderMainView($partID,$part_type)
	{           
					include '../views/searchPartsView.php';
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
	$controller = new MenuSearchPartsController();
	if(isset($_GET['partID']) && isset($_GET['part_type'])) {	
     $controller->renderMainView($_GET['partID'],$_GET['part_type']); 
	}
    else {
	 $controller->renderMainView("","");
	} 
}

?>
