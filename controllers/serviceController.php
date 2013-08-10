<?php
include_once("../models/service.php");

function trim_value(&$value)
{
    $value = trim($value);    // this removes whitespace and related characters from the beginning and end of the string
    $value = stripslashes($value);
}

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

    array_filter($_POST, 'trim_value');
    $postfilter =    // set up the filters to be used with the trimmed post array
    array(
        'partID' => array('filter' => FILTER_SANITIZE_NUMBER_INT), 
        'serviceType' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'partSelector' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH), 
        'partName' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),  
        'serviceDetail' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_NO_ENCODE_QUOTES), 
        'partCostVal' => array('filter' => FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),
        'serviceCostVal' => array('filter' => FILTER_SANITIZE_NUMBER_FLOAT, 'flags' => FILTER_FLAG_ALLOW_FRACTION),
        'city' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'province' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'country' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'address' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_NO_ENCODE_QUOTES),
        'dateShipped' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'deviceSelect' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'newDeviceName' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'newDeviceOwner' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
        'newDeviceDescription' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_NO_ENCODE_QUOTES)
    );

    $post_array = filter_var_array($_POST, $postfilter);    // must be referenced via a variable which is now an array that takes the place of $_POST[]

	   $type = $post_array['serviceType'];

       if($type == "sale") {
       $where = $post_array['partSelector'];
        if ($where == 'byName') {
        	$partID = $post_array['partName'];
        }
        else if ($where == 'byPart') {
			$partID = $post_array['partID'];
        }
        else {
			$message = "Controller called without real sale type! Exiting...";
			include '../views/loginView.php';
			return;
        }

        //Now we have the PartID, process this sale:
        $cost = $post_array['partCostVal'];
        $detail = $post_array['serviceDetail'];

        $city = $post_array['city'];
        $province = $post_array['province'];
        $country = $post_array['country'];
        $address = $post_array['address'];
        $dateShipped = $post_array['dateShipped'];

		//Process this new sale:
		$message = $controller->model->processSale($partID,$cost,$detail,$city,$province,$country,$address,$dateShipped);
         
    }
    else if($type == "upgrade" || $type == "repair") {
        $device = $post_array['deviceSelect'];
        if($device == "0") {
        	//New Device!
        	$newName = $post_array['newDeviceName'];
        	$description = $post_array['newDeviceDescription'];
			$owner = $post_array['newDeviceOwner'];
            
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
        	
        	$detail = $post_array['serviceDetail'];	
     		$where = $post_array['partSelector'];
     		$partID = "";
			if ($where == 'byName') {
        		$partID = $post_array['partName'];
        	}
        	else if ($where == 'byPart') {
				$partID = $post_array['partID'];
       		}

			$message = "";
            if($partID!="") {
            	//Yes, there is a sale within this upgrade! Process it:
	        	$partcost = $post_array['partCostVal'];
    			$message = $controller->model->processSale($partID,$partcost,$detail);
            }

			$servicecost = $post_array['serviceCostVal'];
			//Process the Upgrade part:
        	$message .= $controller->model->processUpgradeRepair($device,$servicecost,$detail,$type);

		}
        else if($type == "repair") {

        	 $servicecost = $post_array['serviceCostVal'];
       		 $detail = $post_array['serviceDetail'];

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