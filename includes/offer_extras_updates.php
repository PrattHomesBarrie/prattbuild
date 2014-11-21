<?php

//don't foget to make any additions here also to the copy offer function

$table = "offerFeatures";
if ($myEditAction == 'SaveFeature' || $myEditAction == 'AddFeature') {
	//either save or add
	$arr["featureText"] = '"'.mysql_real_escape_string($_POST["featureText"]).'"';	
	$arr["featureSubText"] = '"'.mysql_real_escape_string($_POST["featureSubText"]).'"';	
	$arr["featureLocked"] = '"'.mysql_real_escape_string($_POST["featureLocked"]).'"';	
	$arr["featureChangedDate"] = "CURDATE()";
	$currentVar = "featureResalePrice";
	if  ($_POST[$currentVar] > '') {
		$arr[$currentVar] = $_POST[$currentVar];	
	}
	$arr["featureDiscountAllowed"] = $_POST["featureDiscountAllowed"];	
	if ($arr["featureDiscountAllowed"] == 1) { 
		//1 is okay
	}
	else {
		$arr["featureDiscountAllowed"] = 0;
	}

		}
if ($myEditAction == 'DeleteFeature' || $myEditAction == 'AddFeature') {
	//either delete or add 
		}
if ($myEditAction == 'DeleteFeature' || $myEditAction == 'SaveFeature') {
	//either delete or add 
	$where["id"] = $_POST["featureId"];	

	//$where["siteShortName"] = '"'.$siteShortName.'"';	
	//$where["lotNumber"] = $lotNumber;	
		}
if ($myEditAction == 'SaveFeature') {
	//save only 
		}
if ($myEditAction == 'AddFeature') {
	//add only
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["id"] = $newId;	
	$arr["siteShortName"] = '"'.$siteShortName.'"';	
	$arr["lotNumber"] = $lotNumber;	
	$arr["featureAddedDate"] = "CURDATE()";
}
if ($myEditAction == 'DeleteFeature') {
	//delete only
	//will call the delete rows function
}

//echo '<br>Table is:'.$table.'<br>Value Array is:'.print_r($arr).'<br>where clause is:'.print_r($where);

$result = true;
$message = "";
if ($myEditAction == 'AddFeature') {
	if ($newId > -1) {
		$result = $dbSingleUse->InsertRow($table, $arr);
		echo "checking result";
		$errorNumber = $dbSingleUse->ErrorNumber();
		$result = checkRowIdExists($dbSingleUse, $table,"id",$newId);
		if ($result == false) {
			$message = 'There was a problem adding this feature.  There error number was:'.$errorNumber;
		}
	}
	else
	{
		$result = false;			
		$message = "There was a database problem reserving the identifier for this feature, please try again";
	}
}
if ($myEditAction == 'SaveFeature') {
	$result = $dbSingleUse->UpdateRows($table, $arr, $where);
}
if ($myEditAction == 'DeleteFeature') {
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