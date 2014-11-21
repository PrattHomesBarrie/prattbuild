<script>
function clearData(pInput) {
 if (pInput == 'dateDocumentSigned') {
 	document.forms["ChangeOrderMainForm"].elements["dateDocumentSigned"].value = '';
 	document.forms["ChangeOrderMainForm"].elements["dateDocumentSignedDisplay"].value = '';
 }
}

 </script>
<table class="tableOfferEntry" width="100%" border="1" cellspacing="1" cellpadding="1" align="left">
<form action="" method="post" name="ChangeOrderMainForm" target="_self" onsubmit="return checkFormData(this)">

<?php 

$query = 'select *
			from offerChangeOrders 	
				where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;

if ($myEditAction == 'EditSingleChangeOrder') {
	$query = $query.' and id = '.$_GET["changeId"];
}

$query = $query.' order by id asc';
//echo $query;

//echo '<tr><td colspan="4"><h1>Edit Offer Change Orders</h1></td></tr>';
echo '<tr>';
echo '<th >Print?</th>';
echo '<th width="48%" >Change Detail</th>';
if ($securityLevelOneCheck) {
	echo '<th width="12%" align="center">Price</th>';
}
echo '<th width="16%" align="center">Signed Date</th>';
echo '<th width="10%" align="center">Date Added</th>';
echo '<th align="center">Action</th>';
echo '</tr>';
if ($g_UseOfferOverrideDateFunctionality) {
	$areChangeOrderChangesAllowed = areOfferChangesAllowed($dbSingleUse, $lotNumber, $siteShortName);
}
else {
	$areChangeOrderChangesAllowed = true;
}


$x=0;
if ($dbSingleUse->Query($query)) { 
	while ($rowFeatures = $dbSingleUse->Row()) {
		$x = $x + 1;
		if ($myEditAction == 'EditSingleChangeOrder') {
			$printThisItem = $rowFeatures->printThisItem;
			$changeDescription = $rowFeatures->changeDescription;
			$changePrice =  $rowFeatures->changePrice;
			$dateDocumentSigned = $rowFeatures->dateDocumentSigned;
			$changeAddedDate = $rowFeatures->changeAddedDate;
			$changeId = $rowFeatures->id;
		}
		else
		{
			echo '<tr>';
    		echo '<td>';
			if ($rowFeatures->printThisItem == 1) { echo $printThisItem.'Yes'; } else { echo $printThisItem.'No'; }
			echo '</td>';
	    	echo '<td>'.nullToChar($rowFeatures->changeDescription,'-').'</td>';
			if ($securityLevelOneCheck) {
		    	echo '<td  align="right">$';
				echo $rowFeatures->changePrice;
				echo '</td>';
			}
    		echo '<td>'.nullToChar(formatDateForHTML($rowFeatures->dateDocumentSigned,'-'),'-').'</td>';
	    	echo '<td>'.nullToChar(formatDateForHTML($rowFeatures->changeAddedDate,'-'),'-').'</td>';
			if ($areChangeOrderChangesAllowed == true) {
				echo '<td align="center"><big><a href="index.php?myAction=EditOffer&myEditAction=EditSingleChangeOrder&changeId='.$rowFeatures->id.'">Edit</a></big></td>';
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
    <input name="myEditAction" type="hidden" id="myEditAction" value="<?php if ($myEditAction == 'EditSingleChangeOrder') { echo 'SaveChangeOrder'; } else { echo 'AddChangeOrder'; } ?>" />
    <input name="changeId" type="hidden" id="changeId" value="<?php echo $changeId; ?>" />
<tr>
<td> <input name="printThisItem" type="checkbox" id="printThisItem" value="1" <?php if ($myEditAction == 'EditSingleChangeOrder') { if ($printThisItem == 1) { echo ' checked="checked" '; }} else {  echo ' checked="checked" '; } ?> />  </td>
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

		$( "#changeDescription" ).catcomplete({
			delay: 0,
			//source: data,
			//autoFocus: true ,
			minLength: 0, 
			source: "webservice/json_data_service.php?currentField=featuresBoth&",
			select: function(event, ui){
				//$("#featureSubText").val(ui.item.featureName2);
				$("#changePrice").val(ui.item.resalePrice);
				//doThis('Hello');
				//alert(ui.item.category);
			},
			change: function(event, ui) { 
				//$("#featureSubText").val(ui.item.featureName2);
				$("#changePrice").val(ui.item.resalePrice);
				//alert(ui);
				}
		});
	});
	</script>

<label for="changeDescription"></label>
  <textarea name="changeDescription" id="changeDescription" <?php  if ($areChangeOrderChangesAllowed == false) { echo ' disabled="disabled" ';} ?>cols="45" rows="6" onClick="javascript:$(this).catcomplete('search','');"><?php echo $changeDescription; ?></textarea></td>
<td><input name="changePrice" id="changePrice" type="text" <?php  if ($areChangeOrderChangesAllowed == false) { echo ' disabled="disabled" ';} ?> value="<?php echo $changePrice; ?>" onkeypress="validateNumber(event)"  size="10" maxlength="13" /></td>
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
  
  <td><?php if (isset($changeAddedDate)) {echo formatDateForHTML($changeAddedDate,'-');} ?></td>
<td>
<?php 
if ($areChangeOrderChangesAllowed == true) {
    echo '<button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 60px;">';
    if ($myEditAction == 'EditSingleChangeOrder') {
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
if ($myEditAction == 'EditSingleChangeOrder') {
	echo '
	<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td rowspan="2"><form action="index.php?myAction=EditOffer" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="DeleteChangeOrder" />
	<input name="changeId" type="hidden" id="id" value="'.$changeId.'" />
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
    <?php if ($myEditAction == 'EditSingleChangeOrder') {
		echo '<input name="myEditAction" type="hidden" id="myEditAction" value="EditOfferChangeOrders" />';
	}?>
    <button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges" style="width: 60px;"><?php if ($myEditAction == 'EditSingleChangeOrder') {echo 'Cancel';} else {echo 'Return';}?></button></form> </td>
</tr>
<?php
echo '</table>'; 

	?>
