<?php  require_once('classes/report_replace_fields.php');?>
<table class="clsPrattTable" border="0" width="100%">
  <tr>
    <td colspan="2" valign="top" ><strong>CUSTOMER INFORMATION</strong></td>
  </tr>
  <tr>
    <td valign="top" align="right">Customer Names:</td>
    <td colspan="1" valign="top"><strong><?php echo getOfferText($offerInfo,'purchaserNameFull'); ?> </strong></td>
  </tr>
  <tr>
    <td valign="top" align="right">Phone Numbers:</td>
    <td colspan="1" valign="top"><strong>(H)<?php echo getOfferText($offerInfo,'homePhone'); ?>, (W)<?php echo getOfferText($offerInfo,'workPhone'); ?>, (C)<?php echo getOfferText($offerInfo,'otherPhone'); ?></strong></td>
  </tr>
  <tr>
    <td valign="top" align="right">Customer Email:</td>
    <td colspan="1" valign="top"><strong><a href="mailto:<?php echo getOfferText($offerInfo,'email1'); ?> "><?php echo getOfferText($offerInfo,'email1'); ?></a></strong></td>
  </tr>
 
</table>
