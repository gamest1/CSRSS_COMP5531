<?php
include_once("../models/employees.php");
include_once("../models/service.php");

class Ajax {

  function savePaymentCode($employee,$code,$date_begin,$date_end) {
 
    $resp = array();

    $model = new Employees();
    $tmp = $model->updatePaymentCode($employee,$date_begin,$date_end,$code);
    
    if($tmp != "ERROR") $resp['string'] = $tmp;
    else $resp['string'] = "ERROR";

    return json_encode($resp);

  }

  function getStoreReport($startDate,$endDate) {

    $model = new Service();
    $tmp = $model->getStoreReport($startDate,$endDate);

    $resp = array('report' => $tmp);

    return json_encode($resp);
  
  }

  function getServiceHistoryForEmployee($employeeID,$startDate,$endDate) {

    $model = new Service();
    $tmp = $model->getServiceHistoryForEmployee($employeeID,$startDate,$endDate);

    $resp = array('historia' => $tmp);

    return json_encode($resp);
  
  }

  function fetchDailyActivityForDay($date) {
  
    $model = new Service();
    $tmp = $model->fetchDailyActivityForDay($date);

    $resp = array('activity' => $tmp);

    return json_encode($resp);

  }

  function getAllPaymentsForEmployee($employee) {
 
    $resp = array();

    $model = new Employees();
    $tmp = $model->getAllPaymentsForEmployee($employee);
    $resp['payments'] = $tmp;

    $tmp2 = $model->getAllUnpaidServicesForEmployee($employee);
    $resp['unpaid'] = $tmp2;    

    return json_encode($resp);

  }

	function getHistoryForDevice($deviceName)
	{
		$resp = array();
		$tmp = array();

		$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);

		 $query = "select X.d_name, X.description, X.owner, Y.serviceID, Y.type, Z.date, Z.employeeID, Z.details ";
		 $query .= "from CSRSS_Devices as X natural join CSRSS_UpgradesRepairs as Y natural join CSRSS_Services as Z ";
		 $query .= "where X.d_name='" . $deviceName . "' order by Z.date desc";

		 $result = mysql_query($query,$link);

		 if(!$result) return "{\"status\":\"error: error in $query\"}";

         $i=0;
         while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
         	    $tmp2 = array();
  		 		$tmp2['serviceID'] = $record['serviceID'];
  		 		$tmp2['type'] = $record['type'];
  		 		$tmp2['date'] = $record['date'];
  		 		$tmp2['employeeID'] = $record['employeeID'];
  		 		$tmp2['details'] = $record['details'];
  		 		$tmp[$i++] = $tmp2;

  		 		$resp['deviceName'] = $record['d_name'];
  		 		$resp['deviceDesc'] = $record['description'];
  		 		$resp['deviceOwner'] = $record['owner'];
  		 }  		 

  		 $resp['serviceList'] = $tmp;

  		 return json_encode($resp);
	}

	function getDefaultCosts()
	{
		$resp = array();
		$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);

		 $query = "select * from CSRSS_DefaultCost";
		 $result = mysql_query($query,$link);

		 if(!$result) return "{\"status\":\"error: error in getDefaultCosts query\"}";

  		 	while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
  		 		$resp[$record['service_type']] = $record['default_cost'];
  			}

  		return json_encode($resp);
	}

	function getAllDevices()
	{
		$tmp = array();
		$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);

		 $query = "select d_name from CSRSS_Devices";
		 $result = mysql_query($query,$link);

		 if(!$result) return "{\"status\":\"error: error in getAllDevices query\"}";

            $i = 0;
  		 	while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
  		 		$tmp[$i++] = $record['d_name'];
  			}

  		$resp = array('devices' => $tmp);	

  		return json_encode($resp);
	}	

	function getCostForPart($partID)
	{
		$resp = array();
		$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);

		 $query = "select cost from CSRSS_Parts where partID=" . $partID;
		 $result = mysql_query($query,$link);

		 if(!$result) return "{\"status\":\"error: error in getCostForPart query\"}";

  		 $record = mysql_fetch_array($result,MYSQL_ASSOC);
  		 $resp['cost'] = $record['cost'];
  		

  		return json_encode($resp);
	}



  function getAllInfoForEmployee($employeeID)
  {

    $model = new Employees();
    $tmp = $model->getAllInfoForEmployee($employeeID);

    return json_encode($tmp);
  }

   
  function getAllInfoForPart($partID)
  {
    $resp = array();
    $link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
    mysql_select_db("kxc55311",$link);

  $query = "select * from CSRSS_Parts as A natural join CSRSS_Inventory as B ";
  $query .= "left join CSRSS_Computer as D on B.partID=D.partID "; 
  $query .= "left join CSRSS_DesktopComputer as E on D.partID=E.partID ";
  $query .= "left join CSRSS_LaptopComputer as F on D.partID=F.partID ";
  $query .= "where A.partID='" . $partID . "'";

  $result = mysql_query($query,$link);

     if(!$result) return "{\"status\":\"error: error in getAllInfoForPart query\"}";

       $record = mysql_fetch_array($result,MYSQL_ASSOC);
       $resp['partID'] = $record['partID'];
       $resp['partName'] = $record['partName'];
       $resp['desc'] = $record['description'];
       $resp['cost'] = $record['cost'];
       $resp['installation_cost'] = $record['installation_cost'];
       $resp['numberSold'] = $record['numberSold'];      
       $resp['numberAvailable'] = $record['numberAvailable'];
       $resp['whole_price'] = $record['whole_price'];

       $part_type = $record['part_type'];
       $resp['part_type'] = $part_type;

       if($part_type == "desktop" || $part_type == "laptop") {
            //We have a computer:
            $resp['processor'] = $record['processor'];
            $resp['os'] = $record['os'];
            $resp['antivirus'] = $record['antivirus'];
            $resp['RAM_in_MB'] = $record['RAM_in_MB'];
            $resp['memory_specs'] = $record['memory_specs'];
            $resp['GB'] = $record['GB'];
            $resp['storage_specs'] = $record['storage_specs'];
            $resp['type'] = $record['type'];
            $resp['otherInfo'] = $record['otherInfo']; 

            if($part_type == "desktop") {
              //We have a desktop:
              $resp['enclosure'] = $record['enclosure'];
              $resp['power_unit'] = $record['power_unit'];
              $resp['mother_board'] = $record['mother_board'];
              $resp['monitor'] = $record['monitor'];
              $resp['mouse'] = $record['mouse'];
              $resp['keyboard'] = $record['keyboard']; 
            }
            else if($part_type == "laptop") {
              //We have a laptop:
               $resp['screen_size'] = $record['screen_size'];
               $resp['battery_life'] = $record['battery_life'];
               $resp['battery_specs'] = $record['battery_specs']; 
            }

       }

      return json_encode($resp);
  }

	function getInfoForPart($partID)
	{
		$resp = array();
		$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);

		 $query = "select * from CSRSS_Parts where partID='" . $partID . "'";
		 $result = mysql_query($query,$link);

		 if(!$result) return "{\"status\":\"error: error in getInfoForPart query\"}";

  		 $record = mysql_fetch_array($result,MYSQL_ASSOC);
  		 $resp['partID'] = $record['partID'];
  		 $resp['partName'] = $record['partName'];
  		 $resp['desc'] = $record['description'];
  		 $resp['part_type'] = $record['part_type'];
  		 $resp['cost'] = $record['cost'];
  		 $resp['installation_cost'] = $record['installation_cost'];
  		

  		return json_encode($resp);
	}

	function getPartsInCategory($category)
	{
		$tmp = array();
		$tmp2 = array();
		$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);

		 $query = "select partID, partName from CSRSS_Parts where part_type='" . $category . "' order by partName desc";
		 $result = mysql_query($query,$link);

		 if(!$result) return "{\"status\":\"error: error in getPartsInCategory query\"}";

  		    $i = 0;
  		 	while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
  		 		$tmp[$i] = $record['partID'];
				$tmp2[$i] = $record['partName'];
				$i++;
  			}

  		$resp = array('ides' => $tmp,
  					  'names' => $tmp2);

  		return json_encode($resp);
	}

}

if(isset($_POST['action'])) {

	$action = $_POST['action'];
	$controller = new Ajax();


	switch($action) {
       case "getDefaultCosts":
       		echo $controller->getDefaultCosts();
       		break;
       case "getAllDevices":
       		echo $controller->getAllDevices();
       		break;	
       case "getCostForPart":
       		echo $controller->getCostForPart($_POST['partID']);
       		break;
       case "getInfoForPart":
       		echo $controller->getInfoForPart($_POST['partID']);
       		break;
       case "getAllInfoForPart":
          echo $controller->getAllInfoForPart($_POST['partID']);
          break;
       case "getAllInfoForEmployee":
          echo $controller->getAllInfoForEmployee($_POST['employeeID']);
          break;      
       case "getPartsInCategory":
       		echo $controller->getPartsInCategory($_POST['category']);
       		break;		
       case "getHistoryForDevice":
       		echo $controller->getHistoryForDevice(urldecode($_POST['deviceName']));
       		break;
       case "saveCode":
          echo $controller->savePaymentCode($_POST['employee'],$_POST['code'],$_POST['dateBeg'],$_POST['dateEnd']);
          break; 
       case "getAllPaymentsForEmployee":
          echo $controller->getAllPaymentsForEmployee($_POST['employee']);
          break;   
       case "fetchDailyActivityForDay":
          echo $controller->fetchDailyActivityForDay($_POST['date']);
          break;  
       case "getServiceHistoryForEmployee":
          echo $controller->getServiceHistoryForEmployee($_POST['employee'],$_POST['dateBeg'],$_POST['dateEnd']);
          break;
       case "getStoreReport":
          echo $controller->getStoreReport($_POST['dateBeg'],$_POST['dateEnd']);
          break;            			
       default:
           echo "{\"status\":\"error: unknown action name\"}";
            break;
	}

}
else {
	echo "{\"status\":\"error: no action defined\"}";
}


?>