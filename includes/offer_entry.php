<?php

require_once ("classes/misc_functions.php");
require_once ("classes/login_functions.php");
require_once("javascripts/javascript_for_forms.php"); 
require_once('classes/report_replace_fields.php');
echo excavationStartedMessage($dbSingleUse,$lotNumber, $siteShortName)	;
echo '</td></tr>';

	$includeFile2 = '';
//	echo '<br />'.$myEditAction;
	if (isset($myEditAction)) {
		if ($myEditAction == 'ReturnToOfferMenu') {
			$reportDocumentHeaderTitle2 = '';
			$includeFile = 'offer_entry_link_bar.php';
		}
		if ($myEditAction == 'SaveCustomer') {
			require_once ("offer_updates.php");
			$reportDocumentHeaderTitle2 = 'Edit Customer Details';
			$includeFile = 'offer_entry_link_bar.php';
		}
		if ($myEditAction == 'SaveCoreOffer') {
			require_once ("offer_updates.php");
			$reportDocumentHeaderTitle2 = 'Edit Dates and Financials';
			$includeFile = 'offer_entry_link_bar.php';
		}
		if ($myEditAction == 'EditCustomer') {
			$reportDocumentHeaderTitle2 = 'Edit Customer Details';
			$includeFile = 'offer_entry_customer.php';
		}
		if ($myEditAction == 'EditCoreOffer') {
			$reportDocumentHeaderTitle2 = 'Edit Dates and Financials';
			$includeFile = 'offer_entry_core.php';
		}
		if ($myEditAction == 'EditOfferAmendments') {
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Amendments';
			$includeFile = 'offer_entry_amendments.php';
		}
		if ($myEditAction == 'EditSingleAmendment') {
			$reportDocumentHeaderTitle2 = 'Edit Existing Amendment';
			$includeFile = 'offer_entry_amendments.php';
		}
		if ($myEditAction == 'SaveAmendment') {
			require_once ("offer_amendment_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Amendments';
			$includeFile = 'offer_entry_amendments.php';
		}
		if ($myEditAction == 'AddAmendment') {
			require_once ("offer_amendment_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Amendments';
			$includeFile = 'offer_entry_amendments.php';
		}
		if ($myEditAction == 'DeleteAmendment') {
			require_once ("offer_amendment_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Amendments';
			$includeFile = 'offer_entry_amendments.php';
		}
		if ($myEditAction == 'EditOfferChangeOrders') {
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Change Orders';
			$includeFile = 'offer_entry_change_orders.php';
		}
		if ($myEditAction == 'EditSingleChangeOrder') {
			$reportDocumentHeaderTitle2 = 'Edit Existing Change Order';
			$includeFile = 'offer_entry_change_orders.php';
		}
		if ($myEditAction == 'SaveChangeOrder') {
			require_once ("offer_change_order_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Change Orders';
			$includeFile = 'offer_entry_change_orders.php';
		}
		if ($myEditAction == 'AddChangeOrder') {
			require_once ("offer_change_order_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Change Orders';
			$includeFile = 'offer_entry_change_orders.php';
		}
		if ($myEditAction == 'DeleteChangeOrder') {
			require_once ("offer_change_order_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Change Orders';
			$includeFile = 'offer_entry_change_orders.php';
		}
		if ($myEditAction == 'EditOfferWorkCredits') {
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Work Credits';
			$includeFile = 'offer_entry_work_credits.php';
		}
		if ($myEditAction == 'EditSingleWorkCredit') {
			$reportDocumentHeaderTitle2 = 'Edit Existing Work Credit';
			$includeFile = 'offer_entry_work_credits.php';
		}
		if ($myEditAction == 'SaveWorkCredit') {
			require_once ("offer_work_credit_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Work Credits';
			$includeFile = 'offer_entry_work_credits.php';
		}
		if ($myEditAction == 'AddWorkCredit') {
			require_once ("offer_work_credit_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Work Credits';
			$includeFile = 'offer_entry_work_credits.php';
		}
		if ($myEditAction == 'DeleteWorkCredit') {
			require_once ("offer_work_credit_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Work Credits';
			$includeFile = 'offer_entry_work_credits.php';
		}
		if ($myEditAction == 'EditOfferFeatures') {
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Extras';
			$includeFile = 'offer_entry_extras.php';
		}
		if ($myEditAction == 'EditSingleFeature') {
			$reportDocumentHeaderTitle2 = 'Edit Existing Extra';
			$includeFile = 'offer_entry_extras.php';
		}
		if ($myEditAction == 'SaveFeature') {
			require_once ("offer_extras_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Extras';
			$includeFile = 'offer_entry_extras.php';
		}
		if ($myEditAction == 'AddFeature') {
			require_once ("offer_extras_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Extras';
			$includeFile = 'offer_entry_extras.php';
		}
		if ($myEditAction == 'DeleteFeature') {
			require_once ("offer_extras_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Extras';
			$includeFile = 'offer_entry_extras.php';
		}
		if ($myEditAction == 'EditOfferDeposits' or $myEditAction == "CancelDepositDetail" or $myEditAction == "CancelDepositChanges") {
			$reportDocumentHeaderTitle2 = 'Add/Manage Deposits';
			$includeFile = 'offer_entry_deposits.php';
		}
		if ($myEditAction == 'EditSingleDeposit') {
			$reportDocumentHeaderTitle2 = 'Edit Existing Deposit';
			$includeFile = 'offer_entry_deposits.php';
		}
		if ($myEditAction == 'SaveDeposit') {
			require_once ("offer_deposits_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Deposits';
			$includeFile = 'offer_entry_deposits.php';
		}
		if ($myEditAction == 'SaveNewDeposit') {
			require_once ("offer_deposits_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Deposits';
			$includeFile = 'offer_entry_deposits.php';
		}
		if ($myEditAction == 'DeleteDeposit') {
			require_once ("offer_deposits_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Deposits';
			$includeFile = 'offer_entry_deposits.php';
		}
		if ($myEditAction == 'AddOfferDefaultDeposits') {
			$currentSettingCheck = 'Offer Default Deposits PHP File';
			$defaultDepositsFile = getSettingValue($dbSingleUse, $currentSettingCheck) ;
			
			require_once ($defaultDepositsFile);
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Deposits';
			$includeFile = 'offer_entry_deposits.php';
		}
		if ($myEditAction == 'AddOfferDeposit') {
			$reportDocumentHeaderTitle2 = 'Add New Deposits';
			$includeFile = 'offer_entry_deposits.php';
		}
		if ($myEditAction == 'AddDepositDetailDeposit' ) {
			$reportDocumentHeaderTitle2 = 'Add New Deposit';
			$includeFile = 'offer_entry_deposits.php';
		}
		if ($myEditAction == 'AddDepositDetailNote') {
			$reportDocumentHeaderTitle2 = 'Add New Note';
			$includeFile = 'offer_entry_deposits.php';
		}
		if ($myEditAction == 'AddDepositDetailNSF') {
			$reportDocumentHeaderTitle2 = 'Add New NSF Transaction';
			$includeFile = 'offer_entry_deposits.php';
		}
		if ($myEditAction == 'SaveDepositDetail') {
			require_once ("offer_deposits_updates.php");
			$reportDocumentHeaderTitle2 = 'Add/Manage Offer Deposits';
			$includeFile = 'offer_entry_deposits.php';
		}
		if ($myEditAction == 'CopyOffer') {
			require_once ("offer_copy_updates.php");
			$reportDocumentHeaderTitle2 = 'Copying Offer Results';
			$includeFile = 'offer_entry_link_bar.php';
		}
		if ($myEditAction == 'MoveOffer') {
			require_once ("offer_move_updates.php");
			$reportDocumentHeaderTitle2 = 'Moving Offer Results';
			$includeFile = 'offer_entry_link_bar.php';
		}
		if ($myEditAction == 'DeleteOffer') {
			require_once ("offer_delete_updates.php");
			$reportDocumentHeaderTitle2 = 'Deleting Offer Results';
			$includeFile = 'offer_entry_link_bar.php';
		}
		if ($myEditAction == 'PrintOfferForms') {
			$reportDocumentHeaderTitle2 = 'Print Offer Forms';
			$includeFile = 'offer_entry_link_bar.php';
			$includeFile2 = "offer_print_forms.php";
		}
		if ($myEditAction == 'PrintSingleForm') {
			 require_once("offer_print_single_form.php");
		//	 require_once("offer_print_extras_insert.php");
			$reportDocumentHeaderTitle2 = 'Print Offer Forms';
             $includeFile = 'offer_entry_link_bar.php';
			 $includeFile2 = "offer_print_forms.php";
		}
		if ($myEditAction == 'FinishedPrinting') {
			$reportDocumentHeaderTitle2 = 'Print Offer Forms';
             $includeFile = 'offer_entry_link_bar.php';
		}
	}
	else
	{
		$includeFile = 'offer_entry_link_bar.php';
	}
if ($g_UseOfferOverrideDateFunctionality) {
	echo noOfferChangesAllowedMessage($dbSingleUse,$lotNumber, $siteShortName)	;
}


$query = 'select *
			from offerDetailView 	
				where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;

//printf( '<tr><td>'.$query.'</td></tr>');
$rowNumm = 0;
if ($db->Query($query)) { 

	while ($resultRow = $db->Row()) {

	$rowNumm = $rowNumm + 1;
	echo '<tr><td>';
	echo '<h1>Lot <a href="index.php?myAction=Lot&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.$resultRow->lotNumber;
			if ($siteShortName <= "") {
					echo '<small>('.$resultRow->siteShortName.')</small>';
			}
			echo '</a> - <a href="?myAction=Lots&siteShortName='.$resultRow->siteShortName.'">'.$resultRow->siteName.'</a></h1>';
	
	$offerInfo = $resultRow;
    echo '</td></tr>';
	echo '<tr><td>';
	//alertBox($myEditAction);
	$reportDocumentHeaderTitle1 = ''; 
	//echo 'myEditAction'.$myEditAction;

?>
<table class="clsPrattTable" border="0" cellspacing="0"><tr><td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><u><h1><?php echo($reportDocumentHeaderTitle1); ?></h1></u>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><h1><?php echo($reportDocumentHeaderTitle2); ?></h1></td>
        </tr>
    </table></td>
    <td></td>
    <td></td>
  </tr>
</table>

<?php
	if ($includeFile > '') {
		include ($includeFile);
	}
	else {
		echo "Please choose an option.";
	}
	if ($includeFile2 > '') {
	include ($includeFile2);
	}

    echo '</td></tr>';
	echo '<tr><td>&nbsp;';
    echo '</td></tr>';
	echo '<tr><td>';
	require_once ("table_aps_header.php");
    echo '</td></tr>';
	echo '<tr><td>&nbsp;';
    echo '</td></tr>';
	echo '<tr><td>';
	include("uploaded_documents.php");
    echo '</td></tr>';
	echo '<tr><td>&nbsp;';
    echo '</td></tr>';
	echo '<tr><td>';
	include ("table_offer_extras.php");
    echo '</td></tr>';
	echo '<tr><td>&nbsp;';
    echo '</td></tr>';
	echo '<tr><td>';
	include ("table_offer_change_orders.php");
    echo '</td></tr>';
	echo '<tr><td>';
	include ("table_offer_amendments.php");
    echo '</td></tr>';
	echo '<tr><td>';
	include ("table_offer_work_credits.php");
    echo '</td></tr>';
	echo '<tr><td>';
	}
}

/*
if ($rowNumm == 0) {
	echo '<br><br><h1>Error: Lot '.$lotNumber.' was not found in the database.</h1><br><br>';
}
*/
  echo '</td></tr>';
	echo '</table>';
	
		if ($securityCanCopyOrDeleteOffers) {
			echo '
			<form action="index.php?myAction=EditOffer" method="post" name="form3" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="DeleteOffer" />
	<button type="button" class="formbutton" name="delete" id="delete" onclick="if (confirm('."'Are you sure you want to delete this offer and all of its contents?'".')) submit();"  style="width: 400px;">DELETE offer and all related content</button>
	</form>';
	echo '<br><br>
		<form action="index.php?myAction=EditOffer" method="post" name="form4" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="CopyOffer" />
	<button type="button" class="formbutton" name="copy" id="copy" onclick="if (confirm('."'Are you sure you want to copy the offer?'".')) submit();" style="width: 400px;">COPY offer and all related content</button>
	<label for="DestLot">To this lot:</label>
	<input type="text" name="DestLot" id="DestLot" />(at '.$siteShortName.')
    <br>(does <u>not</u> include Deposits)
    </form>

';
	echo '<br><br>
		<form action="index.php?myAction=EditOffer" method="post" name="form4" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="MoveOffer" />
	<button type="button" class="formbutton" name="copy" id="copy" onclick="if (confirm('."'Are you sure you want to move the offer?'".')) submit();" style="width: 400px;">MOVE offer and all related content </button>
	<label for="DestLot">To this lot:</label>
	<input type="text" name="DestLot" id="DestLot" />(at '.$siteShortName.')
    <br>(includes Deposits)
	</form>
    
';
		}	
	
?>

