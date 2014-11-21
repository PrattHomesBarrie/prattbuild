<?php

$table = "offerChangeOrders";
if ($myEditAction == 'SaveChangeOrder' || $myEditAction == 'AddChangeOrder') {
	//either save or add
	$currentVar =  "dateDocumentSigned";
	if ($_POST[$currentVar] > '') {
		$arr[$currentVar] = '"'.date('Y-m-d',strtotime($_POST[$currentVar])).'"';
	}
	else	{
		$arr[$currentVar] = '"0000-00-00"';
	}
	if ($_POST["printThisItem"] ==  "1") { 
		$arr["printThisItem"] = 1;	
		} 
	else { 
		$arr["printThisItem"] = 0;	
		}
	$arr["changeDescription"] = '"'.mysql_real_escape_string($_POST["changeDescription"]).'"';	
	$currentVar = "changePrice";
	if  ($_POST[$currentVar] > '') {
		$arr[$currentVar] = $_POST[$currentVar];	
	}

		}
if ($myEditAction == 'DeleteChangeOrder' || $myEditAction == 'AddChangeOrder') {
	//either delete or add 
		}
if ($myEditAction == 'DeleteChangeOrder' || $myEditAction == 'SaveChangeOrder') {
	//either delete or add 
	$where["id"] = $_POST["changeId"];	

	//$where["siteShortName"] = '"'.$siteShortName.'"';	
	//$where["lotNumber"] = $lotNumber;	
		}
if ($myEditAction == 'SaveChangeOrder') {
	//save only 
		}
if ($myEditAction == 'AddChangeOrder') {
	//add only
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["id"] = $newId;	
	$arr["siteShortName"] = '"'.$siteShortName.'"';	
	$arr["lotNumber"] = $lotNumber;	
	$arr["changeAddedDate"] = "CURDATE()";
}
if ($myEditAction == 'DeleteChangeOrder') {
	//delete only
	//will call the delete rows function
}

//echo '<br>Table is:'.$table.'<br>Value Array is:'.print_r($arr).'<br>where clause is:'.print_r($where);

$result = true;
$message = "";
if ($myEditAction == 'AddChangeOrder') {
	if ($newId > -1) {
		$result = $dbSingleUse->InsertRow($table, $arr);
		$errorNumber = $dbSingleUse->ErrorNumber();
		$result = checkRowIdExists($dbSingleUse, $table,"id",$newId);
		if ($result == false) {
			$message = 'There was a problem adding this change order.  There error number was:'.$errorNumber;
		}
		else {
			$currentSettingCheck = 'Send email when change order is signed';
			$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
			if ($settingValue == 1) {
				$currentVar =  "dateDocumentSigned";
				if ($_POST[$currentVar] > '') {
					echo '<br>Will be sending customer an email.';
					$result = sendChangeOrderSignedEmail($dbSingleUse,$newId);
				}
			}
		}
	}
	else
	{
		$result = false;			
		$message = "There was a database problem reserving the identifier for this change order, please try again";
	}
}
if ($myEditAction == 'SaveChangeOrder') {
	$currentVar =  "dateDocumentSigned";
	if ($_POST[$currentVar] > '') {
		$query = 'Select '.$currentVar.' from '.$table.' where id =  '.$where["id"];
		$result = $dbSingleUse->QuerySingleValue($query);
		$currentSettingCheck = 'Send email when change order is signed';
		$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
		if ($settingValue == 1) {
			if ($result > '0000-00-00') {
				echo 'Previously signed.  no email is needed';
			}
			else {
				echo '<br>Will be sending customer an email.';
				$result = sendChangeOrderSignedEmail($dbSingleUse,$where["id"]);
			}
		}
	}
	$result = $dbSingleUse->UpdateRows($table, $arr, $where);
}
if ($myEditAction == 'DeleteChangeOrder') {
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