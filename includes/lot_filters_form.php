<form id="form1" name="form1" method="post" action="">
  
         <?php 
	if ($securityLevelOneCheck) {
     echo '
        <li><span onClick=”return true”><a>Offer Status</a></span>
        <ul>
          <li ';
		  if ($filterOfferStatusGroup == 'All' or !isset($filterOfferStatusGroup)) { echo ' class="current"';} 
		  echo '><label><a>
            <input style="display:none;" onclick="this.form.submit();" name="filterOfferStatusGroup" type="radio" id="filterOfferStatusGroup_0" value="All" ';
        if ($filterOfferStatusGroup == 'All' or !isset($filterOfferStatusGroup)) { echo ' checked="checked"  ';} 
	      echo '     />
            All Lots</a></label></li>';
	}
        	echo '
	          <li ';
		  if ($filterOfferStatusGroup == 'With Offers'  or ($securityLevelOneCheck != true )) { echo ' class="current"';} 
		  echo '><label><a>
            <input style="display:none;" onClick="this.form.submit();" type="radio" name="filterOfferStatusGroup" value="With Offers" id="filterOfferStatusGroup_1" ';
			if ($filterOfferStatusGroup == 'With Offers' or ( $securityLevelOneCheck != true ) ) { echo ' checked="checked" ';} 
          echo ' />
            With Signed Offers </a></label></li>';
	if ($securityLevelOneCheck) {
        echo'
          <li ';
		  if ($filterOfferStatusGroup == 'Without Offers') { echo ' class="current"';} 
		  echo '  ><label><a>
            <input style="display:none;" onClick="this.form.submit();" type="radio" name="filterOfferStatusGroup" value="Without Offers" id="filterOfferStatusGroup_2" ';
            if ($filterOfferStatusGroup == 'Without Offers') { echo ' checked="checked" ';} 
           echo '/>
            Without Offers (incl. unsigned)</a></label></li>
        </ul>
		</li>';
	}
		?>
      <?php 
		echo '<li><span onClick=”return true”><a>Completion Date</a></span>
		<ul>
          <li ';
	  if ($filterClosingStatusGroup == 'All' or  !isset($filterClosingStatusGroup)) { echo ' class="current"';}  echo '><label><a>';?>
            <input style="display:none;" onClick="this.form.submit();" name="filterClosingStatusGroup" type="radio" id="ClosingStatusGroup_0" value="All" 
            <?php if ($filterClosingStatusGroup == 'All' or  !isset($filterClosingStatusGroup)) { echo ' checked="checked" ';} ?> 
            />
            All</a></label></li>
			
          <li <?php if ($filterClosingStatusGroup == 'Last 30 Plus' ) { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" name="filterClosingStatusGroup" type="radio" id="ClosingStatusGroup_1" value="Last 30 Plus" 
            <?php if ($filterClosingStatusGroup == 'Last 30 Plus' ) { echo ' checked="checked" ';} ?> 
            />
            Last 30 Days and Future<small>(+ any unclosed)</small>
          </a></label></li>
		  
          <li <?php if ($filterClosingStatusGroup == 'In the Future') { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" name="filterClosingStatusGroup" type="radio" id="ClosingStatusGroup_1" value="In the Future" 
            <?php if ($filterClosingStatusGroup == 'In the Future') { echo ' checked="checked" ';} ?> 
            />
            In the Future</a></label></li>
          
          <li <?php if ($filterClosingStatusGroup == 'In the Past') { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" type="radio" name="filterClosingStatusGroup" value="In the Past" id="ClosingStatusGroup_2" 
            <?php if ($filterClosingStatusGroup == 'In the Past') { echo ' checked="checked" ';} ?> 
            />
            In the Past</a></label></li>
          
          <li <?php if ($filterClosingStatusGroup == 'Next 7 Days') { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" type="radio" name="filterClosingStatusGroup" value="Next 7 Days" id="ClosingStatusGroup_3" 
            <?php if ($filterClosingStatusGroup == 'Next 7 Days') { echo ' checked="checked" ';} ?> 
            />
            Next 7 Days</a></label></li>
          
          <li <?php if ($filterClosingStatusGroup == 'Next 14 Days') { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" type="radio" name="filterClosingStatusGroup" value="Next 14 Days" id="ClosingStatusGroup_4" 
            <?php if ($filterClosingStatusGroup == 'Next 14 Days') { echo ' checked="checked" ';} ?> 
            />
            Next 14 Days</a></label></li>
          
          <li <?php if ($filterClosingStatusGroup == 'This Fiscal Year') { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" type="radio" name="filterClosingStatusGroup" value="This Fiscal Year" id="ClosingStatusGroup_5" 
            <?php if ($filterClosingStatusGroup == 'This Fiscal Year') { echo ' checked="checked" ';} ?> 
            />
            This Fiscal Year</a></label></li>
          
          <li <?php if ($filterClosingStatusGroup == 'Next Fiscal Year') { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" type="radio" name="filterClosingStatusGroup" value="Next Fiscal Year" id="ClosingStatusGroup_6" 
            <?php if ($filterClosingStatusGroup == 'Next Fiscal Year') { echo ' checked="checked" ';} ?> 
            />
            Next Fiscal Year</a></label></li>
          </ul>
		  </li>
		
		
      <li><span onClick=”return true”><a>Clearing Activity</a></span>
        <ul>
          <li <?php if ($filterClearingGroup == 'All' or  !isset($filterClearingGroup)) { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" name="filterClearingGroup" type="radio" id="filterClearingGroup_0" value="All"  
            <?php if ($filterClearingGroup == 'All' or  !isset($filterClearingGroup)) { echo ' checked="checked" ';} ?> 
            />
            All</a></label></li>
          
          <li <?php if ($filterClearingGroup == 'Clearing is Complete' ) { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" type="radio" name="filterClearingGroup" value="Clearing is Complete" id="filterClearingGroup_1" 
            <?php if ($filterClearingGroup == 'Clearing is Complete' ) { echo ' checked="checked" ';} ?> 
            />
            Clearing is Complete</a></label></li>
          
          <li <?php if ($filterClearingGroup == 'Head Office Incomplete' ) { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" type="radio" name="filterClearingGroup" value="Head Office Incomplete" id="filterClearingGroup_2" 
            <?php if ($filterClearingGroup == 'Head Office Incomplete' ) { echo ' checked="checked" ';} ?> 
            />
            Head Office Incomplete</a></label></li>
          
          <li <?php if ($filterClearingGroup == 'Site Office Incomplete' ) { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" type="radio" name="filterClearingGroup" value="Site Office Incomplete" id="filterClearingGroup_3" 
            <?php if ($filterClearingGroup == 'Site Office Incomplete' ) { echo ' checked="checked" ';} ?> 
            />
            Site Office Incomplete</a></label></li>
          
          <li <?php if ($filterClearingGroup == 'No Activity Last 7 Days' ) { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" type="radio" name="filterClearingGroup" value="No Activity Last 7 Days" id="filterClearingGroup_4" 
            <?php if ($filterClearingGroup == 'No Activity Last 7 Days' ) { echo ' checked="checked" ';} ?> 
            />
            No Activity Last 7 Days</a></label></li>
          
          <li <?php if ($filterClearingGroup == 'Active in Last 7 Days' ) { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" type="radio" name="filterClearingGroup" value="Active in Last 7 Days" id="filterClearingGroup_5" 
            <?php if ($filterClearingGroup == 'Active in Last 7 Days' ) { echo ' checked="checked" ';} ?> 
            />
            Active in Last 7 Days</a></label></li>
          
          <li <?php if ($filterClearingGroup == 'Active in Last 2 Days' ) { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" type="radio" name="filterClearingGroup" value="Active in Last 2 Days" id="filterClearingGroup_6" 
            <?php if ($filterClearingGroup == 'Active in Last 2 Days' ) { echo ' checked="checked" ';} ?> 
            />
            Active in Last 2 Days</a></label></li>
          
          <li <?php if ($filterClearingGroup == 'Has Had Some Activity' ) { echo ' class="current"';} ?> ><label><a>
            <input style="display:none;" onClick="this.form.submit();" type="radio" name="filterClearingGroup" value="Has Had Some Activity" id="filterClearingGroup_7" 
            <?php if ($filterClearingGroup == 'Has Had Some Activity' ) { echo ' checked="checked" ';} ?> 
            />
            Has Had Some Activity</a></label></li>
          </ul>
		  </li>
		  </ul></div>
		  <? 
			if(isset($myAction))
			  {echo '<br> You are viewing: '.$myAction;
			  if(isset($siteShortName))
			  {
				if($siteShortName == '')
				echo '/ All Sites';
				elseif(isset($_GET['siteName']))
				echo ' / '.$siteName;
			  } 
			  }
		  ?>
</form>