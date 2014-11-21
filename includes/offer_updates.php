<?php

$table = "offers";

$where["siteShortName"] = '"'.$siteShortName.'"';	
$where["lotNumber"] = $lotNumber;	
$arr["siteShortName"] = '"'.$siteShortName.'"';	
$arr["lotNumber"] = $lotNumber;	


if ($myEditAction == 'SaveCustomer') {

	$arr["personPrefix1"] = '"'.$_POST["personPrefix1"].'"';	
	$arr["personPrefix2"] = '"'.$_POST["personPrefix2"].'"';	
	$arr["personPrefix3"] = '"'.$_POST["personPrefix3"].'"';	
    $arr["firstName1"] = '"'.mysql_real_escape_string($_POST["firstName1"]).'"';
    $arr["firstName2"] = '"'.mysql_real_escape_string($_POST["firstName2"]).'"';
    $arr["firstName3"] = '"'.mysql_real_escape_string($_POST["firstName3"]).'"';
    $arr["lastName1"] = '"'.mysql_real_escape_string($_POST["lastName1"]).'"';
    $arr["lastName2"] = '"'.mysql_real_escape_string($_POST["lastName2"]).'"';
    $arr["lastName3"] = '"'.mysql_real_escape_string($_POST["lastName3"]).'"';
	if ($_POST["birthDate1"] > '') {
		$arr["birthDate1"] = '"'.date('Y-m-d',strtotime($_POST["birthDate1"])).'"';
	}
	else	{
		$arr["birthDate1"] = '"0000-00-00"';
//		$arr["birthDate1"] = Null;
	}
	if ($_POST["birthDate2"] > '') {
		$arr["birthDate2"] = '"'.date('Y-m-d',strtotime($_POST["birthDate2"])).'"';
	}
	else	{
		$arr["birthDate2"] = '"0000-00-00"';
	}
	if ($_POST["birthDate3"] > '') {
    	$arr["birthDate3"] = '"'.date('Y-m-d',strtotime($_POST["birthDate3"])).'"';
	}
	else	{
		$arr["birthDate3"] = '"0000-00-00"';
	}
	//echo $_POST["birthDate2"].' - '.$arr["birthDate2"];

     $arr["clientAddress"] = '"'.mysql_real_escape_string($_POST["clientAddress"]).'"'; 
	 $arr["clientCity"]  = '"'.mysql_real_escape_string($_POST["clientCity"]).'"';
	 $arr["clientProvince"] = '"'.mysql_real_escape_string($_POST["clientProvince"]).'"';
	 $arr["clientPostalCode"] = '"'.mysql_real_escape_string($_POST["clientPostalCode"]).'"';
	 $arr["homePhone"] = '"'.mysql_real_escape_string($_POST["homePhone"]).'"';
	 $arr["workPhone"] = '"'.mysql_real_escape_string($_POST["workPhone"]).'"';
	 $arr["otherPhone"] = '"'.mysql_real_escape_string($_POST["otherPhone"]).'"';
	 $arr["email1"] = '"'.mysql_real_escape_string($_POST["email1"]).'"';

}

if ($myEditAction == 'SaveCoreOffer') {

	$offerInfo = getOfferDetailRecord($dbSingleUse,$siteShortName, $lotNumber) 	;

	$offerPreviouslySigned = false;
	echo '<br><small>Checking if offer was previously signed</small>';
	if ($offerInfo->dateDocumentSigned > '0000-00-00') {
		echo '<small> --> Previously signed.  no email is needed</small>';
		$offerPreviouslySigned = true;
	}

	$currentField = "offerDate";
	if ($_POST[$currentField] > '') {
		$arr[$currentField] = '"'.date('Y-m-d',strtotime($_POST[$currentField])).'"';
	}
	else	{
		$arr[$currentField] = '"0000-00-00"';
	}
	$currentField = "closingDate";
	if ($_POST[$currentField] > '') {
		$arr[$currentField] = '"'.date('Y-m-d',strtotime($_POST[$currentField])).'"';
	}
	else	{
		$arr[$currentField] = '"0000-00-00"';
	}
	$currentField = "occupancyDate";
	if ($_POST[$currentField] > '') {
		$arr[$currentField] = '"'.date('Y-m-d',strtotime($_POST[$currentField])).'"';
	}
	else	{
		$arr[$currentField] = '"0000-00-00"';
	}
	$currentField = "amendedClosingDate";
	if ($_POST[$currentField] > '') {
		$arr[$currentField] = '"'.date('Y-m-d',strtotime($_POST[$currentField])).'"';
	}
	else	{
		$arr[$currentField] = '"0000-00-00"';
	}
	$currentField = "amendedOccupancyDate";
	if ($_POST[$currentField] > '') {
		$arr[$currentField] = '"'.date('Y-m-d',strtotime($_POST[$currentField])).'"';
	}
	else	{
		$arr[$currentField] = '"0000-00-00"';
	}
	$currentField = "irrevocableDate";
	if ($_POST[$currentField] > '') {
		$arr[$currentField] = '"'.date('Y-m-d',strtotime($_POST[$currentField])).'"';
	}
	else	{
		$arr[$currentField] = '"0000-00-00"';
	}
	echo '<br><small>Checking if offer is now signed.</small>';
	$currentField = "dateDocumentSigned";
	$offerIsSigned = false;
	if ($_POST[$currentField] > '') {
		$arr[$currentField] = '"'.date('Y-m-d',strtotime($_POST[$currentField])).'"';
		$offerIsSigned = true;
		echo '<small> --> Offer is signed.</small>';
	}
	else	{
		$arr[$currentField] = '"0000-00-00"';
	}
	$currentField = "dateOverrideOfferChangesAllowed";
	if ($_POST[$currentField] > '') {
		$arr[$currentField] = '"'.date('Y-m-d',strtotime($_POST[$currentField])).'"';
	}
	else	{
		$arr[$currentField] = '"0000-00-00"';
	}

    $arr["modelName"] = '"'.mysql_real_escape_string($_POST["modelName"]).'"';
    $arr["elevation"] = '"'.mysql_real_escape_string($_POST["elevation"]).'"';
    $arr["frontDoor"] = '"'.mysql_real_escape_string($_POST["frontDoor"]).'"';
    $arr["garageSize"] = '"'.mysql_real_escape_string($_POST["garageSize"]).'"';
    $arr["lawyer"] = '"'.mysql_real_escape_string($_POST["lawyer"]).'"';

    $arr["offerStatus"] = '"'.mysql_real_escape_string($_POST["offerStatus"]).'"';
	if ($_POST["offerStatus"] == $_POST["offerStatusPrevious"]) {
		//do nothing
	}
	else{
		$arr["offerStatusDate"] = '"'.date("Y-m-d H:i:s").'"';
	}

	$currentVar = "numberOfBedrooms";
	if  (is_numeric($_POST[$currentVar])) {
		$arr[$currentVar] = $_POST[$currentVar];	
	}
	else{
		$arr[$currentVar] = 0;	
	}
	$currentVar = "paintAndClean";
	if ($_POST[$currentVar] ==  "1") { 
		$arr[$currentVar] = 1;	
		} 
	else { 
		$arr[$currentVar] = 0;	
		}
	$currentVar = "investmentProperty";
	if ($_POST[$currentVar] ==  "1") { 
		$arr[$currentVar] = 1;	
		} 
	else { 
		$arr[$currentVar] = 0;	
		}

	$currentVar = "offerPrice";
	if  (is_numeric($_POST[$currentVar])) {
		$arr[$currentVar] = $_POST[$currentVar];	
	}
	else{
		$arr[$currentVar] = 0;	
	}
	$currentVar = "offerDiscountAmount";
	if  (is_numeric($_POST[$currentVar])) {
		$arr[$currentVar] = $_POST[$currentVar];	
	}
	else{
		$arr[$currentVar] = 0;	
	}
	$currentVar = "occupancyFee";
	if  (is_numeric($_POST[$currentVar])) {
		$arr[$currentVar] = $_POST[$currentVar];	
	}
	else{
		$arr[$currentVar] = 0;	
	}
	$currentVar = "rentToOwnInitialDeposit";
	if  (is_numeric($_POST[$currentVar])) {
		$arr[$currentVar] = $_POST[$currentVar];	
	}
	else{
		$arr[$currentVar] = 0;	
	}
	$currentVar = "rentToOwnSubsequentDeposits";
	if  (is_numeric($_POST[$currentVar])) {
		$arr[$currentVar] = $_POST[$currentVar];	
	}
	else{
		$arr[$currentVar] = 0;	
	}
	$currentVar = "numberOfPayments";
	if  (is_numeric($_POST[$currentVar])) {
		$arr[$currentVar] = $_POST[$currentVar];	
	}
	else{
		$arr[$currentVar] = 0;	
	}
}


$result = $dbSingleUse->AutoInsertUpdate($table, $arr, $where);
//$result = $dbSingleUse->SelectRows($table, $where);
$result = $dbSingleUse->Query("select * from ".$table." where 1=1");

$currentField = "offerDate";
$query = "update ".$table." set ".$currentField." = null where ".$currentField." = '0000-00-00' and siteShortName = '".$siteShortName."' and lotNumber =  ".$lotNumber;
$result = $dbSingleUse->Query($query);

$currentField = "closingDate";
$query = "update ".$table." set ".$currentField." = null where ".$currentField." = '0000-00-00' and siteShortName = '".$siteShortName."' and lotNumber =  ".$lotNumber;
$result = $dbSingleUse->Query($query);

$currentField = "occupancyDate";
$query = "update ".$table." set ".$currentField." = null where ".$currentField." = '0000-00-00' and siteShortName = '".$siteShortName."' and lotNumber =  ".$lotNumber;
$result = $dbSingleUse->Query($query);

$currentField = "amendedClosingDate";
$query = "update ".$table." set ".$currentField." = null where ".$currentField." = '0000-00-00' and siteShortName = '".$siteShortName."' and lotNumber =  ".$lotNumber;
$result = $dbSingleUse->Query($query);

$currentField = "amendedOccupancyDate";
$query = "update ".$table." set ".$currentField." = null where ".$currentField." = '0000-00-00' and siteShortName = '".$siteShortName."' and lotNumber =  ".$lotNumber;
$result = $dbSingleUse->Query($query);

$currentField = "irrevocableDate";
$query = "update ".$table." set ".$currentField." = null where ".$currentField." = '0000-00-00' and siteShortName = '".$siteShortName."' and lotNumber =  ".$lotNumber;
$result = $dbSingleUse->Query($query);

$currentField = "dateDocumentSigned";
$query = "update ".$table." set ".$currentField." = null where ".$currentField." = '0000-00-00' and siteShortName = '".$siteShortName."' and lotNumber =  ".$lotNumber;
$result = $dbSingleUse->Query($query);

$currentField = "dateOverrideOfferChangesAllowed";
$query = "update ".$table." set ".$currentField." = null where ".$currentField." = '0000-00-00' and siteShortName = '".$siteShortName."' and lotNumber =  ".$lotNumber;
$result = $dbSingleUse->Query($query);

//$offerInfo = getOfferDetailRecord($dbSingleUse,$siteShortName, $lotNumber) 	;
$currentSettingCheck = 'Send email when offer is signed';
$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
if ($settingValue == 1) {
	if ($offerPreviouslySigned == false and $offerIsSigned == true) {
		$result = sendOfferSignedEmail($dbSingleUse,$siteShortName,$lotNumber);
	}
}

?>