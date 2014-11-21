<script>
function clearData(pInput) {
 if (pInput == 'depositDate') {
 	document.forms["PaymentsMainForm"].elements["depositDate"].value = '';
 	document.forms["PaymentsMainForm"].elements["depositDateDisplay"].value = '';
 }
 if (pInput == 'dueDate') {
 	document.forms["PaymentsMainForm"].elements["dueDate"].value = '';
 	document.forms["PaymentsMainForm"].elements["dueDateDisplay"].value = '';
 }
}

 </script>

<?php 
if (!$securityLevelOneCheck) {
	exit;
}

$sumDeposits = 0;

$query = 'select  sum(depositAmount) as sumDepositAmount, sum(expectedAmount) as sumExpectedAmount
			from offerPayments
				where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;
if ($dbSingleUse->Query($query)) { 
	while ($rowPayments = $dbSingleUse->Row()) {
		$sumDepositAmounts = $rowPayments->sumDepositAmount;
		$sumExpectedAmounts = $rowPayments->sumExpectedAmount;
	}
}

if ($sumExpectedAmounts ==0 and $sumDepositAmounts == 0) { 
	echo '
	<table width="100%" border="0">
	  <tr>
		<td align="center">
		<form action="" method="post" name="PaymentsAddDefaultForm" target="_self" >
		<input name="myAction" type="hidden" id="myAction" value="EditOffer" />
		<input name="myEditAction" type="hidden" id="myEditAction" value="AddOfferDefaultPayments" />
		<button type="submit" class="formbutton" name="addPaymentsButton" id="addPaymentsButton" style="width: 500px;">Click Here to Add Default Customer Expected Payments</button>
	     </form>
		</td>
	  </tr>
	</table>
';
}

$query = 'select id , siteShortName , lotNumber ,dueDate ,depositDate ,expectedAmount ,depositAmount ,paymentStatus ,comments ,modDate ,modUserName 
, case 
   when dueDate < curdate() and paymentStatus <> "Cancelled" and paymentStatus <> "PaymentReceived" then "red" else ""
  end 
  as dateStatus
      from offerPayments 	
				where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;

if ($myEditAction == 'EditSinglePayment') {
	$query = $query.' and id = '.$_GET["paymentId"];
}

$query = $query.' order by dueDate asc';
//echo $query;
?>
<table class="tableOfferEntry" width="100%" border="1" cellspacing="1" cellpadding="1" align="left">
<form action="" method="post" name="PaymentsMainForm" target="_self" onsubmit="return checkFormData(this)">
<?php
//echo '<tr><td colspan="4"><h1>Edit Offer Features</h1></td></tr>';
echo '<tr>';
echo '<th width="125px" >Due Date</th>';
echo '<th width="45px" >Expected<br/>Amount</th>';
echo '<th width="50px" >Status</th>' ;
echo '<th width="125px" >Bank<br />Deposit<br/>Date</th>';
echo '<th width="45px" >Bank<br />Deposit<br/>Amount</th>';
echo '<th width="100px" >Comments</th>';
echo '<th align="center">Action</th>';
echo '</tr>';

$x=0;
if ($dbSingleUse->Query($query)) { 
	while ($rowPayments = $dbSingleUse->Row()) {
		$x = $x + 1;
		if ($myEditAction == 'EditSinglePayment') {
			$dueDate = $rowPayments->dueDate;
			$dateStatus = $rowPayments->dateStatus;
			$depositDate = $rowPayments->depositDate;
			$expectedAmount =  $rowPayments->expectedAmount;
			$depositAmount = $rowPayments->depositAmount;
			$paymentStatus = $rowPayments->paymentStatus;
			$comments = $rowPayments->comments;
			$paymentId = $rowPayments->id;
		}
		else
		{
			//show data for payment row
			echo '<tr>';
			$bgcolor = "";
			if ($rowPayments->dateStatus > "") {
				$bgcolor = ' bgcolor = "'.$rowPayments->dateStatus.'" ';
			}
	    	echo '<td '.$bgcolor.' align="center">'.nullToChar(formatDateForHTML($rowPayments->dueDate,'-'),'-').'</td>';
	    	echo '<td  align="right"><b>$';
			echo $rowPayments->expectedAmount;
			echo '</b></td>';
	    	echo '<td align="center">'.nullToChar($rowPayments->paymentStatus,'-').'</td>';
	    	echo '<td align="center">'.nullToChar(formatDateForHTML($rowPayments->depositDate,'-'),'-').'</td>';
	    	echo '<td  align="right"><b>$';
			echo $rowPayments->depositAmount;
			echo '</b></td>';
	    	echo '<td>'.nullToChar($rowPayments->comments,'-').'</td>';
			echo '<td align="center"><big><a href="index.php?myAction=EditOffer&myEditAction=EditSinglePayment&paymentId='.$rowPayments->id.'">Edit</a></big></td>';
			echo '</tr>';
		}
	}
} 
?>
<input name="myAction" type="hidden" id="myAction" value="EditOffer" />
<input name="myEditAction" type="hidden" id="myEditAction" value="<?php if ($myEditAction == 'EditSinglePayment') { echo 'SavePayment'; } else { echo 'AddPayment'; } ?>" />
<input name="paymentId" type="hidden" id="paymentId" value="<?php echo $paymentId; ?>" />
<tr>
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
  <IMG SRC="images/delete-icon.gif" name="a1" width="15" height="15"  border="0" usemap="#pswd" style="cursor:hand" 	onclick="clearData('dueDate')">
  <input name="dueDateDisplay" type="text" value="<?php if (isset($dueDate)) {echo formatDateForHTML($dueDate,NULL);} ?>" id="dueDateDisplay" style="width:76px;" disabled="disabled"  />
  <input name="dueDate" type="hidden" value="<?php if (isset($dueDate)) {echo formatDateForHTML($dueDate,NULL);} ?>" id="dueDate" style="width:76px;" /></td>
	<td align="right"><input name="expectedAmount" id="expectedAmount" type="text" value="<?php echo $expectedAmount; ?>" onkeypress="validateNumber(event)"  size="7" maxlength="13" />
    </td>
	<td>
    <table width="125px">
	  <tr>
	    <td><label>
	      <input type="radio" name="paymentStatus" value="Payment Expected" <?php if ($paymentStatus ==  "Payment Expected" or $paymentStatus ==  "") { echo "checked=checked"; }?> id="paymentStatus_0" />
	      Payment Expected</label></td>
	    </tr>
	  <tr>
	    <td><label>
	      <input type="radio" name="paymentStatus" value="NSF" <?php if ($paymentStatus ==  "NSF") { echo "checked=checked"; }?> id="paymentStatus_1" />
	      NSF</label></td>
	    </tr>
	  <tr>
	    <td><label>
	      <input type="radio" name="paymentStatus" value="Payment Received" <?php if ($paymentStatus ==  "Payment Received") { echo "checked=checked"; }?> id="paymentStatus_2" />
	      Payment Received</label></td>
	    </tr>
	  <tr>
	    <td><label>
	      <input name="paymentStatus" type="radio" id="paymentStatus_3" value="Cancelled" <?php if ($paymentStatus ==  "Cancelled") { echo "checked=checked"; }?> />
	      Cancelled</label></td>
	    </tr>
	  </table></td>
    
	<td><SCRIPT>$(function() {
                       $("#depositDate").datepicker({ 
					     altField: ('#depositDateDisplay'),
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
  <IMG SRC="images/delete-icon.gif" name="a1" width="15" height="15"  border="0" usemap="#pswd" style="cursor:hand" 	onclick="clearData('depositDate')">
      	    <input name="depositDateDisplay" type="text" value="<?php if (isset($depositDate)) {echo formatDateForHTML($depositDate,NULL);} ?>" id="depositDateDisplay" style="width:76px;" disabled="disabled"  />
        <input name="depositDate" type="hidden" value="<?php if (isset($depositDate)) {echo formatDateForHTML($depositDate,NULL);} ?>" id="depositDate" style="width:76px;" />
  </td>
	<td align="right"><input name="depositAmount" id="depositAmount" type="text" value="<?php echo $depositAmount; ?>" onkeypress="validateNumber(event)"  size="7" maxlength="13" />
	<td >
	  <textarea name="comments" cols="20" rows="4" id="comments" ><?php echo $comments; ?></textarea>
	</td>
    </td>
<td align="right">
     	<button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 60px;"><?php if ($myEditAction == 'EditSinglePayment') {echo '  Save ';} else {echo '  Add  ';} ?></button>
            </td>
            </tr>
<tr ><td></td></tr>
</form>
<?php 
if ($myEditAction == 'EditSinglePayment') {
	echo '
	<tr>
    <td colspan = "7" align="right" rowspan="2"><form action="index.php?myAction=EditOffer" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="DeletePayment" />
	<input name="paymentId" type="hidden" id="id" value="'.$paymentId.'" />
	<button type="button" class="formbutton" name="delete" id="delete" onclick="if (confirm('."'Are you sure you want to delete?'".')) submit();"  style="width: 60px;">Delete</button>
	</form>
	</td>
</tr>
	<tr><td></td></tr>
';
}
?>
<tr>
    <td colspan="2" align="right"><?php	echo '$'.money_format('%.2n',$sumExpectedAmounts); ?>
    <td colspan="3" align="right"><?php	echo '$'.money_format('%.2n',$sumDepositAmounts); ?>
</td>
    <td align="right"><form action="index.php?myAction=EditOffer" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <?php if ($myEditAction == 'EditSingleFeature') {
		echo '<input name="myEditAction" type="hidden" id="myEditAction" value="EditOfferPayments" />';
	}?>
    <button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges" style="width: 60px;"><?php if ($myEditAction == 'EditSinglePayment') {echo 'Cancel';} else {echo 'Return';}?></button></form> </td>
</tr>
</table>
<br />
<h2>Payment Summary</h2>
<?php

$query = 'SELECT  paymentStatus as "Payment Status"
, case 
   when dueDate > curdate() then "2.Future Date"
   when dueDate <= curdate() then "1.Past Due"
   else "3. Other"
  end 
  as "Date Status"
, sum(expectedAmount) as "Expected Payments"
, sum(depositAmount) as "Deposits Total"
, sum(expectedAmount) - sum(depositAmount) as "Outstanding Balance"
FROM `offerPayments` 
	where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;
$query .= ' group by "Date Status", paymentStatus';
$query .= ' order by "Date Status", paymentStatus';
//echo $query;

if ($dbSingleUse->Query($query)) { 
		echo $dbSingleUse->GetHTML(false,"tableDataStandard");
/*	while ($rowPayments = $dbSingleUse->Row()) {
		$sumDepositAmounts = $rowPayments->sumDepositAmount;
		$sumExpectedAmounts = $rowPayments->sumExpectedAmount;
	}*/
	
}

?>