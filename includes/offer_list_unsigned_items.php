<h2>Offers With Unsigned Items <small>(Work Credits, Amendments, Change Orders)</small></h2>
<?php

require_once ("classes/misc_functions.php");

function unsignedOffersItemsHeader() {
	echo '  <tr>';
    echo '<th align="center" >Site</th>';
    echo '<th align="center" >Lot</th>';
    echo '<th align="center" >Model</th>';
    echo '<th align="center" width="0">Offer<br>Date</th>';
    echo '<th align="center" >Move In<br>Date</th>';
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
    echo '<th align="center" width="275" colspan="1">OutStanding Items</th>';
    echo '</tr>';
}

if ($debug == "Yes") {
	echo 'Watch='.$watch;
	echo 'updatelotNumber='.$updatelotNumber;
}

$query = "select * from offerDetailView odv
where 
( odv.offerDate > '0000-00-00')
and
exists
(
select 1 from offerAmendments o where o.lotNumber = odv.lotNumber and o.siteShortName = odv.siteShortName
and ( o.dateDocumentSigned is null
or o.dateDocumentSigned = '0000-00-00')
union
select 1 from offerChangeOrders o2 where o2.lotNumber = odv.lotNumber and o2.siteShortName = odv.siteShortName
and ( o2.dateDocumentSigned is null
or o2.dateDocumentSigned = '0000-00-00')
union
select 1 from offerWorkCredits o3 where o3.lotNumber = odv.lotNumber and o3.siteShortName = odv.siteShortName
and ( o3.dateDocumentSigned is null
or o3.dateDocumentSigned = '0000-00-00')
)";
$query = $query." order by offerDate desc ";
//echo '<br>'.$query;
$rowNum = 0;
echo '<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData">';


if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {
		$headOfficeExpected = getExpectedCountForLotLocation($dbSingleUse, "Head Office",$resultRow->lotNumber, $resultRow->siteShortName);
		$siteOfficeExpected = getExpectedCountForLotLocation($dbSingleUse, "Site Office",$resultRow->lotNumber, $resultRow->siteShortName);
		if ($rowNum == 0) {
			unsignedOffersItemsHeader();
		}
		$rowNum = $rowNum + 1;
		echo '<tr>';
	    echo '<td>'.$resultRow->siteShortName.'</td>';
	    echo '<td align="center"><a href="index.php?myAction=Lot&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.$resultRow->lotNumber.'</a></td>';
		echo '<td align="center"> '.nullToChar($resultRow->modelName,'-').'</td>';

		echo '<td align="center"><a href="index.php?myAction=EditOffer&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.nullToChar($resultRow->offerDate,'-').'</a></td>';

		echo '<td align="center"> '.nullToChar($resultRow->moveInDate,'-');
		if ($securityLevelOneCheck) {
			echo $resultRow->amendedMoveInText;
		}
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
		$itemCount = getNumberOfUnsignedItems($dbSingleUse, "offerAmendments",$resultRow->lotNumber, $resultRow->siteShortName);
		$x = '';
		if ($itemCount > 0) {
			$x = $itemCount." Amendment"; 
		}
		if ($itemCount > 1) {
			$x = $x.'s'; 
		}
		
		$itemCount = getNumberOfUnsignedItems($dbSingleUse, "offerChangeOrders",$resultRow->lotNumber, $resultRow->siteShortName);
		if ($itemCount > 0) {
			if ($x !== '') {
				$x = $x.'<br>';
			}
			$x = $x.$itemCount." Change Order"; 
		}
		if ($itemCount > 1) {
			$x = $x.'s'; 
		}
		$itemCount = getNumberOfUnsignedItems($dbSingleUse, "offerWorkCredits",$resultRow->lotNumber, $resultRow->siteShortName);
		if ($itemCount > 0) {
			if ($x !== '') {
				$x = $x.'<br>';
			}
			$x = $x.$itemCount." Work Credit"; 
		}
		if ($itemCount > 1) {
			$x = $x.'s'; 
		}
		
		if ($x == '') { 
			$x = '-';
		}
    	echo '<td class="tableLotDetailsNumbericData">'.$x.'</td>';
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

  