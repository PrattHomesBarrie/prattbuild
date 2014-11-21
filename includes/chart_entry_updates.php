<?php

function getItemNumber($inputKeyValue) {
	
	$len = strlen($inputKeyValue);
	$firstDelim = strpos($inputKeyValue,'_');
	$secondDelim = strpos($inputKeyValue,'_', $firstDelim + 1);
	$returnValue = substr($inputKeyValue, $firstDelim + 1,$secondDelim - $firstDelim - 1);
	
	return $returnValue;
}
function getCategoryNumber($inputKeyValue) {
	
	$len = strlen($inputKeyValue);
	$firstDelim = strpos($inputKeyValue,'_');
	$secondDelim = strpos($inputKeyValue,'_', $firstDelim + 1);
	$returnValue = substr($inputKeyValue, $secondDelim + 1,$len - $secondDelim);

	return $returnValue;
}
function getExtraSectionNumber($inputKeyValue) {
	
	$len = strlen($inputKeyValue);
	$firstDelim = strpos($inputKeyValue,'_');
	$secondDelim = strpos($inputKeyValue,'_', $firstDelim + 1);
	$thirdDelim = strpos($inputKeyValue,'_', $secondDelim + 1);
	$returnValue = substr($inputKeyValue, $secondDelim + 1,$thirdDelim - $secondDelim - 1);

	return $returnValue;
}
function getExtraCategoryNumber($inputKeyValue) {
	
	$len = strlen($inputKeyValue);
	$firstDelim = strpos($inputKeyValue,'_');
	$secondDelim = strpos($inputKeyValue,'_', $firstDelim + 1);
	$thirdDelim = strpos($inputKeyValue,'_', $secondDelim + 1);
	$fourthDelim = strpos($inputKeyValue,'_', $thirdDelim + 1);
	$returnValue = substr($inputKeyValue, $thirdDelim + 1,$fourthDelim - $thirdDelim - 1);

	return $returnValue;
}
function getExtraRowNumber($inputKeyValue) {
	
	$len = strlen($inputKeyValue);
	$firstDelim = strpos($inputKeyValue,'_');
	$secondDelim = strpos($inputKeyValue,'_', $firstDelim + 1);
	$thirdDelim = strpos($inputKeyValue,'_', $secondDelim + 1);
	$fourthDelim = strpos($inputKeyValue,'_', $thirdDelim + 1);
	$fifthDelim = strpos($inputKeyValue,'_', $fourthDelim + 1);
	$returnValue = substr($inputKeyValue, $fourthDelim + 1,$fifthDelim - $fourthDelim - 1);

	return $returnValue;
}
function getExtraColumnNumber($inputKeyValue) {
	
	$len = strlen($inputKeyValue);
	$firstDelim = strpos($inputKeyValue,'_');
	$secondDelim = strpos($inputKeyValue,'_', $firstDelim + 1);
	$thirdDelim = strpos($inputKeyValue,'_', $secondDelim + 1);
	$fourthDelim = strpos($inputKeyValue,'_', $thirdDelim + 1);
	$fifthDelim = strpos($inputKeyValue,'_', $fourthDelim + 1);
	$returnValue = substr($inputKeyValue, $fifthDelim + 1,$len - $fifthDelim);

	return $returnValue;
}

//don't foget to make any additions here also to the copy offer function


if ($myEditAction == 'SaveChart') {
	//either save or add
	echo '<h3><font color="#FF0000">Saving chart data</font></h3>';

	unset($where);	
	$table = "offerChartAdditionalItems";
	$where["siteShortName"] = '"'.$siteShortName.'"';	
	$where["lotNumber"] = $lotNumber;	
	$where["chartId"] = $chartNumber;	
//	print_r($arr);
//	print "<br />";
	$result = $dbSingleUse->DeleteRows($table, $where);
	$table = "offerChartHeaderData";
	$result = $dbSingleUse->DeleteRows($table, $where);
	
	$prevChartSectionId = "";
	$prevRowNumber = "";
	$workingOnExtraItem = false;
	
	
	
	foreach (array_keys($_POST) as $key) { 

		$$key = $_POST[$key]; 
		//print "$key is ${$key}<br />"; 
		//print "$key is " . $$key . "<br />";

		unset($arr);	
		unset($where);	
		$arr["siteShortName"] = '"'.$siteShortName.'"';	
		$arr["lotNumber"] = $lotNumber;	
		$where["siteShortName"] = '"'.$siteShortName.'"';	
		$where["lotNumber"] = $lotNumber;	

		$itemId = 0;
		$categoryId = 0;


		//print $key."<br>";
		if (substr($key,0,9) == 'extraItem')  {
			$extraItemField = true;
			$table = "offerChartAdditionalItems";
			$chartSectionId = getExtraSectionNumber($key);
			$categoryId = getExtraCategoryNumber($key);
			$columnNumber = getExtraColumnNumber($key);
			$rowNumber = getExtraRowNumber($key);
		}
		if ($workingOnExtraItem == true)  {
			if (substr($key,0,9) != 'extraItem' or $prevChartSectionId != $chartSectionId or $prevRowNumber != $rowNumber)  {
				if ($prevChartSectionId > "" and $dataForRow == false) {
					$where2["siteShortName"] = '"'.$siteShortName.'"';	
					$where2["lotNumber"] = $lotNumber;	
					$where2["chartId"] = $chartNumber;	
					$where2["chartSectionId"] = $prevChartSectionId ;	
					$where2["rowNumber"] = $prevRowNumber;	
					//print_r($where);
					//print "<br />";
					$result = $dbSingleUse->DeleteRows($table, $where2);
					unset($where2);	
					//echo "delete chart ".$chartNumber." section ".$prevChartSectionId." row ".$prevRowNumber." result:".$result."<br>";
				}
				$dataForRow = false;
				$workingOnExtraItem = false;
			}
		}
		
		if (substr($key,0,9) == 'extraItem')  {
			$workingOnExtraItem = true;
			$prevChartSectionId = $chartSectionId;
			$prevRowNumber = $rowNumber;
			
			$arr["chartId"] = $chartNumber;	
			$arr["chartSectionId"] = $chartSectionId;	
			$arr["categoryId"] = $categoryId;	
			$arr["rowNumber"] = $rowNumber;
			$arr["columnNumber"] = $columnNumber;
			$arr["textValue"] = '"'.mysql_real_escape_string($$key).'"';
			$arr["currencyValue"] = "Null";
			//print_r($arr);
			//print "<br />";
			$result = $dbSingleUse->InsertRow($table, $arr);
			$workingOnExtraItem = true;
			if (trim($$key) > "") {
				$dataForRow = true;  //will delete row later, if there is no data for row
			}
		}
		else {
			$extraItemField = 0;
		}
		if (substr($key,0,9) == 'textValue')  {
			$table = "offerChartData";
			$itemId = getItemNumber($key);
			//print "itemId is ".$itemId."<br />";
			$categoryId = getCategoryNumber($key);
			//print "categoryId is ".$categoryId."<br />";
			if ($itemId > 0 and $categoryId > 0 ) {
				$arr["itemId"] = $itemId;
				$arr["categoryId"] = $categoryId;
				$where["itemId"] = $itemId;
				$where["categoryId"] = $categoryId;
			
				$arr["textValue"] = '"'.mysql_real_escape_string($$key).'"';
				$arr["currencyValue"] = "Null";
				//print_r($arr);
				//print "<br />";
				//print_r($where);
				//print "<br />";
				$result = $dbSingleUse->DeleteRows($table, $where);
				$result = $dbSingleUse->InsertRow($table, $arr);
				//echo $result.'x<br />';
			}
		}
		//do all chart header data here
		if ($key == 'availableToPublic')  {
			$table = "offerChartHeaderData";
			$arr["chartId"] = $chartNumber;	
			$currentField = "availableToPublic";
			$arr[$currentField] = $$key;
			if ($arr[$currentField] != 1) {
 				$arr[$currentField] = 0;
			}
			$result = $dbSingleUse->InsertRow($table, $arr);
		}
		if ($key == 'dateDocumentSigned')  {
			$table = "offerChartSignedDates";
			$arr["chartId"] = $chartNumber;	
			$where["chartId"] = $chartNumber;	
			$currentField = "dateDocumentSigned";
			if ($$key > '') {
				$arr[$currentField] = '"'.date('Y-m-d',strtotime($$key)).'"';
			}
			else	{
				$arr[$currentField] = '"0000-00-00"';
			}
			$result = $dbSingleUse->DeleteRows($table, $where);
			$result = $dbSingleUse->InsertRow($table, $arr);
		}

		if ($result === false) {
			if ($message == "") {
				$errorNumber = $dbSingleUse->ErrorNumber();
				$message = "There was a problem updating the database, please try again.  Please record this error number:".$errorNumber;
				echo $message.'<br />';
			}
		}


	} 

}

if ($result === false) {
	if ($message == "") {
		$errorNumber = $dbSingleUse->ErrorNumber();
		$message = "There was a problem updating the database, please try again.  Please record this error number:".$errorNumber;
	}
}

if ($message > "") {
	alertBox ($message);
}

?>