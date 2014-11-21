<?php
require_once('vars.php');
//echo $myAction;
require_once('check_session.php');
require_once ("classes/login_functions.php");
require_once ("classes/misc_functions.php");
require_once('initialize_logic.php');  // put here just in case the index doesn't have it
if ($debug == "Yes")
	{
	echo '<br>$myAction='.$myAction;
	echo '<br>$userName='.$userName;
	echo '<br>$validUser='.$validUser;
	echo '<br>sess myAction='. $_SESSION["myAction"];
	echo '<br>sess $userName='. $_SESSION["userName"];
	echo '<br>sess $validUser='. $_SESSION["validUser"];
	}
if ($myAction == 'login'){
			if (
				(strtolower($userName) == 'suegallant@pratthomes.ca')
				||
				(strtolower($userName) == 'lynn@pratthomes.ca')
				){
				$myAction = 'OfferDashboard';
			}
			else{
				$myAction = 'Lots';
			}
			
	//do nothing - done in initialize_logic.php
}
if ($validUser == true ) {
	/*if ($myAction !== 'Maintenance' and $myAction !== 'Marketing') { 
		include("site_link_bar.php");
	}*/
	include("site_link_bar.php");
	if ($updateLotWatch > '') {
		//echo "need to update lot:".$updateLotWatch;
		setLotWatch($dbSingleUse,$siteShortName,$updateLotWatch,$watchLot, $userName);
	}
	if ($updateLotClearingStatus > '') {
		//echo "need to update lot:".$updateLotWatch;
		setLotClearingStatus($dbSingleUse,$siteShortName,$lotNumber,$updateLotClearingStatus,$statusCheckBox, $userName);
	}
	if ($myAction == 'MySummary') 
		{
			require_once ("user_home_page.php");
		}
	else if ($myAction == 'AddDocument' ) 
		{
			require_once ("upload_document.php");
		}
	else if ($myAction == 'DeleteLotDocument' ) 
		{
			require_once ("upload_document.php");
		}
	else if ($myAction == 'ManageLotNotes' ) 
		{
			require_once ("manage_lot_notes.php");
		}
	else if ($myAction == 'AddLotNote' ) 
		{
			require_once ("manage_lot_notes.php");
		}
	else if ($myAction == 'SaveLotNote' ) 
		{
			require_once ("manage_lot_notes.php");
		}
	else if ($myAction == 'EditSingleLotNote' ) 
		{
			require_once ("manage_lot_notes.php");
		}
	else if ($myAction == 'DeleteSingleLotNote' ) 
		{
			require_once ("manage_lot_notes.php");
		}
	else if ($myAction == 'AddNote' ) 
		{
			require_once ("manage_notes.php");
		}
	else if ($myAction == 'APSDetails' ) 
		{
			require_once ("lot_aps_details_page.php");
		}
	else if ($myAction == 'ColourChart' ) 
		{
			require_once ("lot_colour_chart_print.php");
		}
	else if ($myAction == 'ServiceEntry' ) 
		{
			require_once ("lot_service_entry.php");
		}
	else if ($myAction == 'EditOffer' ) 
		{
			require_once ("offer_entry.php");
		}
	else if ($myAction == 'EditChart' ) 
		{
			require_once ("chart_entry.php");
		}
	else if ($myAction == 'Lot' ) 
		{
			require_once ("lot_details_page.php");
		}
	else if ($myAction == 'Maintenance' ) 
		{
			require_once ("maintenance.php");
		}
	else if ($myAction == 'Marketing' ) 
		{
			require_once ("marketing.php");
		}
	else if ($myAction == 'Construction' ) 
		{
			require_once ("construction.php");
		}
	else if ($myAction == 'Trade' ) 
		{
			require_once ("trade.php");
		}
	else if ($myAction == 'PO' ) 
		{
			require_once ("po.php");
		}
	else if ($myAction == 'Deficiency' ) 
		{
			require_once ("deficiency.php");
		}
	else if ($myAction == 'Notification' ) 
		{
			require_once ("notification.php");
		}
	else if ($myAction == 'AfterSS' ) 
		{
			require_once ("afterss.php");
		}
	else if ($myAction == 'Settings' ) 
		{
			require_once ("maint_settings.php");
		}
	else if ($myAction == 'MoveInsGrid' ) 
		{
			require_once ("stats_month_day_grid.php");
		}
	else if ($myAction == 'Activity' ) 
		{
			require_once ("activity_dashboard.php");
		}
	else if ($myAction == 'DepositTracking' ) 
		{
			require_once ("deposit_tracking.php");
		}
	else if ($myAction == 'NoteTracking' ) 
		{
			require_once ("note_tracking.php");
		}
	else if ($myAction == 'ServiceTracking' ) 
		{
			require_once ("service_tracking.php");
		}
	else if ($myAction == 'OfferDashboard' ) 
		{
			require_once ("offer_dashboard.php");
		}
	else if ($myAction == 'PostBuildLots' ) 
		{
			require_once ("site_lots_post_build_page.php");
		}
	else if ($myAction == 'ProcessUploadFile' ) 
		{
			require_once ("upload_document.php");
		}
	else if ($myAction == 'ChangeLotDocument' ) 
		{
			require_once ("upload_document.php");
		}
	else if ($myAction == 'SaveNewNote' ) 
		{
			require_once ("manage_notes.php");
		}
	else if ($myAction == 'Search' ) 
		{
			require_once ("search.php");
		}
	else if ($myAction == 'ShowHomes' ) 
		{
			require_once ("showhomes_page.php");
		}
	else if ($myAction == 'SpecHomes' ) 
		{
			require_once ("spechomes_page.php");
		}
	else if ($myAction == 'Sites' ) 
		{
			require_once ("site_list_page.php");
		}
	else if ($myAction == 'StatsWeekly' ) 
		{
			require_once ("stats_weekly_grid.php");
		}
	else if ($myAction == '' or $myAction == 'login' or $myAction == 'Lots' ) 
		{
			require_once ("site_lots_page.php");
		}
	else
	{
	require_once ("user_home_page.php");
	}
}
else
{
	if ($myAction == 'login')
		{
		 echo "<br>Login Failed.  Please try again";
		}

	// need to show login screen
	if ($myAction != 'Logout')
		{
			require_once("login_screen.php");
		}
	else 
		{
			header( "Location: index.php" );
		}
}

if ($debug == "Yes")
	{
	echo '<br>$myAction='.$myAction;
	echo '<br>$userName='.$userName;
	echo '<br>$validUser='.$validUser;
	echo '<br>sess myAction='. $_SESSION["myAction"];
	echo '<br>sess $userName='. $_SESSION["userName"];
	echo '<br>sess $validUser='. $_SESSION["validUser"];
	print_r($_SESSION);
	}


?>