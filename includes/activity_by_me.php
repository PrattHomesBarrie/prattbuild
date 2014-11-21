<h2>Recent Activity by Me</h2>
<?php

require_once ("classes/misc_functions.php");

function activitiesByMeHeader() {
	echo '  <tr>';
    echo '<th align="center" >Site</th>';
    echo '<th align="center" >Lot</th>';
    echo '<th align="center" >Model</th>';
    echo '<th align="center" width="0">Offer<br>Date</th>';
    echo '<th align="center" >Completion<br>Date</th>';
    echo '<th align="center">Who ';
    echo '  Updated</th>';
    echo '<th align="center">Head<br />';
    echo '  Office<br />';
    echo '  Clear</th>';
    echo '<th align="center">Head<br />';
    echo '  Office<br />';
    echo '  Outs.</th>';
    echo '<th align="center">Site<br />';
    echo '  Office<br />';
    echo '  Clear</th>';
    echo '<th align="center">Site<br />';
    echo '  Office<br />';
    echo '  Outs.</th>';
    echo '<th width="200" align="center" colspan="2">Activity</th>';
    echo '<th align="center">Watch</th>';
    echo '</tr>';
}

if ($debug == "Yes") {
	echo 'Watch='.$watch;
	echo 'updatelotNumber='.$updatelotNumber;
}

$query = "SELECT lbr.lotNumber,
			 lbr.siteShortName, 
			 lbr.userName,
			 lbr.buildDate,
			 lbr.buildAction,
			 o.modelName, 
			 o.offerDate,
			 o.closingDate,
			 o.moveInDate,
			 o.occupancyDate,
			 o.calculatedClosingDate,
			 o.amendedClosingText,
			 o.amendedMoveInText,
			 o.calculatedBuildCompletionDate,
			 o.calculatedBuildCompletionDateText,
			 CONCAT(substr(firstName, 1,1), '. ', lastName) as updateUser
FROM `lotBuildResultsView`  lbr left join offerDetailView o on lbr.lotNumber = o.lotNumber and lbr.siteShortName = o.siteShortName where userName = '".$userName."' order by buildDate  desc limit 10";
//echo '<br>'.$query;
$rowNum = 0;
echo '<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData">';


if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {
		$headOfficeExpected = getExpectedCountForLotLocation($dbSingleUse, "Head Office",$resultRow->lotNumber, $resultRow->siteShortName);
		$siteOfficeExpected = getExpectedCountForLotLocation($dbSingleUse, "Site Office",$resultRow->lotNumber, $resultRow->siteShortName);
		if ($rowNum == 0) {
			activitiesByMeHeader();
		}
		$rowNum = $rowNum + 1;
		echo '<tr>';
	    echo '<td>'.$resultRow->siteShortName.'</td>';
	    echo '<td align="center"><a href="index.php?myAction=Lot&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.$resultRow->lotNumber.'</a></td>';
		echo '<td align="center"> '.nullToChar($resultRow->modelName,'-').'</td>';
		echo '<td align="center"> '.nullToChar($resultRow->offerDate,'-').'</td>';
		echo '<td align="center"> '.nullToChar($resultRow->calculatedBuildCompletionDate,'-').$resultRow->calculatedBuildCompletionDateText.'</td>';
    	echo '<td align="center">'.nullToChar($resultRow->updateUser,'-').'</td>';
		$headOfficeCompleted = getCompletedCountForLot($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, 'Head Office', null);
		$bgColor = "";
		$bgColor = ' bgcolor = "'.getLotBuildStatusColor( $dbSingleUse,$resultRow->lotNumber,$resultRow->siteShortName, "Head Office").'" ' ;
    	echo '<td '.$bgColor.' class="tableLotDetailsNumbericData">'.$headOfficeCompleted.'</td>';
		$headOfficeOutstanding = $headOfficeExpected - $headOfficeCompleted;
    	echo '<td class="tableLotDetailsNumbericData" >'.$headOfficeOutstanding.'</td>';
		$siteOfficeCompleted = getCompletedCountForLot($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, 'Site Office', null);
		$bgColor = "";
		$bgColor = ' bgcolor = "'.getLotBuildStatusColor( $dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, "Site Office").'" ' ;
    	echo '<td '.$bgColor.' class="tableLotDetailsNumbericData">'.$siteOfficeCompleted.'</td>';
		$siteOfficeOutstanding = $siteOfficeExpected - $siteOfficeCompleted;
    	echo '<td class="tableLotDetailsNumbericData">'.$siteOfficeOutstanding.'</td>';
    	echo '<td class="tableLotDetailsNumbericData">'.substr($resultRow->buildDate,0,10).'</td>';
    	echo '<td class="tableLotDetailsNumbericData">'.nullToChar($resultRow->buildAction,'-').'</td>';
    	echo '<td class="tableLotDetailsNumbericData">';
		$formAction = 'index.php?myAction=MySummary&siteShortName='.$resultRow->siteShortName;
		getlotWatchCheckbox($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, $userName, $formAction);
		echo '</td>';
		echo '</tr>';
	}
}
	if ($rowNum == 0) {
		echo '<tr><td colspan="5"><h3>You have no activity.</h3></td></tr>';
	}

	echo '</table>';

?>

