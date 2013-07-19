<?php

class Parts {

	function getAllParts()
	{
		$tmp = array();
		$tmp2 = array();

		$link = mysql_connect("clipper.encs.concordia.ca", "kxc55311", "gamest11") or die ('DB Server: Error connecting to the database!');
		mysql_select_db("kxc55311",$link);

		 $query = "select partID, partName from CSRSS_Parts";
		 $result = mysql_query($query,$link);

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