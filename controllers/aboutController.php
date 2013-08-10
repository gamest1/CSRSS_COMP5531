<?php

class AboutController {
	
    public function renderMainView()
	{           
					include '../views/aboutView.php';
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
	$controller = new AboutController();
	$controller->renderMainView();
}

?>