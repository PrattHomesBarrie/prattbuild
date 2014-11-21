<?php

require_once ("classes/misc_functions.php");
require_once ("classes/login_functions.php");
require_once("javascripts/javascript_for_forms.php"); 
require_once('classes/report_replace_fields.php');
if (!$securityCanDoMaintenance) {
	exit;
}
//echo '</td></tr>';

	$includeFile2 = '';
	if (isset($myEditAction)) {
		if ($myEditAction == 'EditSite') {
			$reportDocumentHeaderTitle2 = 'Edit Sites';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_sites.php';
		}
		if ($myEditAction == 'EditModels') {
			$reportDocumentHeaderTitle2 = 'Edit Models';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_models.php';
		}
		if ($myEditAction == 'EditFeatures') {
			$reportDocumentHeaderTitle2 = 'Edit Features';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_features.php';
		}
		if ($myEditAction == 'EditBuildTimeline') {
			$reportDocumentHeaderTitle2 = 'Edit Build Timelines';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_build_timelines.php';
		}
		if ($myEditAction == 'EditTimelineSequences') {
			$reportDocumentHeaderTitle2 = 'Edit Build Sequences';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_build_timeline_sequences.php';
		}
		if ($myEditAction == 'EditUsers') {
			$reportDocumentHeaderTitle2 = 'Edit Users';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_users.php';
		}
		
		if ($myEditAction == 'ChooseSiteForLots') {
			$reportDocumentHeaderTitle2 = 'Edit Lots';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_lots.php';
		}
		if ($myEditAction == 'ChooseSiteForModels') {
			$reportDocumentHeaderTitle2 = 'Edit Models';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_models.php';
		}
		if ($myEditAction == 'EditLot') {
			$reportDocumentHeaderTitle2 = 'Edit Lots';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_lots.php';
		}
		if ($myEditAction == 'DeleteLot') {
			require_once ("maintenance_updates.php");
			$reportDocumentHeaderTitle2 = 'Edit Lots (deleting lot)';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_lots.php';
		}
		if ($myEditAction == 'EditSingleLot') {
			$reportDocumentHeaderTitle2 = 'Edit Lots';
			$includeFile = 'maint_lots.php';
		}
		if ($myEditAction == 'EditSingleSite') {
			$reportDocumentHeaderTitle2 = 'Edit Sites';
			$includeFile = 'maint_sites.php';
		}
		if ($myEditAction == 'EditSingleModel') {
			$reportDocumentHeaderTitle2 = 'Edit Models';
			$includeFile = 'maint_models.php';
		}
		if ($myEditAction == 'EditSingleFeature') {
			$reportDocumentHeaderTitle2 = 'Edit Features';
			$includeFile = 'maint_features.php';
		}
		if ($myEditAction == 'EditSingleTimelineMaster') {
			$reportDocumentHeaderTitle2 = 'Edit Timeline Master';
			$includeFile = 'maint_build_timelines.php';
		}
		if ($myEditAction == 'EditSingleBuildSequence') {
			$reportDocumentHeaderTitle2 = 'Edit Build Sequence';
			$includeFile = 'maint_build_timeline_sequences.php';
		}
		if ($myEditAction == 'EditSingleUser') {
			$reportDocumentHeaderTitle2 = 'Edit Users';
			$includeFile = 'maint_users.php';
		}
		if ($myEditAction == 'ConfirmDeleteUser') {
			$reportDocumentHeaderTitle2 = 'Confirm Delete Single User';
			//$includeFile = 'maintenance_link_bar.php';
			$includeFile = 'confirm_delete_user.php';
		}
		if ($myEditAction == 'DeleteSingleUser') {
			$reportDocumentHeaderTitle2 = 'Delete Single User';
			//$includeFile = 'maintenance_link_bar.php';
			require_once ("maintenance_updates.php");
			$includeFile = 'delete_user.php';
		}
		if ($myEditAction == 'SaveSite' || $myEditAction == 'AddSite' ) {
			require_once ("maintenance_updates.php");
			$reportDocumentHeaderTitle2 = 'Edit Sites';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_sites.php';
		}
		if ($myEditAction == 'SaveLot' || $myEditAction == 'AddLot' ) {
			require_once ("maintenance_updates.php");
			$reportDocumentHeaderTitle2 = 'Edit Lots';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_lots.php';
		}
		if ($myEditAction == 'SaveFeature' || $myEditAction == 'AddFeature' ) {
			require_once ("maintenance_updates.php");
			$reportDocumentHeaderTitle2 = 'Edit Features';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_features.php';
		}
		if ($myEditAction == 'SaveTimelineMaster' || $myEditAction == 'AddTimelineMaster' ) {
			require_once ("maintenance_updates.php");
			$reportDocumentHeaderTitle2 = 'Edit Build Timelines';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_build_timelines.php';
		}
		if ($myEditAction == 'SaveBuildSequence' || $myEditAction == 'AddBuildSequence' ) {
			require_once ("maintenance_updates.php");
			$reportDocumentHeaderTitle2 = 'Edit Build Sequences';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_build_timeline_sequences.php';
		}
		if ($myEditAction == 'SaveModel' || $myEditAction == 'AddModel' ) {
			require_once ("maintenance_updates.php");
			$reportDocumentHeaderTitle2 = 'Edit Models';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_models.php';
		}
		if ($myEditAction == 'SaveUser' || $myEditAction == 'AddUser' ) {
			require_once ("maintenance_updates.php");
			$reportDocumentHeaderTitle2 = 'Edit Users';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'maint_users.php';
		}
		if ($myEditAction == 'DeleteLot') {
			// no action for this yet
		}
		if ($myEditAction == 'DeleteModel') {
			$reportDocumentHeaderTitle2 = 'Edit Models';
			$includeFile = 'maint_models.php';
		}
		if ($myEditAction == 'OfferTemplates') {
			$reportDocumentHeaderTitle2 = 'Offer Templates';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'uploaded_templates.php';
		}
		if ($myEditAction == 'DeleteTemplate' ) {
			require_once ("maintenance_updates.php");
			$reportDocumentHeaderTitle2 = 'Offer Templates';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'uploaded_templates.php';
		}
		if ($myEditAction == 'AddTemplate') {
			$reportDocumentHeaderTitle2 = 'Offer Templates';
			$includeFile = 'maintenance_link_bar.php';
			$includeFile2 = 'uploaded_templates.php';
		}
	}
	else
	{
		$includeFile = 'maintenance_link_bar.php';
	}

?>

<table class="clsPrattTable" border="0" cellspacing="0"><tr><td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><u><h1><?php echo($reportDocumentHeaderTitle1); ?></h1></u>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><h1><?php echo($reportDocumentHeaderTitle2); ?></h1></td>
        </tr>
    </table></td>
    <td></td>
    <td></td>
  </tr>
</table>

<?php
	include ($includeFile);
	if ($includeFile2 > '') {
	include ($includeFile2);
	}


?>


</td>
</tr>
</table>