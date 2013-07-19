<?php

class Ajax {

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

	function getInfoForPart($partID)
	{
		$resp = array();
		$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);

		 $query = "select * from CSRSS_Parts where partID=" . $partID;
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

		 $query = "select partID, partName from CSRSS_Parts where part_type=" . $category;
		 $result = mysql_query($query,$link);

		 if(!$result) return "{\"status\":\"error: error in getPartsInCategory query\"}";

  		    $i = 0;
  		 	while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
  		 		$tmp[$i] = $record['partID'];
				$tmp2[$i] = $record['partName'];
				$i++;
  			}

  		$resp = array('ids' => $tmp,
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
       case "getPartsInCategory":
       		echo $controller->getPartsInCategory($_POST['category']);
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