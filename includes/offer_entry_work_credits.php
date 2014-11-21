<script>
function clearData(pInput) {
 if (pInput == 'dateDocumentSigned') {
 	document.forms["WorkCreditMainForm"].elements["dateDocumentSigned"].value = '';
 	document.forms["WorkCreditMainForm"].elements["dateDocumentSignedDisplay"].value = '';
 }
}

 </script>
<table class="tableOfferEntry" width="100%" border="1" cellspacing="1" cellpadding="1" align="left">
<form action="" method="post" name="WorkCreditMainForm" target="_self" onsubmit="return checkFormData(this)">

<?php 
$query = 'select *
			from offerWorkCredits 	
				where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;

if ($myEditAction == 'EditSingleWorkCredit') {
	$query = $query.' and id = '.$_GET["workCreditId"];
}

$query = $query.' order by id asc';
//echo $query;

//echo '<tr><td colspan="4"><h1>Edit Offer Work Credits</h1></td></tr>';
echo '<tr>';
echo '<th >Print?</th>';
echo '<th width="48%" >Work Credit Detail</th>';
if ($securityLevelOneCheck) {
	echo '<th width="12%" align="center">Price</th>';
}
echo '<th width="16%" align="center">Signed Date</th>';
echo '<th width="10%" align="center">Date Added</th>';
echo '<th align="center">Action</th>';
echo '</tr>';
if ($g_UseOfferOverrideDateFunctionality) {
	$areWorkCreditChangesAllowed = areOfferChangesAllowed($dbSingleUse, $lotNumber, $siteShortName);
}
else {
	$areWorkCreditChangesAllowed = true;
}


$x=0;
if ($dbSingleUse->Query($query)) { 
	while ($rowFeatures = $dbSingleUse->Row()) {
		$x = $x + 1;
		if ($myEditAction == 'EditSingleWorkCredit') {
			$printThisItem = $rowFeatures->printThisItem;
			$workCreditDescription = $rowFeatures->workCreditDescription;
			$workCreditPrice =  $rowFeatures->workCreditPrice;
			$dateDocumentSigned = $rowFeatures->dateDocumentSigned;
			$workCreditAddedDate = $rowFeatures->workCreditAddedDate;
			$workCreditId = $rowFeatures->id;
		}
		else
		{
			echo '<tr>';
    		echo '<td>';
			if ($rowFeatures->printThisItem == 1) { echo $printThisItem.'Yes'; } else { echo $printThisItem.'No'; }
			echo '</td>';
	    	echo '<td>'.nullToChar($rowFeatures->workCreditDescription,'-').'</td>';
			if ($securityLevelOneCheck) {
		    	echo '<td  align="right">$';
				echo $rowFeatures->workCreditPrice;
				echo '</td>';
			}
    		echo '<td>'.nullToChar(formatDateForHTML($rowFeatures->dateDocumentSigned,'-'),'-').'</td>';
	    	echo '<td>'.nullToChar(formatDateForHTML($rowFeatures->workCreditAddedDate,'-'),'-').'</td>';
			if ($areWorkCreditChangesAllowed == true) {
				echo '<td align="center"><big><a href="index.php?myAction=EditOffer&myEditAction=EditSingleWorkCredit&workCreditId='.$rowFeatures->id.'">Edit</a></big></td>';
			}
			else {
				echo '<td>No Changes</td>';
			}

			echo '</tr>';
		}
	}
} 


?>

<tr><td>&nbsp;</td></tr>
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="<?php if ($myEditAction == 'EditSingleWorkCredit') { echo 'SaveWorkCredit'; } else { echo 'AddWorkCredit'; } ?>" />
    <input name="workCreditId" type="hidden" id="workCreditId" value="<?php echo $workCreditId; ?>" />
<tr>
<td> <input name="printThisItem" type="checkbox" id="printThisItem" value="1" <?php if ($myEditAction == 'EditSingleWorkCredit') { if ($printThisItem == 1) { echo ' checked="checked" '; }} else {  echo ' checked="checked" '; } ?> />  </td>
<td><label for="workCreditDescription"></label>
  <textarea name="workCreditDescription" id="workCreditDescription" <?php  if ($areWorkCreditChangesAllowed == false) { echo ' disabled="disabled" ';} ?> cols="45" rows="6"><?php echo $workCreditDescription; ?></textarea></td>
<td><input name="workCreditPrice" id="workCreditPrice" type="text" <?php  if ($areWorkCreditChangesAllowed == false) { echo ' disabled="disabled" ';} ?> value="<?php echo $workCreditPrice; ?>" onkeypress="validateNumber(event)"  size="10" maxlength="13" /></td>
                  <td><SCRIPT>$(function() {
                       $("#dateDocumentSigned").datepicker({ 
					     altField: ('#dateDocumentSignedDisplay'),
					    numberOfMonths: 1,
						showOn: "button",
						workCreditMonth: true,
						workCreditYear: true,
						buttonImage: "images/calendar.gif",
						yearRange: 'c-80:c+10',
						buttonImageOnly: true,
                		showButtonPanel: true,
				        dateFormat: 'dd-M-yy',
					    showAnim: 'fadeIn'});
                        }); </SCRIPT>
  <IMG SRC="images/delete-icon.gif" name="a1" width="15" height="15"  border="0" usemap="#pswd" style="cursor:hand" 	onclick="clearData('dateDocumentSigned')">
  <input name="dateDocumentSignedDisplay" type="text" value="<?php if (isset($dateDocumentSigned)) {echo formatDateForHTML($dateDocumentSigned,NULL);} ?>" id="dateDocumentSignedDisplay" style="width:76px;" disabled="disabled"  />
  <input name="dateDocumentSigned" type="hidden" value="<?php if (isset($dateDocumentSigned)) {echo formatDateForHTML($dateDocumentSigned,NULL);} ?>" id="dateDocumentSigned" style="width:76px;" /></td>
  
  <td><?php if (isset($workCreditAddedDate)) {echo formatDateForHTML($workCreditAddedDate,'-');} ?></td>
<td>
<?php 
if ($areWorkCreditChangesAllowed == true) {
    echo '<button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 60px;">';
    if ($myEditAction == 'EditSingleWorkCredit') {
		echo '  Save ';
	} 
	else {
		echo '  Add  ';
	} 
    echo '</button>';
}
else {
	echo 'No Additions Allowed';
}
?>

            </td></tr>
<tr ><td></td></tr>
</form>
<?php 
if ($myEditAction == 'EditSingleWorkCredit') {
	echo '
	<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td rowspan="2"><form action="index.php?myAction=EditOffer" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="DeleteWorkCredit" />
	<input name="workCreditId" type="hidden" id="id" value="'.$workCreditId.'" />
	<button type="button" class="formbutton" name="delete" id="delete" onclick="if (confirm('."'Are you sure you want to delete?'".')) submit();"  style="width: 60px;">Delete</button>
	</form>
	</td>
</tr>
	<tr><td></td></tr>
';
}
?>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><form action="index.php?myAction=EditOffer" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <?php if ($myEditAction == 'EditSingleWorkCredit') {
		echo '<input name="myEditAction" type="hidden" id="myEditAction" value="EditOfferWorkCredits" />';
	}?>
    <button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges" style="width: 60px;"><?php if ($myEditAction == 'EditSingleWorkCredit') {echo 'Cancel';} else {echo 'Return';}?></button></form> </td>
</tr>
<?php
echo '</table>'; 

	?>
