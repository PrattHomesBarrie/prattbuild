<script>
function clearData(pInput)
 {
	if (pInput == 'firstPerson') {
		 document.forms[0].elements["personPrefix1"].value = '';
		 document.forms[0].elements["firstName1"].value = '';
		 document.forms[0].elements["lastName1"].value = '';
		 document.forms[0].elements["birthDate1"].value = '';
	 	document.forms[0].elements["birthDate1Display"].value = '';

	}
	if (pInput == 'secondPerson') {
		 document.forms[0].elements["personPrefix2"].value = '';
		 document.forms[0].elements["firstName2"].value = '';
		 document.forms[0].elements["lastName2"].value = '';
		 document.forms[0].elements["birthDate2"].value = '';
	 	document.forms[0].elements["birthDate2Display"].value = '';

	}
	if (pInput == 'thirdPerson') {
		 document.forms[0].elements["personPrefix3"].value = '';
		 document.forms[0].elements["firstName3"].value = '';
		 document.forms[0].elements["lastName3"].value = '';
		 document.forms[0].elements["birthDate3"].value = '';
	 	document.forms[0].elements["birthDate3Display"].value = '';

	}

 }
</script>


  <table width="100%" class="tableOfferEntry">
<form action="" method="post" name="CustomerMainForm" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="SaveCustomer" onsubmit="return checkFormData(this)"/>

    <tr>
      <td>&nbsp;</td>
      <th></th>
      <th>Title</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Birth Date</th>
    </tr>
    <tr>
      <td>1st Person</td>
      <td><IMG SRC="images/delete-icon.gif" name="a1" width="15" height="15"  border="0" usemap="#pswd" style="cursor:hand" 	onclick="clearData('firstPerson')">
</td>
      <td><select name="personPrefix1" id="personPrefix1">
        <option <?php if (!isset($offerInfo->personPrefix1)) {echo ' selected ';} ?> value=""></option>
        <option <?php if ($offerInfo->personPrefix1 == 'Mr.') {echo ' selected ';} ?> value="Mr.">Mr.</option>
        <option <?php if ($offerInfo->personPrefix1 == 'Mrs.') {echo ' selected ';} ?> value="Mrs.">Mrs.</option>
        <option <?php if ($offerInfo->personPrefix1 == 'Ms.') {echo ' selected ';} ?> value="Ms.">Ms.</option>
        <option <?php if ($offerInfo->personPrefix1 == 'Miss') {echo ' selected ';} ?> value="Miss">Miss</option>
    </select></td>
      <td><input name="firstName1" type="text" id="firstName1" value="<?php echo htmlspecialchars($offerInfo->firstName1); ?>" size="30" maxlength="50"></td>
      <td><input name="lastName1" type="text" id="lastName1" value="<?php echo htmlspecialchars($offerInfo->lastName1); ?>" size="30" maxlength="50"></td>
      <td>
       <SCRIPT>$(function() {
                       $("#birthDate1").datepicker({ 
					     altField: ('#birthDate1Display'),
					    numberOfMonths: 1,
						showOn: "button",
						changeMonth: true,
						changeYear: true,
						buttonImage: "images/calendar.gif",
						yearRange: 'c-80:c+10',
						buttonImageOnly: true,
                		showButtonPanel: true,
				        dateFormat: 'dd-M-yy',
					    showAnim: 'fadeIn'});
                        }); </SCRIPT>
  <input name="birthDate1Display" type="text" value="<?php if (isset($offerInfo->birthDate1) &&  $offerInfo->birthDate1 > '0000-00-00') {echo date('d-M-Y',strtotime($offerInfo->birthDate1));} ?>" id="birthDate1Display" style="width:80px;" disabled="disabled"  />
  <input name="birthDate1" type="hidden" value="<?php if (isset($offerInfo->birthDate1) &&  $offerInfo->birthDate1 > '0000-00-00') {
	  echo date('d-M-Y',strtotime($offerInfo->birthDate1)); }  ?>" id="birthDate1" style="width:80px;"
   />
 
</td>
    </tr>
    <tr>
      <td>2nd Person</td>
      <td><IMG SRC="images/delete-icon.gif" name="a1" width="15" height="15"  border="0" usemap="#pswd" style="cursor:hand" 	onclick="clearData('secondPerson')"></td>
      <td><select name="personPrefix2" id="personPrefix2">
        <option <?php if (!isset($offerInfo->personPrefix2)) {echo ' selected ';} ?> value=""></option>
        <option <?php if ($offerInfo->personPrefix2 == 'Mr.') {echo ' selected ';} ?> value="Mr.">Mr.</option>
        <option <?php if ($offerInfo->personPrefix2 == 'Mrs.') {echo ' selected ';} ?> value="Mrs.">Mrs.</option>
        <option <?php if ($offerInfo->personPrefix2 == 'Ms.') {echo ' selected ';} ?> value="Ms.">Ms.</option>
        <option <?php if ($offerInfo->personPrefix2 == 'Miss') {echo ' selected ';} ?> value="Miss">Miss</option>
      </select></td>
      <td><input name="firstName2" type="text" id="firstName2" value="<?php echo htmlspecialchars($offerInfo->firstName2); ?>" size="30" maxlength="50" >
</td>
      <td><input name="lastName2" type="text" id="lastName2" value="<?php echo htmlspecialchars($offerInfo->lastName2); ?>" size="30" maxlength="50"></td>
      <td>       <SCRIPT>$(function() {
                       $("#birthDate2").datepicker({ 
					     altField: ('#birthDate2Display'),
					    numberOfMonths: 1,
						showOn: "button",
						changeMonth: true,
						changeYear: true,
						buttonImage: "images/calendar.gif",
						yearRange: 'c-80:c+10',
						buttonImageOnly: true,
                		showButtonPanel: true,
                        dateFormat: 'dd-M-yy',
					    showAnim: 'fadeIn'
						});
                        }); </SCRIPT> <div class="demo">
  <input name="birthDate2Display" type="text" value="<?php if (isset($offerInfo->birthDate2) &&  $offerInfo->birthDate2 > '0000-00-00') {echo date('d-M-Y',strtotime($offerInfo->birthDate2));} ?>" id="birthDate2Display" style="width:80px;" disabled="disabled" />
  <input name="birthDate2" type="hidden" value="<?php if (isset($offerInfo->birthDate2) &&  $offerInfo->birthDate2 > '0000-00-00') {echo date('d-M-Y',strtotime($offerInfo->birthDate2));} ?>" id="birthDate2" style="width:80px;" /></div>
</td>
    </tr>
    <tr>
      <td>3rd Person</td>
      <td><IMG SRC="images/delete-icon.gif" name="a1" width="15" height="15"  border="0" usemap="#pswd" style="cursor:hand" 	onclick="clearData('thirdPerson')"></td>
      <td><select name="personPrefix3" id="personPrefix3">
        <option <?php if (!isset($offerInfo->personPrefix3)) {echo ' selected ';} ?> value=""></option>
        <option <?php if ($offerInfo->personPrefix3 == 'Mr.') {echo ' selected ';} ?> value="Mr.">Mr.</option>
        <option <?php if ($offerInfo->personPrefix3 == 'Mrs.') {echo ' selected ';} ?> value="Mrs.">Mrs.</option>
        <option <?php if ($offerInfo->personPrefix3 == 'Ms.') {echo ' selected ';} ?> value="Ms.">Ms.</option>
        <option <?php if ($offerInfo->personPrefix3 == 'Miss') {echo ' selected ';} ?> value="Miss">Miss</option>
      </select></td>
      <td><input name="firstName3" type="text" id="firstName3" value="<?php echo htmlspecialchars($offerInfo->firstName3); ?>" size="30" maxlength="50"></td>
      <td><input name="lastName3" type="text" id="lastName3" value="<?php echo htmlspecialchars($offerInfo->lastName3); ?>" size="30" maxlength="50"></td>
      <td>
       <SCRIPT>$(function() {
                       $("#birthDate3").datepicker({ 
					     altField: ('#birthDate3Display'),
					    numberOfMonths: 1,
						showOn: "button",
						changeMonth: true,
						changeYear: true,
						buttonImage: "images/calendar.gif",
						yearRange: 'c-80:c+10',
						buttonImageOnly: true,
                		showButtonPanel: true,
                        dateFormat: 'dd-M-yy',
					    showAnim: 'fadeIn'});
                        }); </SCRIPT>
  <input name="birthDate3Display" type="text" value="<?php if (isset($offerInfo->birthDate3) &&  $offerInfo->birthDate3 > '0000-00-00') {echo date('d-M-Y',strtotime($offerInfo->birthDate3));} ?>" id="birthDate3Display" style="width:80px;" disabled="disabled" />
  <input name="birthDate3" type="hidden" value="<?php if (isset($offerInfo->birthDate3)  &&  $offerInfo->birthDate3 > '0000-00-00') {echo date('d-M-Y',strtotime($offerInfo->birthDate3));} ?>" id="birthDate3" style="width:80px;" />
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
   <tr>
    <td colspan="6">
    <table class="tableOfferEntry">
    <tr><td align="center">  </td></tr>
    </table>
    </td>
    </tr>
     <tr>
      <td>Residence</td>
      <td colspan="5"><table width="100%" >
        <tr>
          <td><table width="100%" >
            <tr>
              <th>Street Address</th>
              <th>&nbsp;</th>
              </tr>
            <tr>
              <td><textarea name="clientAddress" id="clientAddress" cols="80" rows="2"><?php echo htmlspecialchars($offerInfo->clientAddress); ?></textarea></td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td><table width="100%" >
                <tr>
                  <th width="20%">City</th>
                  <th width="1%">&nbsp;</th>
                  <th width="4%">Prov</th>
                  <th width="75%">Postal Code</th>
                  </tr>
                <tr>
                  <td><input name="clientCity" type="text" id="clientCity" value="<?php echo htmlspecialchars($offerInfo->clientCity); ?>" size="30" maxlength="50"></td>
                  <td>, </td>
                  <td><input name="clientProvince" type="text" id="clientProvince" value="<?php echo htmlspecialchars($offerInfo->clientProvince); ?>" size="2" maxlength="2"></td>
                  <td><input name="clientPostalCode" type="text" id="clientPostalCode" value="<?php echo htmlspecialchars($offerInfo->clientPostalCode); ?>" size="7" maxlength="7"></td>
                  </tr>
                </table></td>
              <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
    </tr>
    <tr>
    </tr>
   <tr>
    <td colspan="6">
    <table class="tableOfferEntry">
    <tr><td align="center">  </td></tr>
    </table>
    </td>
    </tr>
    <tr>
      <td>Contact</td>
      <td colspan="5"><table width="100%">
      <tr>
        <th>Home Phone</th>
        <th>Work Phone</th>
        <th>Other Phone</th>
        <th>eMail(s) - separated by semi-colon(;)</th>
		
      </tr>
      <tr>
        <td><input name="homePhone" type="text" id="homePhone" value="<?php echo htmlspecialchars($offerInfo->homePhone); ?>" size="15" maxlength="30"></td>
        <td><input name="workPhone" type="text" id="workPhone" value="<?php echo htmlspecialchars($offerInfo->workPhone); ?>" size="18" maxlength="30"></td>
        <td><input name="otherPhone" type="text" id="otherPhone" value="<?php echo htmlspecialchars($offerInfo->otherPhone); ?>" size="18" maxlength="30"></td>
        <td><input name="email1" type="text" id="email1" value="<?php echo htmlspecialchars($offerInfo->email1); ?>" size="44" maxlength="100"></td>
      </tr>
      </table> </td>
    </tr>
   <tr>
    <td colspan="6">
    <table class="tableOfferEntry">
    <tr><td align="center">  </td></tr>
    </table>
    </td>
    </tr>
     <tr>
      <td>&nbsp;</td>
    <td colspan="1"><button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 200px;">Save Customer Details</button></form></td>
      <td colspan="6" align="right"><form action="index.php?myAction=EditOffer" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" /><input name="myAction" type="hidden" id="myAction" value="EditOffer" /><button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges"  style="width: 200px;" />Cancel Changes</button></form> </td>
    </tr>
  </table>

<p>&nbsp;</p>
<p>&nbsp;</p>