<style>
.ui-autocomplete-loading { background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat; }
.ui-autocomplete-input {  FONT-SIZE: 5px; }
.ui-menu {  FONT-SIZE: 12px; }
/*
#elevation { width: 20em; }
#modelName { width: 20em;  }
*/

</style>

 <script>

	$(function() {
		$( "#featureCategory" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=featureCategory&"
//		 }).focus(function(){             
  //          $(this).trigger('keydown.autocomplete'); 
		});
	});
	$(function() {
		$( "#featureName" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=featureName&"
//		 }).focus(function(){             
  //          $(this).trigger('keydown.autocomplete'); 
		});
	});
	$(function() {
		$( "#featureName2" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=featureName2&"
//		 }).focus(function(){             
  //          $(this).trigger('keydown.autocomplete'); 
		});
	});
	</script>

<table class="tableOfferEntry" width="100%" border="1" cellspacing="1" cellpadding="1" align="left">
<form action="" method="post" name="FeaturesMainForm" target="_self" onsubmit="return checkFormData(this)">
<?php
$query = 'select *
			from lookupFeatures	
				' ;

if ($myEditAction == 'EditSingleFeature') {
	$query = $query.' where featureID = '.$_GET["featureID"];
}

$query = $query.' order by featureCategory, featureName asc';
//echo $query;

//echo '<tr><td colspan="4"><h1>Edit Offer Features</h1></td></tr>';
echo '<tr>';
echo '<th  align="center">Category</th>';
echo '<th align="center">Feature</th>';
echo '<th align="center">Subtext</th>';
echo '<th align="center" >Resale Price</th>';
echo '<th align="center" >Discount<br />Allowed</th>';
echo '<th align="center">Action</th>';
echo '</tr>';

$x=0;
if ($dbSingleUse->Query($query)) { 
	while ($features = $dbSingleUse->Row()) {
		$x = $x + 1;
		
		if ($myEditAction == 'EditSingleFeature') {
			$featureID = $features->featureID;
			$featureCategory = $features->featureCategory;
			$featureName = $features->featureName;
			$featureName2 = $features->featureName2;
			$resalePrice =  $features->resalePrice;
			$discountAllowed =  $features->discountAllowed;
		}
		else
		{
			echo '<tr>';
	    	echo '<td>'.nullToChar($features->featureCategory,'-').'';
	    	echo '<td><b>'.nullToChar($features->featureName,'-').'</b>';
	    	echo '<td>'.nullToChar($features->featureName2,'-').'';
	    	echo '<td>'.nullToChar($features->resalePrice,'-').'';
			echo '<td align="center">';
			echo '<input name="discountAllowed" id="discountAllowed" type="checkbox" value="1" disabled="disabled" ';
			if ($features->discountAllowed == 1) {
				echo ' checked="checked" ';
			}
			echo '/>';
			echo '</td>';
			echo '<td align="center"><big><a href="index.php?myAction=Maintenance&myEditAction=EditSingleFeature&featureID='.$features->featureID.'">Edit</a></big></td>';
			echo '</tr>';
		}
	}
} 

?>

<tr><td>
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="<?php if ($myEditAction == 'EditSingleFeature') { echo 'SaveFeature'; } else { echo 'AddFeature'; } ?>" />
    <input name="featureID" type="hidden" id="featureID" value="<?php echo $featureID; ?>" />
</td></tr>
<tr>
 <td><span class="ui-widget">
        <input id="featureCategory"  name="featureCategory" value="<?php echo htmlspecialchars($featureCategory);?>" size="20" maxlength="50" onClick="javascript:$(this).autocomplete('search','');"/>
      </span></td>                    
 <td><span class="ui-widget">
        <input id="featureName"  name="featureName" value="<?php echo htmlspecialchars($featureName);?>" size="40" maxlength="100" onClick="javascript:$(this).autocomplete('search','');"/>
      </span></td>                    
 <td><span class="ui-widget">
        <input id="featureName2"  name="featureName2" value="<?php echo htmlspecialchars($featureName2);?>" size="40" maxlength="100" onClick="javascript:$(this).autocomplete('search','');"/>
      </span></td>                    
 <td> <input id="resalePrice"  name="resalePrice" value="<?php echo htmlspecialchars($resalePrice);?>" size="6" maxlength="10" onkeypress="validateCurrency(event)"/> </td>
 <td align="center">
 <input name="discountAllowed" id="discountAllowed" type="checkbox" value="1"  
<?php			if ($myEditAction == 'EditSingleFeature') {
					if ($discountAllowed == 1) {
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
     	<button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 60px;"><?php if ($myEditAction == 'EditSingleFeature') {echo '  Save ';} else {echo '  Add  ';} ?></button>

            </td></tr>
<tr ><td></td></tr>
</form>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><form action="index.php?myAction=Maintenance" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <?php if ($myEditAction == 'EditSingleFeature') {
		echo '<input name="myEditAction" type="hidden" id="myEditAction" value="EditFeatures" />';
	}?>
    <button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges" style="width: 60px;"><?php if ($myEditAction == 'EditSingleFeature') {echo 'Cancel';} else {echo 'Return';}?></button></form> </td>
</tr>
</table>