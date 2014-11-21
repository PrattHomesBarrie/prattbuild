<?php
require_once ("classes/misc_functions.php");
require_once ("classes/login_functions.php");

$reportDocumentHeaderTitle1 = 'A.P.S  DETAILS'; 
$reportDocumentHeaderTitle2 = 'AGREEMENT OF PURCHASE AND SALE DETAILS'; 
?>
<table class="clsPrattTable" border="0" cellspacing="0"><tr><td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><u><h1><?php echo($reportDocumentHeaderTitle1); ?></h1></u>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><h2><?php echo($reportDocumentHeaderTitle2); ?></h2></td>
        </tr>
    </table></td>
    <td align="center"><img src="images/pratt_construction.jpg" width="240" height="83" alt="Pratt Contruction" /></td>
  </tr>
  <tr>
  <td align="right"><b>Date:</b></td>
  <td align="center"><b><?php printCurrentDateLong();?></b></td>
  </tr>
</table>
<?php
echo '</td></tr>';
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
?>

