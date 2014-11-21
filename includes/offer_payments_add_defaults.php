<?php
$query = "select offerDate from offers where siteShortName = '".$siteShortName."' and lotNumber = ".$lotNumber."";
$offerDate = "";
if ($dbSingleUse->Query($query)) { 

	$myRow = $dbSingleUse->Row();
		$offerDate = $myRow->offerDate;
	}
//don't foget to make any additions here also to the copy offer function
if ($offerDate > '0000-00-00') {
	$table = "offerPayments";
	//	$arr[$currentVar] = '"'.date('Y-m-d',strtotime($_POST[$currentVar])).'"';
	$arr["dueDate"] = '"'.date('Y-m-d',strtotime($offerDate)).'"';
	//$resultRow->siteShortName
	$arr["expectedAmount"] = 500;	
	$arr["paymentStatus"] = '"'."Payment Expected".'"';
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["id"] = $newId;	
	$arr["siteShortName"] = '"'.$siteShortName.'"';	
	$arr["lotNumber"] = $lotNumber;	
	$arr["modUserName"] = '"'.$userName.'"';	
	$result = true;
	$message = "";
	$result = $dbSingleUse->InsertRow($table, $arr);
	//print_r($arr);
}
else {
	alertBox("This offer needs an offer date");
}

?>