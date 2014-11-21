 
<tr>
    <td width="29%" valign="top"  align="right">Base Price:</td>
    <td width="70%" colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'offerBaseAmount',$dbSingleUse); ?></strong></td>
  </tr>
  <tr>
    <td width="29%" valign="top"  align="right">Extra's Total:</td>
    <td width="70%" colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'extrasSum',$dbSingleUse); ?></strong></td>
  </tr>
  <tr>
    <td width="29%" valign="top"  align="right">MSRP:</td>
    <td width="70%" colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'MSRP',$dbSingleUse); ?></strong></td>
  </tr>
  <tr>
    <td width="29%" valign="top"  align="right"> Actual Discount:</td>
    <td width="70%" colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'discountActual',$dbSingleUse); ?></strong><?php echo '<td align="right"><small>   (AD'.getOfferText($offerInfo,'discountAllowableInteger',$dbSingleUse);
	  									echo 'PCI'.getAvailableSiteDiscountInteger($dbSingleUse,$offerInfo->siteShortName).')</small></td>'; ?></td>
  </tr>
    <tr>
    <td width="29%" valign="top">&nbsp;</td>
    <td width="70%" colspan="3" valign="top"><strong>&nbsp;</strong></td>
  </tr>
  <tr>
    <td width="29%" valign="top"  align="right">Asking Price:</td>
    <td width="70%" colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'offerAmount',$dbSingleUse); ?></strong></td>
  </tr>
<?php 
$currentSettingCheck = 'Amendments Add to Offer Total';
$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
if ($settingValue == '1') {
	$amendmentTotalStyle = '';
}
else {
	$amendmentTotalStyle = 'style="display: none;"';
}
?>
    <tr <?php echo $amendmentTotalStyle; ?>>
    <td width="29%" valign="top">&nbsp;</td>
    <td width="70%" colspan="3" valign="top"><strong>&nbsp;</strong></td>
  </tr>
    <tr <?php echo $amendmentTotalStyle; ?>>
    <td width="29%" valign="top"  align="right">Amendments:</td>
    <td width="70%" colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'amendmentsSum',$dbSingleUse); ?></strong></td>
  </tr>
    <tr <?php echo $amendmentTotalStyle; ?>>
    <td width="29%" valign="top">&nbsp;</td>
    <td width="70%" colspan="3" valign="top"><strong>&nbsp;</strong></td>
  </tr>
    <tr <?php echo $amendmentTotalStyle; ?>>
    <td width="29%" valign="top"  align="right">Asking Price with Amendments:</td>
    <td width="70%" colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'offerAmountWithAmendments',$dbSingleUse); ?></strong></td>
  </tr>
