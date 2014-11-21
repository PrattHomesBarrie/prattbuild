<?php
require_once ("classes/misc_functions.php");

if ($myEditAction == 'SaveBuildCompletionDate'  ) {
	require_once ("maintenance_updates.php");
}
$currentSettingCheck = 'Show Lot Notes on Build Screen';
$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
if ($settingValue == '1') {
	$allowLotNoteEditing = false;
	include("lot_notes.php");
}


$query = 'select count(*) as HowMany from lotDocuments where siteShortName =  "'.$siteShortName.'" and lotNumber = '.$lotNumber.' ';
if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row()) {
		$numberDocuments = $resultRow->HowMany;
	}
}

$query = 'select count(*) as HowMany from lotNotes where siteShortName =  "'.$siteShortName.'" and lotNumber = '.$lotNumber.' ';
if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row()) {
		$numberNotes = $resultRow->HowMany;
	}
}

if ( $securityLevelOneCheck != true ) {
	   $query = 'select * from offerDetailViewSignedOnly ';
}
else {
		$query = 'select * from offerDetailView 	';
}
$query .= '	where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;

//printf( $query);
$rowLotNum = 0;
if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row()) {
	$lotTimelineMasterID = $resultRow->timelineMasterID;
	$rowLotNum = $rowLotNum + 1;
	$buildCompletionDate = $resultRow->calculatedBuildCompletionDate;
	echo excavationStartedMessage($dbSingleUse,$lotNumber, $siteShortName)	;
	
		
	
	if ($g_UseOfferOverrideDateFunctionality) {
		echo noOfferChangesAllowedMessage($dbSingleUse,$lotNumber, $siteShortName)	;
	}
	echo '<h1>Lot '.$resultRow->lotNumber.' - <a href="?myAction=Lots&siteShortName='.$resultRow->siteShortName.'">'.$resultRow->siteName.'</a></h1>';
	echo ' <table width ="100%" border="0"><tr>';
	echo '<td align="left" width="14%"><a href="index.php?myAction=APSDetails&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">A.P.S. Details</a></td>';
	if ($securityLevelOneCheck) {
		echo '<td align="center"  width="14%"><a href="index.php?myAction=EditOffer&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">Offer Details</a></td>';
	}
	if ($securityLevelOneCheck) {
		echo '<td align="center"  width="14%"><a href="index.php?myAction=EditChart&myEditAction=EditChart&chartNumber=2&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">Colour Chart</a></td>';
	}
	if ($securityLevelTwoCheck ) {
//		echo '<td align="center"><a href="index.php?myAction=EditChart&myEditAction=EditChart&chartNumber=2&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">Colour Chart</a></td>';
	echo '<td align="center"  width="14%"><a target="_blank" href="index.php?myAction=ColourChart&chartNumber=2&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">Colour Chart</a></td>';
	}
//	if ($securityLevelOneCheck ) {
	if ($securityCanDoServiceTracking) {
		echo '<td align="center"  width="14%"><a href="index.php?myAction=ServiceEntry&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">Services</a></td>';
	}
	if ($securityLevelOneCheck) {
	echo '<td align="center"  width="10%"><a  href="index.php?myAction=PO&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'&siteName='.$resultRow->siteName.'">PO</a></td>';
	}
	if ($securityLevelOneCheck) {
	echo '<td align="center"  width="13%"><a  href="index.php?myAction=Deficiency&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'&siteName='.$resultRow->siteName.'">Deficiency</a></td>';
	}
	echo '<td align="center"  width="13%"><a  href="index.php?myAction=ManageLotNotes&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">Notes(<b>'.$numberNotes.'</b>)</a></td>';

	echo ' <td align="right"><a href="index.php?myAction=AddDocument&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">Attached Documents(<b>'.$numberDocuments.'</b>)</a></td>';
	echo '</tr></table>';
	echo '<div  id="detailsDiv">';
	echo '<table  class="clsPrattTable" id="LotDetails">';
	echo '  <tr>';
	echo '    <td width="150" class="labelRightJustified">Offer Model:</td>';
	echo '    <td width="200" class="tableDataStandard">'.$resultRow->modelName.'</td>';
	echo '    <td width="58">&nbsp;</td>';
	echo '    <td width="150" class="labelRightJustified">Lot Size:</td>';
	echo '    <td width="200" class="tableDataStandard">'.$resultRow->lotSize.'</td>';
	echo '  </tr>';
	echo '  <tr>';
	echo '    <td class="labelRightJustified">Elevation:</td>';
	echo '    <td class="tableDataStandard">'.$resultRow->elevation.'</td>';
	echo '    <td >&nbsp;</td>';
	echo '    <td class="labelRightJustified">Address:</td>';
	echo '    <td class="tableDataStandard">'.$resultRow->munStreetNumber.' '.$resultRow->munStreetAddress.'</td>';
	echo '  </tr>';
	echo '  <tr>';
	echo '    <td class="labelRightJustified"># Bedrooms:</td>';
	echo '    <td class="tableDataStandard">'.$resultRow->numberOfBedrooms.'</td>';
	echo '    <td>&nbsp;</td>';
	echo '    <td class="labelRightJustified">Plan #:</td>';
	echo '    <td class="tableDataStandard">'.$resultRow->planNumber.'</td>';
	echo '  </tr>';
	echo '  <tr>';
	if ($g_AllowedToSeeOccCloseDates == true) {
		echo '    <td class="labelRightJustified">Occ. Date:</td>';
		echo '    <td class="tableDataStandard">'.nullToChar($resultRow->calculatedOccupancyDate,'-');
		if ($securityLevelOneCheck) {
			echo $resultRow->amendedOccupancyText;
		}
		echo '</td>';
		echo '    <td>&nbsp;</td>';
		echo '    <td class="labelRightJustified"></td>';
		echo '    <td class="tableDataStandard"></td>';
	}
	echo '  </tr>';
	echo '  <tr>';
	if ($g_AllowedToSeeOccCloseDates == true) {
		echo '    <td class="labelRightJustified">Closing Date:</td>';
		echo '    <td class="tableDataStandard">'.nullToChar($resultRow->calculatedClosingDate,'-');
		if ($securityLevelOneCheck) {
			echo $resultRow->amendedClosingText;
		}
		echo '</td>';
	}
	else {
		echo '<td colspan="2"></td>';
	}
	echo '    <td>&nbsp;</td>';
	echo '    <td class="labelRightJustified">Build Completion Date:</td>';
	echo '    <td class="tableDataStandard">'.nullToChar($resultRow->calculatedBuildCompletionDate,'-');
	if ($securityLevelOneCheck) {
		echo '<small>'.$resultRow->calculatedBuildCompletionDateText.'</small>';
	}
	echo '</td>';
	echo '  </tr>';
	
	$settingShowBuildCountdownOnLotDetails = false;
	$currentSettingCheck = 'Show Build Countdown on Lot Details';
	$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
	if ($settingValue == '1') {
		$settingShowBuildCountdownOnLotDetails = true;
	}
	
	if ($settingShowBuildCountdownOnLotDetails  or $securityCanChangeBuildCompleteDate) {
	
		echo '  <tr>';
		if ($settingShowBuildCountdownOnLotDetails  ) {
			echo '    <td class="labelRightJustified">Build Countdown:</td>';
			echo '  <td class="tableDataStandard">';
			if (nullToChar($resultRow->calculatedBuildCompletionDate,'-') <> '-') {
				echo'
				<iframe src="https://freesecure.timeanddate.com/countdown/i3odlfd8/n1167/cf12/cm0/cu4/ct5/cs1/ca0/co0/cr0/ss0/cac000/cpc090/pct/tcfff/fn2/fs100/szw320/szh135/iso
				'.$resultRow->calculatedBuildCompletionDate.'T17:00:00'.'
				/bo3" frameborder="0" width="154" height="31"></iframe>
						
				';
			}
			echo '</td>';
		}
		else {
			echo '    <td class="labelRightJustified"></td>';
			echo '  <td class="tableDataStandard"></td>';
		}
		echo '    <td>&nbsp;</td>';
		if ($securityCanChangeBuildCompleteDate) {
			echo '  <td class="labelRightJustified">Set Completion Date:</td>';
			echo '    <td class="tableDataStandard">';
			include("lot_build_complete_date_form.php");
			echo '  </td>';
		}
		echo '  </tr>';
	}
	echo '  </table>';
	echo '</div>';
}
}
    //echo "<pre>"; print_r($_POST) ;  echo "</pre>";
	?>
    
    <table><tr><td>
	<form action="" method="post">
    	<input type="hidden" name="showHideCompletedActivity" value="Hide" />
		<input name="btnHideCompleted" type="button" value="Hide Completed" onclick="this.form.submit()" 
        	<?php if ($showHideCompletedActivity == "Hide") { echo 'disabled="disabled"';} ?>
        />    
    </form>
    </td><td>
	<form action="" method="post">
    	<input type="hidden" name="showHideCompletedActivity" value="Show" />
		<input name="btnShowCompleted" type="button" value="Show Completed" onclick="this.form.submit()" 
        	<?php if ($showHideCompletedActivity == "Show"  or is_null($showHideCompletedActivity)) { echo 'disabled="disabled"';} ?>
            />    
    </form>
    </td></tr></table>
	<?php


if ($rowLotNum == 0) {
	echo '<br><br><h1>Error: Lot '.$lotNumber.' was not found in the database.</h1><br><br>';
}

	echo '<h2>Clearing';
	if ($securityLevelOneCheck) {
		echo ' - '.getLotBuildPercent($dbSingleUse,$lotNumber, $siteShortName,$lotTimelineMasterID ).'%';
	}
	echo ' </h2>';
	echo '<table  class="clsPrattTable">';
//	echo '<table  >';


	$query = 'select bt.buildAction, bt.location, bt.sequence, br.userName, br.buildDate, bt.numberOfDays,bt.moveInDateOffset,
				 CONCAT(substr(u.firstName, 1,1), ". ", u.lastName) as updateUser, bt.isPostBuildItem, bt.timelineMasterID
 			from buildTimeline  bt left join lotBuildResults br 
			LEFT JOIN users u ON u.userName = br.userName 
							on bt.buildAction = br.buildAction	
				and br.siteShortName = "'.$siteShortName.'" and br.lotNumber ='.$lotNumber.'
				where bt.timelineMasterID = '.$lotTimelineMasterID.'
				and bt.sequenceIsActive = 1
				 order by bt.moveInDateOffset';
/*
	$query = 'select bt.buildAction, bt.location, bt.sequence, br.userName, br.buildDate, bt.numberOfDays,
				 CONCAT(substr(u.firstName, 1,1), ". ", u.lastName) as updateUser, bt.isPostBuildItem, 
 (select sum(numberOfDays) from buildTimeline bt2 where bt.sequence <= bt2.sequence and bt2.isPostBuildItem = false) as daysBeforeClosing,
 (select 0-sum(numberOfDays) from buildTimeline bt2 where bt.sequence <= bt2.sequence and bt2.isPostBuildItem = true) as daysAfterClosing
 			from buildTimeline  bt left join lotBuildResults br 
			LEFT JOIN users u ON u.userName = br.userName 
							on bt.buildAction = br.buildAction	
				and br.siteShortName = "'.$siteShortName.'" and br.lotNumber ='.$lotNumber.' order by bt.sequence';
*/
	//echo '<br>'.$query;
	$rowNumm = 0;
	$buildLocation = "";
	if ($db2->Query($query)) { 
		while ($resultRow = $db2->Row()) {
		if (	$buildLocation != $resultRow->location) {
			$buildLocation = $resultRow->location;
		 echo '<tr>
		  <th class="tableDataStandard" width="100%">'.$resultRow->location.' </th>
		  <th class="tableDataStandard" width="2%" >Comp.<small><br />(click to complete)</small></th>
		  <th class="tableDataStandard" >Who <br />
			Last <br />
			Updated </th>
		  <th class="tableDataStandard" >Date <br />
			Completed</th>
		  <th class="tableDataStandard" >Expected <br />
			Completion Date
			</th>
		  <th  class="tableDataStandard" >Notes<br /><small>(click a cell to add note)</small></th>
		</tr>
		';

		}
		if (!is_null($resultRow->buildDate) and $showHideCompletedActivity == "Hide"){
			//don't show row
		}
		else
		{ //show row
			$rowNumm = $rowNumm + 1;
			if (isset($buildCompletionDate)) {
//				if ($resultRow->isPostBuildItem) {
					$tempDate = strtotime(date("Y-m-d", strtotime($buildCompletionDate)) . " +".$resultRow->moveInDateOffset." day");
//				}
//				else {
//					$tempDate = strtotime(date("Y-m-d", strtotime($buildCompletionDate)) . " -".$resultRow->daysBeforeClosing." day");
//				}
				
				$expectedDate = date('Y-m-d', $tempDate);
				$expiration_date = strtotime($expectedDate);
				$todays_date = date("Y-m-d");
				$today = strtotime($todays_date);
	//			if ($expiration_date > $today) {
	//				$isBehindSchedule = false;
	//			} else {
	//				$isBehindSchedule = true;
	//			}
			}
	
			echo '<tr><td class="tableClearingData" ';
			if (!is_null($resultRow->buildDate)){
				//do nothing
				//$buildBgColour = ' bgcolor="green" ';
				$buildBgColour = ' ';
			}
			else
			{
				$buildBgColour = ' bgcolor="'.getBuildActionColor($expectedDate).'" ';
	
			}
			echo $buildBgColour;
			echo '><b>'.$resultRow->buildAction.'</b></td>';
			echo '<td class="tableClearingData" align="center">';
			if (isset($buildCompletionDate)) {
					
				echo '<form id="form1" name="form1" method="post" action="index.php?myAction=Lot">';
				
				echo '<input type="checkbox" name="statusCheckBox" ';
				if (!is_null($resultRow->buildDate)){echo ' checked="checked" ';}
				echo '  onclick="this.form.submit()"';
				echo ' id="statusCheckBox" />';
				echo '<input name="updateLotClearingStatus" type="hidden" id="updateLotClearingStatus" value="'.$resultRow->buildAction.'" />';
				echo '<input name="siteShortName" type="hidden" id="siteShortName" value="'.$siteShortName.'" />';
				echo '<input name="lotNumber" type="hidden" id="lotNumber" value="'.$lotNumber.'" />';
				echo '<input name="buildActionToChange" type="hidden" id="buildActionToChange" value="'.$resultRow->buildAction.'" />';
				echo '</form>';
			}
			echo '</td>';
			echo '<td class="tableClearingData" align="center">'.$resultRow->updateUser.'</td>';
			echo '<td class="tableClearingData" align="center">'.substr($resultRow->buildDate,0,10).'</td>';
	//		echo '<td class="tableClearingData" align="center"><small>'.$resultRow->buildDate.'</small></td>';
			echo '<td class="tableClearingData" align="center"';
			echo '>'.$expectedDate.' '.$interval.'</td>';
			$notes =  findBuildResultNotesText($dbSingleUse,$lotNumber, $siteShortName, $resultRow->buildAction);
			if ($notes > '') {
				$cellattributes = ' width="20%"';
				$class = "notesMenu";
			}
			else {
				$cellattributes = "";
				$notes = ''.$resultRow->buildAction.' note';
				$class = "notesMenuEmpty";
			}
			echo '<td  '.$cellattributes.' >';
			echo '<a  class="'.$class.'" href="index.php?myAction=AddNote&buildSequence='.$resultRow->sequence.'&lotNumber='.$lotNumber.'&siteShortName='.$siteShortName.'"><small>'.$notes.'</small></a>';
			echo '</td>';
			echo '</tr>';
			}
		}
	}
	echo '</table>';
	
	$query = 'Select * from lotBuildResults br where br.buildAction not in 
		(select buildAction from buildTimeline bt 	where bt.timelineMasterID = '.$lotTimelineMasterID.')
		and br.siteShortName = "'.$siteShortName.'" and br.lotNumber ='.$lotNumber.' order by buildDate';

	//echo $query;
	$x = 0;
	if ($db2->Query($query)) { 
		while ($resultRow = $db2->Row()) {
			if ($x==0) {
				echo '<div><br><br><b><ul><large>These item were attached to this lot, but not currently part of the build timeline for this lot: </large></ul></b><br><br>';
			}
			else {
				echo '<br>';
			}
			echo substr($resultRow->buildDate,0,10).' '.$resultRow->buildAction;
			$x +=  1;
		}
	}
	if ($x > 0) {
		echo '</div>';
	}
?>

