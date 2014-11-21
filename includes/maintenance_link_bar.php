<?php


function buildMaintenanceBar ($displayValue, $editAction, $siteShortName, $lotNumber) {

echo '<td><a href="index.php?myAction=Maintenance&myEditAction='.$editAction;
echo '&siteShortName='.$siteShortName;
echo '">';
echo $displayValue.'</a></td>';

}

echo '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableSitesMenu">';
echo  '<tr>';
buildMaintenanceBar ('Edit Sites','EditSite', $siteShortName, null) ;
buildMaintenanceBar ('Edit Lots','EditLot', $siteShortName, null) ;
buildMaintenanceBar ('Edit Models','EditModels',  $siteShortName, null) ;
buildMaintenanceBar ('Edit Features','EditFeatures', null, null) ;
buildMaintenanceBar ('Edit Build Timelines','EditBuildTimeline', null, null) ;
if ($securityCanManageUsers) {
	buildMaintenanceBar ('Edit Users','EditUsers', null, null) ;
}
buildMaintenanceBar ('Offer Templates','OfferTemplates', null, null) ;
echo '</tr>';
echo '</table>';

?>
