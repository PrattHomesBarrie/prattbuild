<tr>
<td valign="top" width="400" align="right"><strong>FINANCIAL INFORMATION</strong></td>
    <td></td>
    <td valign="top" colspan="2"  align="center"><strong>RENT TO OWN PAYMENTS</strong></td>
  </tr>
  <tr>
    <td valign="top" align="right">Deposit #1 Amount:</td>
    <td valign="top"><strong>$500.00</strong></td>
    <td align="right" valign="top">1:</td>
    <td valign="top"><strong><?php echo getOfferText($offerInfo,'rTOChequeAmt1'); ?></strong></td>
  </tr>
  <tr>
    <td valign="top" align="right">Deposit #1 Due Date:</td>
    <td width="300" valign="top"><strong><?php echo getOfferText($offerInfo,'offerDate'); ?></strong></td>
    <td align="right" valign="top">2:</td>
    <td valign="top"><strong><?php echo getOfferText($offerInfo,'rTOChequeAmt2'); ?></strong></td>
  </tr>
    <tr>
      <td valign="top" align="right">Deposit #2 Amount:</td>
    <td valign="top"><strong>$2000.00 (if not rto)</strong></td>
    <td align="right"valign="top">3:</td>
    <td valign="top"><strong><?php echo getOfferText($offerInfo,'rTOChequeAmt3'); ?></strong></td>
  <tr>
    <td valign="top" align="right">Deposit #2 Due Date:</td>
    <td valign="top"><strong><?php echo getOfferText($offerInfo,'offerPlus30Days',$dbSingleUse); ?></strong></td>
    <td align="right" valign="top">4:</td>
    <td valign="top"><strong><?php echo getOfferText($offerInfo,'rTOChequeAmt4'); ?></strong></td>
  </tr>
  <tr>
    <td valign="top" align="right">Deposit #3 Amount:</td>
    <td valign="top"><strong>$2500.00 (if not rto)</strong></td>
    <td align="right" valign="top">5:</td>
    <td valign="top"><strong><?php echo getOfferText($offerInfo,'rTOChequeAmt5'); ?></strong></td>
  </tr>
  <tr>
    <td valign="top" align="right">Deposit #3 Due Date:</td>
    <td valign="top"><strong><?php echo getOfferText($offerInfo,'offerPlus60Days',$dbSingleUse); ?></strong></td>
    <td align="right" valign="top">6:</td>
    <td valign="top"><strong><?php echo getOfferText($offerInfo,'rTOChequeAmt6'); ?></strong></td>
  </tr>