<small>(note: To go directly to the desposit the screen, click on the balance)</small>
<h2>Past Due Deposits</h2>
<?php

require_once ("classes/misc_functions.php");

function depositsPastDueHeader() {
	echo '  <tr>';
    echo '<th align="center" width="0">Due<br>Date</th>';
    echo '<th align="center" >Required<br>Amount</th>';
    echo '<th align="center" >Balance<br>(now)</th>';
    echo '<th align="center" ></th>';
    echo '<th align="center" >Site</th>';
    echo '<th align="center" >Lot</th>';
    echo '<th align="center" >Model</th>';
    echo '<th align="center" width="0">Offer<br>Date</th>';
    echo '<th align="center" >Move In<br>Date</th>';
    echo '<th align="center" >Watch</th>';
    echo '</tr>';
}

echo '<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData">';

if ($debug == "Yes") {
	echo 'Watch='.$watch;
	echo 'updatelotNumber='.$updatelotNumber;
}

$query = "select a.*, ifnull(expectedAmount,0) - ifnull(depositPaymentTotal,0) as balance from 
(SELECT d.*
, (select sum(detailAmount) 
from offerDepositsDetail dd where dd.depositId = d.id) as depositPaymentTotal FROM offerDeposits d 
) a
where 1=1
and ifnull(expectedAmount,0) - ifnull(depositPaymentTotal,0) > 0
and dueDate < CURDATE()
order by a.dueDate";

if ($db->Query($query)) { 
	while ($depositRow = $db->Row() ) {
		if ($rowNum == 0) {
			depositsPastDueHeader();
		}
		$rowNum = $rowNum + 1;
		$query = "select * from offerDetailView  where lotNumber = ".$depositRow->lotNumber." and siteShortName = '".$depositRow->siteShortName."'";
		//echo '<br>'.$query;
		if ($db2->Query($query)) { 
			while ($resultRow = $db2->Row() ) {
				echo '<tr>';
				echo '<td align="center"> '.nullToChar($depositRow->dueDate,'-').'</td>';
				echo '<td align="center"> '.nullToChar($depositRow->expectedAmount,'-').'</td>';
				echo '<td align="center"><a href="index.php?myAction=EditOffer&myEditAction=EditOfferDeposits&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.nullToChar($depositRow->balance,'-').'</a></td>';
			    echo '<td align="center">'.$depositRow->depositName.'</td>';
			    echo '<td align="center">'.$resultRow->siteShortName.'</td>';
	    		echo '<td align="center"><a href="index.php?myAction=Lot&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.$resultRow->lotNumber.'</a></td>';
				echo '<td align="center"> '.nullToChar($resultRow->modelName,'-').'</td>';
				echo '<td align="center"><a href="index.php?myAction=EditOffer&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.nullToChar($resultRow->offerDate,'-').'</a></td>';

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

  