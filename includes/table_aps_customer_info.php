  <tr>
    <td valign="top" align="right"><strong>CUSTOMER INFORMATION</strong></td>
    <td  width="76" valign="top"><strong>&nbsp;</strong></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td valign="top" align="right">Customer Names:</td>
    <td colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'purchaserNameFull'); ?> </strong></td>
  </tr>
  <tr>
    <td valign="top" align="right">Customers Date of Birth:</td>
    <td colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'allBirthDates');  ?></strong></td>
  </tr>
  <tr>
    <td valign="top" align="right">Phone Numbers:</td>
    <td colspan="3" valign="top"><strong>(H)<?php echo getOfferText($offerInfo,'homePhone'); ?>, (W)<?php echo getOfferText($offerInfo,'workPhone'); ?>, (C)<?php echo getOfferText($offerInfo,'otherPhone'); ?></strong></td>
  </tr>
  <tr>
    <td valign="top" align="right">Customer Email:</td>
    <td colspan="3" valign="top"><strong><a href="mailto:<?php echo getOfferText($offerInfo,'email1'); ?> "><?php echo getOfferText($offerInfo,'email1'); ?></a></strong></td>
  </tr>
  <tr>
    <td valign="top" align="right">Customer Address:</td>
    <td colspan="3" valign="top"><strong><?php echo getOfferText($offerInfo,'clientAddress'); ?>,     <?php echo getOfferText($offerInfo,'clientCity'); ?>, <?php echo getOfferText($offerInfo,'clientProvince'); ?>, <?php echo getOfferText($offerInfo,'clientPostalCode'); ?></strong></td>
  </tr>
  <tr>
    <td valign="top" align="right">&nbsp;</td>
    <td valign="top"><strong>&nbsp;</strong></td>
  </tr>
