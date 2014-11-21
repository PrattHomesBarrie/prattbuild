<?php  require_once('classes/report_replace_fields.php');?>
<table class="clsPrattTable" border="0" width="100%">
	  <?php if ($securityLevelOneCheck ) {
		   include("table_aps_customer_info.php"); 
	  }
	  ?>
	  <?php 
		$currentSettingCheck = 'Show Parking Number';
		$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
		if ($settingValue == '1') {
			$parkingNumberStyle = '';
		}
		else {
			$parkingNumberStyle = 'style="display: none;"';
		}
		$currentSettingCheck = 'Show Garage Size on APS';
		$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
		if ($settingValue == '1') {
			$garageSizeOnAPSStyle = '';
		}
		else {
			$garageSizeOnAPSStyle = 'style="display: none;"';
		}
		$currentSettingCheck = 'Show Front Door';
		$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
		if ($settingValue == '1') {
			$frontDoorStyle = '';
		}
		else {
			$frontDoorStyle = 'style="display: none;"';
		}
	  
	  if ($securityLevelOneCheck ) {
		 //  include("table_aps_financial.php"); 
	  }
	  ?>
  <tr>
    <td width="29%" valign="top" align="center"><strong>&nbsp;</strong></td>
    <td width="70%" colspan="3" valign="top"><strong>&nbsp;</strong></td>
  </tr>
  <tr>
    <td width="29%" valign="top"  align="right"><strong>LOT</strong><strong> INFORMATION</strong></td>
    <td width="70%" colspan="3" valign="top"><strong>&nbsp;</strong></td>
  </tr>
  <tr>
    <td width="29%" valign="top"  align="right">Lot:</td>
    <td width="70%" colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'lotNum'); ?> <?php echo getOfferText($offerInfo,'siteName'); ?></strong></td>
  </tr>
  <tr>
    <td width="29%" valign="top"  align="right">Lot Size:</td>
    <td width="70%" colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'lotSize'); ?></strong></td>
  </tr>
  <tr>
    <td width="29%" valign="top"  align="right">Address:</td>
    <td width="70%" colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'munStreetNumber'); ?> <?php echo getOfferText($offerInfo,'munStreetAddress'); ?> , <?php echo getOfferText($offerInfo,'postalCode'); ?></strong></td>
  </tr>
  <tr>
    <td width="29%" valign="top"  align="right">Plan Number:</td>
    <td width="70%" colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'planNumber'); ?></strong></td>
  </tr>
  <tr <?php echo $parkingNumberStyle;?>>
    <td width="29%" valign="top"  align="right">Parking Number:</td>
    <td width="70%" colspan="3" valign="top" ><strong><?php echo getOfferText($offerInfo,'parkingNumber'); ?></strong></td>
  </tr>
	  <tr>
    <td width="29%" valign="top"  align="right">&nbsp;</td>
    <td width="70%" colspan="3" valign="top"><strong>&nbsp;</strong></td>
  </tr>
  <tr>
    <td width="29%" valign="top"  align="right"><strong>OFFER DETAILS:</strong></td>
    <td width="70%" colspan="3" valign="top"><strong>&nbsp;</strong></td>
  </tr>
  <tr>
    <td width="29%" valign="top"  align="right">Model:</td>
    <td width="70%" colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'modelName'); ?></strong></td>
  </tr>
  <tr>
    <td width="29%" valign="top"  align="right">Elevation:</td>
    <td width="70%" colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'elevation'); ?></strong></td>
  </tr>
  <tr>
    <td width="29%" valign="top"  align="right">Bedrooms:</td>
    <td width="70%" colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'numberOfBedrooms'); ?></strong></td>
  </tr>
  <tr <?php echo $garageSizeOnAPSStyle;?>>
    <td width="29%" valign="top"  align="right">Garage Size:</td>
    <td width="70%" colspan="3" valign="top" ><strong><?php echo getOfferText($offerInfo,'garageSize'); ?></strong></td>
  </tr>
  <tr <?php echo $frontDoorStyle;?>>
    <td width="29%" valign="top"  align="right">Front Door:</td>
    <td width="70%" colspan="3" valign="top" ><strong><?php echo getOfferText($offerInfo,'frontDoor'); ?></strong></td>
  </tr>
	  <?php 	if ($g_AllowedToSeeOccCloseDates == true) {
		   	include "table_aps_dates.php" ;
	  }
	  ?>
	  <?php if ($securityLevelOneCheck ) {
		   include "table_aps_price.php" ;
	  }
	  ?>
 
</table>
