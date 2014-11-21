<?php
$query = "select offerDate from offers where siteShortName = '".$siteShortName."' and lotNumber = ".$lotNumber."";
$offerDate = "";
if ($dbSingleUse->Query($query)) { 

	$myRow = $dbSingleUse->Row();
		$offerDate = $myRow->offerDate;
	}
//don't foget to make any additions here also to the copy offer function
if ($offerDate > '0000-00-00') {
	$table = "offerDeposits";
	$arr["dueDate"] = '"'.date('Y-m-d',strtotime($offerDate)).'"';
	//$resultRow->siteShortName
	$arr["expectedAmount"] = 2500;	
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["id"] = $newId;	
	$arr["siteShortName"] = '"'.$siteShortName.'"';	
	$arr["lotNumber"] = $lotNumber;	
	$arr["modUserName"] = '"'.$userName.'"';	
	$arr["depositName"] = '"First Deposit"';	
	$result = true;
	$message = "";
	echo '<br>Adding Deposit for:'.$arr["dueDate"];
	$result = $dbSingleUse->InsertRow($table, $arr);
	//print_r($arr);
	$irrevPlus60 = getIrrevocableDatePlusDays($dbSingleUse, $lotNumber, $siteShortName,60);
	echo 'irrev='.$irrevPlus60.'-'.strtotime('- 5 years');
	if (strtotime($irrevPlus60) > strtotime('- 5 years')) {
		$arr["dueDate"] = '"'.date('Y-m-d',strtotime($irrevPlus60)).'"';
	}
	else {
		alertBox('No valid irrevocable date, so can only create one payment');
	}
	//$resultRow->siteShortName
	$arr["expectedAmount"] = 2500;	
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["id"] = $newId;	
	$arr["siteShortName"] = '"'.$siteShortName.'"';	
	$arr["lotNumber"] = $lotNumber;	
	$arr["modUserName"] = '"'.$userName.'"';	
	$arr["depositName"] = '"Second Deposit"';	
	$result = true;
	$message = "";
	echo '<br>Adding Deposit for:'.$arr["dueDate"];
	$result = $dbSingleUse->InsertRow($table, $arr);
	//print_r($arr);
}
else {
	alertBox("This offer needs an offer date");
}

?>