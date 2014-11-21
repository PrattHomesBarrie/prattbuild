<?php

//don't foget to make any additions here also to the copy offer function

$table = "offerPayments";
if ($myEditAction == 'SavePayment' || $myEditAction == 'AddPayment') {
	//either save or add
	$currentVar =  "dueDate";
	if ($_POST[$currentVar] > '') {
		$arr[$currentVar] = '"'.date('Y-m-d',strtotime($_POST[$currentVar])).'"';
	}
	else	{
		$arr[$currentVar] = '"0000-00-00"';
	}
	$currentVar =  "depositDate";
	if ($_POST[$currentVar] > '') {
		$arr[$currentVar] = '"'.date('Y-m-d',strtotime($_POST[$currentVar])).'"';
	}
	else	{
		$arr[$currentVar] = '"0000-00-00"';
	}
	$currentVar = "expectedAmount";
	if  ($_POST[$currentVar] > '') {
		$arr[$currentVar] = $_POST[$currentVar];	
	}
	$currentVar = "depositAmount";
	if  ($_POST[$currentVar] > '') {
		$arr[$currentVar] = $_POST[$currentVar];	
	}
	if (!isset($_POST["paymentStatus"])) {
		$arr["paymentStatus"] = "Payment Expected";
	}
	else {
		$arr["paymentStatus"] = '"'.mysql_real_escape_string($_POST["paymentStatus"]).'"';	
	}
	$arr["comments"] = '"'.mysql_real_escape_string($_POST["comments"]).'"';	
	$arr["modUserName"] = '"'.$userName.'"';

		}
if ($myEditAction == 'DeletePayment' || $myEditAction == 'AddPayment') {
	//either delete or add 
		}
if ($myEditAction == 'DeletePayment' || $myEditAction == 'SavePayment') {
	//either delete or add 
	$where["id"] = $_POST["paymentId"];	

	//$where["siteShortName"] = '"'.$siteShortName.'"';	
	//$where["lotNumber"] = $lotNumber;	
		}
if ($myEditAction == 'SavePayment') {
	//save only 
		}
if ($myEditAction == 'AddPayment') {
	//add only
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["id"] = $newId;	
	$arr["siteShortName"] = '"'.$siteShortName.'"';	
	$arr["lotNumber"] = $lotNumber;	
}
if ($myEditAction == 'DeleteFeature') {
	//delete only
	//will call the delete rows function
}

//echo '<br>Table is:'.$table.'<br>Value Array is:'.print_r($arr).'<br>where clause is:'.print_r($where);

$result = true;
$message = "";
if ($myEditAction == 'AddPayment') {
	if ($newId > -1) {
		$result = $dbSingleUse->InsertRow($table, $arr);
		echo "checking result";
		$errorNumber = $dbSingleUse->ErrorNumber();
		$result = checkRowIdExists($dbSingleUse, $table,"id",$newId);
		if ($result == false) {
			$message = 'There was a problem adding this payment.  There error number was:'.$errorNumber;
		}
	}
	else
	{
		$result = false;			
		$message = "There was a database problem reserving the identifier for this payment, please try again";
	}
}
if ($myEditAction == 'SavePayment') {
	$result = $dbSingleUse->UpdateRows($table, $arr, $where);
}
if ($myEditAction == 'DeletePayment') {
	$result = $dbSingleUse->DeleteRows($table, $where);
}

if ($result == false) {
	if ($message == "") {
		$errorNumber = $dbSingleUse->ErrorNumber();
		$message = "There was a problem updating the database, please try again.  Please record this error number:".$errorNumber;
	}
	alertBox ($message);
}


?>