<style type="text/css">
.lefttopbottom {
	border-top-style: solid;
	border-right-style: none;
	border-bottom-style: solid;
	border-left-style: solid;
	border-width:1px;
	border-color: #999;
}
.leftrighttopbottom {
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-width:1px;
	border-color: #999;
}
.righttopbottom {
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: none;
	border-width:1px;
	border-color: #999;
}
.topbottom {
	border-top-style: solid;
	border-right-style: none;
	border-bottom-style: solid;
	border-left-style: none;
	border-width:1px;
	border-color: #999;
}
.top {
	border-top-style: solid;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	border-width:1px;
	border-color: #999;
}
.allborders {
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-width:1px;
	border-color: #999;
}
</style>

<?php 
if (!$securityCanEditDeposits and !$securityLevelOneCheck) {
	exit;
}

require_once("classes/misc_functions.php");


$sumDeposits = 0;

$query = 'select  sum(expectedAmount) as sumExpectedAmount
		  from offerDeposits od
	      where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;
if ($dbSingleUse->Query($query)) { 
	while ($rowDeposits = $dbSingleUse->Row()) {
		$sumExpectedAmounts = $rowDeposits->sumExpectedAmount;
		$sumDetailAmounts = $rowDeposits->sumDetailAmount;
	}
}
$query = 'select  sum(detailAmount) as sumDetailAmount 
		  from offerDeposits od
			      left join offerDepositsDetail odd on od.id = odd.depositId
	      where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;
if ($dbSingleUse->Query($query)) { 
	while ($rowDeposits = $dbSingleUse->Row()) {
		$sumDetailAmounts = $rowDeposits->sumDetailAmount;
	}
}

if ($sumExpectedAmounts ==0 and $myEditAction != "AddOfferDeposit" ) { 
	echo '
	<table width="100%" border="0">
	  <tr>
		<td align="center">
		<form action="" method="post" name="DepositsAddDefaultForm" target="_self" >
		<input name="myAction" type="hidden" id="myAction" value="EditOffer" />
		<input name="myEditAction" type="hidden" id="myEditAction" value="AddOfferDefaultDeposits" />
		<button type="submit" class="formbutton" name="addDepositsButton" id="addDepositsButton" style="width: 500px;">Click Here to Add Default Customer Expected Deposits</button>
	     </form>
		</td>
	  </tr>
	</table>
';
}



$query = 'select d.id, d.siteShortName , d.lotNumber , d.depositName , d.dueDate , d.expectedAmount , d.modDate , d.modUserName ,  sum(dd.detailAmount) as sumDetailAmount  from offerDeposits d	left join offerDepositsDetail dd on d.id  = dd.depositId ';

$query .= '	where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;

if ($myEditAction == 'EditSingleDeposit' or $myEditAction == 'AddDepositDetailDeposit' or $myEditAction == 'AddDepositDetailNote' or $myEditAction == 'AddDepositDetailNSF') {
	$query = $query.' and d.id = '.$_GET["depositId"];
}
$query .= ' group by d.id, d.siteShortName , d.lotNumber , d.depositName , d.dueDate , d.expectedAmount , d.modDate , d.modUserName ';

$query = $query.' order by dueDate asc';
//echo $query;
?>
<?php
if ($myEditAction == 'AddDepositDetailDeposit' or $myEditAction == 'AddDepositDetailNote' or $myEditAction == 'AddDepositDetailNSF') {	
	$currentDepositId = $_GET["depositId"];
	require_once("offer_entry_deposits_detail_edit.php");
}
if ($myEditAction == 'EditSingleDeposit' ) {	
	$currentDepositId = $_GET["depositId"];
}
if ($myEditAction == 'AddOfferDeposit')  {
   	require_once("offer_entry_deposits_edit.php");
}
?>
<table  width="100%" border="0" cellspacing="0" cellpadding="0" align="left">


<?php
//echo '<tr><td colspan="4"><h1>Edit Offer Features</h1></td></tr>';
$curDate = date("Y-m-d");

$date = strtotime($curDate);
$date = strtotime("+7 day", $date);
$datePlusTwoWeeks = date('Y-m-d', $date);

$x=0;
if ($dbSingleUse->HasRecords($query)) {
	$depositsArray = $dbSingleUse->QueryArray($query);
	foreach ($depositsArray as $i => $depositsRow) { 
	
		$x = $x + 1;
		if ($myEditAction == 'EditSingleDeposit' ) {
			$depositName =  $depositsRow["depositName"];
			$dueDate = $depositsRow["dueDate"];
			$expectedAmount =  $depositsRow["expectedAmount"];
			$id = $depositsRow["id"];
			$currentDepositId  = $depositsRow["id"];
	    	require_once("offer_entry_deposits_edit.php");
		}
		else
		{
			//show data for payment row
			echo '<tr bgcolor="#CCCCCC">';
			echo '<td class="lefttopbottom"  align="right" width="20%"><b>'.$depositsRow["depositName"].'</b>  AMOUNT: </td>';
			echo '<td class="topbottom" width="9%" align="right"><b>$';
			echo money_format('%#12n',$depositsRow["expectedAmount"]);
			echo '</b></td>';
			echo '<td class="topbottom" width="2%">&nbsp;</td>';
			if ($depositsRow["dueDate"] < $curDate and ($depositsRow["expectedAmount"] - $depositsRow["sumDetailAmount"]) > 0) {
				$font = ' <font color="red"> '; 
			}
			elseif ($depositsRow["dueDate"] < $datePlusTwoWeeks and ($depositsRow["expectedAmount"] - $depositsRow["sumDetailAmount"]) > 0) {
				$font = ' <font color="#FF6633"> '; 
			}
			elseif (($depositsRow["expectedAmount"] - $depositsRow["sumDetailAmount"]) < 0) {
				$font = ' <font color="#0000FF"> '; 
			}
			else {
				$font = ' <font> '; 
			}
			echo '<td class="topbottom" align="right">'.$font.'DUE DATE: </font></td>';
			echo '<td class="topbottom" align="left">'.$font.'<b>'.nullToChar(formatDateForHTML($depositsRow["dueDate"],'-'),'-').'</b></font></td>';
			echo '<td class="topbottom" align="right">';
			if ($myEditAction == 'AddDepositDetailDeposit' or $myEditAction == 'AddDepositDetailNote' or $myEditAction == 'AddDepositDetailNSF') {	
			}
			else {
				echo '<table><tr>';
				echo '<td class="allborders" align="center" width="70px" bgcolor="#FFCC99">';
				echo '<a href="index.php?myAction=EditOffer&myEditAction=AddDepositDetailNote&depositId='.$depositsRow["id"].'"><b>Add Note</b></a>';
				echo '</td>';
				echo '<td class="allborders" align="center" width="70px" bgcolor="#00CC33">';
				echo '<font><a href="index.php?myAction=EditOffer&myEditAction=AddDepositDetailDeposit&depositId='.$depositsRow["id"].'"><b>Deposit</b></a></font>';
				echo '</td>';
				echo '<td class="allborders" align="center" width="70px" bgcolor="#FF0000">';
				echo '<a href="index.php?myAction=EditOffer&myEditAction=AddDepositDetailNSF&depositId='.$depositsRow["id"].'"><b>NSF</b></a>';
				echo '</td>';
				echo '</tr></table>';		
			}
			echo '</td>';
			echo '<td class="righttopbottom" align="center"><big><a href="index.php?myAction=EditOffer&myEditAction=EditSingleDeposit&depositId='.$depositsRow["id"].'">Edit</a></big></td>';
			echo '</tr>';
			$query = 'select * from offerDepositsDetail 	where depositId = '.$depositsRow["id"].' order by id';
			//echo $query;
			$detRowCount = 0;
			$depositBalance =  $depositsRow["expectedAmount"];
			if ($dbSingleUse->hasRecords($query)) {
				$depositsDetailArray = $dbSingleUse->QueryArray($query);
				foreach ($depositsDetailArray as $i => $depositsDetailRow) { 
					$depositBalance -= $depositsDetailRow["detailAmount"];
					$detRowCount += 1;
					if ($detRowCount > 1)  {
						echo '</tr>';
						echo '<tr>';
						echo '<td colspan="3">&nbsp;</td>';
						echo '</tr>';
					}
					echo '<tr bgcolor="#FFFFBB"  >';
					echo '<td  align="right">'.$detRowCount.') </td>';
					echo '<td class="lefttopbottom" width="9%" align="right"><b>';
					if ($depositsDetailRow["detailAmount"] != 0) {
						echo '$'.money_format('%#10n',$depositsDetailRow["detailAmount"]);
					}
					echo '</b></td>';
					echo '<td class="righttopbottom" width="2%">&nbsp;</td>';
					echo '<td class="leftrighttopbottom" align="center">'.$depositsDetailRow["detailAction"].'</td>';
					echo '<td  align="left"><b>'.nullToChar(formatDateForHTML($depositsDetailRow["detailDate"],'-'),'-').'</b></td>';
	//				alertBox($depositsDetailRow["modUserName"].'-'.getNameFromUserName($dbSingleUse,$depositsDetailRow["modUserName"]));
					echo '<td  align="left">'.getNameFromUserName($dbSingleUse,$depositsDetailRow["modUserName"]).'</td>';
		//			echo '<td align="center"><big><a href="index.php?myAction=EditOffer&myEditAction=EditSingleDeposit&depositId='.$depositsRow["id"].'">Edit</a></big></td>';
					echo '</tr>';
					if ($depositsDetailRow["comments"] > '') {
						echo '<tr>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td colspan="3">Note:</td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td class="leftrighttopbottom" colspan="3">'.$depositsDetailRow["comments"].'</td>';
						echo '</tr>';
					}
				}
			}
			echo '<tr>';
			echo '<td align="right">BALANCE:</td>';
			echo '<td colspan="1" class="top" align="right" ><b>$'.money_format('%#12n',$depositBalance).'</b></td>';
			echo '<td  width="2%">&nbsp;</td>';
    		echo '<td colspan="3" align="left">';
	        if ($depositBalance < 0) {
				echo "(This deposit has extra payments applied)";
			}
			echo '</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td></td>';
			echo '<td></td>';
			echo '<td colspan="3">&nbsp;</td>';
			echo '</tr>';
		}
	} 
}
?>
<tr><td colspan="3" bgcolor="#CCCCCC"><big><b>Deposit Summary</b></big></td></tr>
<tr><td width="15%"><b>TOTAL DUE</b></td><td align="right"><b><?php echo money_format('%#12n',$sumExpectedAmounts); ?></b></td></tr>
<tr><td><b>TOTAL RECEIVED</b></td><td align="right"><b><?php echo money_format('%#12n',$sumDetailAmounts); ?></b></td></tr>

</table>
<table width="100%">
<tr>
<td align="left">
<?php

if ($securityCanEditDeposits ) { 
	if ($myEditAction == 'EditSingleDeposit' or $myEditAction == 'AddOfferDeposit') {
		//do nothing
	}
	else {
		echo '
		<form action="" method="post" name="DepositsAddDepositForm" target="_self" >
		<input name="myAction" type="hidden" id="myAction" value="EditOffer" />
		<input name="myEditAction" type="hidden" id="myEditAction" value="AddOfferDeposit" />
		<button type="submit" class="formbutton" name="addDepositButton" id="addDepositButton" style="width: 200px;">Add Single Deposit</button></form>';
	}
}
?>
</td>
<td align="right">
<?php
	if ($myEditAction == 'EditSingleDeposit' or $myEditAction == 'AddOfferDeposit') {
		//do nothing
	}
	else {
		echo '
		<form action="index.php?myAction=EditOffer" method="post" name="form2" target="_self">
	    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
		<input name="myEditAction" type="hidden" id="myEditAction" value="ReturnToOfferMenu" /><button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges"  style="width: 200px;" />Return To Offer</button></form>';
	}
?>
</td>
</tr>
</table>
<?php
?>
