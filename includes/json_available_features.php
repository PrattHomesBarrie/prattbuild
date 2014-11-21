<?php

require_once('check_session.php'); 
require_once('vars.php');
require_once("classes/mysql_ultimate.php"); 
$db = new MySQL(); 
$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends
$query = 'select * from lookupFeatures where upper(featureCategory) like upper("%'.$term.'%") or upper(featureName) like upper("%'.$term.'%") order by featureCategory, featureName, featureName2';
if ($db->Query($query)) { 
	while ($resultRow = $db->Row()) {
		$row['label']=htmlentities(stripslashes($resultRow->featureName));
		$row['resalePrice']=htmlentities(stripslashes($resultRow->resalePrice));
		$row['featureName2']=htmlentities(stripslashes($resultRow->featureName2));
		$row['id']=htmlentities(stripslashes($resultRow->featureID));
		$row['category']=htmlentities(stripslashes($resultRow->featureCategory));
		$row['discountAllowed']=htmlentities(stripslashes($resultRow->discountAllowed));
		$row_set[] = $row;//build an array
	}
}


echo json_encode($row_set);//format the array into json data

?>