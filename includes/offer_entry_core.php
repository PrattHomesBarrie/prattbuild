<?php  require_once('classes/report_replace_fields.php');

$currentSettingCheck = 'Show Occupancy Fee on Offer Screen';
$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
if ($settingValue == '1') {
	$occupancyFeeStyle = '';
}
else {
	$occupancyFeeStyle = 'style="display: none;"';
}
$currentSettingCheck = 'Amendments Add to Offer Total';
$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
if ($settingValue == '1') {
	$amendmentTotalStyle = '';
}
else {
	$amendmentTotalStyle = 'style="display: none;"';
}
$currentSettingCheck = 'Show Front Door';
$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
if ($settingValue == '1') {
	$frontDoorStyle = '';
}
else {
	$frontDoorStyle = 'style="display: none;"';
}
$currentSettingCheck = 'Show Investment Property';
$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
if ($settingValue == '1') {
	$investmentPropertyStyle = '';
}
else {
	$investmentPropertyStyle = 'style="display: none;"';
}

?>
<script>



function updateOfferNumbers()
 {


	newText = formatCurrency(
								parseFloat(document.forms["CoreOfferForm"].elements["offerPrice"].value)
								+
								parseFloat(document.forms["CoreOfferForm"].elements["offerSumOfFeatures"].value)
								-
								parseFloat(document.forms["CoreOfferForm"].elements["offerDiscountAmount"].value)
								);
   $('.offerAmountText').text(newText);

	newText = formatCurrency(
								parseFloat(document.forms["CoreOfferForm"].elements["offerPrice"].value)
								+
								parseFloat(document.forms["CoreOfferForm"].elements["offerSumOfFeatures"].value)
								+
								parseFloat(document.forms["CoreOfferForm"].elements["offerSumOfAmendments"].value)
								-
								parseFloat(document.forms["CoreOfferForm"].elements["offerDiscountAmount"].value)
								);
   $('.offerAmountWithAmendmentsText').text(newText);

	newText = formatCurrency(
								parseFloat(document.forms["CoreOfferForm"].elements["offerPrice"].value)
								+
								parseFloat(document.forms["CoreOfferForm"].elements["offerSumOfFeatures"].value)
								);
								//alert(document.forms["CoreOfferForm"].elements["offerSumOfFeatures"].value);
   $('.offerMSRPText').text(newText);
    if (document.forms["CoreOfferForm"].elements["offerSumOfFeatures"].value > 0) {
		newText = '(' + formatDecimal(
								parseFloat(document.forms["CoreOfferForm"].elements["offerDiscountAmount"].value)
								/
								parseFloat(document.forms["CoreOfferForm"].elements["offerSumOfFeaturesDiscountAllowed"].value)
								* 
								100
								) + ')';
	}
	else
	{
		newText = '(0)';
	}
   $('.offerDiscountPercentText').text(newText);

	newText = formatCurrency(parseFloat(document.forms["CoreOfferForm"].elements["offerPrice"].value));
   $('.offerPriceText').text(newText);
	
	newText = formatCurrency(parseFloat(document.forms["CoreOfferForm"].elements["offerDiscountAmount"].value));
   $('.offerDiscountAmountText').text(newText);

	newText = formatCurrency(parseFloat(document.forms["CoreOfferForm"].elements["rentToOwnInitialDeposit"].value));
   $('.rentToOwnInitialDepositText').text(newText);

	newText = formatCurrency(parseFloat(document.forms["CoreOfferForm"].elements["rentToOwnSubsequentDeposits"].value));
   $('.rentToOwnSubsequentDepositsText').text(newText);

	newText = parseFloat(document.forms["CoreOfferForm"].elements["numberOfPayments"].value);
   $('.numberOfPaymentsText').text(newText);

	newText = formatCurrency(
								parseFloat(document.forms["CoreOfferForm"].elements["rentToOwnInitialDeposit"].value)
								+
								(parseFloat(document.forms["CoreOfferForm"].elements["rentToOwnSubsequentDeposits"].value)
								*
								 
									(
									parseFloat(document.forms["CoreOfferForm"].elements["numberOfPayments"].value)
									-
									1
									)
								 ) 
								);
   $('.sumOfRtoDepositsText').text(newText);

}

function confirmRentToOwn() {
	if (document.forms["CoreOfferForm"].elements["rentToOwn"].checked) {
	}
	else
	{
		if 	(confirm("Are you sure you want to clear any rent to own fields?")) {
		 	document.forms["CoreOfferForm"].elements["rentToOwnInitialDeposit"].value = '0';
		 	document.forms["CoreOfferForm"].elements["rentToOwnSubsequentDeposits"].value = '0';
		 	document.forms["CoreOfferForm"].elements["numberOfPayments"].value = '0';
			updateOfferNumbers();
		}
		else {
			document.forms["CoreOfferForm"].elements["rentToOwn"].checked = true;
		}

	}
}

function clearData(pInput) {
 if (pInput == 'offerDate') {
 	document.forms["CoreOfferForm"].elements["offerDate"].value = '';
 	document.forms["CoreOfferForm"].elements["offerDateDisplay"].value = '';
 }
 if (pInput == 'closingDate') {
 	document.forms["CoreOfferForm"].elements["closingDate"].value = '';
 	document.forms["CoreOfferForm"].elements["closingDateDisplay"].value = '';
 }
 if (pInput == 'occupancyDate') {
 	document.forms["CoreOfferForm"].elements["occupancyDate"].value = '';
 	document.forms["CoreOfferForm"].elements["occupancyDateDisplay"].value = '';
 }
 if (pInput == 'amendedClosingDate') {
 	document.forms["CoreOfferForm"].elements["amendedClosingDate"].value = '';
 	document.forms["CoreOfferForm"].elements["amendedClosingDateDisplay"].value = '';
 }
 if (pInput == 'amendedOccupancyDate') {
 	document.forms["CoreOfferForm"].elements["amendedOccupancyDate"].value = '';
 	document.forms["CoreOfferForm"].elements["amendedOccupancyDateDisplay"].value = '';
 }
 if (pInput == 'irrevocableDate') {
 	document.forms["CoreOfferForm"].elements["irrevocableDate"].value = '';
 	document.forms["CoreOfferForm"].elements["irrevocableDateDisplay"].value = '';
 }
 if (pInput == 'dateDocumentSigned') {
 	document.forms["CoreOfferForm"].elements["dateDocumentSigned"].value = '';
 	document.forms["CoreOfferForm"].elements["dateDocumentSignedDisplay"].value = '';
 }
 if (pInput == 'dateOverrideOfferChangesAllowed') {
 	document.forms["CoreOfferForm"].elements["dateOverrideOfferChangesAllowed"].value = '';
 	document.forms["CoreOfferForm"].elements["dateOverrideOfferChangesAllowedDisplay"].value = '';
 }


}

 </script>
<style>
.ui-autocomplete-loading { background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat; }
/*
#elevation { width: 20em; }
#modelName { width: 20em;  }
.ui-autocomplete-input {  FONT-SIZE: 8px; }
.ui-menu {  FONT-SIZE: 12px; }
*/

</style>

 <script>
	$(function() {
		$( "#modelName" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=models&site=<?php echo $siteShortName;?>&"
//		 }).click(function(){             
//            $(this).trigger('keydown.autocomplete'); 
		});
	});
	$(function() {
		$( "#elevation" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=elevation&site=<?php echo $siteShortName;?>&"
//		 }).focus(function(){             
  //          $(this).trigger('keydown.autocomplete'); 
		});
	});
	$(function() {
		$( "#frontDoor" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=frontDoor&site=<?php echo $siteShortName;?>&"
//		 }).focus(function(){             
  //          $(this).trigger('keydown.autocomplete'); 
		});
	});
	$(function() {
		$( "#garageSize" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=garageSize&site=<?php echo $siteShortName;?>&"
//		 }).focus(function(){             
  //          $(this).trigger('keydown.autocomplete'); 
		});
	});
	</script>


<table  class="tableOfferEntry">
<form action="" method="post" name="CoreOfferForm" target="_self" onsubmit="return checkFormData(this)">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="SaveCoreOffer" />
    <input name="offerSumOfFeatures" type="hidden" id="offerSumOfFeatures" value="<?php echo calcSumOfFeatures($dbSingleUse,$offerInfo->lotNumber, $offerInfo->siteShortName); ?>" />
    <input name="offerSumOfFeaturesDiscountAllowed" type="hidden" id="offerSumOfFeaturesDiscountAllowed" value="<?php echo calcSumOfFeaturesAllowingDiscount($dbSingleUse,$offerInfo->lotNumber, $offerInfo->siteShortName); ?>" />
    <input name="offerSumOfAmendments" type="hidden" id="offerSumOfAmendments" value="<?php echo calcSumOfAmendments($dbSingleUse,$offerInfo->lotNumber, $offerInfo->siteShortName); ?>" />

    <tr>
      <td class="offerEntryRightLabel"  >Model</td>
      <td>

	
<div class="demo">

<div class="ui-widget">
  <input id="modelName" name="modelName" value="<?php echo htmlspecialchars($offerInfo->modelName);?>" size="25" maxlength="50" onClick="javascript:$(this).autocomplete('search','');"><?php echo htmlspecialchars($offerInfo->designatedModelName);?>
</div>

</div><!-- End demo -->

      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td  class="offerEntryRightLabel">Elevation</td>
      <td><span class="ui-widget">
        <input id="elevation" name="elevation" value="<?php echo htmlspecialchars($offerInfo->elevation);?>" size="25" maxlength="50" onClick="javascript:$(this).autocomplete('search','');"/>
      </span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr <?php echo $frontDoorStyle; ?> >
      <td  class="offerEntryRightLabel">Front Door</td>
      <td><span class="ui-widget">
        <input id="frontDoor" name="frontDoor" value="<?php echo htmlspecialchars($offerInfo->frontDoor);?>" size="25" maxlength="50" onClick="javascript:$(this).autocomplete('search','');"/>
      </span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td  class="offerEntryRightLabel">Garage Size</td>
      <td><span class="ui-widget">
        <input id="garageSize" name="garageSize" value="<?php echo htmlspecialchars($offerInfo->garageSize);?>" size="25" maxlength="50" onClick="javascript:$(this).autocomplete('search','');"/>
      </span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td  class="offerEntryRightLabel">Number Of Bedrooms</td>
      <td>
        <input name="numberOfBedrooms" id="numberOfBedrooms" value="<?php echo $offerInfo->numberOfBedrooms;?>" size="5" maxlength="10" onkeypress="validateNumber(event)"/>
      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td  class="offerEntryRightLabel">Lawyer</td>
      <td>
        <input name="lawyer" id="lawyer" value="<?php echo $offerInfo->lawyer;?>" size="30" maxlength="60" />
      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td colspan="4">
    <table class="tableOfferEntry">
    <tr><td align="center">  </td></tr>
    </table>
    </td>
    </tr>
     <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
       <td  class="offerEntryRightLabel">Offer Status</td>
       <td colspan="3">
         <table width="150">
    <tr >
      <td 
      	<?php
        	if ($offerInfo->offerStatus == 'Firm') {echo ' bgcolor="#00FF99"';}
		?>
		>
        <input name="offerStatus" type="radio" id="offerStatus_0" value="Firm" 
		<?php  
				if ($offerInfo->offerStatus == 'Firm') {echo ' checked="checked"';}
		?> 
         >
         <label for="offerStatus_0">Firm</label>

        
      </td>
      <td  
      	<?php
        	if ($offerInfo->offerStatus == 'Tentative') {echo ' bgcolor="#FFCC66"';}
		?>
		>
        <input type="radio" name="offerStatus" value="Tentative" id="offerStatus_1" 
	  	<?php  
				if ($offerInfo->offerStatus == 'Tentative') {echo ' checked="checked"';}
		?> 
        >
         <label for="offerStatus_1">Tentative</label>
         <input name="offerStatusPrevious" type="hidden" id="offerStatusPrevious" value="<?php echo $offerInfo->offerStatus; ?>" />
	   </td>
    </tr>
  </table>
</td>
    </tr>
    <tr>
      <td  class="offerEntryRightLabel">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td  class="offerEntryRightLabel">Offer Date</td>
      <td>       <SCRIPT>$(function() {
                       $("#offerDate").datepicker({ 
					     altField: ('#offerDateDisplay'),
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
                        <IMG SRC="images/delete-icon.gif" name="a1" width="15" height="15"  border="0" usemap="#pswd" style="cursor:hand" 	onclick="clearData('offerDate')">
  <input name="offerDateDisplay" type="text" value="<?php if (isset($offerInfo->offerDate) &&  $offerInfo->offerDate > '0000-00-00') {echo date('d-M-Y',strtotime($offerInfo->offerDate));} ?>" id="offerDateDisplay" style="width:80px;" disabled="disabled"  />
  <input name="offerDate" type="hidden" value="<?php if (isset($offerInfo->offerDate) &&  $offerInfo->offerDate > '0000-00-00') {
	  echo date('d-M-Y',strtotime($offerInfo->offerDate)); }  ?>" id="offerDate" style="width:80px;"
   />
</td>
      <td></td>
      <td><?php  ?></td>
    </tr>
    <tr>
      <td class="offerEntryRightLabel">Closing Date</td>
      <td><script>$(function() {
                       $("#closingDate").datepicker({ 
					     altField: ('#closingDateDisplay'),
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
                        }); </script>
        <img src="images/delete-icon.gif" name="a1" width="15" height="15"  border="0" usemap="#pswd" id="a1" style="cursor:hand" 	onclick="clearData('closingDate')" />
        <input name="closingDateDisplay" type="text" value="<?php if (isset($offerInfo->closingDate) &&  $offerInfo->closingDate > '0000-00-00') {echo date('d-M-Y',strtotime($offerInfo->closingDate));} ?>" id="closingDateDisplay" style="width:80px;" disabled="disabled"  />
      <input name="closingDate" type="hidden" value="<?php if (isset($offerInfo->closingDate) &&  $offerInfo->closingDate > '0000-00-00') {
	  echo date('d-M-Y',strtotime($offerInfo->closingDate)); }  ?>" id="closingDate" style="width:80px;"
   /></td>
      <td class="offerEntryRightLabel">Amended Closing Date</td>
      <td><script>$(function() {
                       $("#amendedClosingDate").datepicker({ 
					     altField: ('#amendedClosingDateDisplay'),
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
                        }); </script><img src="images/delete-icon.gif" alt="" name="a1" width="15" height="15"  border="0" usemap="#pswd" id="a3" style="cursor:hand" 	onclick="clearData('amendedClosingDate')" />
        <input name="amendedClosingDateDisplay" type="text" value="<?php if (isset($offerInfo->amendedClosingDate) &&  $offerInfo->amendedClosingDate > '0000-00-00') {echo date('d-M-Y',strtotime($offerInfo->amendedClosingDate));} ?>" id="amendedClosingDateDisplay" style="width:80px;" disabled="disabled"  />
      <input name="amendedClosingDate" type="hidden" value="<?php if (isset($offerInfo->amendedClosingDate) &&  $offerInfo->amendedClosingDate > '0000-00-00') {
	  echo date('d-M-Y',strtotime($offerInfo->amendedClosingDate)); }  ?>" id="amendedClosingDate" style="width:80px;"
   /></td>
    </tr>
    <tr>
      <td class="offerEntryRightLabel">Occupancy Date</td>
      <td><script>$(function() {
                       $("#occupancyDate").datepicker({ 
					     altField: ('#occupancyDateDisplay'),
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
                        }); </script><img src="images/delete-icon.gif" name="a1" width="15" height="15"  border="0" usemap="#pswd" id="a2" style="cursor:hand" 	onclick="clearData('occupancyDate')" />
        <input name="occupancyDateDisplay" type="text" value="<?php if (isset($offerInfo->occupancyDate) &&  $offerInfo->occupancyDate > '0000-00-00') {echo date('d-M-Y',strtotime($offerInfo->occupancyDate));} ?>" id="occupancyDateDisplay" style="width:80px;" disabled="disabled"  />
      <input name="occupancyDate" type="hidden" value="<?php if (isset($offerInfo->occupancyDate) &&  $offerInfo->occupancyDate > '0000-00-00') {
	  echo date('d-M-Y',strtotime($offerInfo->occupancyDate)); }  ?>" id="occupancyDate" style="width:80px;"
   /></td>
      <td class="offerEntryRightLabel">Amended Occupancy Date</td>
      <td><script>$(function() {
                       $("#amendedOccupancyDate").datepicker({ 
					     altField: ('#amendedOccupancyDateDisplay'),
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
                        }); </script><img src="images/delete-icon.gif" name="a1" width="15" height="15"  border="0" usemap="#pswd" id="a2" style="cursor:hand" 	onclick="clearData('amendedOccupancyDate')" />
        <input name="amendedOccupancyDateDisplay" type="text" value="<?php if (isset($offerInfo->amendedOccupancyDate) &&  $offerInfo->amendedOccupancyDate > '0000-00-00') {echo date('d-M-Y',strtotime($offerInfo->amendedOccupancyDate));} ?>" id="amendedOccupancyDateDisplay" style="width:80px;" disabled="disabled"  />
      <input name="amendedOccupancyDate" type="hidden" value="<?php if (isset($offerInfo->amendedOccupancyDate) &&  $offerInfo->amendedOccupancyDate > '0000-00-00') {
	  echo date('d-M-Y',strtotime($offerInfo->amendedOccupancyDate)); }  ?>" id="amendedOccupancyDate" style="width:80px;"
   /></td>
    </tr>
    <tr>
      <td class="offerEntryRightLabel">Irrevocable Date</td>
            <td><script>$(function() {
                       $("#irrevocableDate").datepicker({ 
					     altField: ('#irrevocableDateDisplay'),
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
                        }); </script><img src="images/delete-icon.gif" alt="" name="a1" width="15" height="15"  border="0" usemap="#pswd" id="a3" style="cursor:hand" 	onclick="clearData('irrevocableDate')" />
        <input name="irrevocableDateDisplay" type="text" value="<?php if (isset($offerInfo->irrevocableDate) &&  $offerInfo->irrevocableDate > '0000-00-00') {echo date('d-M-Y',strtotime($offerInfo->irrevocableDate));} ?>" id="irrevocableDateDisplay" style="width:80px;" disabled="disabled"  />
      <input name="irrevocableDate" type="hidden" value="<?php if (isset($offerInfo->irrevocableDate) &&  $offerInfo->irrevocableDate> '0000-00-00') {
	  echo date('d-M-Y',strtotime($offerInfo->irrevocableDate)); }  ?>" id="irrevocableDate" style="width:80px;"
   /></td>

      <td>&nbsp;</td>
      <td></td>
    </tr>
    <tr>
      <td class="offerEntryRightLabel">Offer Signed Date</td>
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
                        }); 

                        
                        </SCRIPT>
  <IMG SRC="images/delete-icon.gif" name="a1" width="15" height="15"  border="0" usemap="#pswd" style="cursor:hand" 	onclick="clearData('dateDocumentSigned')">
  <input name="dateDocumentSignedDisplay" type="text" value="<?php if (isset($offerInfo->dateDocumentSigned)) {echo formatDateForHTML($offerInfo->dateDocumentSigned,NULL);} ?>" id="dateDocumentSignedDisplay" style="width:80px;" disabled="disabled"  />
  <input name="dateDocumentSigned" type="hidden" value="<?php if (isset($offerInfo->dateDocumentSigned)) {echo formatDateForHTML($offerInfo->dateDocumentSigned,NULL);} ?>" id="dateDocumentSigned" style="width:76px;" />
  <?php	if (isset($offerInfo->dateOverrideOfferChangesAllowed) && $offerInfo->dateOverrideOfferChangesAllowed > '0000-00-00') {
	  		//changes date has been overridden
  }
  else {
	  		//check for override
	  		if ($g_UseOfferOverrideDateFunctionality and areOfferChangesAllowed($dbSingleUse, $lotNumber, $siteShortName) == false)
	  	 		{ echo false;
				  echo '<img src="images/yield.png" width="15" height="15" alt="no changes, based on date offer signed!"/>';
	  			 } 
  }?></td>
      <td class="offerEntryRightLabel" <?php if ($g_UseOfferOverrideDateFunctionality == false) {  echo 'style="display:none"';} ?>>Offer Changes Override Date</td>
      <td <?php if ($g_UseOfferOverrideDateFunctionality == false) { echo 'style="display:none"';} ?>><?php if ($securityLevelOneCheck) { echo
	  				'<SCRIPT>$(function() {
                       $("#dateOverrideOfferChangesAllowed").datepicker({ 
					     altField: ('."'".'#dateOverrideOfferChangesAllowedDisplay'."'".'),
					    numberOfMonths: 1,
						showOn: "button",
						changeMonth: true,
						changeYear: true,
						buttonImage: "images/calendar.gif",
						yearRange: "c-80:c+10",
						buttonImageOnly: true,
                		showButtonPanel: true,
				        dateFormat: "dd-M-yy",
					    showAnim: "fadeIn"});
                        }); 

                        
                        </SCRIPT>
						'; }?>
						<?php if ($securityLevelOneCheck) { echo
'  <IMG SRC="images/delete-icon.gif" name="a1" width="15" height="15"  border="0" usemap="#pswd" style="cursor:hand" 	onclick="clearData('."'".'dateOverrideOfferChangesAllowed'."'".')">';} ?>
  <input name="dateOverrideOfferChangesAllowedDisplay" type="text" value="<?php if (isset($offerInfo->dateOverrideOfferChangesAllowed)) {echo formatDateForHTML($offerInfo->dateOverrideOfferChangesAllowed,NULL);} ?>" id="dateOverrideOfferChangesAllowedDisplay" style="width:80px;" disabled="disabled"  />
  <input name="dateOverrideOfferChangesAllowed" type="hidden" value="<?php if (isset($offerInfo->dateOverrideOfferChangesAllowed)) {echo formatDateForHTML($offerInfo->dateOverrideOfferChangesAllowed,NULL);} ?>" id="dateOverrideOfferChangesAllowed" style="width:76px;" />
  <?php if (isset($offerInfo->dateOverrideOfferChangesAllowed) && $offerInfo->dateOverrideOfferChangesAllowed > '0000-00-00') {
	  		//changes date has been overridden ,check for override
  		if (areOfferChangesAllowed($dbSingleUse, $lotNumber, $siteShortName) == false)
  	 		{ echo false;
			  echo '<img src="images/yield.png" width="15" height="15" alt="no changes, based on date offer signed!"/>';
			}
  }
  ?>
  </td>
    </tr>
   <tr>
    <td colspan="4">
    <table class="tableOfferEntry">
    <tr><td align="center">  </td></tr>
    </table>
    </td>
    </tr>
     <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
     <tr>
       <td class="offerEntryRightLabel">Base Price :</td>
		<td><table width="100%" cellspacing="0" cellpadding="0"><tr>
        <SCRIPT>
		                        

});
		</script>
       <td ><input name="offerPrice" id="offerPrice" type="text" value="<?php echo $offerInfo->offerPrice; ?>" onchange="updateOfferNumbers()" onkeypress="validateNumber(event)"  size="10" maxlength="13" /></td><td class="offerEntryRightLabel"><div class ="offerPriceText" id ="offerPriceText"><?php echo getOfferText($offerInfo,'offerBaseAmount',$dbSingleUse); ?></div></td>
	    </tr></table></td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
      <td class="offerEntryRightLabel">Extra's Total :</td>
      <td  class="offerEntryRightLabel"><?php echo getOfferText($offerInfo,'extrasSum',$dbSingleUse); ?></td>
       <td align="right" ><?php 
					$sumOfFeatures = calcSumOfFeatures($dbSingleUse,$offerInfo->lotNumber, $offerInfo->siteShortName);
	   				if ($sumOfFeatures == 0 && isset($offerInfo->offerDiscountAmount)) {
					//	echo '0.00';
					}
					else {
						if (isset($offerInfo->offerDiscountAmount) and $offerInfo->offerDiscountAmount !== 0) {

						//	echo number_format($offerInfo->offerDiscountAmount/$sumOfFeatures*100,2);
						}
					}
					
					?></td>
      <td  class="offerEntryLeftText"><table><tr><td><?php echo 'D'.getOfferText($offerInfo,'extrasSumAllowingDiscountInteger',$dbSingleUse);
	  									?> - </td><td><div class="offerDiscountPercentText"><b>
                                        (<?php 
					$sumOfFeaturesAllowingDiscount = calcSumOfFeaturesAllowingDiscount($dbSingleUse,$offerInfo->lotNumber, $offerInfo->siteShortName);
	   				if ($sumOfFeaturesAllowingDiscount == 0 && isset($offerInfo->offerDiscountAmount)) {
						echo 'N/A';
					}
					else {
						if (isset($offerInfo->offerDiscountAmount) and $offerInfo->offerDiscountAmount !== 0) {
							echo ''.number_format($offerInfo->offerDiscountAmount/$sumOfFeaturesAllowingDiscount*100,2).'';
						}
					}
					
					?>%)</b></div>
      </td></tr></table></td>
    
    </tr>
     <tr>
      <td class="offerEntryRightLabel">&nbsp;</td>
      <td class="offerEntryRightLabel">________________</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
       <td class="offerEntryRightLabel">MSRP :</td>
      <td class="offerEntryRightLabel"><div class="offerMSRPText"><?php echo getOfferText($offerInfo,'MSRP',$dbSingleUse); ?></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="offerEntryRightLabel">Actual Discount :</td>
		<td> <table width="100%" cellspacing="0" cellpadding="0">
             <tr>
               <td ><input name="offerDiscountAmount" id="offerDiscountAmount" type="text" value="<?php echo $offerInfo->offerDiscountAmount; ?>" onchange="updateOfferNumbers()" onkeypress="validateNumber(event)"  size="10" maxlength="13" /><td class="offerEntryLeftText"> </td>
                    <td class="offerEntryRightLabel"><div class="offerDiscountAmountText"><?php echo getOfferText($offerInfo,'discountActual',$dbSingleUse); ?></div></td>
	    </tr></table></td>
       <td class="offerEntryRightLabel">&nbsp;</td>
      <td class="offerEntryLeftText"><?php echo 'AD'.getOfferText($offerInfo,'discountAllowableInteger',$dbSingleUse);
	  									echo 'PCI'.getAvailableSiteDiscountInteger($dbSingleUse,$offerInfo->siteShortName); ?>
      </td>
    </tr>
     <tr>
      <td class="offerEntryRightLabel">&nbsp;</td>
      <td class="offerEntryRightLabel" >________________</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="offerEntryRightLabel">Offer Total :</td>
      <td class="offerEntryRightLabel"><div class="offerAmountText"><?php echo getOfferText($offerInfo,'offerAmount',$dbSingleUse); ?></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    <div >
     <tr>
      <td class="offerEntryRightLabel">&nbsp;</td>
      <td class="offerEntryRightLabel" ></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr <?php echo $amendmentTotalStyle; ?>>
      <td class="offerEntryRightLabel">Amendments Total :</td>
      <td  class="offerEntryRightLabel"><?php echo getOfferText($offerInfo,'amendmentsSum',$dbSingleUse); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
     <tr <?php echo $amendmentTotalStyle; ?>>
      <td class="offerEntryRightLabel">&nbsp;</td>
      <td class="offerEntryRightLabel" >________________</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr <?php echo $amendmentTotalStyle; ?>>
      <td class="offerEntryRightLabel">Offer Total with Amendments :</td>
      <td class="offerEntryRightLabel"><div class="offerAmountWithAmendmentsText"><?php echo getOfferText($offerInfo,'offerAmountWithAmendments',$dbSingleUse); ?></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
     <tr>
    <td colspan="4">
    <table class="tableOfferEntry">
    <tr><td align="center">  </td></tr>
    </table>
    </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="offerEntryRightLabel">Rent-To-Own :</td>
      <td> <input name="rentToOwn" type="checkbox" id="rentToOwn"  onclick="confirmRentToOwn(this)" value="1" <?php
	  				  if (
					  		( $offerInfo->rentToOwnInitialDeposit > 0)
						|| 	
							( $offerInfo->rentToOwnSubsequentDeposits > 0)
						) {
								 echo ' checked="checked" '; 
							}
						?> />      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
  	  <td class="offerEntryRightLabel">RTO Initial Deposit :</td>      
	<td><table width="100%" cellspacing="0" cellpadding="0"><tr>
       <td ><input name="rentToOwnInitialDeposit" id="rentToOwnInitialDeposit" type="text" value="<?php echo $offerInfo->rentToOwnInitialDeposit; ?>" onchange="updateOfferNumbers()" onkeypress="validateNumber(event)"  size="10" maxlength="13" /></td>
       <td class="offerEntryRightLabel"><div class="rentToOwnInitialDepositText"><?php echo getOfferText($offerInfo,'rTOChequeAmt1',$dbSingleUse); ?></div></td>
       </tr></table></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
  	  <td class="offerEntryRightLabel">RTO Remainder of Deposits :</td>      
	<td><table width="100%" cellspacing="0" cellpadding="0"><tr>
       <td ><input name="rentToOwnSubsequentDeposits" id="rentToOwnSubsequentDeposits" type="text" value="<?php echo $offerInfo->rentToOwnSubsequentDeposits; ?>" onchange="updateOfferNumbers()" onkeypress="validateNumber(event)"  size="10" maxlength="13" /></td>
       <td class="offerEntryRightLabel"><div class="rentToOwnSubsequentDepositsText"><?php echo getOfferText($offerInfo,'rtoSubsequentDeposits',$dbSingleUse); ?></div></td>
       </tr></table></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
  	  <td class="offerEntryRightLabel">Number of Payments :</td>      
	<td><table width="100%" cellspacing="0" cellpadding="0"><tr>
       <td ><input name="numberOfPayments" id="numberOfPayments" type="text" value="<?php echo $offerInfo->numberOfPayments; ?>" onchange="updateOfferNumbers()" onkeypress="validateNumber(event)"  size="10" maxlength="13" /></td>
       <td class="offerEntryRightLabel"><div class="numberOfPaymentsText"><?php echo $offerInfo->numberOfPayments; ?></div></td>
       </tr></table></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
     <tr>
      <td class="offerEntryRightLabel">&nbsp;</td>
      <td class="offerEntryRightLabel" >________________</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
  	  <td class="offerEntryRightLabel">Sum of Deposits :</td>      
      <td class="offerEntryRightLabel"><div class="sumOfRtoDepositsText" ><?php echo getOfferText($offerInfo,'sumOfRtoDeposits',$dbSingleUse); ?></div></td>
      <td>(including initial deposit)</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr <?php echo $occupancyFeeStyle; ?>>
      <td  class="offerEntryRightLabel">Occupancy Fee :</td>
       <td ><input name="occupancyFee" id="occupancyFee" type="text" value="<?php echo $offerInfo->occupancyFee; ?>"  onkeypress="validateNumber(event)"  size="10" maxlength="13" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td  class="offerEntryRightLabel">Paint and Clean :</td>
      <td> <input name="paintAndClean" type="checkbox" id="paintAndClean" value="1" <?php  if ($offerInfo->paintAndClean == 1) { echo ' checked="checked" '; } ?> />  </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr <?php echo $investmentPropertyStyle; ?>>
      <td  class="offerEntryRightLabel">Investment Property :</td>
      <td> <input name="investmentProperty" type="checkbox" id="investmentProperty" value="1" <?php  if ($offerInfo->investmentProperty == 1) { echo ' checked="checked" '; } ?> />  </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td colspan="4">
    <table class="tableOfferEntry">
    <tr><td align="center">  </td></tr>
    </table>
    </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    <td colspan="2"><button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 200px;">Save Offer Details</button></form></td>
      <td colspan="2"><form action="index.php?myAction=EditOffer" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" /><input name="myAction" type="hidden" id="myAction" value="EditOffer" /><button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges"  style="width: 200px;" />Cancel Changes</button></form> </td>
    </tr>
  </table>

<p>&nbsp;</p>
<p>&nbsp;</p>