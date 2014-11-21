<?php

function copyOfferTable($db2, $dbSingleUse, $table, $siteShortName, $sourceLot, $destLot, $userName, $session) {
	$result = true;
	echo "<br> Begin: copying table ".$table;
	//echo "<br>new ID = ".$newId;
	$tableColumns = $dbSingleUse->GetColumnNames($table);
	$query = 'select * from '.$table.' where siteShortName = "'.$siteShortName.'" and lotNumber ='.$sourceLot;
	echo '<br>'.$query;
	if ($db2->Query($query)) { 
		while ($resultRow = $db2->Row()) {
			$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
			$x = 0;
			while ($x < $dbSingleUse->GetColumnCount($table)) {
				$columnName = $dbSingleUse->GetColumnName($x, $table);
				$columnDataType = $dbSingleUse->GetColumnDataType($columnName, $table);
				if ($columnDataType == 'real') {$columnDataType = 'double';}
				//echo '<br>'.$columnName.'-'.$columnDataType.'-'.$arr[$columnName] ;
				if ($x == 0) {
					$arr[$columnName] = $newId;
					$checkExistsColumn = $columnName;
				}
				elseif ($columnName == 'lotNumber') {
					$arr[$columnName] = $destLot;
				}
				else {
					if (! is_null($resultRow->$columnName)) {
						$arr[$columnName] = $dbSingleUse->SQLValue( $resultRow->$columnName, $columnDataType);
					}
				}
				//echo '<br>'.$columnName.'-'.$columnDataType.'-'.$arr[$columnName] ;
				$x = $x+1;
			}
			//echo '<br>the new row data : '; print_r($arr);
			//echo '<br>Adding new row';
			$result = $dbSingleUse->InsertRow($table, $arr);
			echo '<br>Checking if row was copied successfully';
			$result = checkRowIdExists($dbSingleUse, $table,$checkExistsColumn,$newId);
		}
	}
	else {
		$result = false;
	}
	if ($result == false) {
			echo'<br><font color = "red"> There was a problem copying this table : '.$table."</font>";
	}
	return $result;
}


$newLot = $_POST["DestLot"];
echo '<br><b><big>Copying Offer from Lot '.$lotNumber.' to lot '.$newLot.'</b></big><br>';

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

	echo "<br>Copying Customer and Financials";
	$whereOld["siteShortName"] = '"'.$siteShortName.'"';	
	$whereOld["lotNumber"] = $lotNumber;
	$whereNew["siteShortName"] = '"'.$siteShortName.'"';	
	$whereNew["lotNumber"] = $newLot;
	
	$table = "offers";
	//$query = 'select *	from '.$table.' where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;
	//$dbSingleUse->Query($query);
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $whereOld))) {
		$result = copyOfferTable($db2, $dbSingleUse, $table, $siteShortName, $lotNumber, $newLot, $userName, session_id());
		if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $whereNew))) {
			$dbSingleUse->SelectRows($table, $whereNew);
			echo '<br>'.$dbSingleUse->GetHTML();
		}
	}
	echo "<br>Copying Amendments";
	$table = "offerAmendments";
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $whereOld))) {
		$result = copyOfferTable($db2, $dbSingleUse, $table, $siteShortName, $lotNumber, $newLot, $userName, session_id());
		if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $whereNew))) {
			$dbSingleUse->SelectRows($table, $whereNew);
			echo '<br>'.$dbSingleUse->GetHTML();
		}
	}
	echo "<br>Copying Change Orders";
	$table = "offerChangeOrders";
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $whereOld))) {
		$result = copyOfferTable($db2, $dbSingleUse, $table, $siteShortName, $lotNumber, $newLot, $userName, session_id());
		if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $whereNew))) {
			$dbSingleUse->SelectRows($table, $whereNew);
			echo '<br>'.$dbSingleUse->GetHTML();
		}
	}
	echo "<br>Copying Features";
	$table = "offerFeatures" ;
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $whereOld))) {
		$result = copyOfferTable($db2, $dbSingleUse, $table, $siteShortName, $lotNumber, $newLot, $userName, session_id());
		if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $whereNew))) {
			$dbSingleUse->SelectRows($table, $whereNew);
			echo '<br>'.$dbSingleUse->GetHTML();
		}
	}
	echo "<br>Copying Work Credits";
	$table = "offerWorkCredits";
	if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $whereOld))) {
		$result = copyOfferTable($db2, $dbSingleUse, $table, $siteShortName, $lotNumber, $newLot, $userName, session_id());
		if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $whereNew))) {
			$dbSingleUse->SelectRows($table, $whereNew);
			echo '<br>'.$dbSingleUse->GetHTML();
		}
	}
	echo "<BR><hr> Note:Chart and Deposit data is not copied</hr>";
}
?>