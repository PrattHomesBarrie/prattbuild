<?php
require_once ("classes/misc_functions.php");
require_once ("classes/login_functions.php");


$reportDocumentHeaderTitle1 = 'Lot Build Notes'; 
$reportDocumentHeaderTitle2 = 'View and Add Notes Related to Specific Build Items'; 
?>
<table class="clsPrattTable" border="0" cellspacing="0">
<tr><td>

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

<p>
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
	
    echo '</td></tr>';
	}
}

if ($rowNumm == 0) {
	echo '<br><br><h1>Error: Lot '.$lotNumber.' was not found in the database.</h1><br><br>';
}

//echo $myAction;

if ($myAction == "SaveNewNote"){ 
	echo "<tr><td>";
	$buildActionName = getBuildActionName($dbSingleUse, $_POST['noteBuildSequence'],$lotNumber, $siteShortName) ;

	$query = 'insert into lotBuildResultsNotes  (userName,siteShortName, lotNumber, noteText, buildAction ) values ("'.$userName.'", "'.$siteShortName.'", '.$lotNumber.',"'.$_POST['noteText'].'","'.$buildActionName.'")';
		//	echo '<br>'.$query;
		$numberOfRows = $dbSingleUse->Query($query);
		if ($numberOfRows < 1) {
			echo "<br><br>ERROR - Note was not added to database.  Please try again.";
		}

	 echo '</td></tr>';
}

	echo '<tr><td>';


echo '</tr></td></table>';


?>
  
</p>
<h1>Add New Note</h1>
<form  method="POST" enctype="multipart/form-data" target="_self">

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>Build Action</td>
      <td ><?php  echo createBuildActionComboBox($dbSingleUse, $buildSequence, $lotNumber, $siteShortName)?>    
      </tr>
    <tr>
      <td>Enter a Comment:</td>
      <td><textarea name="noteText" id="noteText" cols="80" rows="3"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" value="Save Note" />
        <input name="myAction" type="hidden" id="myAction3" value="SaveNewNote" /></td>
    </tr>
  </table>
  <p><br />
  </p>
</form>
<p>&nbsp;</p>
<?php
$allowLotNoteEditing = false;
include("lot_notes_build_related.php");
?>
