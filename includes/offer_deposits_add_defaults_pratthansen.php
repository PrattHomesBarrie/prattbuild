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
	$arr["expectedAmount"] = 1000;	
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
	$offerPlus30 = getOfferDatePlusDays($dbSingleUse, $lotNumber, $siteShortName,30);
	echo 'offer='.$offerPlus30.'-'.strtotime('- 5 years');
	if (strtotime($offerPlus30) > strtotime('- 5 years')) {
		$arr["dueDate"] = '"'.date('Y-m-d',strtotime($offerPlus30)).'"';
	}
	else {
		alertBox('No valid offer date, so can only create one payment');
	}
	//$resultRow->siteShortName
	$arr["expectedAmount"] = 2000;	
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
	$offerPlus60 = getOfferDatePlusDays($dbSingleUse, $lotNumber, $siteShortName,60);
	echo 'offer='.$offerPlus60.'-'.strtotime('- 5 years');
	if (strtotime($offerPlus60) > strtotime('- 5 years')) {
		$arr["dueDate"] = '"'.date('Y-m-d',strtotime($offerPlus60)).'"';
	}
	$arr["expectedAmount"] = 2500;	
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["id"] = $newId;	
	$arr["siteShortName"] = '"'.$siteShortName.'"';	
	$arr["lotNumber"] = $lotNumber;	
	$arr["modUserName"] = '"'.$userName.'"';	
	$arr["depositName"] = '"Third Deposit"';	
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