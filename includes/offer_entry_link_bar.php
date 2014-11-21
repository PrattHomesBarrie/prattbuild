<?php


function buildOfferEditLinkBar ($displayValue, $editAction, $siteShortName, $lotNumber) {

echo '<td><a href="index.php?myAction=EditOffer&myEditAction='.$editAction;
echo '&siteShortName='.$siteShortName;
echo '&lotNumber='.$lotNumber.'">';
echo $displayValue.'</a></td>';

}

echo '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableSitesMenu">';
echo  '<tr>';
buildOfferEditLinkBar ('Customer Details','EditCustomer', $siteShortName, $lotNumber) ;
buildOfferEditLinkBar ('Dates/Financial','EditCoreOffer', $siteShortName, $lotNumber) ;
buildOfferEditLinkBar ('Extras','EditOfferFeatures', $siteShortName, $lotNumber) ;
buildOfferEditLinkBar ('Amendments','EditOfferAmendments', $siteShortName, $lotNumber) ;
buildOfferEditLinkBar ('Work Credits','EditOfferWorkCredits', $siteShortName, $lotNumber) ;
buildOfferEditLinkBar ('Change Orders','EditOfferChangeOrders', $siteShortName, $lotNumber) ;
buildOfferEditLinkBar ('Deposits','EditOfferDeposits', $siteShortName, $lotNumber) ;
buildOfferEditLinkBar ('Print Forms','PrintOfferForms', $siteShortName, $lotNumber) ;
echo '</tr>';
echo '</table>';

?>
