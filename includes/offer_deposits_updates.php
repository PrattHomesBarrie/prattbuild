<?php

//don't foget to make any additions here also to the copy offer function

$table = "offerDepositsDetail";
$continue = true;
if ($myEditAction == 'SaveDepositDetail' ) {
	if ($_POST["detailAction"] == "NSF" and $_POST["detailAmount"] > 0) {
		alertBox("Error: NSF amount must be a negative number.  ");
		echo '<font color="red">NSF was not saved, must be a negative number.</font>';
		$continue = false;
	}
}
if ($continue == true and  $myEditAction == 'SaveDepositDetail' ) {
	if ($myEditAction == 'SaveDepositDetail' ) {
		//either save or add
		$currentVar =  "depositId";
		$arr[$currentVar] = $_POST[$currentVar];
		$currentVar = "detailAmount";
		if  ($_POST[$currentVar] > '') {
			$arr[$currentVar] = $_POST[$currentVar];	
		}
		$currentVar =  "detailDate";
		if ($_POST[$currentVar] > '') {
			$arr[$currentVar] = '"'.date('Y-m-d',strtotime($_POST[$currentVar])).'"';
		}
		else	{
			$arr[$currentVar] = '"0000-00-00"';
		}
		$currentVar = "detailAmount";
		if  ($_POST[$currentVar] > '') {
			$arr[$currentVar] = $_POST[$currentVar];	
		}
	
		$arr["detailAction"] = '"'.mysql_real_escape_string($_POST["detailAction"]).'"';	
		$arr["comments"] = '"'.mysql_real_escape_string($_POST["comments"]).'"';	
		$arr["actionUserName"] = '"'.$userName.'"';
		$arr["modUserName"] = '"'.$userName.'"';
	
	}
	//if ($myEditAction == 'SaveDepositDetail' || $myEditAction == 'AddDepositDetail') {
		//either delete or add 
	//		}
	//if ($myEditAction == 'DeleteDepositDetail' || $myEditAction == 'SaveDepositDetail') {
		//either delete or add 
		//$where["id"] = $_POST["paymentId"];	
	
		//$where["siteShortName"] = '"'.$siteShortName.'"';	
		//$where["lotNumber"] = $lotNumber;	
	//		}
	if ($myEditAction == 'SaveDepositDetail') {
		//add only
		$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
		$arr["id"] = $newId;	
	}
	//if ($myEditAction == 'DeleteDeposit') {
		//delete only
		//will call the delete rows function
	//}
	
	//echo '<br>Table is:'.$table.'<br>Value Array is:'.print_r($arr).'<br>where clause is:'.print_r($where);
	
	$result = true;
	$message = "";
	if ($myEditAction == 'SaveDepositDetail') {
		if ($newId > -1) {
			$result = $dbSingleUse->InsertRow($table, $arr);
			echo "checking result";
			$errorNumber = $dbSingleUse->ErrorNumber();
			$result = checkRowIdExists($dbSingleUse, $table,"id",$newId);
			if ($result == false) {
				$message = 'There was a problem adding this deposit detail.  There error number was:'.$errorNumber;
			}
		}
		else
		{
			$result = false;			
			$message = "There was a database problem reserving the identifier for this deposit detail, please try again";
		}
	}
	//if ($myEditAction == 'SaveDepositDetail') {
	//	$result = $dbSingleUse->UpdateRows($table, $arr, $where);
	//}
	//if ($myEditAction == 'DeleteDepositDetail') {
	//	$result = $dbSingleUse->DeleteRows($table, $where);
	//}
	
	if ($result == false) {
		if ($message == "") {
			$errorNumber = $dbSingleUse->ErrorNumber();
			$message = "There was a problem updating the database, please try again.  Please record this error number:".$errorNumber;
		}
		alertBox ($message);
	}
	
}


//SaveOfferDepositDetail


$table = "offerDeposits";
if ($myEditAction == 'SaveDeposit' || $myEditAction == 'DeleteDeposit' || $myEditAction == 'SaveNewDeposit') {
	if ($myEditAction == 'SaveDeposit' || $myEditAction == 'SaveNewDeposit') {
		//either save or add
		$currentVar =  "dueDate";
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
		$arr["depositName"] = '"'.mysql_real_escape_string($_POST["depositName"]).'"';	
		$arr["modUserName"] = '"'.$userName.'"';
	
			}
	if ($myEditAction == 'DeleteDeposit' || $myEditAction == 'SaveNewDeposit') {
		//either delete or add 
			}
	if ($myEditAction == 'DeleteDeposit' || $myEditAction == 'SaveDeposit') {
		//either delete or add 
		$where["id"] = $_POST["id"];	
	
		//$where["siteShortName"] = '"'.$siteShortName.'"';	
		//$where["lotNumber"] = $lotNumber;	
			}
	if ($myEditAction == 'SaveDeposit') {
		//save only 
			}
	if ($myEditAction == 'SaveNewDeposit') {
		//add only
		$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
		$arr["id"] = $newId;	
		$arr["siteShortName"] = '"'.$siteShortName.'"';	
		$arr["lotNumber"] = $lotNumber;	
	}
	if ($myEditAction == 'DeleteDeposit') {
		//delete only
		//will call the delete rows function
	}
	
	//echo '<br>Table is:'.$table.'<br>Value Array is:'.print_r($arr).'<br>where clause is:'.print_r($where);
	
	$result = true;
	$message = "";
	if ($myEditAction == 'SaveNewDeposit') {
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
	if ($myEditAction == 'SaveDeposit') {
		$result = $dbSingleUse->UpdateRows($table, $arr, $where);
	}
	if ($myEditAction == 'DeleteDeposit') {
		$query="insert into deletedOfferDeposits select * from offerDeposits where id=".$_POST["id"];
		if ($dbSingleUse->Query($query)) {
			$query="insert into deletedOfferDepositsDetail select * from offerDepositsDetail where depositId=".$_POST["id"];
			if ($dbSingleUse->Query($query)) {
				$query="delete from offerDepositsDetail where depositId=".$_POST["id"];
				if ($dbSingleUse->Query($query)) {
					$query="delete from offerDeposits where id=".$_POST["id"];
					if ($dbSingleUse->Query($query)) {
						echo '<br>Deposit has been deleted';
					}
					else {
						$message = "There was a problem deleting the deposit. Please contact support.";
					alertBox($dbSingleUse->Error);
						alertBox ($message);
					}
				}
				else {
					$message = "There was a problem deleting the transactions.  Deposit not deleted.";
					alertBox($dbSingleUse->Error);
					alertBox ($message);
				}
			}
			else {
				$message = "There was a problem backing up the transactions.  Deposit not deleted.".$result;
				alertBox($dbSingleUse->Error);
				alertBox ($message);
			}
		}
		else {
			//error backing up deposit detail
			$message = "There was a problem backing up the deposit.  Deposit not deleted.";
			alertBox($dbSingleUse->Error);
			alertBox ($message);
		}
//		echo $query;
//		$result = $dbSingleUse->DeleteRows($table, $where);
	}
	
	if ($result == false) {
		if ($message == "") {
			$errorNumber = $dbSingleUse->ErrorNumber();
			$message = "There was a problem updating the database, please try again.  Please record this error number:".$errorNumber;
		}
		alertBox ($message);
	}
	
}
?>