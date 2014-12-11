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
<h2>Lots with Expected Activity</h2>

<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" id="lotListTable">
  <thead>
  <tr>
<th align="center" >Site</th>
<th align="center">Lot</th>
    <th align="center">Model</th>
    <th  align="center" width="0">Offer<br />Date</th>
    <th align="center" >Completion<br />Date</th>
    <th align="center" >Head<br />
      Office<br />
      Clear</th>
    <th  align="center">Head<br />
      Office<br />
      Outs.</th>
    <th  align="center">Site<br />
      Office<br />
      Clear</th>
    <th align="center" >Site<br />
      Office<br />
      Outs.</th>
    <th colspan="2" align="center">Expected Activity</th>
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
$query = "select * from offerDetailViewSignedOnly where calculatedBuildCompletionDate is not null";

$query = $query." order by siteShortName, lotNumber ";
echo '<br>'.$query;

$rowNum = 0;
echo '<tbody>';
if ($db2->Query($query)) { 
		
	while ($resultRow = $db2->Row() ) {
		$headOfficeExpected = getExpectedCountForLotLocation($dbSingleUse, "Head Office",$resultRow->lotNumber, $resultRow->siteShortName);
		$siteOfficeExpected = getExpectedCountForLotLocation($dbSingleUse, "Site Office",$resultRow->lotNumber, $resultRow->siteShortName);
		$bgColorTest = getLotBuildStatusColor( $dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, null) ;
		if ($bgColorTest == "red" or $bgColorTest == "yellow") {
			$rowNum = $rowNum + 1;
			echo '<tr>';
			echo '<td align="center"> '.nullToChar($resultRow->siteShortName,'-').'</td>';
			echo '<td align="center"><a href="index.php?myAction=Lot&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.$resultRow->lotNumber;
			echo '</a></td>';
			echo '<td align="center"> '.nullToChar($resultRow->modelName,'-').'</td>';
			echo '<td align="center"> '.nullToChar($resultRow->offerDate,'-').'</td>';
			echo '<td align="center"> '.nullToChar($resultRow->calculatedBuildCompletionDate,'-');
			if ($securityLevelOneCheck) {
				echo $resultRow->calculatedBuildCompletionDateText;
			}
			echo '</td>';
			$headOfficeCompleted = getCompletedCountForLot($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, 'Head Office', null);
			$bgColor = "";
			if (isset($resultRow->calculatedBuildCompletionDate)) {
				$bgColor = ' bgcolor = "'.getLotBuildStatusColor( $dbSingleUse,$resultRow->lotNumber,$resultRow->siteShortName, "Head Office").'" ' ;
			}
    		echo '<td '.$bgColor.'  class="tableLotDetailsNumbericData">'.$headOfficeCompleted.'</td>';
			$headOfficeOutstanding = $headOfficeExpected - $headOfficeCompleted;
	    	echo '<td class="tableLotDetailsNumbericData" >'.$headOfficeOutstanding.'</td>';
			$siteOfficeCompleted = getCompletedCountForLot($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, 'Site Office', null);
			$bgColor = "";
			if (isset($resultRow->calculatedBuildCompletionDate)) {
				$bgColor = ' bgcolor = "'.getLotBuildStatusColor( $dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, "Site Office").'" ' ;
			}
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
		$nextSequence = getLotNextActivity($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, null, $null);
		if (isset($nextSequence)) {
			$expectedDateForActivity = getExpectedDateForBuildAction($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, $nextSequence);
		}
    	echo '<td class="tableLotDetailsNumbericData">'.nullToChar($expectedDateForActivity, '-').'</td>';
    	echo '<td class="tableLotDetailsNumbericData">'.nullToChar(getBuildActionName($dbSingleUse, $nextSequence,$resultRow->lotNumber, $resultRow->siteShortName),'-').'</td>';
		$formAction = 'index.php?myAction='.$myAction.'&siteShortName='.$resultRow->siteShortName;
		echo '<td align="center">';
		echo getlotWatchCheckbox($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, $userName, $formAction);
		
		echo '</td>';

		echo '</tr>';
	}
}
}

	if ($rowNum == 0) {
		echo '<tr><td colspan="5"><h3>There is no expected activity at this time.</h3></td></tr>';
	}
	echo '</tbody>';
?>
</table>
