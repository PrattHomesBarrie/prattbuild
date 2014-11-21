<?php
	if ($securityLevelOneCheck) {
		// all is good
	}
	else {
		exit;
	}
require_once ("classes/misc_functions.php");
//require_once("lot_filters_form.php");
echo "<br>";
echo '<h1><u>Offer Dashboard</u><small> (click on offer date to edit offer details)</small></h1>';
require_once ("offer_list_unsigned.php");
echo "<br>";

include ("offer_list_recent_offers.php");
echo "<br>";
require_once ("offer_list_unsigned_items.php");
echo "<br>";
/*
require_once ("activity_by_others.php");
echo "<br>";
require_once ("activity_by_me.php");
*/
?>