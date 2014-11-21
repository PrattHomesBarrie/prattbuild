<?php

require_once('check_session.php'); 
require_once('vars.php');
require_once("classes/mysql_ultimate.php"); 
$db = new MySQL(); 
$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends
$query = 'select distinct(city) as cityValue from lots where siteShortName = "'.$siteShortName.'" order by 1';
//$query = 'select distinct(lotType) as lotTypeValue from lots where siteShortName = "MWI" order by 1';
if ($db->Query($query)) { 
	while ($resultRow = $db->Row()) {
		$row['label']=htmlentities(stripslashes($resultRow->cityValue));
		$row_set[] = $row;//build an array
	}
}


echo json_encode($row_set);//format the array into json data

?>