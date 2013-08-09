<?php

class Service {


	function getAllDevices()
	{
		$tmp = array();
		$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);

		 $query = "select d_name from CSRSS_Devices";
		 $result = mysql_query($query,$link);

		 if(!$result) return false;

            $i = 0;
  		 	while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
  		 		$tmp[$i++] = $record['d_name'];
  			}

  		return $tmp;	
	}

	function insertNewDevice($deviceName,$description,$owner)
	{
		$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);

		 $query = "insert into CSRSS_Devices (d_name,description,owner) values ('" . $deviceName . "','" . $description . "','" . $owner . "')";
		 $result = mysql_query($query,$link);
		 $rows = mysql_affected_rows($link);
		 if($rows == 1) return true;
		 else return false;
	}

	function processSale($partID,$cost,$detail) 
	{

		$today = date("Y-m-d"); 

        if(!isset($_SESSION['employeeID'])) return "We have problems finding you employeeID. This session may have expired";
        else $thisEmployee = $_SESSION['employeeID'];

		$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);


		//Check that we have part available in inventory:
		
		 $query = "select * from CSRSS_Inventory where partID=" . $partID;
		 $result = mysql_query($query,$link);

		 if(!$result) return "Problems connecting with the inventory database: " . $partID;

  		 $record = mysql_fetch_array($result,MYSQL_ASSOC);
  		 $total = $record['numberAvailable'];
  		 if($total<1) return "We are sorry. This part is out-of-stock!";

  		 $sold = $record['numberSold'];
          //Reduce inventory by one!
  		 $total--; 
  		 $sold++;
  		 //Update inventory:
		 $query = "update CSRSS_Inventory set numberAvailable=" . $total . ", numberSold=" . $sold . " where partID=" . $partID;
		 $result = mysql_query($query,$link);

		 if(!$result) return "Problems updating the inventory database";

         $wholePrice = $record['whole_price'];
         $storeRevenue = $cost-$wholePrice;
         //Insert the new record:
         $query = "insert into CSRSS_Services (date,type,employeeID,details,total_amount_paid,paid_to_employee,store_revenue) values (";
         $query .= "'$today','sale','$thisEmployee','$detail','$cost','0.00','$storeRevenue'";
         $query .= ")";

		 $result = mysql_query($query,$link);
		 $rows = mysql_affected_rows($link);
         $newID = mysql_insert_id($link);

		 if($rows == 1)  $resp = "Your sale was processed successfully! ";
		 else return "We had a problem processing this sale :(";

         //Modify the Sales Table:
		 $query = "insert into CSRSS_Sales (serviceID,partID) values (";
         $query .= "'$newID','$partID'";
         $query .= ")";	
          
         $result = mysql_query($query,$link);
		 $rows = mysql_affected_rows($link);

		 if($rows == 1)  $resp .= "A new record was added to the Store Sales history too!";
		 else $resp .= "But we had a problem while adding this order to the Store Sales history :(";

         return $resp; 
	}

	function processUpgradeRepair($device,$servicecost,$detail,$type) 
	{
		 $today = date("Y-m-d"); 

        if(!isset($_SESSION['employeeID'])) return "We have problems finding you employeeID. This session may have expired";
        else $thisEmployee = $_SESSION['employeeID'];

		$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);


         //Fetch the service fee for this employee:
         $query = "select service_fee from CSRSS_Employees where employeeID=" . $thisEmployee;
		 $result = mysql_query($query,$link);

		 if(!$result) return "Problems connecting with the employee database";

  		 $record = mysql_fetch_array($result,MYSQL_ASSOC);
  		 $fee = $record['service_fee'];
         
         //Calulate revenues, etc:
         $employeeAmount = $fee*$servicecost/100.0;
         $storeRevenue = $servicecost - $employeeAmount;

		 $query = "insert into CSRSS_Services (date,type,employeeID,details,total_amount_paid,paid_to_employee,store_revenue) values (";
         $query .= "'$today','$type','$thisEmployee','$detail','$servicecost','$employeeAmount','$storeRevenue'";
         $query .= ")";

		 $result = mysql_query($query,$link);
		 $rows = mysql_affected_rows($link);
         $newID = mysql_insert_id($link);

		 if($rows == 1)  $resp = "Your $type service order was processed successfully! ";
		 else return "We had a problem processing this $type order :(";

         //Now create the CSRSS_UpgradesRepairs instance:
		 $query = "insert into CSRSS_UpgradesRepairs (serviceID,d_name,type,number_of_hours) values (";
         $query .= "'$newID','$device','$type',0";
         $query .= ")";

		 $result = mysql_query($query,$link);
		 $rows = mysql_affected_rows($link);

		 if($rows == 1)  $resp .= "A new record was added to the Store Upgrades/Repairs history too!";
		 else $resp .= "But we had a problem while adding this order to the Upgrades/Repairs history :(";

         return $resp; 
		
	}


}

?>