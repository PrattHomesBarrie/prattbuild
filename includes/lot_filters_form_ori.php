<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotFilters">
    <tr>
      <th>Offer Status</th>
      <th>Completion Date</th>
      <th>Clearing Activity</th>
      <th>&nbsp;</th>
    </tr>
<tr>
      <td ><table width="200" class="tableLotFilters" >    <?php 
	if ($securityLevelOneCheck) {
     echo '
        <tr>
          <td ';
		  if ($filterOfferStatusGroup == 'All' or !isset($filterOfferStatusGroup)) { echo ' bgcolor="#FFFFCC" ';} 
		  echo '><label  >
            <input  onclick="this.form.submit();" name="filterOfferStatusGroup" type="radio" id="filterOfferStatusGroup_0" value="All" ';
        if ($filterOfferStatusGroup == 'All' or !isset($filterOfferStatusGroup)) { echo ' checked="checked"  ';} 
	      echo '     />
            All Lots</label></td>
    	    </tr>';
	}
        	echo '<tr>
	          <td ';
		  if ($filterOfferStatusGroup == 'With Offers'  or ($securityLevelOneCheck != true )) { echo ' bgcolor="#FFFFCC" ';} 
		  echo '><label>
            <input onClick="this.form.submit();" type="radio" name="filterOfferStatusGroup" value="With Offers" id="filterOfferStatusGroup_1" ';
			if ($filterOfferStatusGroup == 'With Offers' or ( $securityLevelOneCheck != true ) ) { echo ' checked="checked" ';} 
          echo ' />
            With Signed Offers </label></td>
        </tr>';
	if ($securityLevelOneCheck) {
        echo'<tr>
          <td ';
		  if ($filterOfferStatusGroup == 'Without Offers') { echo ' bgcolor="#FFFFCC" ';} 
		  echo '  ><label>
            <input onClick="this.form.submit();" type="radio" name="filterOfferStatusGroup" value="Without Offers" id="filterOfferStatusGroup_2" ';
            if ($filterOfferStatusGroup == 'Without Offers') { echo ' checked="checked" ';} 
           echo '/>
            Without Offers (incl. unsigned)</label></td>
        </tr>';
	}
		?>
      </table></td>
      <td><table width="200" class="tableLotFilters">
        <tr>
          <td <?php if ($filterClosingStatusGroup == 'All' or  !isset($filterClosingStatusGroup)) { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" name="filterClosingStatusGroup" type="radio" id="ClosingStatusGroup_0" value="All" 
            <?php if ($filterClosingStatusGroup == 'All' or  !isset($filterClosingStatusGroup)) { echo ' checked="checked" ';} ?> 
            />
            All</label></td>
          </tr>
        <tr>
          <td <?php if ($filterClosingStatusGroup == 'Last 30 Plus' ) { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" name="filterClosingStatusGroup" type="radio" id="ClosingStatusGroup_1" value="Last 30 Plus" 
            <?php if ($filterClosingStatusGroup == 'Last 30 Plus' ) { echo ' checked="checked" ';} ?> 
            />
            Last 30 Days and Future<small>(+ any unclosed)</small>
          </label></td>
          </tr>
        <tr>
          <td <?php if ($filterClosingStatusGroup == 'In the Future') { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" name="filterClosingStatusGroup" type="radio" id="ClosingStatusGroup_1" value="In the Future" 
            <?php if ($filterClosingStatusGroup == 'In the Future') { echo ' checked="checked" ';} ?> 
            />
            In the Future</label></td>
          </tr>
        <tr>
          <td <?php if ($filterClosingStatusGroup == 'In the Past') { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" type="radio" name="filterClosingStatusGroup" value="In the Past" id="ClosingStatusGroup_2" 
            <?php if ($filterClosingStatusGroup == 'In the Past') { echo ' checked="checked" ';} ?> 
            />
            In the Past</label></td>
          </tr>
        <tr>
          <td <?php if ($filterClosingStatusGroup == 'Next 7 Days') { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" type="radio" name="filterClosingStatusGroup" value="Next 7 Days" id="ClosingStatusGroup_3" 
            <?php if ($filterClosingStatusGroup == 'Next 7 Days') { echo ' checked="checked" ';} ?> 
            />
            Next 7 Days</label></td>
          </tr>
        <tr>
          <td <?php if ($filterClosingStatusGroup == 'Next 14 Days') { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" type="radio" name="filterClosingStatusGroup" value="Next 14 Days" id="ClosingStatusGroup_4" 
            <?php if ($filterClosingStatusGroup == 'Next 14 Days') { echo ' checked="checked" ';} ?> 
            />
            Next 14 Days</label></td>
          </tr>
        <tr>
          <td <?php if ($filterClosingStatusGroup == 'This Fiscal Year') { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" type="radio" name="filterClosingStatusGroup" value="This Fiscal Year" id="ClosingStatusGroup_5" 
            <?php if ($filterClosingStatusGroup == 'This Fiscal Year') { echo ' checked="checked" ';} ?> 
            />
            This Fiscal Year</label></td>
          </tr>
        <tr>
          <td <?php if ($filterClosingStatusGroup == 'Next Fiscal Year') { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" type="radio" name="filterClosingStatusGroup" value="Next Fiscal Year" id="ClosingStatusGroup_6" 
            <?php if ($filterClosingStatusGroup == 'Next Fiscal Year') { echo ' checked="checked" ';} ?> 
            />
            Next Fiscal Year</label></td>
          </tr>
      </table></td>
      <td><table width="200" class="tableLotFilters">
        <tr>
          <td <?php if ($filterClearingGroup == 'All' or  !isset($filterClearingGroup)) { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" name="filterClearingGroup" type="radio" id="filterClearingGroup_0" value="All"  
            <?php if ($filterClearingGroup == 'All' or  !isset($filterClearingGroup)) { echo ' checked="checked" ';} ?> 
            />
            All</label></td>
          </tr>
        <tr>
          <td <?php if ($filterClearingGroup == 'Clearing is Complete' ) { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" type="radio" name="filterClearingGroup" value="Clearing is Complete" id="filterClearingGroup_1" 
            <?php if ($filterClearingGroup == 'Clearing is Complete' ) { echo ' checked="checked" ';} ?> 
            />
            Clearing is Complete</label></td>
          </tr>
        <tr>
          <td <?php if ($filterClearingGroup == 'Head Office Incomplete' ) { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" type="radio" name="filterClearingGroup" value="Head Office Incomplete" id="filterClearingGroup_2" 
            <?php if ($filterClearingGroup == 'Head Office Incomplete' ) { echo ' checked="checked" ';} ?> 
            />
            Head Office Incomplete</label></td>
          </tr>
        <tr>
          <td <?php if ($filterClearingGroup == 'Site Office Incomplete' ) { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" type="radio" name="filterClearingGroup" value="Site Office Incomplete" id="filterClearingGroup_3" 
            <?php if ($filterClearingGroup == 'Site Office Incomplete' ) { echo ' checked="checked" ';} ?> 
            />
            Site Office Incomplete</label></td>
          </tr>
        <tr>
          <td <?php if ($filterClearingGroup == 'No Activity Last 7 Days' ) { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" type="radio" name="filterClearingGroup" value="No Activity Last 7 Days" id="filterClearingGroup_4" 
            <?php if ($filterClearingGroup == 'No Activity Last 7 Days' ) { echo ' checked="checked" ';} ?> 
            />
            No Activity Last 7 Days</label></td>
          </tr>
        <tr>
          <td <?php if ($filterClearingGroup == 'Active in Last 7 Days' ) { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" type="radio" name="filterClearingGroup" value="Active in Last 7 Days" id="filterClearingGroup_5" 
            <?php if ($filterClearingGroup == 'Active in Last 7 Days' ) { echo ' checked="checked" ';} ?> 
            />
            Active in Last 7 Days</label></td>
          </tr>
        <tr>
          <td <?php if ($filterClearingGroup == 'Active in Last 2 Days' ) { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" type="radio" name="filterClearingGroup" value="Active in Last 2 Days" id="filterClearingGroup_6" 
            <?php if ($filterClearingGroup == 'Active in Last 2 Days' ) { echo ' checked="checked" ';} ?> 
            />
            Active in Last 2 Days</label></td>
          </tr>
        <tr>
          <td <?php if ($filterClearingGroup == 'Has Had Some Activity' ) { echo ' bgcolor="#FFFFCC" ';} ?> ><label>
            <input onClick="this.form.submit();" type="radio" name="filterClearingGroup" value="Has Had Some Activity" id="filterClearingGroup_7" 
            <?php if ($filterClearingGroup == 'Has Had Some Activity' ) { echo ' checked="checked" ';} ?> 
            />
            Has Had Some Activity</label></td>
          </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
