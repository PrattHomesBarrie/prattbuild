<?php

require_once('check_session.php'); 
require_once('vars.php');
require_once("classes/mysql_ultimate.php"); 
$db = new MySQL(); 
$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends
$query = 'select distinct featureName2  as myValue from lookupFeatures where upper(featureName2) like upper("%'.$term.'%") order by myValue';
if ($db->Query($query)) { 
	while ($resultRow = $db->Row()) {
		$row['label']=htmlentities(stripslashes($resultRow->myValue));
		$row_set[] = $row;//build an array
	}
}


echo json_encode($row_set);//format the array into json data

?>