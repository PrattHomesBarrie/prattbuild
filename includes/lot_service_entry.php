<?php

require_once ("classes/misc_functions.php");
require_once ("classes/login_functions.php");
require_once("javascripts/javascript_for_forms.php"); 
require_once('classes/report_replace_fields.php');

$includeFile2 = '';
//	echo '<br />'.$myEditAction;
if (isset($myEditAction)) {
	if ($myEditAction == 'SaveCustomer') {
		require_once ("lot_service_updates.php");
		$reportDocumentHeaderTitle2 = 'Edit Customer Details';
	}
}
else
{
}


require_once ("lot_service_details.php");
	
	
?>

