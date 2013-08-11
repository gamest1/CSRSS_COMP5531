<?php

class Parts {
    public $db;
	
	public function __construct()  
    {  
    	$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);
        $this->db = $link;

    } 

	function addNewPart($partID,$partName,$description,$part_type,$cost,$installationCost) {
        
         if ($description != "NULL") {
         	$description = '"' . $description . '"';
         }

		 $query = "insert into CSRSS_Parts (partID,partName,description,part_type,cost,installation_cost) values (";
		 $query .= "'$partID'," . '"' . $partName . '",' . $description . ",'$part_type',$cost,$installationCost)";
		 
		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);
		 if($rows == 1) return "Item added successfully to Parts database. ";
		 else return "ERROR";
	} 

	function updateExistingPart($partID,$partName,$description,$cost,$installationCost) {
        
         if ($description != "NULL") {
         	$description = '"' . $description . '"';
         }

		 $query = 'update CSRSS_Parts set partName=' . '"' . $partName . '", ';
		 $query .= 'description=' . $description . ', ';
		 $query .= "cost=$cost, installation_cost=$installationCost ";
		 $query .= "where partID='$partID'";

		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);
		 if($rows == 1) return "Item $partID successfully updated in Parts database. ";
		 else if($rows == 0) return "Nothing to update for $partID in Parts database. ";
		 else return "ERROR";
	}

	function addPartToInventory($partID,$numberSold,$numberAvailable,$wholePrice) {

		 $query = "insert into CSRSS_Inventory (partID,numberSold,numberAvailable,whole_price) values (";
		 $query .= "'$partID'," . $numberSold . ",$numberAvailable,$wholePrice)";
		 
		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);
		 if($rows == 1) return "Item added successfully to Inventory. ";
		 else return "ERROR";

	}

	function addPartToPurchaseHistory($partID,$purchaseDate,$units,$unit_price) {

		 $query = "insert into CSRSS_PurchaseHistory (partID,purchase_date,units,unit_price) values ";
		 $query .= "('$partID','$purchaseDate',$units,$unit_price)";
		 
		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);
		 if($rows == 1) return "Item added successfully to Purchase History. ";
		 else return "ERROR";

	}

	function updateInventoryPart($partID,$numberSold,$numberAvailable,$wholePrice,$purchaseDate) {

        //Remember: This function must be smart enough to understand if there is new items being purchased and update CSRSS_PurchaseHistory accordingly
		$resp = "";

		//Find out the current numberAvailable:
		 $query = "select numberAvailable from CSRSS_Inventory where partID='$partID'"; 
		 $result = mysql_query($query,$this->db);
  		 $record = mysql_fetch_array($result,MYSQL_ASSOC);
  		 $total = $record['numberAvailable'];
  		 if($total<$numberAvailable) {
  		 	 //We have a new purchase! Add difference to purchase history:
  		 	$diff = $numberAvailable - $total;
		    $query = "insert into CSRSS_PurchaseHistory (partID,purchase_date,units,unit_price) values ";
		 	$query .= "('$partID','$purchaseDate'," . intval($diff) . ",$wholePrice)";
		 	$result = mysql_query($query,$this->db);
 			$rows = mysql_affected_rows($this->db);
 			if($rows == 1) $resp .= "New purchase! Purchase History successfully updated for $partID. ";
 			else $resp .= "New purchase detected! but we had a problem while updating Purchase History for $partID. ";
  		 }

  		 //Now update inventory:

		 $query = "update CSRSS_Inventory set numberSold=$numberSold, numberAvailable=$numberAvailable, whole_price=$wholePrice ";
		 $query .= "where partID='$partID'";

		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);

		 if($rows == 1) $resp .= "Item $partID successfully updated in Inventory database. ";
		 else if($rows == 0) $resp .= "Nothing to update for $partID in Inventory database. ";
		 else $resp = "ERROR";

		 return $resp;
	}

	function addNewComputerItem($partID,$processor,$os,$antivirus,$ram,$memory_specs,$gb,$storage_specs,$type,$otherinfo) {

		if ($antivirus != "NULL") {
         	$antivirus = '"' . $antivirus . '"';
        }

        if ($otherinfo != "NULL") {
         	$otherinfo = '"' . $otherinfo . '"';
        }

         $query = "insert into CSRSS_Computer (partID,processor,os,antivirus,RAM_in_MB,memory_specs,GB,storage_specs,type,otherInfo) values (";
		 $query .= "'$partID','$processor','$os'," . $antivirus . ",$ram,'$memory_specs',$gb,'$storage_specs','$type'," . $otherinfo . ")";
		 
		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);
		 if($rows == 1) return "Item added successfully to Computer database. ";
		 else return "ERROR";
	}

	function updateComputerItem($partID,$processor,$os,$antivirus,$ram,$memory_specs,$gb,$storage_specs,$type,$otherinfo) {

		if ($antivirus != "NULL") {
         	$antivirus = '"' . $antivirus . '"';
        }

        if ($otherinfo != "NULL") {
         	$otherinfo = '"' . $otherinfo . '"';
        }

		 $query = "update CSRSS_Computer set processor='$processor', os='$os', antivirus=" . $antivirus . ", ";
		 $query .= "RAM_in_MB=$ram, memory_specs='$memory_specs', GB=$gb, storage_specs='$storage_specs', ";
		 $query .= "type='$type', otherInfo=" . $otherinfo . " ";
		 $query .= "where partID='$partID'";

		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);

		 if($rows == 1) return "Item $partID successfully updated in Computer database. ";
		 else if($rows == 0) return "Nothing to update for $partID in Computer database. ";
		 else return "ERROR";

	}

	function addNewDesktopItem($partID,$enclosure,$power_unit,$mother_board,$monitor,$mouse,$keyboard) {

		if ($enclosure != "NULL") {
         	$enclosure = '"' . $enclosure . '"';
        }

        if ($power_unit != "NULL") {
         	$power_unit = '"' . $power_unit . '"';
        }

        if ($mother_board != "NULL") {
         	$mother_board = '"' . $mother_board . '"';
        }

        if ($monitor != "NULL") {
         	$monitor = '"' . $monitor . '"';
        }

        if ($mouse != "NULL") {
         	$mouse = '"' . $mouse . '"';
        }

        if ($keyboard != "NULL") {
         	$keyboard = '"' . $keyboard . '"';
        }

         $query = "insert into CSRSS_DesktopComputer (partID,enclosure,power_unit,mother_board,monitor,mouse,keyboard) values (";
		 $query .= "'$partID'," . $enclosure . "," . $power_unit . "," . $mother_board . "," . $monitor . "," . $mouse . "," . $keyboard  . ")";
		 
		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);
		 if($rows == 1) return "Item added successfully to Desktop Computer database. ";
		 else return "ERROR";
	}

	function updateDesktopItem($partID,$enclosure,$power_unit,$mother_board,$monitor,$mouse,$keyboard) {

		if ($enclosure != "NULL") {
         	$enclosure = '"' . $enclosure . '"';
        }

        if ($power_unit != "NULL") {
         	$power_unit = '"' . $power_unit . '"';
        }

        if ($mother_board != "NULL") {
         	$mother_board = '"' . $mother_board . '"';
        }

        if ($monitor != "NULL") {
         	$monitor = '"' . $monitor . '"';
        }

        if ($mouse != "NULL") {
         	$mouse = '"' . $mouse . '"';
        }

        if ($keyboard != "NULL") {
         	$keyboard = '"' . $keyboard . '"';
        }

		 $query = "update CSRSS_DesktopComputer set enclosure=" . $enclosure . ", ";
		 $query .= "power_unit=" . $power_unit . ", mother_board=" . $mother_board . ", ";
		 $query .= "monitor=" . $monitor . ", mouse=" . $mouse . ", ";
		 $query .= "keyboard=" . $keyboard . " ";
		 $query .= "where partID='$partID'";

		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);

		 if($rows == 1) return "Item $partID successfully updated in Desktop Computer database. ";
		 else if($rows == 0) return "Nothing to update for $partID in Desktop Computer database. ";
		 else return "ERROR";

	}

	function addNewLaptopItem($partID,$screen_size,$battery_life,$battery_specs) {

		if ($screen_size != "NULL") {
         	$screen_size = '"' . $screen_size . '"';
        }

        if ($battery_life != "NULL") {
         	$battery_life = '"' . $battery_life . '"';
        }

        if ($battery_specs != "NULL") {
         	$battery_specs = '"' . $battery_specs . '"';
        }

         $query = "insert into CSRSS_LaptopComputer (partID,screen_size,battery_life,battery_specs) values (";
		 $query .= "'$partID'," . $screen_size . "," . $battery_life . "," . $battery_specs  . ")";
		 
		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);
		 if($rows == 1) return "Item added successfully to Laptop Computer database. ";
		 else return "ERROR";

	}

	function updateLaptopItem($partID,$screen_size,$battery_life,$battery_specs) {

		if ($screen_size != "NULL") {
         	$screen_size = '"' . $screen_size . '"';
        }

        if ($battery_life != "NULL") {
         	$battery_life = '"' . $battery_life . '"';
        }

        if ($battery_specs != "NULL") {
         	$battery_specs = '"' . $battery_specs . '"';
        }

		 $query = "update CSRSS_LaptopComputer set screen_size=" . $screen_size . ", ";
		 $query .= "battery_life=" . $battery_life . ", battery_specs=" . $battery_specs . " ";
		 $query .= "where partID='$partID'";

		 $result = mysql_query($query,$this->db);
		 $rows = mysql_affected_rows($this->db);

		 if($rows == 1) return "Item $partID successfully updated in Laptop Computer database. ";
		 else if($rows == 0) return "Nothing to update for $partID in Laptop Computer database. ";
		 else return "ERROR";

	}


	function fetchPurchaseHistory($partID) {

		 $tmp = array();

		 $query = "select * from CSRSS_PurchaseHistory where partID='$partID' order by purchase_date asc";
		 $result = mysql_query($query,$this->db);
	
		 if(!$result) return $tmp;

            $i = 0;
  		 	while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
  		 		$tmp2 = array();
  		 		$tmp2['partID'] = $record['partID'];
  		 		$tmp2['purchase_date'] = $record['purchase_date'];
  		 		$tmp2['units'] = $record['units'];
  		 		$tmp2['unit_price'] = $record['unit_price'];
  		 		$tmp[$i] = $tmp2;
  		 		$i++;
  			}

  		 return $tmp;
	}

	function getInventory()
	{
		$tmp = array();

		 $query = "select X.partID, Y.partName, Y.part_type, X.numberSold, X.numberAvailable from CSRSS_Inventory as X natural join CSRSS_Parts as Y order by Y.part_type asc";
		 $result = mysql_query($query,$this->db);

		 if(!$result) return $tmp;

            $i = 0;
  		 	while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
  		 		$tmp2 = array();
  		 		$tmp2['partID'] = $record['partID'];
  		 		$tmp2['partName'] = $record['partName'];
  		 		$tmp2['part_type'] = $record['part_type'];
  		 		$tmp2['numberSold'] = $record['numberSold'];
  		 		$tmp2['numberAvailable'] = $record['numberAvailable'];  		 		
  		 		$tmp[$i] = $tmp2;
  		 		$i++;
  			}

  		 return $tmp;	
	}
	

	function getAllParts()
	{
		$tmp = array();
		$tmp2 = array();

		 $query = "select partID, partName from CSRSS_Parts order by partName desc";
		 $result = mysql_query($query,$this->db);

		 if(!$result) return $tmp;

            $i = 0;
  		 	while ($record = mysql_fetch_array($result,MYSQL_ASSOC)) {
  		 		$tmp[$i] = $record['partID'];
  		 		$tmp2[$i] = $record['partName'];
  		 		$i++;
  			}

  		 return array('ids' => $tmp,
  					  'names' => $tmp2 );	

	}

}

?>