<?php

$table = "offerWorkCredits";
if ($myEditAction == 'SaveWorkCredit' || $myEditAction == 'AddWorkCredit') {
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
	$arr["workCreditDescription"] = '"'.mysql_real_escape_string($_POST["workCreditDescription"]).'"';	
	$currentVar = "workCreditPrice";
	if  ($_POST[$currentVar] > '') {
		$arr[$currentVar] = $_POST[$currentVar];	
	}

		}
if ($myEditAction == 'DeleteWorkCredit' || $myEditAction == 'AddWorkCredit') {
	//either delete or add 
		}
if ($myEditAction == 'DeleteWorkCredit' || $myEditAction == 'SaveWorkCredit') {
	//either delete or add 
	$where["id"] = $_POST["workCreditId"];	

	//$where["siteShortName"] = '"'.$siteShortName.'"';	
	//$where["lotNumber"] = $lotNumber;	
		}
if ($myEditAction == 'SaveWorkCredit') {
	//save only 
		}
if ($myEditAction == 'AddWorkCredit') {
	//add only
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["id"] = $newId;	
	$arr["siteShortName"] = '"'.$siteShortName.'"';	
	$arr["lotNumber"] = $lotNumber;	
	$arr["workCreditAddedDate"] = "CURDATE()";
}
if ($myEditAction == 'DeleteWorkCredit') {
	//delete only
	//will call the delete rows function
}

//echo '<br>Table is:'.$table.'<br>Value Array is:'.print_r($arr).'<br>where clause is:'.print_r($where);

$result = true;
$message = "";
if ($myEditAction == 'AddWorkCredit') {
	if ($newId > -1) {
		$result = $dbSingleUse->InsertRow($table, $arr);
		$errorNumber = $dbSingleUse->ErrorNumber();
		$result = checkRowIdExists($dbSingleUse, $table,"id",$newId);
		if ($result == false) {
			$message = 'There was a problem adding this work credit.  There error number was:'.$errorNumber;
		}
		else {
			$currentSettingCheck = 'Send email when work credit is signed';
			$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
			if ($settingValue == 1) {
				$currentVar =  "dateDocumentSigned";
				if ($_POST[$currentVar] > '') {
					echo '<br>Will be sending customer an email.';
					$result = sendWorkCreditSignedEmail($dbSingleUse,$newId);
				}
			}
		}
	}
	else
	{
		$result = false;			
		$message = "There was a database problem reserving the identifier for this work credit, please try again";
	}
}
if ($myEditAction == 'SaveWorkCredit') {
	$currentVar =  "dateDocumentSigned";
	if ($_POST[$currentVar] > '') {
		$query = 'Select '.$currentVar.' from '.$table.' where id =  '.$where["id"];
		$result = $dbSingleUse->QuerySingleValue($query);
		$currentSettingCheck = 'Send email when work credit is signed';
		$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
		if ($settingValue == 1) {
			if ($result > '0000-00-00') {
				echo 'Previously signed.  no email is needed';
			}
			else {
				echo '<br>Will be sending customer an email.';
				$result = sendWorkCreditSignedEmail($dbSingleUse,$where["id"]);
			}
		}
	}
	$result = $dbSingleUse->UpdateRows($table, $arr, $where);
}
if ($myEditAction == 'DeleteWorkCredit') {
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