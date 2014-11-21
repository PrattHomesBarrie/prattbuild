<?php
//require_once('../includes/check_session.php'); 
require_once('../includes/vars.php');
require_once("../includes/classes/mysql_ultimate.php"); 
$db = new MySQL(); 
//$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends
$table = mysql_real_escape_string(trim(strip_tags($_GET['table'])));
$whereColumn = mysql_real_escape_string(trim(strip_tags($_GET['whereColumn'])));
$whereData = trim(strip_tags($_GET['whereData']));

$query = 'select * from '.$table.' where 1=1 ';
if ($whereColumn > '') {
	$query .= ' and '.$whereColumn;
	$query .= " = '".mysql_real_escape_string($whereData)."'";
}
 $query .= ' order by 1';
//echo $query;

if ($db->Query($query)) { 
//	var_export($db);
	while ($row = $db->RowArray()) {
		$x=0;
		$columnCount = $db->GetColumnCount($table);
		while ($x < $columnCount) {
			$columnName = $db->GetColumnName($x);
			$jsonRow[$columnName]= $row[$x];
			$x=$x+1;
		}
		$row_set[] = $jsonRow;//build an array
	}

}


echo json_encode($row_set);//format the array into json data

?>