<?php

class Service {
	public $db;
    
    public function __construct()  
    {  
    	$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);
        $this->db = $link;
    }


  function getStoreReport($startDate,$endDate)
  {
     $tmp = array();
     
     $query = "select isOnline, sum(store_revenue) as revenue from CSRSS_Services left join CSRSS_Sales using(serviceID) ";
     $query .= "where date >= '$startDate' and date <= '$endDate' group by isOnline order by isOnline asc";
     $result = mysql_query($query,$this->db);

     if(!$result) return $tmp;

       while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {

          $tag = $record['isOnline'];

          switch ($tag) {
            case "":
            case NULL:
               $tmp['other'] = $record['revenue'];
              break;
            case 0:
               $tmp['sales'] = $record['revenue'];
              break;
            case 1:
               $tmp['online'] = $record['revenue'];
              break;  
            default:
               $tmp['unknown'] = $record['revenue'];
              break;
          }
      }    

     return $tmp;

    }


    function getServiceHistoryForEmployee($employeeID,$startDate,$endDate) {
    	
     $tmp = array();

		 $query = "select * from CSRSS_Services left join CSRSS_Sales using(serviceID) ";
     $query .= "where date >= '$startDate' and date <= '$endDate' and employeeID=$employeeID order by date asc";

		 $result = mysql_query($query,$this->db);

		 if(!$result) return "{\"status\":\"error: error in $query\"}";

         $i=0;
         while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
         	$tmp2 = array();
  		 		
          $type = $record['type'];

          if($type == "sale") {
              $partID = $record['partID'];
              if($record['isOnline']==1) {
                $type = "online ($partID)";
              }
              else {
                $type = "sale ($partID)";
              }
          } 

          $tmp2['serviceID'] = $record['serviceID'];
  		 		$tmp2['date'] = $record['date'];
          $tmp2['type'] = $type;
  		 		$tmp2['details'] = $record['details'];
  		 		$tmp2['amount_paid'] = $record['total_amount_paid'];
  		 		$tmp2['amount_employee'] = $record['paid_to_employee'];
  		 		$tmp[$i++] = $tmp2;
  		 }  		 

  		 return $tmp;
    }

    function fetchDailyActivityForDay($date) {

		 $tmp = array();

		 $query = "select serviceID, type, employeeID, details, total_amount_paid from CSRSS_Services where date = '$date'";
		 $result = mysql_query($query,$this->db);

		 if(!$result) return "{\"status\":\"error: error in $query\"}";

         $i=0;
         while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
         	    $tmp2 = array();
  		 		$tmp2['serviceID'] = $record['serviceID'];
  		 		$tmp2['type'] = $record['type'];
  		 		$tmp2['employeeID'] = $record['employeeID'];
  		 		$tmp2['details'] = $record['details'];
  		 		$tmp2['amount'] = $record['total_amount_paid'];
  		 		$tmp[$i++] = $tmp2;
  		 }  		 

  		 return $tmp;
    }


	function getAllDevices()
	{
		 $tmp = array();

		 $query = "select d_name from CSRSS_Devices";
		 $result = mysql_query($query,$this->db);

		 if(!$result) return false;

            $i = 0;
  		 	while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
  		 		$tmp[$i++] = $record['d_name'];
  			}

  		return $tmp;	
	}

	function insertNewDevice($deviceName,$description,$owner)
	{
		 $query = "insert into CSRSS_Devices (d_name,description,owner) values ('" . $deviceName . "','" . $description . "','" . $owner . "')";
		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);
		 if($rows == 1) return true;
		 else return false;
	}

	function processSale($partID,$cost,$detail,$city,$province,$country,$address,$dateShipped) 
	{

		$today = date("Y-m-d"); 
    $resp = "";
    
        if(!isset($_SESSION['employeeID'])) return "We have problems finding you employeeID. This session may have expired";
        else $thisEmployee = $_SESSION['employeeID'];


      $isonline = false;
      if($city != "" && $province != "" && $country != "" && $address != "" && $dateShipped != "") {
        //This is an online sale!
         $isonline = true;
      }

		 //Check that we have part available in inventory:
		
		 $query = "select * from CSRSS_Inventory where partID=" . $partID;
		 $result = mysql_query($query,$this->db);

		 if(!$result) return "Problems connecting with the inventory database: " . $partID;

  		 $record = mysql_fetch_array($result,MYSQL_ASSOC);
  		 $total = $record['numberAvailable'];
  		 if($total<1) return "We are sorry. This part is out-of-stock!";

  		 $sold = $record['numberSold'];
          //Reduce inventory by one!
  		 $total--; 
  		 $sold++;


         $wholePrice = $record['whole_price'];
         $storeRevenue = $cost-$wholePrice;
         $employeeAmount = 0;

         if($isonline) {
            //For sales online, the employee keeps certain percentage of the Store Revenue of this item.
            //Fetch the percentage, and update the Store Revenue accordingly:
           $query = "select online_fee from CSRSS_Employees where employeeID=$thisEmployee";
           $result = mysql_query($query,$this->db);

           if(!$result) {
              $resp .= "We couldn't find the online percentage for this employee. A 50% rate was applied. ";
              $percentage = 50;
           }
           {
              $record = mysql_fetch_array($result,MYSQL_ASSOC);
              $percentage = $record['online_fee'];
              $resp .= "An online percentage bonus rate for this employee of $percentage% was applied for this online sale. ";
           }

           $employeeAmount = $percentage*$storeRevenue/100.0;
           $storeRevenue = $storeRevenue - $employeeAmount;          
         }
         
         //Insert the new record:
         $query = "insert into CSRSS_Services (date,type,employeeID,details,total_amount_paid,paid_to_employee,store_revenue) values (";
         $query .= "'$today','sale','$thisEmployee','$detail','$cost',$employeeAmount,'$storeRevenue'";
         $query .= ")";

		     $result = mysql_query($query,$this->db);
		     $rows = mysql_affected_rows($this->db);
         $newID = mysql_insert_id($this->db);

		 if($rows == 1)  {
          $resp .= "Your sale was processed successfully! ";
		      //Now update inventory:
          $query = "update CSRSS_Inventory set numberAvailable=" . $total . ", numberSold=" . $sold . " where partID=" . $partID;
          $result = mysql_query($query,$this->db);

          if(!$result) $resp .= "Problems updating the inventory database. ";
          else $resp .= "Our inventory was updated accordingly. ";
     }
     else {
     
      return "We had a problem processing this sale: " . $query;
     }

      if($isonline) {
         $query = "insert into CSRSS_Sales (serviceID,partID,isOnline) values (";
         $query .= "'$newID','$partID',1";
         $query .= ")";
      }
      else {
         //Modify the Sales Table:
         $query = "insert into CSRSS_Sales (serviceID,partID) values (";
         $query .= "'$newID','$partID'";
         $query .= ")";
      }	
          
         $result = mysql_query($query,$this->db);
		     $rows = mysql_affected_rows($this->db);

		     if($rows == 1)  {
            $resp .= "A new record was added to the Store Sales history too! ";
            if($isonline) {
                //Since this is an on-online sale, add a record to CSRSS_OnlineSales:
                $query = "insert into CSRSS_OnlineSales (serviceID,city,province,country,address,date_shipped) values (";
                $query .= "'$newID','$city','$province','$country','$address','$dateShipped'";
                $query .= ")";
                $result = mysql_query($query,$this->db);
                $rows = mysql_affected_rows($this->db);
                if($rows == 1) $resp .= "And it was saved as an online sale.";
                else  $resp .= "But we had a problem saving it into our online sales database.";
            }
		     }
         else $resp .= "But we had a problem while adding this order to the Store Sales history :(";

         return $resp; 
	}

	function processUpgradeRepair($device,$servicecost,$detail,$type) 
	{
		 $today = date("Y-m-d"); 

        if(!isset($_SESSION['employeeID'])) return "We have problems finding you employeeID. This session may have expired";
        else $thisEmployee = $_SESSION['employeeID'];

         //Fetch the service fee for this employee:
         $query = "select service_fee from CSRSS_Employees where employeeID=" . $thisEmployee;
		 $result = mysql_query($query,$this->db);

		 if(!$result) return "Problems connecting with the employee database";

  		 $record = mysql_fetch_array($result,MYSQL_ASSOC);
  		 $fee = $record['service_fee'];
         
         //Calulate revenues, etc:
         $employeeAmount = $fee*$servicecost/100.0;
         $storeRevenue = $servicecost - $employeeAmount;

		 $query = "insert into CSRSS_Services (date,type,employeeID,details,total_amount_paid,paid_to_employee,store_revenue) values (";
         $query .= "'$today','$type','$thisEmployee','$detail','$servicecost','$employeeAmount','$storeRevenue'";
         $query .= ")";

		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);
         $newID = mysql_insert_id($this->db);

		 if($rows == 1)  $resp = "Your $type service order was processed successfully! ";
		 else return "We had a problem processing this $type order :(";

         //Now create the CSRSS_UpgradesRepairs instance:
		 $query = "insert into CSRSS_UpgradesRepairs (serviceID,d_name,type,number_of_hours) values (";
         $query .= "'$newID','$device','$type',0";
         $query .= ")";

		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);

		 if($rows == 1)  $resp .= "A new record was added to the Store Upgrades/Repairs history too!";
		 else $resp .= "But we had a problem while adding this order to the Upgrades/Repairs history :(";

         return $resp; 
		
	}


}

?>