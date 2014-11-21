<script>
function clearData(pInput) {
 if (pInput == 'dateDocumentSigned') {
 	document.forms["FeatureMainForm"].elements["dateDocumentSigned"].value = '';
 	document.forms["FeatureMainForm"].elements["dateDocumentSignedDisplay"].value = '';
 }
}

 </script>
<table class="tableOfferEntry" width="100%" border="1" cellspacing="1" cellpadding="1" align="left">
<form action="" method="post" name="FeatureMainForm" target="_self" onsubmit="return checkFormData(this)">

<?php 

include("classes/offer_discount_values.php");

$query = 'select *
			from offerFeatures 	
				where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;

if ($myEditAction == 'EditSingleFeature') {
	$query = $query.' and id = '.$_GET["featureId"];
}

$query = $query.' order by id asc';
//echo $query;

//echo '<tr><td colspan="4"><h1>Edit Offer Features</h1></td></tr>';
echo '<tr>';
echo '<th width="50%" >Feature Text</th>';
echo '<th width="8%" align="center">Date Changed/Added</th>';
if ($securityLevelOneCheck) {
	echo '<th width="10%" align="center">MSRP</th>';
	echo '<th width="4%" align="center">Discount<br />Allowed?</th>';
	echo '<th width="10%" align="center">After Disc.</th>';
	echo '<th width="10%" align="center"';
	if ($g_UseFeatureLocking == false) {  echo 'style="display:none"';}
	echo '>Locked</th>';
	echo '<th align="center">Action</th>';
}
echo '</tr>';

$x=0;
if ($dbSingleUse->Query($query)) { 
	while ($rowFeatures = $dbSingleUse->Row()) {
		$x = $x + 1;
		if ($myEditAction == 'EditSingleFeature') {
			$featureText = $rowFeatures->featureText;
			$featureSubText = $rowFeatures->featureSubText;
			$featureResalePrice =  $rowFeatures->featureResalePrice;
			$featureAddedDate = $rowFeatures->featureAddedDate;
			$featureChangedDate = $rowFeatures->featureChangedDate;
			$featureDiscountAllowed = $rowFeatures->featureDiscountAllowed;
			$featureLocked = $rowFeatures->featureLocked;
			$featureId = $rowFeatures->id;
		}
		else
		{
			$featureAfterDiscount = 0;
			if ($sumResalePriceDiscoutAllowed > 0 and $rowFeatures->featureDiscountAllowed == 1) {
				$featureAfterDiscount = $rowFeatures->featureResalePrice - ( $offerDiscountAmount*($rowFeatures->featureResalePrice/$sumResalePriceDiscoutAllowed)) ;
			}
			else {
				$featureAfterDiscount = $rowFeatures->featureResalePrice ;
			}
			$sumDiscounts = $sumDiscounts + $featureAfterDiscount;			
			echo '<tr>';
	    	echo '<td><b>'.nullToChar($rowFeatures->featureText,'-').'</b>';
	    	echo '<br><small>'.nullToChar($rowFeatures->featureSubText,'-').'</small></td>';
	    	echo '<td>'.nullToChar(formatDateForHTML($rowFeatures->featureChangedDate,'-'),'-').'';
	    	echo '<br>'.nullToChar(formatDateForHTML($rowFeatures->featureAddedDate,'-'),'-').'</td>';
			if ($securityLevelOneCheck) {
		    	echo '<td  align="right"><b>$';
				echo $rowFeatures->featureResalePrice;
				echo '</b></td>';
				echo '<td align="center">';
				echo '<input name="discountAllowed" id="discountAllowed" type="checkbox" value="1" disabled="disabled" ';
				if ($rowFeatures->featureDiscountAllowed == 1) {
					echo ' checked="checked" ';
				}
				echo '/>';
				echo '</td>';
		    	echo '<td  align="right">$';
				echo money_format('%.2n',$featureAfterDiscount);
				echo '</td>';
				echo '<td align="center"';
				if ($g_UseFeatureLocking == false) {  echo 'style="display:none"';}
				echo '>';
				echo '<input name="featureLocked" id="featureLocked" type="checkbox" value="1" disabled="disabled" ';
				if ($rowFeatures->featureLocked == 1) {
					echo ' checked="checked" ';
				}
				echo '/>';
				echo '</td>';
				echo '<td align="center"><big>';
				if ($rowFeatures->featureLocked == 1 and $g_UseFeatureLocking == true ) {
					if ($securityCanLockFeature) {
						echo '<a href="index.php?myAction=EditOffer&myEditAction=EditSingleFeature&featureId='.$rowFeatures->id.'">Edit</a>';
					}
				}
				else {
					echo '<a href="index.php?myAction=EditOffer&myEditAction=EditSingleFeature&featureId='.$rowFeatures->id.'">Edit</a>';
				}
				echo '</big></td>';
			}
			else {
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
			}
			echo '</tr>';
		}
	}
} 


?>

<tr><td>
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="<?php if ($myEditAction == 'EditSingleFeature') { echo 'SaveFeature'; } else { echo 'AddFeature'; } ?>" />
    <input name="featureId" type="hidden" id="featureId" value="<?php echo $featureId; ?>" />
</td></tr>
<tr>
<td colspan="2">
     <script>
	function doThis(msg) {
		//alert(msg);
		
	}
	
	</script>

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

		$( "#featureText" ).catcomplete({
			delay: 0,
			//source: data,
			//autoFocus: true ,
			minLength: 0, 
			source: "webservice/json_data_service.php?currentField=features&",
			select: function(event, ui){
				$("#featureSubText").val(ui.item.featureName2);
				$("#featureResalePrice").val(ui.item.resalePrice);
				if (ui.item.discountAllowed == '1') {
					$("#featureDiscountAllowed").attr('checked',true);
				}
				else {
					$("#featureDiscountAllowed").attr('checked',false);
				}
				//alert(ui.item.discountAllowed);
				//doThis('Hello');
				//alert(ui.item.category);
			},
			change: function(event, ui) { 
//				$("#featureSubText").val('something here');
				$("#featureSubText").val(ui.item.featureName2);
				$("#featureResalePrice").val(ui.item.resalePrice);
				if (ui.item.discountAllowed == '1') {
					$("#featureDiscountAllowed").attr('checked',true);
				}
				else {
					$("#featureDiscountAllowed").attr('checked',false);
				}
				//alert(ui.item.discountAllowed);
				}
		});
	});
	</script>

<label for="featureText"></label>
  <textarea name="featureText" cols="70" rows="4" id="featureText" onClick="javascript:$(this).catcomplete('search','');" ><?php echo $featureText; ?></textarea>
<br /><label for="featureSubText"></label>
<textarea name="featureSubText" cols="70" rows="4" id="featureSubText">
<?php echo $featureSubText; ?></textarea></td>
<td><input name="featureResalePrice" id="featureResalePrice" type="text" value="<?php echo $featureResalePrice; ?>" onkeypress="validateNumber(event)"  size="10" maxlength="13" /></td>
 <td align="center">
 <input name="featureDiscountAllowed" id="featureDiscountAllowed" type="checkbox" value="1"  
<?php			if ($myEditAction == 'EditSingleFeature') {
					if ($featureDiscountAllowed == 1) {
						echo ' checked="checked" ';
					}
				}
				else {
						echo ' ';
				}
			?>
/>
 </td>
<td></td>                    
 <td align="center" <?php if ($g_UseFeatureLocking == false) {  echo 'style="display:none"';}  ?>>
 <input name="featureLocked" id="featureLocked" type="checkbox" value="1"  <?php  if ($securityCanLockFeature ==false) {echo ' disabled="disabled" '; }  ?>
 <?php			if ($myEditAction == 'EditSingleFeature') {
					if ($featureLocked == 1) {
						echo ' checked="checked" ';
					}
				}
				else {
						echo ' ';
				}
			?>
/>
 </td>
<td>
     	<button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 60px;"><?php if ($myEditAction == 'EditSingleFeature') {echo '  Save ';} else {echo '  Add  ';} ?></button>

            </td></tr>
<tr ><td></td></tr>
</form>
<?php 
if ($myEditAction == 'EditSingleFeature') {
	echo '
	<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>';
    echo '<td';
	if ($g_UseFeatureLocking == false) {  echo 'style="display:none"';}
	echo '></td>';
	
    echo '<td rowspan="2"><form action="index.php?myAction=EditOffer" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="DeleteFeature" />
	<input name="featureId" type="hidden" id="id" value="'.$featureId.'" />
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
    <td align="right"><?php	echo '$'.money_format('%.2n',$sumResalePrice); ?>
    <td></td>
    <td align="right"><?php	echo '$'.money_format('%.2n',$sumDiscounts).'<br>('.'$'.$offerDiscountAmount.')'; ?>
</td>
    <td	<?php if ($g_UseFeatureLocking == false) {  echo 'style="display:none"';}?>></td>
    <td><form action="index.php?myAction=EditOffer" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <?php if ($myEditAction == 'EditSingleFeature') {
		echo '<input name="myEditAction" type="hidden" id="myEditAction" value="EditOfferFeatures" />';
	}?>
    <button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges" style="width: 60px;"><?php if ($myEditAction == 'EditSingleFeature') {echo 'Cancel';} else {echo 'Return';}?></button></form> </td>
</tr>
</table>



	



