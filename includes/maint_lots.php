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
		$( "#lotType" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=lotType&site=<?php echo $siteShortName;?>&"
//		 }).focus(function(){             
  //          $(this).trigger('keydown.autocomplete'); 
		});
	});
	$(function() {
		$( "#munStreetAddress" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=munStreetAddress&site=<?php echo $siteShortName;?>&"
//		 }).focus(function(){             
  //          $(this).trigger('keydown.autocomplete'); 
		});
	});
	$(function() {
		$( "#planNumber" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=planNumber&site=<?php echo $siteShortName;?>&"
//		 }).focus(function(){             
  //          $(this).trigger('keydown.autocomplete'); 
		});
	});
	$(function() {
		$( "#city" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=lotCity&site=<?php echo $siteShortName;?>&"
//		 }).focus(function(){             
  //          $(this).trigger('keydown.autocomplete'); 
		});
	});
	$(function() {
		$( "#designatedModelName" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=models&site=<?php echo $siteShortName;?>&"
//		 }).click(function(){             
//            $(this).trigger('keydown.autocomplete'); 
		});
	});
	</script>

<p></p>
<form action="" method="get" name="ChooseSiteForLots" target="_self" >
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="ChooseSiteForLots" />

 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableSitesMenu">
 <tr>

<?php 

$currentSettingCheck = 'Show Parking Number';
$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
if ($settingValue == '1') {
	$parkingNumberStyle = '';
}
else {
	$parkingNumberStyle = 'style="display: none;"';
}

$x=0;  
$query = ' SELECT * FROM `sites`';
if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {
		$x = $x + 1;
		echo '<td>';
		echo '<label>';
        echo '<input type="radio" name="siteShortName" value="';
		echo $resultRow->siteShortName;
		echo '" id="siteShortName"';
		if ($siteShortName == null && $x == 1) {
			echo ' checked="checked" ';
			$siteShortName =  $resultRow->siteShortName;
		}
		if ($resultRow->siteShortName == $siteShortName) {
			echo ' checked="checked" ';
		}
		echo ' onclick="this.form.submit();"/>';
		if ($resultRow->siteShortName == $siteShortName) {
			echo '<b>';
		}
		echo $resultRow->siteName;
		if ($resultRow->siteShortName == $siteShortName) {
			echo '</b>';
		}
		echo '</label>';
	}
}

?>
</tr>
</table>
</form>
<table class="tableOfferEntry" width="1000%" border="1" cellspacing="1" cellpadding="0" align="left">
<form action="" method="post" name="LotsMainForm" target="_self" onsubmit="return checkFormData(this)">
<?php
$query = 'select l.*, btm.timelineMasterName
			from lots l left join buildTimelineMaster btm on l.timelineMasterID = btm.timelineMasterID
				where siteShortName = "'.$siteShortName.'"' ;

if ($myEditAction == 'EditSingleLot') {
	$query = $query.' and lotNumber = '.$_GET["lotNumber"];
}

$query = $query.' order by lotNumber asc';
//echo $query;

//echo '<tr><td colspan="4"><h1>Edit Offer Features</h1></td></tr>';
echo '<tr>';
echo '<th width="10px" >Lot #</th>';
echo '<th  align="center">Lot Type</th>';
echo '<th align="center">Size</th>';
echo '<th align="center">Plan</th>';
echo '<th width="140px" align="center" colspan="2">Address</th>';
echo '<th align="center">City</th>';
echo '<th align="center">Postal Code</th>';
echo '<th align="center" '.$parkingNumberStyle.'>Parking #</th>';
echo '<th align="center">Designated Model</th>';
echo '<th width="100px" align="center">Build Timeline</th>';
echo '<th align="center">Action</th>';
echo '</tr>';

$x=0;
if ($dbSingleUse->Query($query)) { 
	while ($lots = $dbSingleUse->Row()) {
		$x = $x + 1;
		if ($myEditAction == 'EditSingleLot') {
			$lotNumber = $lots->lotNumber;
			$lotType = $lots->lotType;
			$lotSize =  $lots->lotSize;
			$planNumber = $lots->planNumber;
			$munStreetNumber = $lots->munStreetNumber;
			$munStreetAddress = $lots->munStreetAddress;
			$city = $lots->city;
			$postalCode = $lots->postalCode;
			$parkingNumber = $lots->parkingNumber;
			$designatedModelName = $lots->designatedModelName;
			$timelineMasterID = $lots->timelineMasterID;
			$timelineMasterName = $lots->timelineMasterName;
			$lotID = $lots->lotID;
		}
		else
		{
			echo '<tr>';
	    	echo '<td><b>'.nullToChar($lots->lotNumber,'-').'</b></td>';
	    	echo '<td>'.nullToChar($lots->lotType,'-').'</td>';
	    	echo '<td>'.nullToChar($lots->lotSize,'-').'</td>';
	    	echo '<td>'.nullToChar($lots->planNumber,'-').'</td>';
	    	echo '<td>'.nullToChar($lots->munStreetNumber,'-').'</td>';
	    	echo '<td>'.nullToChar($lots->munStreetAddress,'-').'</td>';
	    	echo '<td>'.nullToChar($lots->city,'-').'</td>';
	    	echo '<td>'.nullToChar($lots->postalCode,'-').'</td>';
	    	echo '<td '.$parkingNumberStyle.'>'.nullToChar($lots->parkingNumber,'-').'</td>';
	    	echo '<td>'.nullToChar($lots->designatedModelName,'-').'</td>';
	    	echo '<td>'.nullToChar($lots->timelineMasterName,'-').'</td>';
			echo '<td align="center"><big><a href="index.php?myAction=Maintenance&myEditAction=EditSingleLot&lotNumber='.$lots->lotNumber.'">Edit</a></big></td>';
			echo '</tr>';
		}
	}
} 
?>

<tr><td>
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="<?php if ($myEditAction == 'EditSingleLot') { echo 'SaveLot'; } else { echo 'AddLot'; } ?>" />
    <input name="lotID" type="hidden" id="lotID" value="<?php echo $lotID; ?>" />
    <input name="siteShortName" type="hidden" id="siteShortName" value="<?php echo $siteShortName; ?>" />
    <input <?php if ($myEditAction == 'EditSingleLot') {echo 'type="hidden"';} ?> id="lotNumber"  name="lotNumber" value="<?php if ($myEditAction == 'EditSingleLot') { echo htmlspecialchars($lotNumber); } ?>" size="3" maxlength="5" onkeypress="validateNumber(event)"/> 
 <?php if ($myEditAction == 'EditSingleLot') {echo '<b><big>'.htmlspecialchars($lotNumber).'</b></big>';} ?>
 </td>
 <td><span class="ui-widget">
        <input id="lotType"  name="lotType" value="<?php echo htmlspecialchars($lotType);?>" size="6" maxlength="10" onClick="javascript:$(this).autocomplete('search','');"/>
      </span></td>                    
 <td> <input id="lotSize"  name="lotSize" value="<?php echo htmlspecialchars($lotSize);?>" size="1" maxlength="5" onkeypress="validateNumber(event)"/> </td>
 <td><span class="ui-widget">
        <input id="planNumber"  name="planNumber" value="<?php echo htmlspecialchars($planNumber);?>" size="8" maxlength="10" onClick="javascript:$(this).autocomplete('search','');"/>
      </span></td>                    
 <td> <input id="munStreetNumber"  name="munStreetNumber" value="<?php echo htmlspecialchars($munStreetNumber);?>" size="3" maxlength="10"/> </td>
 
 <td><span class="ui-widget">
        <input id="munStreetAddress"  name="munStreetAddress" value="<?php echo htmlspecialchars($munStreetAddress);?>" size="15" maxlength="50" onClick="javascript:$(this).autocomplete('search','');"/>
      </span></td>                    
 <td><span class="ui-widget">
        <input id="city"  name="city" value="<?php echo htmlspecialchars($city);?>" size="9" maxlength="10" onClick="javascript:$(this).autocomplete('search','');"/>
      </span></td>                    
 <td> <input id="postalCode"  name="postalCode" value="<?php echo htmlspecialchars($postalCode);?>" size="4" maxlength="7"/> </td>
 <td <?php echo $parkingNumberStyle; ?>> <input id="parkingNumber"  name="parkingNumber" value="<?php echo htmlspecialchars($parkingNumber);?>" size="3" maxlength="50"/> </td>
 <td><span class="ui-widget">
        <input id="designatedModelName"  name="designatedModelName" value="<?php echo htmlspecialchars($designatedModelName);?>" size="7" maxlength="50" onClick="javascript:$(this).autocomplete('search','');"/>
      </span></td>                    

 <td> <?php echo createHtmlTimelineComboBox($dbSingleUse, $timelineMasterID); echo '<br>'.$timelineMasterName; ?>
 	</td>
<td>
     	<button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 60px;"><?php if ($myEditAction == 'EditSingleLot') {echo '  Save ';} else {echo '  Add  ';} ?></button>

            </td></tr>

</form>
<tr>

    <td colspan="10" align="right"><br /><form action="index.php?myAction=Maintenance" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <?php if ($myEditAction == 'EditSingleLot') {
		echo '<input name="myEditAction" type="hidden" id="myEditAction" value="EditLot" />';
	}?>
    <button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges" style="width: 60px;"><?php if ($myEditAction == 'EditSingleLot') {echo 'Cancel';} else {echo 'Return';}?></button></form> </td>
</tr>
<tr>
 
    <td colspan="10" align="right"><br /><br /><form action="index.php?myAction=Maintenance" method="post" name="form3" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <input name="siteShortName" type="hidden" id="siteShortName" value="<?php echo $siteShortName; ?>" />
    <input name="lotNumber" type="hidden" id="lotID" value="<?php echo $lotNumber; ?>" />
    <?php if ($myEditAction == 'EditSingleLot') {
		echo '<input name="myEditAction" type="hidden" id="myEditAction" value="DeleteLot" />';
	}?>
    <?php if ($myEditAction == 'EditSingleLot') {
    	echo '<button type="submit" class="formbutton" name="deleteLot" id="deleteLot" onclick="return confirm('."'Are you sure you want to delete?'".')" style="width: 60px;" >Delete</button>'; }  ?>
		</form> </td>
</tr>
</table>



	



