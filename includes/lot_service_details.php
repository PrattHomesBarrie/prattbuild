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
if (!$securityLevelOneCheck) {
	exit;
}

require_once("classes/misc_functions.php");



$query = 'select  ls.id as serviceId, siteShortName, lotNumber,  serviceTypeName, lst.displaySequence, ls.requiredActionDate, ls.openDate, ls.closeDate, count(lsi.id) as numberOfItems
		  from lotServices ls
			      left join lotServicesItems lsi on ls.id = lsi.serviceId
				  left join lookupServiceTypes lst on ls.serviceTypeId = lst.serviceTypeId
	      where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;

if (!$dbSingleUse->HasRecords($query)) {
	echo '
	<table width="100%" border="0">
	  <tr>
		<td align="center">
		<form action="" method="post" name="ServicesAddDefaultForm" target="_self" >
		<input name="myAction" type="hidden" id="myAction" value="LotServices" />7
		<input name="myEditAction" type="hidden" id="myEditAction" value="AddLotDefaultServices" />
		<button type="submit" class="formbutton" name="addServicessButton" id="addServicessButton" style="width: 500px;">Click Here to Add Default LotService Items</button>
	     </form>
		</td>
	  </tr>
	</table>
';
}



if ($myEditAction == 'EditSingleService' or $myEditAction == 'AddServiceItem') {
	$query = $query.' and ls.id = '.$_GET["serviceId"];
}

$query .= ' group  by ls.id , siteShortName, lotNumber, serviceTypeName, lst.displaySequence,ls.requiredActionDate, ls.openDate, ls.closeDate';
$query = $query.' order by lst.displaySequence, 1 asc';
?>
<?php
/*
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
*/
?>
<table  class="tableServiceEntry"  >


<?php
//echo '<tr><td colspan="4"><h1>Edit Offer Features</h1></td></tr>';
$curDate = date("Y-m-d");

$date = strtotime($curDate);
$date = strtotime("+7 day", $date);
$datePlusTwoWeeks = date('Y-m-d', $date);
//echo $query;
$x=0;
if ($dbSingleUse->HasRecords($query)) {
	$serviceArray = $dbSingleUse->QueryArray($query);
	foreach ($serviceArray as $i => $serviceRow) { 
		$x = $x + 1;
		if ($myEditAction == 'EditSingleService' ) {
			$openDate = $serviceRow["openDate"];
			$id = $serviceRow["serviceId"];
			$currentServiceId  = $serviceRow["serviceId"];
	    	//require_once("offer_entry_deposits_edit.php");
			echo 'edit single service';
		}
		else
		{
			//show data for payment row
			echo '<tr bgcolor="#CCCCCC">';
			echo '<td align="left" rowspan="2" >';
			if ($myEditAction == 'AddDepositDetailDeposit' or $myEditAction == 'AddDepositDetailNote' or $myEditAction == 'AddDepositDetailNSF') {	
			}
			else {
				echo '<table class="tableServiceMenuList"><tr>';
				echo '<td class="tableCellServiceMenuList">';
				echo '<a href="index.php?myAction=ServiceEntry&myEditAction=AddServiceNote&serviceId='.$serviceRow["serviceId"].'"><b>Add Note</b></a>';
				echo '</td>';
				echo '</tr><tr>';
				echo '<td class="tableCellServiceMenuList">';
				echo '<font><a href="index.php?myAction=ServiceEntry&myEditAction=AddServiceInspection&serviceId='.$serviceRow["serviceId"].'"><b>Add Inspection</b></a></font>';
				echo '</td>';
				echo '</tr><tr>';
				echo '<td class="tableCellServiceMenuList">';
				echo '<a href="index.php?myAction=ServiceEntry&myEditAction=EditSingleService&serviceId='.$serviceRow["serviceId"].'"><b>Edit Service</b></a>';
				echo '</td>';
				echo '</tr></table>';		
			}
			echo '</td>';
			echo '<td align="right"></td>';
			echo '<td align="left">Opened: </td>';
			echo '<td align="left">Required: </td>';
			echo '<td align="left">Closed: </td>';
			echo '</tr><tr bgcolor="#CCCCCC">';
			echo '<td width="125px" align="left"><b>';
			echo $serviceRow["serviceTypeName"];
			echo '</b></td>';
			if ($depositsRow["requiredActionDate"] < $curDate and ($depositsRow["expectedAmount"] - $depositsRow["sumDetailAmount"]) > 0) {
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
			echo '<td width="100px" align="left">'.$font.'<b>'.nullToChar(formatDateForHTML($serviceRow["openDate"],'-'),'-').'</b></font></td>';
			echo '<td width="100px" align="left">'.$font.'<b>'.nullToChar(formatDateForHTML($serviceRow["requiredActionDate"],'-'),'-').'</b></font></td>';
			echo '<td width="100px" align="left">'.$font.'<b>'.nullToChar(formatDateForHTML($serviceRow["closeDate"],'-'),'-').'</b></font></td>';
			echo '</tr>';
			$query = 'select * from lotServicesItems 	where serviceId = '.$serviceRow["serviceId"].' order by id';
			//echo $query;
			$itemRowCount = 0;
			$depositBalance =  $depositsRow["expectedAmount"];
			if ($dbSingleUse->hasRecords($query)) {
				$serviceItemArray = $dbSingleUse->QueryArray($query);
				foreach ($serviceItemArray as $i => $serviceItemRow) { 
					$itemRowCount += 1;
					if ($itemRowCount > 1)  {
						echo '</tr>';
						echo '<tr>';
						echo '<td colspan="3">&nbsp;</td>';
						echo '</tr>';
					}
					echo '<tr bgcolor="#FFFFBB"  >';
					echo '<td  align="right">'.$detRowCount.') </td>';
					echo '<td class="lefttopbottom"  align="right"><b>';
					echo $serviceItemRow["itemSummary"];
					echo '</b></td>';
					echo '<td class="righttopbottom" >&nbsp;</td>';
					echo '<td  align="left"><b>'.nullToChar(formatDateForHTML($serviceItemRow["itemOpenDate"],'-'),'-').'</b></td>';
	//				alertBox($depositsDetailRow["modUserName"].'-'.getNameFromUserName($dbSingleUse,$depositsDetailRow["modUserName"]));
					echo '<td  align="left">'.getNameFromUserName($dbSingleUse,$serviceItemRow["modUserName"]).'</td>';
		//			echo '<td align="center"><big><a href="index.php?myAction=EditOffer&myEditAction=EditSingleDeposit&depositId='.$depositsRow["id"].'">Edit</a></big></td>';
					echo '</tr>';
					if ($serviceItemRow["comments"] > '') {
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
						echo '<td class="leftrighttopbottom" colspan="3">'.$serviceItemRow["itemComments"].'</td>';
						echo '</tr>';
					}
				}
			}
			echo '<tr>';
			echo '<td></td>';
			echo '<td></td>';
			echo '<td colspan="3">&nbsp;</td>';
			echo '</tr>';
		}
	} 
}
?>
</table>
<table width="100%">
<tr>
<td align="left">
<?php
if ($securityTestUser) { 
	if ($myEditAction == 'EditSingleService' or $myEditAction == 'AddService') {
		//do nothing
	}
	else {
		echo '
		<form action="" method="post" name="ServicesAddServiceForm" target="_self" >
		<input name="myAction" type="hidden" id="myAction" value="EditServices" />
		<input name="myEditAction" type="hidden" id="myEditAction" value="AddServiceEntry" />
		<button type="submit" class="formbutton" name="addServiceButton" id="addServiceButton" style="width: 200px;">Add New Service Entry</button></form>';
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
		<form action="index.php?myAction=Lot" method="post" name="form2" target="_self">
	    <input name="myAction" type="hidden" id="myAction" value="Lot" />
		<button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges"  style="width: 200px;" />Return To Lot</button></form>';
	}
?>
</td>
</tr>
</table>
<?php
?>
