<style>
.ui-autocomplete-loading { background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat; }
.ui-autocomplete-input {  FONT-SIZE: 5px; }
.ui-menu {  FONT-SIZE: 12px; }
/*
#elevation { width: 20em; }
#modelName { width: 20em;  }
*/

</style>


<table class="tableOfferEntry"  border="1" cellspacing="1" cellpadding="2" align="left">
<form action="" method="post" name="BuildSequencesMainForm" target="_self" onsubmit="return checkFormData(this)">
<?php
function buildSequenceHeader($timelineMasterName) {
	echo '<tr>';
	echo '<td colspan="8" align="center"><h2>'.$timelineMasterName.' - Build Sequences</h2></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Sequence #</th>';
	echo '<th>Location</th>';
	echo '<th>Build Action</th>';
	echo '<th>% of Build</th>';
	echo '<th># Days Before/After<br /> Complete Date</th>';
	echo '<th  align="center">Active</th>';
	echo '<th align="center">If Today was the end date</th>';
	echo '<th align="center">Action</th>';
	echo '</tr>';
}
$timelineMasterID = $_GET["timelineMasterID"];

$query = 'select btm.timelineMasterName, bt.*
			from buildTimelineMaster btm left join buildTimeline bt on bt.timelineMasterID = btm.timelineMasterID where 1=1	' ;

	$query = $query.' and btm.timelineMasterID = "'.$_GET["timelineMasterID"].'"';
if ($myEditAction == 'EditSingleBuildSequence') {
	$query = $query.' and bt.timelineSequenceID = "'.$_GET["timelineSequenceID"].'"';
}
$query = $query.' order by moveInDateOffset, sequence asc';
//echo $query;
$x=0;
$totalPercentBuild = 0;
$canChangeBuildAction = true;
if ($db->HasRecords($query)) { 
	$dbArray = $db->QueryArray($query);
	foreach ($dbArray as $j => $buildSequences) {
		$totalPercentBuild += $buildSequences["percentOfBuild"];
		$tempDate = strtotime(date("Y-m-d") . " +".$buildSequences["moveInDateOffset"]." day");
		$expectedDate = date('Y-m-d', $tempDate);
		$timelineMasterName = $buildSequences["timelineMasterName"];
		if ($x == 0) {	
			buildSequenceHeader($timelineMasterName);
		}
		$x = $x + 1;
		if ($myEditAction == 'EditSingleBuildSequence') {
			$timelineSequenceID = $buildSequences["timelineSequenceID"];
			$sequence = $buildSequences["sequence"];
			$location = $buildSequences["location"];
			$buildAction = $buildSequences["buildAction"];	
			$percentOfBuild = $buildSequences["percentOfBuild"];
			$moveInDateOffset = $buildSequences["moveInDateOffset"];
			$sequenceIsActive = $buildSequences["sequenceIsActive"];
			$query = "select * from lots l, lotBuildResults lbr where l.lotNumber = lbr.lotNumber and l.siteShortName = lbr.siteShortName and l.timelineMasterID=".$_GET["timelineMasterID"]." and buildAction = '".$buildAction."'";
			//echo $query;
			if ($db->HasRecords($query)) { 
				$canChangeBuildAction = false;
			}
		}
		else
		{
			if ($buildSequences["sequence"] > 0 ) {	
				echo '<tr>';
				echo '<td align="center">'.nullToChar($buildSequences["sequence"],'-').'</td>';
				echo '<td align="center">'.nullToChar($buildSequences["location"],'-').'</td>';
				echo '<td align="center">'.nullToChar($buildSequences["buildAction"],'-').'</td>';
				echo '<td align="center">'.nullToChar($buildSequences["percentOfBuild"],'-').'</td>';
				echo '<td align="center">'.nullToChar($buildSequences["moveInDateOffset"],'-').'</td>';
				echo '<td align="center">';
				echo '<input name="sequenceIsActive" id="sequenceIsActive" type="checkbox" value="1" disabled="disabled" ';
				if ($buildSequences["sequenceIsActive"] == 1) {
					echo ' checked="checked" ';
				}
				echo '/>';
				echo '</td>';
				echo '<td class="tableClearingData" align="center"';
				echo '>'.$expectedDate.' '.$interval.'</td>';
				echo '<td align="center"><big><a href="index.php?myAction=Maintenance&myEditAction=EditSingleBuildSequence&timelineMasterID='.$timelineMasterID.'&timelineSequenceID='.$buildSequences["timelineSequenceID"].'">Edit</a></big></td>';
				echo '</tr>';
			}
		}
	}
} 
if ($myEditAction != 'EditSingleBuildSequence' ) {
	echo '<tr>';
	echo '<td colspan="3"></td>';
	echo '<td align="center">'.$totalPercentBuild.'%</td>';
	echo '<td colspan="4"></td>';
	echo '</tr>';
}
if ($x == 0) {	
	buildSequenceHeader($timelineMasterName);
}
?>

<tr><td>
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="<?php if ($myEditAction == 'EditSingleBuildSequence') { echo 'SaveBuildSequence'; } else { echo 'AddBuildSequence'; } ?>" />
    <input name="timelineSequenceID" type="hidden"  value="<?php if ($myEditAction == 'EditSingleBuildSequence') { echo $timelineSequenceID; } ?>" />
    <input name="timelineMasterID" type="hidden"  value="<?php echo $timelineMasterID;  ?>" />
    <input name="sequenceOfRecord" type="hidden"  value="<?php if ($myEditAction == 'EditSingleBuildSequence') { echo $sequence; } ?>" />
    <input type="text" id="sequence"  name="sequence" value="<?php if ($myEditAction == 'EditSingleBuildSequence') { echo htmlspecialchars($sequence); } ?>" size="4" maxlength="10" onkeypress="validateNumber(event);" /> 
 <?php if ($myEditAction == 'EditSingleBuildSequence') {echo '<br/><b><big>'.htmlspecialchars($sequence).'</b></big>';} ?>
 </td>
 <td><select name="location">
   <option value="Site Office" <?php if ($myEditAction == 'EditSingleBuildSequence' and $location == 'Site Office') {echo "selected=\"selected\"";} ?>>Site Office</option>
   <option value="Head Office" <?php if ($myEditAction == 'EditSingleBuildSequence' and $location == 'Head Office') {echo "selected=\"selected\"";} ?>>Head Office</option>
 </select>
     
	 <?php if ($myEditAction == 'EditSingleBuildSequence') {echo '<br/><b><big>'.htmlspecialchars($location).'</b></big>';} ?>
    </td>
 <td>
    <input type="<?php if ($canChangeBuildAction == false && $securityCanDoMaintenance!= true) {echo 'hidden'; } else {echo 'text';} ?>" id="buildAction"  name="buildAction" value="<?php if ($myEditAction == 'EditSingleBuildSequence') { echo htmlspecialchars($buildAction); } ?>" size="40" maxlength="50" onkeypress="return isAlphaNumberKey(event);" /> 
	 <?php if ($myEditAction == 'EditSingleBuildSequence') {echo '<br/><b><big>'.htmlspecialchars($buildAction).'</b></big>';} ?>
    </td>
     <td> <input id="percentOfBuild"  name="percentOfBuild" value="<?php echo htmlspecialchars($percentOfBuild);?>" size="2" maxlength="2" onkeypress="validateNumber(event)"/>
	 <?php if ($myEditAction == 'EditSingleBuildSequence') {echo '<br/><b><big>'.htmlspecialchars($percentOfBuild).'</b></big>';} ?>
      </td>
 <td> <input id="moveInDateOffset"  name="moveInDateOffset" value="<?php echo htmlspecialchars($moveInDateOffset);?>" size="3" maxlength="4" onkeypress="validateNumber(event)"/> 	 <?php if ($myEditAction == 'EditSingleBuildSequence') {echo '<br/><b><big>'.htmlspecialchars($moveInDateOffset).'</b></big>';} ?>
</td>
 <td align="center"> <input name="sequenceIsActive" id="sequenceIsActive" type="checkbox" value="1"  
<?php			if ($myEditAction == 'EditSingleBuildSequence') {
					if ($sequenceIsActive== 1) {
						echo ' checked="checked" ';
					}
				}
				else {
						echo ' checked="checked" ';
				}
			?>
/>
 </td>
<td class="tableClearingData" align="center"><?php echo $expectedDate; ?></td>


<td align="right">
     	<button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 60px;"><?php if ($myEditAction == 'EditSingleBuildSequence') {echo '  Save ';} else {echo '  Add  ';} ?></button>

            </td></tr>

</form>
<tr>
    <td colspan = "9" align="right"><form action="index.php?myAction=Maintenance&timelineMasterID=<?php echo $timelineMasterID; ?>" method="post" name="form2" target="_self">
    <?php if ($myEditAction == 'EditSingleBuildSequence') {
		echo '<input name="myEditAction" type="hidden" id="myEditAction" value="EditTimelineSequences" />';
	}
	else {
		echo '<input name="myEditAction" type="hidden" id="myEditAction" value="EditBuildTimeline" />';
	}?>
    <button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges" style="width: 60px;"><?php if ($myEditAction == 'EditSingleBuildSequence') {echo 'Cancel';} else {echo 'Return';}?></button></form> </td>
</tr>

</table>
<?php
	if ($canChangeBuildAction == false && $securityCanDoMaintenance!= true) {
		echo '<b>Note: This build action is in use.  No changes to Build Action name</b>';
	}
echo '<br /><small>*Note: That the "# days" determines the expected date for an activity.  And, the "sequence" is used in determining the next "expected" activity. If you  do not want to mess with this, then put "number of days" and "sequence" in the same sequential order. </small>';
?>
