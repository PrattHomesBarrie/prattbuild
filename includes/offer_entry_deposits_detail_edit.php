<script>
function clearData(pInput) {
 if (pInput == 'detailDate') {
 	document.forms["DepositsAddDepositDetailForm"].elements["detailDate"].value = '';
 	document.forms["DepositsAddDepositDetailForm"].elements["detailDateDisplay"].value = '';
 }
}

 </script>

<?php 
if (!$securityLevelOneCheck) {
	exit;
}

if ($myEditAction == 'AddDepositDetailDeposit') {
	$transHeader = 'Enter Deposit Amount:';
	$amountBoxStyle = 'STYLE="font-weight: bold; background-color: #FFCC99;"';
	$amountTextBox = "TEXT";
	$amountValue = "";
	$defaultField = "detailAmount";
	$detailAction = "Deposit";
}
if ( $myEditAction == 'AddDepositDetailNote' ) {
	$transHeader = '';
	$amountTextBox = "HIDDEN";
	$amountValue = "0";
	$defaultField = "comments";
	$detailAction = "Note";
}
if ($myEditAction == 'AddDepositDetailNSF') {
	$transHeader = 'Enter NSF Amount:<br><font color="#FF0000">(NSF amount must be a negative number)</font>';
	$amountBoxStyle = 'STYLE="font-weight: bold; background-color: #FF0000;"';
	$amountTextBox = "TEXT";
	$amountValue = "";
	$defaultField = "detailAmount";
	$detailAction = "NSF";
}


?>
<form action="" method="post" name="DepositsAddDepositDetailForm" target="_self" onsubmit="return checkFormData(this)" >
		<input name="myAction" type="hidden" id="myAction" value="EditOffer" />
		<input name="detailAction" type="hidden" id="detailAction" value="<?php echo $detailAction; ?>" />
		<input name="depositId" type="hidden" id="depositId" value="<?php echo $currentDepositId; ?>" />

<table class="tableDepositEntry" >

<tr>
<td align="right" width="40%"><?php echo $transHeader;?></td>
		<td ><input name="detailAmount" id="detailAmount" type="<?php echo $amountTextBox; ?>" value="<?php echo $amountValue;?>" onkeypress="validateNumber(event)"  size="7" maxlength="13" <?php echo $amountBoxStyle; ?> /></td>
	</tr>		
    <TR>
    <td align="right">Date:</td>

	<td><SCRIPT>$(function() {
	   $("#detailDate").datepicker({ 
		 altField: ("#detailDateDisplay"),
		numberOfMonths: 1,
		showOn: "button",
		changeMonth: true,
		changeYear: true,
		buttonImage: "images/calendar.gif",
		yearRange: "c-80:c+10",
		buttonImageOnly: true,
		showButtonPanel: true,
		dateFormat: "dd-M-yy",
		showAnim: "fadeIn"});
		}); </SCRIPT>
        
	
	<input name="detailDateDisplay" type="text" value="<?php echo date('d-M-Y'); ?>" id="detailDateDisplay" style="width:76px;" disabled="disabled"  />
<input name="detailDate" type="hidden" value="<?php echo date('d-M-Y'); ?>" id="detailDate" style="width:76px;" /></td>
</tr>
<tr>			
    <td align="right">Note:</td>
<td colspan="1"><textarea name="comments" cols="50" rows="4" id="comments" ></textarea></td>
</TR>
</table>
<table width="100%">
<tr>
<td colspan="1" align="center">
<button type="submit" class="formbutton" name="myEditAction" id="myEditAction" value="SaveDepositDetail" style="width: 270px;">Save</button>
</td>
<td colspan="1" align="center">
<button type="submit" class="formbutton" name="myEditAction" id="myEditAction" value="CancelDepositDetail" style="width: 270px;">Cancel</button>
</td>		
</tr>

</table>

</form>
   <script
      type="text/javascript"
      language="javascript">
      document.getElementById("<?php echo $defaultField; ?>").focus();
   </script>
        </body>
	
<br />
<p>&nbsp;</p>
<h2>This transaction will be applied to the required payment below:</h2>
<br />
