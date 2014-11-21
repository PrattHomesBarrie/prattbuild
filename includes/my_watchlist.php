<h2>My Watchlist</h2>
<?php

require_once ("classes/misc_functions.php");

function watchlistHeader() {
	echo '  <tr>';
    echo '<th align="center" >Site</th>';
    echo '<th align="center" >Lot</th>';
    echo '<th align="center" >Model</th>';
    echo '<th align="center" width="0">Offer<br>Date</th>';
    echo '<th align="center" >Completion<br>Date</th>';
    echo '<th align="center" >Head<br />';
    echo '  Office<br />';
    echo '  Clear</th>';
    echo '<th align="center" >Head<br />';
    echo '  Office<br />';
    echo '  Outs.</th>';
    echo '<th align="center" >Site<br />';
    echo '  Office<br />';
    echo '  Clear</th>';
    echo '<th align="center" >Site<br />';
    echo '  Office<br />';
    echo '  Outs.</th>';
    echo '<th align="center" width="200" colspan="2">Last Activity</th>';
    echo '<th align="center" >Watch</th>';
    echo '</tr>';
}

if ($debug == "Yes") {
	echo 'Watch='.$watch;
	echo 'updatelotNumber='.$updatelotNumber;
}

$query = "select * from watchListView";
if ($userName > "") {
	$query = $query."  where userName='".$userName."'";
}
$query = $query." order by lotNumber";
//echo '<br>'.$query;
$rowNum = 0;
echo '<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData">';


if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {
		$headOfficeExpected = getExpectedCountForLotLocation($dbSingleUse, "Head Office",$resultRow->lotNumber, $resultRow->siteShortName);
		$siteOfficeExpected = getExpectedCountForLotLocation($dbSingleUse, "Site Office",$resultRow->lotNumber, $resultRow->siteShortName);
		if ($rowNum == 0) {
			watchlistHeader();
		}
		$rowNum = $rowNum + 1;
		echo '<tr>';
	    echo '<td>'.$resultRow->siteShortName.'</td>';
	    echo '<td align="center"><a href="index.php?myAction=Lot&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.$resultRow->lotNumber.'</a></td>';
		echo '<td align="center"> '.nullToChar($resultRow->modelName,'-').'</td>';
		echo '<td align="center"> '.nullToChar($resultRow->offerDate,'-').'</td>';
		echo '<td align="center"> '.nullToChar($resultRow->calculatedBuildCompletionDate,'-');
		if ($securityLevelOneCheck) {
			echo $resultRow->calculatedBuildCompletionDateText;
		}
		echo '</td>';
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
		$mostRecentBuildAction = mostRecentBuildAction ($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName);
		if ($mostRecentBuildAction != '-') {
			$mostRecentBuildActionDate = buildActionDate ($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, $mostRecentBuildAction);
		}
		else
		{
			$mostRecentBuildActionDate = '-';
		}
    	echo '<td class="tableLotDetailsNumbericData">'.nullToChar($mostRecentBuildActionDate, '-').'</td>';
    	echo '<td class="tableLotDetailsNumbericData">'.nullToChar($mostRecentBuildAction,'-').'</td>';
    	echo '<td class="tableLotDetailsNumbericData">';
		getlotWatchCheckbox($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, $userName, $formAction);
		echo '</td>';
		echo '</tr>';
	}
}
	if ($rowNum == 0) {
		echo '<tr><td colspan="5"><h3>You have no items in your watchlist</h3></td></tr>';
	}
	echo '</table>';

?>

  