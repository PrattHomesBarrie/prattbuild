<h2>Recent Deposit Transactions</h2>
<?php

require_once ("classes/misc_functions.php");

function depositsRecentActivityHeader() {
	echo '  <tr>';
    echo '<th align="center" width="0">Trans<br>Date</th>';
    echo '<th align="center" width="0">Trans<br>Type</th>';
    echo '<th align="center" >Trans<br>Amount</th>';
    echo '<th align="center" width="0">Who</th>';
    echo '<th align="center" width="0">Due<br>Date</th>';
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
(
select dd.*, d.siteShortName, d.lotNumber, d.dueDate, d.depositName, d.expectedAmount
,(select sum(detailAmount) 
from offerDepositsDetail dd2 where dd2.depositId = d.id) as depositPaymentTotal
  from offerDepositsDetail dd, offerDeposits d
where dd.depositID = d.id
) a
order by id desc limit 30";
$rowNum = 0;
if ($db->Query($query)) { 
	while ($depositRow = $db->Row() ) {
		if ($rowNum == 0) {
			depositsRecentActivityHeader();
		}
		$rowNum = $rowNum + 1;
		$query = "select * from offerDetailView  where lotNumber = ".$depositRow->lotNumber." and siteShortName = '".$depositRow->siteShortName."'";
		//echo '<br>'.$query;
		if ($db2->Query($query)) { 
			while ($resultRow = $db2->Row() ) {
				echo '<tr>';
				echo '<td align="center"> '.nullToChar($depositRow->detailDate,'-').'</td>';
				echo '<td align="center"> '.nullToChar($depositRow->detailAction,'-').'</td>';
				echo '<td align="center"> '.nullToChar($depositRow->detailAmount,'-').'</td>';
				echo '<td  align="left">'.getNameFromUserName($dbSingleUse,$depositRow->actionUserName).'</td>';
				echo '<td align="center"> '.nullToChar($depositRow->dueDate,'-').'</td>';
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
				if ($depositRow->comments > '') {
					echo '<tr><td colspan="3"></td><td colspan="5" bgcolor="#CCCCCC" >';
					echo  nl2br($depositRow->comments);
					echo '</td></tr>';
				}
			}
		}
	}
}
echo '</table>';

?>
