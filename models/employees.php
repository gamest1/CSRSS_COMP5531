<?php

class Employees {
    public $db;
    
    public function __construct()  
    {  
    	$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);
        $this->db = $link;
    }

	function getAllEmployeesInfo()
	{
		 $answer = array();

		 $query = "select * from CSRSS_Employees join CSRSS_Users using(username) order by employeeID asc";
		 $result = mysql_query($query,$this->db);

		 if(!$result) return $resp;

  		 	while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
  		 		$resp = array();
  		 		$resp['username'] = $record['username'];
  		 		$resp['online_fee'] = $record['online_fee'];
  		 		$resp['service_fee'] = $record['service_fee'];
  		 		$resp['isAdmin'] = $record['isAdmin'];
  		 		$resp['firstName'] = $record['firstName'];
  		 		$resp['lastName'] = $record['lastName'];
  		 		$resp['first_day_of_work'] = $record['first_day_of_work'];
  		 		$resp['base_salary'] = $record['base_salary'];
  		 		$resp['address'] = $record['address'];
  		 		$resp['phone'] = $record['phone'];
  		 		$answer[$record['employeeID']] = $resp;
  			}

  		 return $answer;
	}

	function getAllInfoForEmployee($employeeID)
	{
		$resp = array();

		 $query = "select * from CSRSS_Employees join CSRSS_Users using(username) where employeeID='$employeeID'";
		 $result = mysql_query($query,$this->db);

		 if(!$result) return $resp;

  		 $record = mysql_fetch_array($result,MYSQL_ASSOC);
  		 $resp['employeeID'] = $record['employeeID'];
  		 $resp['username'] = $record['username'];
  		 $resp['last_login'] = $record['last_login'];
  		 $resp['online_fee'] = $record['online_fee'];
  		 $resp['service_fee'] = $record['service_fee'];
  		 $resp['isAdmin'] = $record['isAdmin'];
  		 $resp['firstName'] = $record['firstName'];
  		 $resp['lastName'] = $record['lastName'];
  		 $resp['first_day_of_work'] = $record['first_day_of_work'];
  		 $resp['base_salary'] = $record['base_salary'];
  		 $resp['address'] = $record['address'];
  		 $resp['phone'] = $record['phone'];

	  	 return $resp;
	}

	function addNewEmployee($employeeID,$username,$onlinefee,$isAdmin,$firstName,$lastName,$firstDayWork,$baseSalary,$address,$phone) {
	
		$resp = "ERROR";

		if ($address != "NULL") {
         	$address = '"' . $address . '"';
        }

        if ($phone != "NULL") {
         	$phone = '"' . $phone . '"';
        }

         $query = "insert into CSRSS_Employees (employeeID,username,online_fee,isAdmin,firstName,lastName,first_day_of_work,base_salary,address,phone) values (";
		 $query .= "'$employeeID','$username',$onlinefee,$isAdmin,'$firstName','$lastName','$firstDayWork',$baseSalary," . $address . "," . $phone . ")";
		 
		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);
		 if($rows == 1) {
				
				$resp = "Employee added successfully to Employees database ";
			 	//This function also adds an entry to the Users table:
				$query = "insert into CSRSS_Users (username) values ('$username')";
		 		$result = mysql_query($query,$this->db);
		 		$rows = mysql_affected_rows($this->db);
				if($rows == 1) $resp .= "and new username added to the Users database. New user can login with default password now!";
		 		else $resp .= "; however, we couldn't create a default login for this user. Please, update the Users table manually.";
		 }

		 return $resp;
	}

	function updateEmployee($employeeID,$onlinefee,$servicefee,$isAdmin,$firstName,$lastName,$firstDayWork,$baseSalary,$address,$phone) {
	
		if ($address != "NULL") {
         	$address = '"' . $address . '"';
        }

        if ($phone != "NULL") {
         	$phone = '"' . $phone . '"';
        }

		 $query = "update CSRSS_Employees set online_fee=$onlinefee, service_fee=$servicefee, isAdmin=$isAdmin, firstName='$firstName'";
		 $query .= ", lastName='$lastName', first_day_of_work='$firstDayWork', base_salary=$baseSalary";
		 $query .= ", address=" . $address . ", phone=" . $phone ;
		 $query .= " where employeeID='$employeeID'";

		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);

		 if($rows == 1) return "Employee $employeeID successfully updated in Employees database. ";
		 else if($rows == 0) return "Nothing to update for $employeeID in Employees database. ";
		 else return "ERROR";
	}


	function getAllEmployees()
	{
		 $resp = array();

		 $query = "select employeeID from CSRSS_Employees order by employeeID asc";
		 $result = mysql_query($query,$this->db);

		 if(!$result) return $resp;

            $i = 0;
  		 	while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
  		 		$resp[$i++] = $record['employeeID'];
  			}

  		 return $resp;
	}

	function getAllPayments()
	{
		 $resp = array();

		 $query = "select * from CSRSS_Payments order by employeeID asc";
		 $result = mysql_query($query,$this->db);

		 if(!$result) return $resp;

            $i = 0;
  		 	while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
  		 		$tmp = array();
  		 		$tmp['employeeID'] = $record['employeeID'];
  		 		$tmp['period_start_on'] = $record['period_start_on'];
  		 		$tmp['period_finish_on'] = $record['period_finish_on'];
  		 		$tmp['amount'] = $record['amount'];
  		 		$tmp['payment_code'] = $record['payment_code'];
  		 		$tmp['paid_on'] = $record['paid_on'];
  		 		$resp[$i++] = $tmp;
  			}

  		 return $resp;
	}

	function updatePaymentCode($employee,$startDate,$finishDate,$code)
	{

		 $today = date("Y-m-d"); 

		 $query = "update CSRSS_Payments set payment_code=$code, paid_on='$today' ";
		 $query .= "where employeeID='$employee' and period_start_on=DATE('$startDate') and period_finish_on=DATE('$finishDate')";

		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);
		 if($rows == 1) return "Payment record successfully updated in Payments database. ";
		 else return $query;
	}
	
	function getAllPaymentsForEmployee($employee)
	{
		 $resp = array();

		 $query = "select * from CSRSS_Payments where employeeID='$employee' order by period_start_on asc";
		 $result = mysql_query($query,$this->db);

		 if(!$result) return $resp;

            $i = 0;
  		 	while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
  		 		$tmp = array();
  		 		$tmp['period_start_on'] = $record['period_start_on'];
  		 		$tmp['period_finish_on'] = $record['period_finish_on'];
  		 		$tmp['amount'] = $record['amount'];
  		 		$tmp['paid_on'] = $record['paid_on'];
  		 		$tmp['payment_code'] = $record['payment_code'];
  		 		$resp[$i++] = $tmp;
  			}

  		 return $resp;
	}

	function getAllUnpaidServicesForEmployee($employee)
	{
		 $resp = array();

		 $query = "select distinct serviceID, date, type, paid_to_employee from CSRSS_Services as X left join ";
		 $query .= "CSRSS_Payments as Y on (X.employeeID=Y.employeeID) where X.employeeID='$employee' and ";
		 $query .= "X.serviceID not in ( ";
		 $query .= "select serviceID from CSRSS_Services as Z join CSRSS_Payments as W on ";
		 $query .= "(Z.employeeID=W.employeeID and (Z.date >= W.period_start_on and Z.date <= W.period_finish_on)) where ";
		 $query .= "Z.employeeID='$employee');";

		 $result = mysql_query($query,$this->db);

		 if(!$result) return $resp;

            $i = 0;
  		 	while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
  		 		$tmp = array();
  		 		$tmp['serviceID'] = $record['serviceID'];
  		 		$tmp['date'] = $record['date'];
  		 		$tmp['type'] = $record['type'];
  		 		$tmp['paid_to_employee'] = $record['paid_to_employee'];
  		 		$resp[$i++] = $tmp;
  			}

  		 return $resp;
	}

	function createPaymentForEmployee($employee,$date_start,$date_end)
	{

		 //Calculate the amount owned to employee on the given date interval:
		 $query = "select T.employeeID, SUM(paid_to_employee) as total_owed from ( ";
		 $query .= "select distinct X.employeeID, serviceID, date, type, paid_to_employee from CSRSS_Services as X left ";
		 $query .= "join CSRSS_Payments as Y on (X.employeeID=Y.employeeID) where X.employeeID='$employee' and X.serviceID ";
		 $query .= "not in ( ";
		 $query .= "select serviceID from CSRSS_Services as Z join CSRSS_Payments as W on (Z.employeeID=W.employeeID and ";
		 $query .= "(Z.date >= W.period_start_on and Z.date <= W.period_finish_on)) where Z.employeeID='$employee' ";
		 $query .= ")"; 
		 $query .= ") as T "; 
		 $query .= "where (T.date >= DATE('$date_start') and T.date <= DATE('$date_end')) group by T.employeeID";

		 $result = mysql_query($query,$this->db);
		 if(!$result) return false;

  		 $record = mysql_fetch_array($result,MYSQL_ASSOC);
  		 //If the previous query returns an empty set:
  		 if($record === false) $owed = 0.0;
	  	 else $owed = $record['total_owed'];

 		 $query = "insert into CSRSS_Payments (employeeID,period_start_on,period_finish_on,amount) values (";  
		 $query .= "'$employee','$date_start','$date_end',$owed)";

		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);

		 if($rows == 1) return true;
		 else return false;
		 
	}

}

?>