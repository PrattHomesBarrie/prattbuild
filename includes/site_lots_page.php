<SCRIPT LANGUAGE='Javascript'>    $(document).ready(function() {
                  oTable = $("#lotListTable").dataTable({
									"bJQueryUI": true,
                                    "bPaginate": false,
								    /*"sScrollY": "600px",*/
                                    "bLengthChange": false,
                                    "bFilter": true,
                                    "bSort": true,
                                    "bInfo": true,
    								 "bProcessing": false
                         });
               } );    </SCRIPT>
<?php require_once("lot_filters_form.php");
if (!isset($lotSortList)) {
	$lotSortList = "  ";
	if ($securityLevelOneCheck) {
		$lotSortList .= " siteShortName, lotNumber ";
	}
	else {
		$currentSettingCheck = 'Default Lot Sorting for Level 2 User';
		$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
		if ($settingValue > 'a') {
			$lotSortList .= $settingValue.',';
		}
		$lotSortList .= " siteShortName, lotNumber ";
	}
}

?>
<form method="post" action="" > 
<table width = 100%">
<tr>

<td >
<table align="right">
    <tr>
<?php
if ($securityLevelOneCheck) {

  echo '
      <td > Details:
        <label>
        <input type="radio" ';
		if ($radioViewOptions != 'stats') {
			echo ' checked = "checked"';
		}
		echo 'name="radioViewOptions" value="standard" id="radioViewOptions_0" onChange="this.form.submit();"/>
        Standard</label></td>
      <td ><label>
        <input type="radio"';
		if ($radioViewOptions == 'stats') {
			echo ' checked = "checked"';
		}
		echo ' name="radioViewOptions" value="stats" id="radioViewOptions_1" onChange="this.form.submit();"/>
        Statistics</label></td>
		';
}

else {
  echo'    <td ><input type="hidden" name="radioViewOptions" value="standard" id="radioViewOptions_0" onChange="this.form.submit();"/></td>';
}
  ?>
   </tr>
  </table></td>
</tr>
</table>
</form>
<small>Note: Click on a column title to sort by that column</small>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" id="lotListTable">
<thead>
  <tr>
  
<th >Lot</th>
    <th align="center">Model on Offer<br />
      (or Designated Model)</th>
    <th  align="center" width="0">Date on Offer</th>
    <th align="center" >Completion 
      <br />Date</th>
    <th align="center" >Head<br />
      Office<br />
      Cleared</th>
    <th  align="center">Head<br />
      Office<br />
      Outs.</th>
    <th  align="center">Site<br />
      Office<br />
      Cleared</th>
    <th align="center" >Site<br />
      Office<br />
      Outs.</th>
    <th colspan="2" align="center">Last Activity</th>
    <?php
	if ($radioViewOptions == 'stats' and $securityLevelOneCheck) {
	    echo '<th  align="center">%</th>';
	}
	?>
    <th align="center" >Watch</th>
</tr>
</thead>
<?php

require_once ("classes/misc_functions.php");

if ($debug == "Yes") {
	echo 'Watch='.$watch;
	echo 'updatelotNumber='.$updatelotNumber;
}

 if (strlen($siteShortName) > 10) {
	 echo "<br><b>Error:something wrong with length of siteShortName";
	 exit;
 }
 
//$filterOfferStatusGroup;
if ( $securityLevelOneCheck != true ) {
	   $query = 'select * from offerDetailViewSignedOnly';
}
else {
	if ($filterOfferStatusGroup == 'All') {
		$query = 'select * from offerDetailView';
	}
	if ($filterOfferStatusGroup == 'With Offers') {
	   $query = 'select * from offerDetailViewSignedOnly';
	}
	if ($filterOfferStatusGroup == 'Without Offers') {
		$query = 'select * from offerDetailView';
	}
}

if ($siteShortName > "") {
	$query = $query.'  where siteShortName="'.$siteShortName.'" ';
}
else {
	$query = $query.'  where 1=1 ';
}

//$filterOfferStatusGroup;
if ($filterOfferStatusGroup == 'All') {
	//do nothing
}
if ($filterOfferStatusGroup == 'With Offers') {
	$query = $query.' and offerDate is not null ';
}
if ($filterOfferStatusGroup == 'Without Offers') {
	$query = $query.' and (offerDate is null or dateDocumentSigned is null) ';
}
//$filterClosingStatusGroup;
if ($filterClosingStatusGroup == 'All' or !isset($filterClosingStatusGroup)) {
	//do nothing
}
if ($filterClosingStatusGroup == 'Last 30 Plus' ) {
	$query = $query.' and (calculatedBuildCompletionDate >= curdate() - interval 30 day or calculatedClosingDate >= curdate() ) ';
}
if ($filterClosingStatusGroup == 'In the Future') {
	$query = $query.' and calculatedBuildCompletionDate >= curdate() ';
}
if ($filterClosingStatusGroup == 'In the Past') {
	$query = $query.' and calculatedBuildCompletionDate < curdate() ';
}
if ($filterClosingStatusGroup == 'Next 7 Days') {
	$query = $query.' and calculatedBuildCompletionDate >= curdate() ';
	$query = $query.' and calculatedBuildCompletionDate <= (curdate() + interval 7 day) ';
}
if ($filterClosingStatusGroup == 'Next 14 Days') {
	$query = $query.' and calculatedBuildCompletionDate >= curdate() ';
	$query = $query.' and calculatedBuildCompletionDate <= (curdate() + interval 14 day) ';
}
if ($filterClosingStatusGroup == 'This Fiscal Year') {
	$query = $query." and calculatedBuildCompletionDate >= '".$thisFiscalStart."'";
	$query = $query." and calculatedBuildCompletionDate <= '".$thisFiscalEnd."'";
}
if ($filterClosingStatusGroup == 'Next Fiscal Year') {
	$query = $query." and calculatedBuildCompletionDate >= '".$nextFiscalStart."'";
	$query = $query." and calculatedBuildCompletionDate <= '".$nextFiscalEnd."'";
}



$query = $query." order by ".$lotSortList;

if ($lotSortList > '') {
	$query = $query.",";
}

$query = $query."siteShortName, lotNumber ";
//echo '<br>'.$query;
echo '<tbody>';
$prevTimelineMasterID = 0;
if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {
		if ($prevTimelineMasterID != $resultRow->timelineMasterID) {
			$headOfficeExpected = getExpectedCountForLotLocation($dbSingleUse, "Head Office",$resultRow->lotNumber, $resultRow->siteShortName);
			$siteOfficeExpected = getExpectedCountForLotLocation($dbSingleUse, "Site Office",$resultRow->lotNumber, $resultRow->siteShortName);
			$prevTimelineMasterID = $resultRow->timelineMasterID;
		}

		$headOfficeCompleted = getCompletedCountForLot($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, 'Head Office', null);
		$headOfficeOutstanding = $headOfficeExpected - $headOfficeCompleted;
		$siteOfficeCompleted = getCompletedCountForLot($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, 'Site Office', null);
		$siteOfficeOutstanding = $siteOfficeExpected - $siteOfficeCompleted;
		$mostRecentBuildAction = '-';
		$mostRecentBuildAction = mostRecentBuildAction ($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName);
		
		$mostRecentBuildActionDate = '-';
		if ($mostRecentBuildAction != '-') {
			$mostRecentBuildActionDate = buildActionDate ($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, $mostRecentBuildAction);
		}
		else
		{
			$mostRecentBuildActionDate = '-';
		}

		//$filterClearingGroup;
		$showThisRow = true;

		if ($filterClearingGroup == 'All') {
			//do nothing
		}
		if ($filterClearingGroup == 'Clearing is Complete') {
			if ($headOfficeOutstanding > 0 or $siteOfficeOutstanding > 0 ) {
				$showThisRow = false;
			}
		}
		
		if ($filterClearingGroup == 'Head Office Incomplete') {
			if ($headOfficeOutstanding == 0  ) {
				$showThisRow = false;
			}
		}
	
		if ($filterClearingGroup == 'Site Office Incomplete') {
			if ($siteOfficeOutstanding == 0  ) {
				$showThisRow = false;
			}
		}
	
		if ($filterClearingGroup == 'No Activity Last 7 Days') {
			if ($mostRecentBuildAction != '-' and $mostRecentBuildAction > '') {
				$activityPlusSeven = strtotime(date("Y-m-d", strtotime($mostRecentBuildActionDate)) . " +".' 7 '." day");
				//$expectedDate = date('Y-m-d', $tempDate);
				//$expiration_date = strtotime($expectedDate);
				$todays_date = date("Y-m-d");
				$todayCompare = strtotime($todays_date);	
				//alertBox ($mostRecentBuildAction .' - '.$mostRecentBuildActionDate.' - '.$todayCompare.'  -  '.$activityPlusSeven);	
				if ($todayCompare < $activityPlusSeven ) {
					$showThisRow = false;
				}
			}
		}

		if ($filterClearingGroup == 'Active in Last 7 Days') {
			if ($mostRecentBuildAction = '-' and $mostRecentBuildAction = '') {
					$showThisRow = false;
			}
			else {
				$activityPlusSeven = strtotime(date("Y-m-d", strtotime($mostRecentBuildActionDate)) . " +".' 7 '." day");
				//$expectedDate = date('Y-m-d', $tempDate);
				//$expiration_date = strtotime($expectedDate);
				$todays_date = date("Y-m-d");
				$todayCompare = strtotime($todays_date);	
				//alertBox ($mostRecentBuildAction .' - '.$mostRecentBuildActionDate.' - '.$todayCompare.'  -  '.$activityPlusSeven);	
				if ($todayCompare >= $activityPlusSeven ) {
					$showThisRow = false;
				}
			}
		}
		

		if ($filterClearingGroup == 'Active in Last 2 Days') {
			if ($mostRecentBuildAction = '-' and $mostRecentBuildAction = '') {
					$showThisRow = false;
			}
			else {
				$activityPlusSeven = strtotime(date("Y-m-d", strtotime($mostRecentBuildActionDate)) . " +".' 2 '." day");
				//$expectedDate = date('Y-m-d', $tempDate);
				//$expiration_date = strtotime($expectedDate);
				$todays_date = date("Y-m-d");
				$todayCompare = strtotime($todays_date);	
				//alertBox ($mostRecentBuildAction .' - '.$mostRecentBuildActionDate.' - '.$todayCompare.'  -  '.$activityPlusSeven);	
				if ($todayCompare >= $activityPlusSeven ) {
					$showThisRow = false;
				}
			}
		}
		
		if ($filterClearingGroup == 'Has Had Some Activity') {
		
			if ($mostRecentBuildAction == '-' or  $mostRecentBuildAction == '') {
				$showThisRow = false;
			}
		}
		
		if ($showThisRow == true)  {
			echo '<tr>';
			echo '<td class="lotLinkCellInTable" ><a href="index.php?myAction=Lot&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">';
			if ($siteShortName == "All" or $siteShortName == "All Active" or $siteShortName == "") {
				echo '<small>'.$resultRow->siteShortName.'</small>-';
			}
			echo '<strong>'.str_pad($resultRow->lotNumber,4,'0',STR_PAD_LEFT).'</strong>';
			echo '</a></td>';
			echo '<td align="center"> ';

			$modelName =  '-';
			if ($resultRow->modelName > '') {
				$modelName = $resultRow->modelName;
			}
			else {
				if ($resultRow->designatedModelName > '') {
					$modelName = $resultRow->designatedModelName.'(d)';
				}
			}
			echo $modelName;

			echo '</td>';
			echo '<td align="center"> '.nullToChar($resultRow->offerDate,'-').'</td>';
			echo '<td align="center"> '.nullToChar($resultRow->calculatedBuildCompletionDate,'-');
			if ($securityLevelOneCheck) {
				echo $resultRow->calculatedBuildCompletionDateText;
			}
			echo '</td>';
			$bgColor = "";
			if (isset($resultRow->calculatedBuildCompletionDate)) {
				$bgColor = ' bgcolor = "'.getLotBuildStatusColor( $dbSingleUse,$resultRow->lotNumber,$resultRow->siteShortName, "Head Office").'" ' ;
			}
    		echo '<td '.$bgColor.'  class="tableLotDetailsNumbericData">'.$headOfficeCompleted.'</td>';
    		echo '<td class="tableLotDetailsNumbericData" >'.$headOfficeOutstanding.'</td>';
			$bgColor = "";
			if (isset($resultRow->calculatedBuildCompletionDate)) {
				$bgColor = ' bgcolor = "'.getLotBuildStatusColor( $dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, "Site Office").'" ' ;
			}
			echo '<td '.$bgColor.' class="tableLotDetailsNumbericData">'.$siteOfficeCompleted.'</td>';
    		echo '<td class="tableLotDetailsNumbericData">'.$siteOfficeOutstanding.'</td>';
	    	echo '<td class="tableLotDetailsNumbericData">'.nullToChar($mostRecentBuildActionDate, '-').'</td>';
    		echo '<td class="tableLotDetailsNumbericData">'.nullToChar($mostRecentBuildAction,'-').'</td>';
			$formAction = 'index.php?myAction=Lots&siteShortName='.$resultRow->siteShortName;
			if ($radioViewOptions == 'stats' and $securityLevelOneCheck) {
			    echo '<td>';
				if ($headOfficeCompleted > 0 or $siteOfficeCompleted > 0 ) {
					echo getLotBuildPercent($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, $resultRow->timelineMasterID);
				}
				else {
					echo '0';
				}
				echo '</td>';
			}

			echo '<td align="center">';
			echo getlotWatchCheckbox($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, $userName, $formAction);
		
			echo '</td>';

			echo '</tr>';
		}
	}
}
echo '</tbody>		';

?>

</table>
