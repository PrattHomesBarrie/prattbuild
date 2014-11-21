<?php

 if ($printingFormat == "Yes") {
  }
  else
  {
    echo '<div id="log_in_name" >Hello:'.$userName.'</div>';
    echo '<a id="logout_link" href="index.php?myAction=Logout">Logout</a>';
	echo  '<div id="main_nav">';
	echo  '<ul>';
	echo '<li><span onClick=”return true”><a>Actions</a></span>';
	
	if ($printingFormat == "Yes") {
  }
  else
  {	
	
	if ($validUser) {
		
    	echo '<ul>';
		if ($securityLevelOneCheck) {
	    	echo '<li><span onClick=”return true”><a>PASS<img src="./images/white_arrow.png" alt="" style="float:right; width:16px;" /></a></span>';
			echo 	'<ul>
							<li><span onClick=”return true”><a href="index.php?myAction=AfterSS">After Sales Service</a></span></li>
							<li><span onClick=”return true”><a href="index.php?myAction=PO">Purchase Order</a></span></li>
							<li><span onClick=”return true”><a href="index.php?myAction=Trade">Trades</a></span></li>
							<li><span onClick=”return true”><a href="index.php?myAction=Notification">Notification</a></span></li>
						</ul>
					</li>';
		}
	    echo '<li><a href="index.php?myAction=MySummary">My Summary</a></li>';
    	echo '<li><a href="index.php?myAction=Search">Search</a></li>';
		if ($securityTestUser) {
	    	echo '<li><a href="index.php?myAction=Marketing">Marketing</a></li>';
		}
		if ($securityLevelOneCheck ) {
	    	echo '<li><a href="index.php?myAction=Sites">Sites Report</a></li>';
		}
//		echo '<li>Lots';
  //  	echo '<ul>';
	    //echo '<li><a href="index.php?myAction=Lots&siteShortName=All">Lots - All</a></li>';
		echo '<li>';
		echo '<a href="index.php?myAction=PostBuildLots">Lots - Moved-In</a>';
		echo '</li>';
	//	echo '</ul></li>';
		if ($securityLevelOneCheck ) {
	    	echo '<li><a href="index.php?myAction=OfferDashboard">Offer Dashboard</a></li>';
		}
		if ($securityLevelOneCheck ) {
			$currentSettingCheck = 'Use Show Homes Page';
			$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
			if ($settingValue == 1) {
		    	echo '<li><a href="index.php?myAction=ShowHomes">Show Homes</a></li>';
			}
		}
		if ($securityLevelOneCheck ) {
			$currentSettingCheck = 'Use Spec Homes Page';
			$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
			if ($settingValue == 1) {
		    	echo '<li><a href="index.php?myAction=SpecHomes">Spec Homes</a></li>';
			}
		}
		if ($securityLevelOneCheck ) {
	    	echo '<li><a href="index.php?myAction=MoveInsGrid">Calendars</a></li>';
		}
		if ($securityLevelOneCheck ) {
	    	echo '<li><a href="index.php?myAction=Activity">Activity</a></li>';
		}
		if ($securityLevelOneCheck ) {
	    	echo '<li><a href="index.php?myAction=StatsWeekly">Stats Weekly</a></li>';
		}
		if ($securityLevelOneCheck ) {
	    	echo '<li><a href="index.php?myAction=DepositTracking">Deposit Tracking</a></li>';
		}
    	echo '<li><a href="index.php?myAction=NoteTracking">Note Tracking</a></li>';
		if ($securityCanDoServiceTracking) {
	    	echo '<li><a href="index.php?myAction=ServiceTracking">Service Tracking</a></li>';
		}
		if ($securityCanDoMaintenance) {
		    echo '<li><a href="index.php?myAction=Maintenance">Maintenance</a></li>';
		}
		if ($securityCanDoSettings) {
		    echo '<li><a href="index.php?myAction=Settings">Settings</a></li>';
		}
    	
	    echo '</ul>';
   	    //echo '<p>&nbsp;</p>';
		echo '</li>';
		
	}
	elseif ($myAction!='login'){
    	//echo '<ul class="nav">';
      //echo '<li><a href="index.php">Login</a></li>';
      //echo '</ul>';
	}
    
  }
  /*
echo  '<li';
	
	echo '><a href="index.php?myAction=';
	if ($myAction == 'PostBuildLots') {
		echo 'PostBuildLots';
	}
	else {
		echo 'Lots';
	}
	echo '&siteShortName=All">Sites</a>'; */
	echo '
        <li><span onClick=”return true”><a>Lot - Sites</a></span>';
	echo  '<ul>';
	echo '<li';
	if (($siteShortName == 'All' or $siteShortName == '') and $myAction == 'Lots') {
		echo ' class="current"';
	}
	echo '><a href="index.php?myAction=Lots&siteShortName=All">All</a>
		  </li>';
$query = ' SELECT * FROM `sites` WHERE siteID >2';

if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {
		echo '<li';
		if ($resultRow->siteShortName == $siteShortName) {
			echo ' class="current"';
		}
		echo '><a href="index.php?myAction=Lots&siteShortName='.$resultRow->siteShortName.'&siteName='.$resultRow->siteName.'">'.$resultRow->siteName.'</a></li>';
	}
}

	echo '</ul></li>';
	if($myAction == 'Lots' or !isset($myAction))
	{
		//echo '<li><a>Offer Status</a>';
		//echo '</li>';
		//echo '<li><a>Completion Date</a>';
		//echo '</li>';
		//echo '<li><a>Clearing Activity</a>';
		//echo '</li>';
	}
	else if($myAction == 'AfterSS' or $myAction == 'Deficiency' or $myAction == 'Trade' or $myAction == 'Notification' or $myAction == 'PO')
	{
		if($myAction != 'PO')
		{
		echo '<li><span onClick=”return true”><a href="#">Deficiencies</a></span>';
		echo 	'<ul>
					<li><a href="index.php?myAction=Deficiency">All</a></li>
				</ul>';
		echo '</li>';
		}
		echo '<li><span onClick=”return true”><a href="index.php?myAction=Trade">Trades</a></span>';
		echo '</li>';
		echo '<li><span onClick=”return true”><a href="index.php?myAction=Notification">Notification</a></span>';
		echo '</li>';
		echo '</ul></li>';
		echo '</ul></div>';
		if(isset($myAction))
		  {
			if($myAction =="AfterSS") echo '<br> You are viewing: After Sales Service'; 		
			else echo '<br> You are viewing: '.$myAction; 
		}
		
	}
	else{
	echo  '</ul>';
	echo  '</div>';
	echo '<br>You are viewing: '.$myAction;
	}
  }
	
?>
