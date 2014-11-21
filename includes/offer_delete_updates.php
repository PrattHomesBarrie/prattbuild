<?php

echo "<br>Deleting Customer and Financials";
$table = "offers";
$where["siteShortName"] = '"'.$siteShortName.'"';	
$where["lotNumber"] = $lotNumber;	
//$query = 'select *	from '.$table.' where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;
//$dbSingleUse->Query($query);
$dbSingleUse->SelectRows($table, $where);
echo '<br>'.$dbSingleUse->GetHTML();
$result = $dbSingleUse->DeleteRows($table, $where);
echo "<br>Deleting Amendments";
$table = "offerAmendments";
$dbSingleUse->SelectRows($table, $where);
echo '<br>'.$dbSingleUse->GetHTML();
$result = $dbSingleUse->DeleteRows($table, $where);
echo "<br>Deleting Change Orders";
$table = "offerChangeOrders";
$dbSingleUse->SelectRows($table, $where);
echo '<br>'.$dbSingleUse->GetHTML();
$result = $dbSingleUse->DeleteRows($table, $where);
echo "<br>Deleting Features";
$table = "offerFeatures" ;
$dbSingleUse->SelectRows($table, $where);
echo '<br>'.$dbSingleUse->GetHTML();
$result = $dbSingleUse->DeleteRows($table, $where);
echo "<br>Deleting Work Credits";
$table = "offerWorkCredits";
$dbSingleUse->SelectRows($table, $where);
echo '<br>'.$dbSingleUse->GetHTML();
$result = $dbSingleUse->DeleteRows($table, $where);
$currentSettingCheck = 'Delete deposits when deleting offers';
$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
if ($settingValue == '1') {
	echo "<br>Backing Up Deposits";
	$query = "insert into offerDepositsDeleted select * from offerDeposits where lotNumber= ".$lotNumber." and siteShortName = '".$siteShortName."'";
	$dbSingleUse->Query($query);
	echo "<br>Backing Up Deposits Detail";
	$query = "insert into offerDepositsDetailDeleted select * from  offerDepositsDetail where depositId in  (select id from offerDeposits where lotNumber= ".$lotNumber." and siteShortName = '".$siteShortName."')";
	echo '<br>'.$query;
	$x = $dbSingleUse->Query($query);
	echo "<br>Deleting Deposits Detail";
	$query = "delete from offerDepositsDetail where depositId in  (select id from offerDeposits where lotNumber= ".$lotNumber." and siteShortName = '".$siteShortName."')";
	echo '<br>'.$query;
	$x= $dbSingleUse->Query($query);
	echo "<br>Deleting Deposits ";
	$table = "offerDeposits";
	$dbSingleUse->SelectRows($table, $where);
	echo '<br>'.$dbSingleUse->GetHTML();
	$result = $dbSingleUse->DeleteRows($table, $where);
}

?>