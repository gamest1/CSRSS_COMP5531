<?php
include_once("../models/service.php");

class ServiceController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Service();
    } 

    public function loadViewWithMessage($message)
	{
		 $message .= "";
		 include '../views/genericMessageView.php';
		 return;
	}

}

session_start();

if (!isset($_SESSION['employeeID'])) {
    $message = "You must login first!";
	include '../views/loginView.php';
	return;
}
else if (!isset($_POST['createServiceButton']) || !isset($_POST['serviceType']) ) {
	$message = "Controller called from bogus source! Exiting...";
	include '../views/loginView.php';
	return;
}
else
{   
	$controller = new ServiceController();
    $message = "Processing your request...";
	$type = $_POST['serviceType'];

    if($type == "sale") {
       $where = $_POST['partSelector'];
        if ($where == 'byName') {
        	$partID = $_POST['partName'];
        }
        else if ($where == 'byPart') {
			$partID = $_POST['partID'];
        }
        else {
			$message = "Controller called without real sale type! Exiting...";
			include '../views/loginView.php';
			return;
        }

        //Now we have the PartID, process this sale:
        $cost = $_POST['partCostVal'];
        $detail = $_POST['serviceDetail'];

		//Process this new sale:
		$message = $controller->model->processSale($partID,$cost,$detail);
		// ob_start();
		// 	var_dump($_POST);
		// $message = ob_get_clean();
         
    }
    else if($type == "upgrade" || $type == "repair") {
        $device = $_POST['deviceSelect'];
        if($device == "0") {
        	//New Device!
        	$newName = $_POST['newDeviceName'];
        	$description = $_POST['newDeviceDescription'];
			$owner = $_POST['newDeviceOwner'];
            //Do some sanitization here!! This is dangerous:
            
            //Process insertion of new device:
			if($controller->model->insertNewDevice($newName,$description,$owner)) {
				$message = "Your device was created succesfully.";
			}
			else {
				$message = "We had a problem while saving your device data.";
			}

        	$device = $newName;
        }

        //Now you have the $device, process this upgrade or repair:
		if($type == "upgrade") {
        	
        	$detail = $_POST['serviceDetail'];	
     		$where = $_POST['partSelector'];
     		$partID = "";
			if ($where == 'byName') {
        		$partID = $_POST['partName'];
        	}
        	else if ($where == 'byPart') {
				$partID = $_POST['partID'];
       		}

			$message = "";
            if($partID!="") {
            	//Yes, there is a sale within this upgrade! Process it:
	        	$partcost = $_POST['partCostVal'];
    			$message = $controller->model->processSale($partID,$partcost,$detail);
            }

			$servicecost = $_POST['serviceCostVal'];
			//Process the Upgrade part:
        	$message .= $controller->model->processUpgradeRepair($device,$servicecost,$detail,$type);

		}
        else if($type == "repair") {

        	 $servicecost = $_POST['serviceCostVal'];
       		 $detail = $_POST['serviceDetail'];

        	//Process this new repair:
       		 $message .= $controller->model->processUpgradeRepair($device,$servicecost,$detail,$type);
		}



    }
    else {
       $message = "Controller called for unknown service type! Exiting...";
		include '../views/loginView.php';
		return;
    }

	$controller->loadViewWithMessage($message);

}

?>