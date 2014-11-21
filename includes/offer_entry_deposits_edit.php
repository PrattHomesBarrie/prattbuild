

<script>
function clearData(pInput) {
 if (pInput == 'dueDate') {
 	document.forms["DepositsMainForm"].elements["dueDate"].value = '';
 	document.forms["DepositsMainForm"].elements["dueDateDisplay"].value = '';
 }
}

 </script>

<?php 
if (!$securityLevelOneCheck) {
	exit;
}

?>
<form action="" method="post" name="DepositsEditForm" target="_self" onsubmit="return checkFormData(this)" >
		<input name="myAction" type="hidden" id="myAction" value="EditOffer" />
		<input name="id" type="hidden" id="id" value="<?php  echo $id; ?>" />
<table class="tableDepositEntry" >
<tr>
    <td align="right">Deposit Name:</td>
	<td><input name="depositName" id="depositName" size="50" maxlength="50" STYLE="font-weight: bold; background-color: #FFCC99;" value="<?php echo $depositName; ?>" /></input></td>
</tr>
<tr>
<td align="right">Due Date:</td>
<td><SCRIPT>$(function() {
                       $("#dueDate").datepicker({ 
					     altField: ('#dueDateDisplay'),
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
  
  <input name="dueDateDisplay" type="text" value="<?php if (isset($dueDate)) {echo formatDateForHTML($dueDate,NULL);} ?>" id="dueDateDisplay" style="width:76px;" disabled="disabled"  />
  <input name="dueDate" type="hidden" value="<?php if (isset($dueDate)) {echo formatDateForHTML($dueDate,NULL);} ?>" id="dueDate" style="width:76px;" />
</td>
</tr>
<tr>   
<td align="right">Required Deposit Amount:</td>
<td align="left"><input name="expectedAmount" id="expectedAmount" type="text" STYLE="font-weight: bold; background-color: #FFCC99;" value="<?php echo $expectedAmount; ?>" onkeypress="validateNumber(event)"  size="7" maxlength="13" />
</td>
</tr>
</table>
<table width="100%">
<tr>
<td colspan="1" align="center">
<button type="submit" class="formbutton" name="myEditAction" id="myEditAction" value="<?php if ($myEditAction == 'AddOfferDeposit') { echo  'SaveNewDeposit'; } else {echo 'SaveDeposit'; } ?>" style="width: 270px;">Save</button>
</td>
<td colspan="1" align="center">
<button type="submit" class="formbutton" name="myEditAction" id="myEditAction" value="CancelDepositChanges" style="width: 270px;">Cancel</button>
</td>		
<td colspan="1" align="center">
<button type="submit" class="formbutton" name="myEditAction" id="myEditAction" value="DeleteDeposit" style="width: 270px;" onclick="return confirm('Delete this deposit and all its related transactions?');" >Delete</button>
</td>		
</tr>
<tr>
<td>
&nbsp;
</td>
</tr>
<tr>
<td>
&nbsp;
</td>
</tr>
</table>
</form>
       <script
      type="text/javascript"
      language="javascript">
      document.getElementById("depositName").focus();
   </script>
