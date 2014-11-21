<h2>Show Homes List </h2> 
(Homes with Occupancy Certification.)
<?php

require_once ("classes/misc_functions.php");

function showHomesHeader() {
	echo '  <tr>';
    echo '<th align="center" >Site</th>';
    echo '<th align="center" >Lot</th>';
    echo '<th align="center" >Address</th>';
    echo '<th align="center" >Model</th>';
    echo '<th align="center" >Move In<br>Date</th>';
    echo '<th align="center" >Completion<br>Date</th>';
    echo '<th width="200" align="center" >Most Recent Activity</th>';
    echo '</tr>';
}

if ($debug == "Yes") {
	echo 'Watch='.$watch;
	echo 'updatelotNumber='.$updatelotNumber;
}

$query = "SELECT distinct o.lotNumber,
			 o.siteShortName, 
			 o.modelName, 
			 o.offerDate,
			 o.closingDate,
			 o.occupancyDate,
			 o.calculatedClosingDate,
			 o.moveInDate,
			 o.amendedMoveInText,
			 o.amendedClosingText,
			 o.munStreetNumber,
			 o.munStreetAddress,
			 o.buildCompletionDate,
			 o.calculatedBuildCompletionDate,
			 o.calculatedBuildCompletionDateText
FROM offerDetailView o join showHomeQualifiersView shqv  on o.lotNumber = shqv.lotNumber and o.siteShortName = shqv.siteShortName 
where (moveInDate > curdate() or moveInDate is null) order by moveInDate asc ";
//echo '<br>'.$query;
$rowNum = 0;
echo '<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData">';


if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {
		$headOfficeExpected = getExpectedCountForLotLocation($dbSingleUse, "Head Office",$resultRow->lotNumber, $resultRow->siteShortName);
		$siteOfficeExpected = getExpectedCountForLotLocation($dbSingleUse, "Site Office",$resultRow->lotNumber, $resultRow->siteShortName);
		if ($rowNum == 0) {
			showHomesHeader();
		}
		$rowNum = $rowNum + 1;
		echo '<tr>';
	    echo '<td>'.$resultRow->siteShortName.'</td>';
	    echo '<td align="center"><a href="index.php?myAction=Lot&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.$resultRow->lotNumber.'</a></td>';
		echo '<td align="center"> '.$resultRow->munStreetNumber.' '.nullToChar($resultRow->munStreetAddress,'-').'</td>';
		echo '<td align="center"> '.nullToChar($resultRow->modelName,'-').'</td>';
		echo '<td align="center"> '.nullToChar($resultRow->moveInDate,'-');
		if ($securityLevelOneCheck) {
			echo $resultRow->amendedMoveInText;
		}
		echo '<td align="center"> '.nullToChar($resultRow->calculatedBuildCompletionDate,'-');
		if ($securityLevelOneCheck) {
			echo $resultRow->calculatedBuildCompletionDateText;
		}
		echo '</td>';
		$mostRecentBuildAction = '-';
		$mostRecentBuildAction = mostRecentBuildAction ($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName);
    	echo '<td class="tableLotDetailsNumbericData">'.$mostRecentBuildAction.'</td>';
    	echo '<td class="tableLotDetailsNumbericData">';
		echo '</td>';
		echo '</tr>';
	}
}
	if ($rowNum == 0) {
		echo '<tr><td colspan="5"><h3>There are no qualifying show homes.</h3></td></tr>';
	}
	echo '</table>';

?>

