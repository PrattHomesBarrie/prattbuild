<?php

require_once ("classes/misc_functions.php");
require_once ("classes/login_functions.php");
require_once("javascripts/javascript_for_forms.php"); 
require_once('classes/report_replace_fields.php');
echo '</td></tr>';


	$includeFile2 = '';
	if (isset($myEditAction)) {
		if ($myEditAction == 'SaveChart') {
//			require_once ("offer_updates.php");
//			$reportDocumentHeaderTitle2 = 'Edit Chart';
			$includeFile = 'chart_entry_updates.php';
			$includeFile2 = 'chart_entry_form.php';
		}
		if ($myEditAction == 'EditChart') {
//			$reportDocumentHeaderTitle2 = 'Edit Chart';
			$includeFile = 'chart_entry_form.php';
		}
		if ($myEditAction == 'DeleteChart') {
//			require_once ("offer_amendment_updates.php");
			$reportDocumentHeaderTitle2 = 'Deleting Chart';
//			$includeFile = 'offer_entry_amendments.php';
		}
	}
	else
	{
//		$includeFile = 'offer_entry_link_bar.php';
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
	include ($includeFile);
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
	
		if ($securityLevelOneCheck ) {
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
    </form>

';
	echo '<br><br>
		<form action="index.php?myAction=EditOffer" method="post" name="form4" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditOffer" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="MoveOffer" />
	<button type="button" class="formbutton" name="copy" id="copy" onclick="if (confirm('."'Are you sure you want to move the offer?'".')) submit();" style="width: 400px;">MOVE offer and all related content</button>
	<label for="DestLot">To this lot:</label>
	<input type="text" name="DestLot" id="DestLot" />(at '.$siteShortName.')
    </form>

';
		}	
	
?>

