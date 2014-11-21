<h2>Recent Signed Offers That Have Not Been Setup With Deposits</h2>
<?php

require_once ("classes/misc_functions.php");

function depositsMissingHeader() {
	echo '  <tr>';
    echo '<th align="center" >Site</th>';
    echo '<th align="center" >Lot</th>';
    echo '<th align="center" >Model</th>';
    echo '<th align="center" width="0">Offer<br>Date</th>';
    echo '<th align="center" width="0">Signed<br>Date</th>';
    echo '<th align="center" >Move In<br>Date</th>';
    echo '<th align="center" >Watch</th>';
    echo '</tr>';
}

echo '<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData">';

if ($debug == "Yes") {
	echo 'Watch='.$watch;
	echo 'updatelotNumber='.$updatelotNumber;
}

$query = "select  lotNumber, siteShortName
from offerDetailViewSignedOnly o
where not exists (select 1 from offerDeposits d where d.lotNumber = o.lotNumber and d.siteShortName = o.siteShortName)
and (offerDate > DATE_SUB(CURDATE(),INTERVAL 60 DAY)
or dateDocumentSigned > DATE_SUB(CURDATE(),INTERVAL 60 DAY))
order by offerDate desc";
$rowNum = 0;
if ($db->Query($query)) { 
	while ($depositRow = $db->Row() ) {
		if ($rowNum == 0) {
			depositsMissingHeader();
		}
		$rowNum = $rowNum + 1;
		$query = "select * from offerDetailView  where lotNumber = ".$depositRow->lotNumber." and siteShortName = '".$depositRow->siteShortName."'";
		//echo '<br>'.$query;
		if ($db2->Query($query)) { 
			while ($resultRow = $db2->Row() ) {
				echo '<tr>';
			    echo '<td align="center">'.$resultRow->siteShortName.'</td>';
	    		echo '<td align="center"><a href="index.php?myAction=Lot&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.$resultRow->lotNumber.'</a></td>';
				echo '<td align="center"> '.nullToChar($resultRow->modelName,'-').'</td>';
				echo '<td align="center"><a href="index.php?myAction=EditOffer&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.nullToChar($resultRow->offerDate,'-').'</a></td>';
				echo '<td align="center">'.nullToChar($resultRow->dateDocumentSigned,'-').'</td>';

				echo '<td align="center"> '.nullToChar($resultRow->moveInDate,'-');
				if ($securityLevelOneCheck) {
					echo $resultRow->amendedMoveInText;
				}
		    	echo '<td class="tableLotDetailsNumbericData">';
				$formAction = 'index.php?myAction=DepositTracking';
				getlotWatchCheckbox($dbSingleUse,$resultRow->lotNumber, $resultRow->siteShortName, $userName, $formAction);
				echo '</td>';
				echo '</tr>';
			}
		}
	}
}
echo '</table>';

?>

  