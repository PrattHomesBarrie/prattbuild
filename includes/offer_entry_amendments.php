<script>
function clearData(pInput) {
 if (pInput == 'dateDocumentSigned') {
 	document.forms["AmendmentMainForm"].elements["dateDocumentSigned"].value = '';
 	document.forms["AmendmentMainForm"].elements["dateDocumentSignedDisplay"].value = '';
 }
}

 </script>
<table class="tableOfferEntry" width="100%" border="1" cellspacing="1" cellpadding="1" align="left">
<form action="" method="post" name="AmendmentMainForm" target="_self" onsubmit="return checkFormData(this)">

<?php 
$query = 'select *
			from offerAmendments 	
				where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;

if ($myEditAction == 'EditSingleAmendment') {
	$query = $query.' and id = '.$_GET["amendmentId"];
}

$query = $query.' order by id asc';
//echo $query;

//echo '<tr><td colspan="4"><h1>Edit Offer Amendments</h1></td></tr>';
echo '<tr>';
echo '<th >Print?</th>';
echo '<th width="48%" >Amendment Detail</th>';
if ($securityLevelOneCheck) {
	echo '<th width="12%" >Price</th>';
}
echo '<th width="16%" >Signed Date</th>';
echo '<th width="10%" >Date Added</th>';
echo '<th>Action</th>';
echo '</tr>';

if ($g_UseOfferOverrideDateFunctionality) {
	$areAmendmentChangesAllowed = areOfferChangesAllowed($dbSingleUse, $lotNumber, $siteShortName);
}
else {
	$areAmendmentChangesAllowed = true;
}
$x=0;
if ($dbSingleUse->Query($query)) { 
	while ($rowFeatures = $dbSingleUse->Row()) {
		$x = $x + 1;
		if ($myEditAction == 'EditSingleAmendment') {
			$printThisItem = $rowFeatures->printThisItem;
			$amendmentDescription = $rowFeatures->amendmentDescription;
			$amendmentResalePrice =  $rowFeatures->amendmentResalePrice;
			$dateDocumentSigned = $rowFeatures->dateDocumentSigned;
			$amendmentAddedDate = $rowFeatures->amendmentAddedDate;
			$amendmentId = $rowFeatures->id;
		}
		else
		{
			echo '<tr>';
    		echo '<td>';
			if ($rowFeatures->printThisItem == 1) { echo $printThisItem.'Yes'; } else { echo $printThisItem.'No'; }
			echo '</td>';
	    	echo '<td>'.nullToChar($rowFeatures->amendmentDescription,'-').'</td>';
			if ($securityLevelOneCheck) {
		    	echo '<td  align="right">$';
				echo $rowFeatures->amendmentResalePrice;
				echo '</td>';
			}
    		echo '<td>'.nullToChar(formatDateForHTML($rowFeatures->dateDocumentSigned,'-'),'-').'</td>';
	    	echo '<td>'.nullToChar(formatDateForHTML($rowFeatures->amendmentAddedDate,'-'),'-').'</td>';
			if ($areAmendmentChangesAllowed == true) {
				echo '<td><big><a href="index.php?myAction=EditOffer&myEditAction=EditSingleAmendment&amendmentId='.$rowFeatures->id.'">Edit</a></big></td>';
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
    <input name="myEditAction" type="hidden" id="myEditAction" value="<?php if ($myEditAction == 'EditSingleAmendment') { echo 'SaveAmendment'; } else { echo 'AddAmendment'; } ?>" />
    <input name="amendmentId" type="hidden" id="amendmentId" value="<?php echo $amendmentId; ?>" />
<tr>
<td> <input name="printThisItem" type="checkbox" id="printThisItem" value="1" <?php if ($myEditAction == 'EditSingleAmendment') { if ($printThisItem == 1) { echo ' checked="checked" '; }} else {  echo ' checked="checked" '; } ?> />  </td>



<td>
<style>
	.ui-autocomplete-category {
		font-weight: bold;
		padding: .2em .4em;
		margin: .8em 0 .2em;
		line-height: 1.5;
		font-size: 12px;
		text-decoration: underline; 
	}
	</style>
	<script>
	$.widget( "custom.catcomplete", $.ui.autocomplete, {
		_renderMenu: function( ul, items ) {
			var self = this,
				currentCategory = "";
			$.each( items, function( index, item ) {
				if ( item.category != currentCategory ) {
					ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
					currentCategory = item.category;
				}
				self._renderItem( ul, item );
			});
		}
	});
	</script>
	<script>
	$(function() {
		// don't know if this css does anything here

		$( "#amendmentDescription" ).catcomplete({
			delay: 0,
			//source: data,
			//autoFocus: true ,
			minLength: 0, 
			source: "webservice/json_data_service.php?currentField=featuresBoth&",
			select: function(event, ui){
				//$("#featureSubText").val(ui.item.featureName2);
				$("#amendmentResalePrice").val(ui.item.resalePrice);
				//doThis('Hello');
				//alert(ui.item.category);
			},
			change: function(event, ui) { 
				//$("#featureSubText").val(ui.item.featureName2);
				$("#amendmentResalePrice").val(ui.item.resalePrice);
				//alert(ui);
				}
		});
	});
	</script>

<label for="amendmentDescription"></label>
  <textarea name="amendmentDescription" id="amendmentDescription"  <?php  if ($areAmendmentChangesAllowed == false) { echo ' disabled="disabled" ';} ?>cols="45" rows="6" onClick="javascript:$(this).catcomplete('search','');"><?php echo $amendmentDescription; ?></textarea></td>
<td><input name="amendmentResalePrice" id="amendmentResalePrice" <?php  if ($areAmendmentChangesAllowed == false) { echo ' disabled="disabled" ';} ?>type="text" value="<?php echo $amendmentResalePrice; ?>" onkeypress="validateNumber(event)"  size="10" maxlength="13" /></td>
                  <td><SCRIPT>$(function() {
                       $("#dateDocumentSigned").datepicker({ 
					     altField: ('#dateDocumentSignedDisplay'),
					    numberOfMonths: 1,
						showOn: "button",
						changeMonth: true,
						changeYear: true,
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
  
  <td><?php if (isset($amendmentAddedDate)) {echo formatDateForHTML($amendmentAddedDate,'-');} ?></td>
<td>
<?php 
if ($areAmendmentChangesAllowed == true) {
    echo '<button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 60px;">';
    if ($myEditAction == 'EditSingleAmendment') {
        echo '  Save ';} else {echo '  Add  ';
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
if ($myEditAction == 'EditSingleAmendment') {
	echo '
	<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td rowspan="2"><form action="index.php?myAction=EditOffer" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="DeleteAmendment" />
	<input name="amendmentId" type="hidden" id="id" value="'.$amendmentId.'" />
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
    <?php if ($myEditAction == 'EditSingleAmendment') {
		echo '<input name="myEditAction" type="hidden" id="myEditAction" value="EditOfferAmendments" />';
	}?>
    <button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges" style="width: 60px;"><?php if ($myEditAction == 'EditSingleAmendment') {echo 'Cancel';} else {echo 'Return';}?></button></form> </td>
</tr>
<?php
echo '</table>'; 

	?>
