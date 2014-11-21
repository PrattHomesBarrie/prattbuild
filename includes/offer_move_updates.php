<?php


$newLot = $_POST["DestLot"];


$continue = true;
echo '<big><b><font color="red">';
if (!is_numeric($newLot)) {
	echo "<br><br>Error - The Lot Number is not valid - must be a valid number";
	$continue = false;
}


$table = "lots";
$where["siteShortName"] = '"'.$siteShortName.'"';	
$where["lotNumber"] = $newLot;
if ($continue) {
	if (!$dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
		echo "<br><br>Error - The Lot Number is not valid - ".$newLot." does not exist in this site - ".$siteShortName;
		$continue = false;
	}
}

$table = "offers";
if ($continue) {
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
		echo "<br><br>Error - data already exists in ".$table." for ".$newLot."- delete offer on lot ".$siteShortName."-".$newLot." first.";
		$continue = false;
	}
}

$table = "offerAmendments";
if ($continue) {
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
		echo "<br><br>Error - data already exists in ".$table." for ".$newLot."- delete offer on lot ".$siteShortName."-".$newLot." first.";
		$continue = false;
	}
}
$table = "offerChangeOrders";
if ($continue) {
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
		echo "<br><br>Error - data already exists in ".$table." for ".$newLot."- delete offer on lot ".$siteShortName."-".$newLot." first.";
		$continue = false;
	}
}
$table = "offerFeatures" ;
if ($continue) {
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
		echo "<br><br>Error - data already exists in ".$table." for ".$newLot."- delete offer on lot ".$siteShortName."-".$newLot." first.";
		$continue = false;
	}
}
$table = "offerWorkCredits";
if ($continue) {
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
		echo "<br><br>Error - data already exists in ".$table." for ".$newLot."- delete offer on lot ".$siteShortName."-".$newLot." first.";
		$continue = false;
	}
}

echo '</font></b></big>';

if ($continue) {

	echo "<br>Moving Customer and Financials";
	$table = "offers";
	$where["siteShortName"] = '"'.$siteShortName.'"';	
	$where["lotNumber"] = $lotNumber;
	$update["lotNumber"] = $_POST["DestLot"];
	
		
	//$query = 'select *	from '.$table.' where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;
	//$dbSingleUse->Query($query);
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
		$dbSingleUse->SelectRows($table, $where);
		echo '<br>'.$dbSingleUse->GetHTML();
		$result = $dbSingleUse->UpdateRows($table, $update, $where);
	}
	echo "<br>Moving Amendments";
	$table = "offerAmendments";
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
		$dbSingleUse->SelectRows($table, $where);
		echo '<br>'.$dbSingleUse->GetHTML();
		$result = $dbSingleUse->UpdateRows($table, $update, $where);
	}
	echo "<br>Moving Change Orders";
	$table = "offerChangeOrders";
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
		$dbSingleUse->SelectRows($table, $where);
		echo '<br>'.$dbSingleUse->GetHTML();
		$result = $dbSingleUse->UpdateRows($table, $update, $where);
	}
	echo "<br>Moving Features";
	$table = "offerFeatures" ;
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
		$dbSingleUse->SelectRows($table, $where);
		echo '<br>'.$dbSingleUse->GetHTML();
		$result = $dbSingleUse->UpdateRows($table, $update, $where);
	}
	echo "<br>Moving Work Credits";
	$table = "offerWorkCredits";
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
		$dbSingleUse->SelectRows($table, $where);
		echo '<br>'.$dbSingleUse->GetHTML();
		$result = $dbSingleUse->UpdateRows($table, $update, $where);
	}
	echo "<br>Moving Deposits";
	$table = "offerDeposits";
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
		$dbSingleUse->SelectRows($table, $where);
		echo '<br>'.$dbSingleUse->GetHTML();
		$result = $dbSingleUse->UpdateRows($table, $update, $where);
	}
}
?>