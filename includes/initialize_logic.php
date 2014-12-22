
<?php
//define('TIMEZONE', 'America/Toronto');  
//date_default_timezone_set(TIMEZONE);
//ini_set("date.timezone", "America/Toronto"); 
//date_default_timezone_set("America/Toronto"); 

require_once('check_session.php');
require_once('vars.php');
require_once("classes/mysql_ultimate.php"); 
require_once ("classes/login_functions.php");
$db = new MySQL(); 
$db2 = new MySQL(); 
$dbSingleUse = new MySQL(); 
$db->Query("SET time_zone = '-4:00';");
$db2->Query("SET time_zone = '-4:00';");
$dbSingleUse->Query("SET time_zone = '-4:00';");
//echo $myAction;
if ($myAction == 'login')
{
	$validUser = false;  //initialize it
	require_once("classes/login_functions.php"); 
	
	if (validateLogin($dbSingleUse, $loginUserName, $loginPassword))
		{
			$userName = $loginUserName;
			$validUser = true;
    	     $_SESSION["validUser"] = $validUser;
    	     $_SESSION["userName"] = $userName;
			//echo 'Testing'.$sess->getVariable('userName');
			if (isset($_GET["myAction"])) {
				$myAction = $_GET["myAction"];
			}
	}
	else
	{
			$validUser = false;
    	     $_SESSION["validUser"] = $validUser;
    	     $_SESSION["userName"] = "none";
		}

//	echo 'checking login';
}
else if ($myAction == 'Logout')
{
			$validUser = false;
    	     $_SESSION["validUser"] = $validUser;
    	     $_SESSION["userName"] = "none";
	
}

$securityTestUser = false;
$securityCanManageUsers = false;
$securityCanDoMaintenance = false;
$securityCanDoSettings = false;
$securityCanCopyOrDeleteOffers = false;
$securityCanEditDeposits = false;
$securityConstruction = false;
if ($validUser == true ) {
	$securityLevelOneCheck = userSecurityLevelCheck($dbSingleUse,$userName,$levelOne);
	$securityLevelTwoCheck = userSecurityLevelCheck($dbSingleUse,$userName,$levelTwo);
	if (  strtolower($userName) == 'doug@pratthomes.ca'
	    or strtolower($userName) == 'hhansen'
	    or strtolower($userName) == 'khansen'
	    or strtolower($userName) == 'todd'
		or strtolower($userName) == 'an.duong'
		) {
			$securityTestUser = true;
		}
	if (  strtolower($userName) == 'doug@pratthomes.ca'
	    or strtolower($userName) == 'hhansen'
	    or strtolower($userName) == 'khansen'
	    or strtolower($userName) == 'todd'
		or strtolower($userName) == 'an.duong'
		) {
			$securityCanManageUsers = true;
		}
	if (  strtolower($userName) == 'doug@pratthomes.ca'
	    or strtolower($userName) == 'hhansen'
	    or strtolower($userName) == 'khansen'
	    or strtolower($userName) == 'todd'
	    or strtolower($userName) == 'bruno'
		or strtolower($userName) == 'an.duong'
		or strtolower($userName) == 'wendy'
		) {
			$securityCanDoMaintenance = true;
		}
	if (  strtolower($userName) == 'doug@pratthomes.ca'
	    or strtolower($userName) == 'hhansen'
	    or strtolower($userName) == 'khansen'
	    or strtolower($userName) == 'todd'
	    or strtolower($userName) == 'bruno'
		or strtolower($userName) == 'an.duong'
		or strtolower($userName) == 'wendy'
		) {
			$securityCanDoTrade = true;
		}
	if (  strtolower($userName) == 'doug@pratthomes.ca'
	    or strtolower($userName) == 'hhansen'
	    or strtolower($userName) == 'khansen'
	    or strtolower($userName) == 'todd'
	    or strtolower($userName) == 'bruno'
		or strtolower($userName) == 'kath'
		or strtolower($userName) == 'an.duong'
		or strtolower($userName) == 'wendy'
		) {
			$securityCanDoPO = true;
		}
	if (  strtolower($userName) == 'doug@pratthomes.ca'
	    or strtolower($userName) == 'hhansen'
	    or strtolower($userName) == 'khansen'
	    or strtolower($userName) == 'todd'
		or strtolower($userName) == 'an.duong'
		) {
			$securityCanDoSettings  = true;
		}
	if (  strtolower($userName) == 'doug@pratthomes.ca'
	    or strtolower($userName) == 'hhansen'
	    or strtolower($userName) == 'khansen'
	    or strtolower($userName) == 'todd'
		) {
			$securityCanCopyOrDeleteOffers = true;
		}
	if (  strtolower($userName) == 'doug@pratthomes.ca'
	    or strtolower($userName) == 'hhansen'
	    or strtolower($userName) == 'khansen'
	    or strtolower($userName) == 'todd'
	    or strtolower($userName) == 'bruno'
		) {
			$securityCanEditDeposits = true;
		}
	if (  strtolower($userName) == 'doug@pratthomes.ca'
	    or strtolower($userName) == 'bpratt@pratthomes.ca'
	    or strtolower($userName) == 'hhansen'
	    or strtolower($userName) == 'todd'
	    or strtolower($userName) == 'khansen'
	    or strtolower($userName) == 'bruno'
		) {
			$securityCanChangeBuildCompleteDate = true;
		}
	if (  strtolower($userName) == 'doug@pratthomes.ca'
	    or strtolower($userName) == 'bpratt@pratthomes.ca'
	    or strtolower($userName) == 'hhansen'
	    or strtolower($userName) == 'khansen'
	    or strtolower($userName) == 'todd'
		) {
			$securityCanLockFeature = true;
		}
	if (  strtolower($userName) == 'doug@pratthomes.ca'
	    //or strtolower($userName) == 'khansen'
		) {
			$securityCanDoServiceTracking = true;
		}
	
	if (  strtolower($userName) == 'doug@pratthomes.ca'
	    or strtolower($userName) == 'hhansen'
	    or strtolower($userName) == 'khansen'
	    or strtolower($userName) == 'wendy'
		or strtolower($userName) == 'an.duong'
		) {
			$securityConstruction = true;
		}
	$currentSettingCheck = 'Both Level One and Two Can Edit Deposits';
	$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
	if ($settingValue == 1) {
		  if ($securityLevelOneCheck or $securityLevelTwoCheck) {
			$securityCanEditDeposits = true;
		  }
	}
	//These users can edit anyways
	if (  strtolower($userName) == 'doug@pratthomes.ca'
	    or strtolower($userName) == 'hhansen'
	    or strtolower($userName) == 'khansen'
	    or strtolower($userName) == 'todd'
	    or strtolower($userName) == 'bruno'
		) {
			$securityCanEditDeposits = true;
		}
}


$currentSettingCheck = 'Only Level One Can See Occupancy and Close Dates';
$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
if ($settingValue == 1) {
	  if ($securityLevelOneCheck ) {
		$g_AllowedToSeeOccCloseDates =  true;
	  }
	  else {
		$g_AllowedToSeeOccCloseDates =  false;
	  }
}
else {
	$g_AllowedToSeeOccCloseDates =  true;
}

$currentSettingCheck = 'Use Offer Override Date Functionality';
$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
if ($settingValue == 1) {
	$g_UseOfferOverrideDateFunctionality = true;
}
else {
	$g_UseOfferOverrideDateFunctionality = false;
}

$currentSettingCheck = 'Use Feature Locking Functionality';
$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
if ($settingValue == 1) {
	$g_UseFeatureLocking = true;
}
else {
	$g_UseFeatureLocking = false;
}



?>