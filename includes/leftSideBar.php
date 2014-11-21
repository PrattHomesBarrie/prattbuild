<style type="text/css">
.highlightStyle {
	background-color: #0FF;
}
</style>
    <?php
//if (isset($userName) ) {
	
 if ($printingFormat == "Yes") {
  }
  else
  {	
	echo '  <div class="sidebar1">';	
	if ($validUser) {
		echo 'logged in as:'.$userName.'<br>';
    	echo '<ul class="nav">';
	    echo '<li><a href="index.php?myAction=MySummary">My Summary</a></li>';
    	echo '<li><a href="index.php?myAction=Search">Search</a></li>';
		if ($securityLevelOneCheck ) {
	    	echo '<li><a href="index.php?myAction=Sites">Sites</a></li>';
		}
//		echo '<li>Lots';
  //  	echo '<ul>';
	    echo '<li><a href="index.php?myAction=Lots">Lots - All</a></li>';
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
		if ($securityTestUser) {
	    	echo '<li><a href="index.php?myAction=Marketing">Marketing</a></li>';
		}
		if ($securityCanDoMaintenance) {
		    echo '<li><a href="index.php?myAction=Maintenance">Maintenance</a></li>';
		}
		if ($securityCanDoSettings) {
		    echo '<li><a href="index.php?myAction=Settings">Settings</a></li>';
		}
    	echo '<li><a href="index.php?myAction=Logout">Logout</a></li>';
	    echo '</ul>';
   	    echo '<p>&nbsp;</p>';
	}
	elseif ($myAction!='login'){
    	echo '<ul class="nav">';
      echo '<li><a href="index.php">Login</a></li>';
      echo '</ul>';
	}
    echo '<!-- end .sidebar1 --></div>';
  }
	 ?>
