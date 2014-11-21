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
<form action="" method="post" name="BuildTimelinesMainForm" target="_self" onsubmit="return checkFormData(this)">
<?php
$query = 'select *
			from buildTimelineMaster where 1=1	' ;

if ($myEditAction == 'EditSingleTimelineMaster') {
	$query = $query.' and timelineMasterID = "'.$_GET["timelineMasterID"].'"';
}

$query = $query.' order by timelineMasterName asc';
//echo $query;

//echo '<tr><td colspan="4"><h1>Edit Offer Features</h1></td></tr>';
echo '<tr>';
echo '<th  >Timeline Name</th>';
echo '<th  align="center">Timeline Status - Active</th>';
echo '<th align="center">Action</th>';
echo '<th align="center">Build Sequence Detail</th>';
echo '</tr>';

$x=0;
if ($dbSingleUse->Query($query)) { 
	while ($timelineMaster = $dbSingleUse->Row()) {
		$x = $x + 1;
		if ($myEditAction == 'EditSingleTimelineMaster') {
			$timelineMasterName = $timelineMaster->timelineMasterName;
			$timelineIsActive = $timelineMaster->timelineIsActive;
			$timelineMasterID = $timelineMaster->timelineMasterID;
		}
		else
		{
			echo '<tr>';
	    	echo '<td align="center">'.nullToChar($timelineMaster->timelineMasterName,'-').'</td>';
			echo '<td align="center">';
			echo '<input name="timelineIsActive" id="timelineIsActive" type="checkbox" value="1" disabled="disabled" ';
			if ($timelineMaster->timelineIsActive == 1) {
				echo ' checked="checked" ';
			}
			echo '/>';
			echo '</td>';
			echo '<td align="center"><big><a href="index.php?myAction=Maintenance&myEditAction=EditSingleTimelineMaster&timelineMasterID='.$timelineMaster->timelineMasterID.'">Edit</a></big></td>';
			echo '<td align="center"><big><a href="index.php?myAction=Maintenance&myEditAction=EditTimelineSequences&timelineMasterID='.$timelineMaster->timelineMasterID.'">Manage Sequences</a></big></td>';
			echo '</tr>';
		}
	}
} 
?>

<tr><td align="center">
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="<?php if ($myEditAction == 'EditSingleTimelineMaster') { echo 'SaveTimelineMaster'; } else { echo 'AddTimelineMaster'; } ?>" />
    <input name="timelineMasterID" type="hidden"  value="<?php if ($myEditAction == 'EditSingleTimelineMaster') { echo $timelineMasterID; } ?>" />
    <?php if ($myEditAction == 'EditSingleTimelineMaster') { echo $timelineMasterName; } ?>
    <input type="text" id="timelineMasterName"  name="timelineMasterName" value="<?php if ($myEditAction == 'EditSingleTimelineMaster') { echo htmlspecialchars($timelineMasterName); } ?>" size="30" maxlength="30" onkeypress="return isAlphaNumberKey(event);" /> 
 <?php if ($myEditAction == 'EditSingleTimelineMaster') {echo '<b><big>'.htmlspecialchars($timelineMasterName).'</b></big>';} ?>
 </td>
  <td align="center">
 <input name="timelineIsActive" id="timelineIsActive" type="checkbox" value="1"  
<?php			if ($myEditAction == 'EditSingleTimelineMaster') {
					if ($timelineIsActive== 1) {
						echo ' checked="checked" ';
					}
				}
				else {
						echo ' checked="checked" ';
				}
			?>
/>
 </td>
 <td>
 </td>

<td align="right">
     	<button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 60px;"><?php if ($myEditAction == 'EditSingleTimelineMaster') {echo '  Save ';} else {echo '  Add  ';} ?></button>

            </td></tr>

</form>
<tr>
    <td colspan = "5" align="right"><form action="index.php?myAction=Maintenance" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <?php if ($myEditAction == 'EditSingleTimelineMaster') {
		echo '<input name="myEditAction" type="hidden" id="myEditAction" value="EditBuildTimeline" />';
	}?>
    <button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges" style="width: 60px;"><?php if ($myEditAction == 'EditSingleTimelineMaster') {echo 'Cancel';} else {echo 'Return';}?></button></form> </td>
</tr>

</table>


	



