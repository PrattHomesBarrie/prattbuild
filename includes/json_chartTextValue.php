<?php

require_once('check_session.php'); 
require_once('vars.php');
require_once("classes/mysql_ultimate.php"); 
$db = new MySQL(); 

//$term = trim(strip_tags($_GET['term']));

$sectionId = trim(strip_tags($_GET['sectionId']));
$itemId = trim(strip_tags($_GET['itemId']));
$categoryId = trim(strip_tags($_GET['categoryId']));
$limitToCategory = trim(strip_tags($_GET['limitToCategory']));
$limitToItem = trim(strip_tags($_GET['limitToItem']));
$query = 'select distinct textValue  as myValue from offerChartData where upper(textValue) like upper("%'.$term.'%") ';
if ($limitToCategory) {
	$query = $query.' and categoryId = '.$categoryId;
}
if ($limitToItem) {
	$query = $query.' and itemId in (select id from chartSectionItems where chartSectionId = '.$sectionId.')';
}
$query = $query.' order by myValue';
if ($db->Query($query)) { 
	while ($resultRow = $db->Row()) {
		$row['label']=
//		$query.'-'.
//		$sectionId.'-'.
//		$itemId.'-'.
//		$categoryId.'-'.
//		$limitToCategory.'-'.
//		$limitToItem.'-'.
		htmlentities(stripslashes($resultRow->myValue));
		$row_set[] = $row;//build an array
	}
}


echo json_encode($row_set);//format the array into json data

?>