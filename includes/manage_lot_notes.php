<?php
require_once ("classes/misc_functions.php");
require_once ("classes/login_functions.php");

//foreach ($_POST as $key => $entry)
//{
//    print $key . ": " . $entry . "<br>";
//}
//foreach ($_GET as $key => $entry)
//{
//   print $key . ": " . $entry . "<br>";
//}
$reportDocumentHeaderTitle1 = 'Lot Notes'; 
$reportDocumentHeaderTitle2 = 'View and Add Notes for This Lot'; 
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
  $lotNotesID = $_GET["lotNotesID"];
  if ($_POST["lotNotesID"] > $lotNotesID) {
	  $lotNotesID =  $_POST["lotNotesID"];
  }
  
echo '</td></tr>';
$query = 'select *
			from offerDetailView 	
				where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;

//printf( '<tr><td>'.$query.'</td></tr>');
$rowNum = 0;
if ($db->Query($query)) { 

	while ($resultRow = $db->Row()) {

	$rowNum = $rowNum + 1;
	echo '<tr><td>';
	echo '<h1>Lot <a href="index.php?myAction=Lot&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.$resultRow->lotNumber;
			if ($siteShortName <= "") {
					echo '<small>('.$resultRow->siteShortName.')</small>';
			}
			echo '</a> - <a href="?myAction=Lots&siteShortName='.$resultRow->siteShortName.'">'.$resultRow->siteName.'</a></h1>';
	
    echo '</td></tr>';
	}
}

if ($rowNum == 0) {
	echo '<br><br><h1>Error: Lot '.$lotNumber.' was not found in the database.</h1><br><br>';
}

//echo $myAction;
$availableToPublic = $_POST['availableToPublic'];
if ($availableToPublic == '') {
	$availableToPublic = 0;
}
if ($myAction == "AddLotNote"){ 
	echo "<tr><td>";

	$query = 'insert into lotNotes  (userName,siteShortName, lotNumber, noteText, availableToPublic) values ("'.$userName.'", "'.$siteShortName.'", '.$lotNumber.',"'.mysql_real_escape_string($_POST['noteText']).'", '.$availableToPublic.')';
		//	echo '<br>'.$query;
		$numberOfRows = $dbSingleUse->Query($query);
		if ($numberOfRows < 1) {
			echo "<br><br>ERROR - Note was not added to database.  Please try again.";
		}

	 echo '</td></tr>';
}
if ($myAction == "SaveLotNote"){ 
	echo "<tr><td>";

	$query = 'update lotNotes  
	       set userName = "'.$userName.'" ,siteShortName = "'.$siteShortName.'", availableToPublic = '.$availableToPublic.', lotNumber =  '.$lotNumber.', noteText = "'.mysql_real_escape_string($_POST['noteText']).'"
		   	where lotNotesID = '.$lotNotesID;
		//	echo '<br>'.$query;
		$numberOfRows = $dbSingleUse->Query($query);
		if ($numberOfRows < 1) {
			echo "<br><br>ERROR - Note was not updated.  Please try again.";
		}

	 echo '</td></tr>';
}

if ($myAction == "DeleteSingleLotNote"){ 
	echo "<tr><td>";

	$query = 'delete from lotNotes where lotNotesID = '.$lotNotesID;
		//	echo '<br>'.$query;
		$numberOfRows = $dbSingleUse->Query($query);
		if ($numberOfRows < 1) {
			echo "<br><br>ERROR - Note was not deleted.  Please try again.";
		}

	 echo '</td></tr>';
}

	echo '<tr><td>';


echo '</tr></td></table>';

if ($myAction == 'EditSingleLotNote') {
	$query = 'select *
			from lotNotes 	
				where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber
				;

	$query .= " and lotNotesID = ".$lotNotesID;
	$rowNum = 0;
	if ($db->Query($query)) { 
		while ($resultRow = $db->Row()) {
			$rowNum = $rowNum + 1;
			$noteText = $resultRow->noteText;
			$noteDate = $resultRow->noteDate;
			$noteUserName = $resultRow->userName;
			$availableToPublic = $resultRow->availableToPublic;

		}
	}
	
	if ($rowNum == 0) {
		echo '<br><br><h1>Error: Note was not found in the database.</h1><br><br>';
	}
}

?>
  
</p>
<?php
if ($myAction == 'EditSingleLotNote') {
	echo '<h2>Edit Note ';

	echo 'created on '.substr($noteDate, 0,10).'';
	echo ' by '.$userName.'</h2>';}
else {
	echo '<h2>Add New Note</h2>';
}
?>
<form  method="POST" enctype="multipart/form-data" target="_self">

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
      <td>Enter Note Text:</td>
      <td><textarea name="noteText" id="noteText" cols="80" rows="4"><?php
       		if ($myAction == 'EditSingleLotNote') {	
			echo $noteText;
		}?></textarea></td>
    </tr>
    <tr>
      <td>Available to Public:</td>
      <td>
      <input name="availableToPublic" type="checkbox" value="1" <?php
	  	if ($myAction == 'EditSingleLotNote') {	
			if ( $availableToPublic == 1) {
				echo 'checked="checked"';
			}

		}
	   ?>  /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" value="<?php
       		if ($myAction == 'EditSingleLotNote') {	
			echo 'Save Note';
		}
		else {
			echo 'Add Note';
		}
		?>" />
        <input name="siteShortName" type="hidden" value="<?php echo $siteShortName; ?>" />
        <input name="lotNumber" type="hidden" value="<?php echo $lotNumber; ?>" />
        <input name="lotNotesID" type="hidden" value="<?php echo $lotNotesID; ?>" />
        <input name="myAction" type="hidden" id="myAction3" value="<?php
       		if ($myAction == 'EditSingleLotNote') {	
			echo 'SaveLotNote';
		}
		else {
			echo 'AddLotNote';
		}
		?>" />
      </td>
    </tr>
  </table>
</form>
<?php
$allowLotNoteEditing = true;
include("lot_notes.php");
include("lot_notes_build_related.php");
?>
