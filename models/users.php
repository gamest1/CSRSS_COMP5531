<?php

class Users {

	function updatePassword($p1,$p2) {

		 $link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		 mysql_select_db("kxc55311",$link);

		 $query = "update CSRSS_Users set password='" . md5("COMP5531" . $p1) . "' where username='" . $_SESSION['username'] . "'";  
		 $result = mysql_query($query,$link);

		 if(!$result) return false;

  		 $rows = mysql_affected_rows($link);
		 if($rows == 1) return true;
		 else return false;

	}

	function login($username, $password)
	{
		$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);

		 $query = "select last_login, isAdmin, employeeID, username from CSRSS_Users natural join CSRSS_Employees where username='" . $username . "' and password='" . md5('COMP5531' . $password) . "' limit 1";
		 $result = mysql_query($query,$link);

		 if(!$result) return false;

  		 $record = mysql_fetch_array($result);

  		 if($record) {
  		 	//Create session, etc...=
  		 	 $_SESSION['employeeID'] = $record['employeeID'];
  		 	 $_SESSION['username'] = $record['username'];
  		 	 $_SESSION['isAdmin'] = $record['isAdmin'];

  		 	//Update last-login date:
  		 	 $today = date("Y-m-d"); 
  		 	 $query = "update CSRSS_Users set last_login='$today' where username='$username'";
		 	 $result = mysql_query($query,$link);

  		 	return true;
  		 }
		else {
			return false;
		}


	}
	
	function logout()
	{
		$_SESSION = array();
		session_destroy();
	}	

	function isAdmin($employeeID)
	{
		 $link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		 mysql_select_db("kxc55311",$link);

		 $query = "select * from CSRSS_Employees where employeeID='" . $employeeID . "' limit 1";
		 $result = mysql_query($query,$link);

		 if(!$result) return false;

  		 $record = mysql_fetch_assoc($result);

  		 if($record['isAdmin']==1) {
  		 	//Update last-login date:
  		 	//Create session, etc...
  		 	return true;
  		 }
		else {
			return false;
		}
	}

}

?>