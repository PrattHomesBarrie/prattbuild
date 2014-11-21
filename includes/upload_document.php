<?php
require_once ("classes/misc_functions.php");
require_once ("classes/login_functions.php");

$reportDocumentHeaderTitle1 = 'Lot Documents'; 
$reportDocumentHeaderTitle2 = 'Upload and Attach Document to Lot'; 

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
if ($myAction == "ChangeLotDocument"){ 
	 echo "<tr><td>";
	 $table="lotDocuments";
	 $where["id"]=$_POST['id'];
 	$availableToPublic = $_POST['availableToPublic'];
	if ($availableToPublic == '') {
 		$availableToPublic = 0;
	}
	 $arr["availableToPublic"]=$availableToPublic;
	$result = $dbSingleUse->UpdateRows($table,$arr,$where);
	 if ($result) {
		 echo "<br>Successfully Updated Document";
	 }
	 else  { 
	 	 alertBox("Sorry, there was a problem updating your file.");
		 echo "<br>Sorry, there was a problem updating your file."; 
	 }
	 echo '</td></tr>';
}
if ($myAction == "ProcessUploadFile"){ 
	echo "<tr><td>";
	$name = basename( $_FILES['documentName']['name']);
//     $name_stripped =  str_replace(' ','',$name) ; 
	$documentPrefix = $siteShortName.'_'.$lotNumber.'_';
	$newFileName = $documentPrefix.basename( $_FILES['documentName']['name']);
	$target_unstripped = "uploadedItems/"; 
	 $target_unstripped = $target_unstripped . $newFileName ; 
//	 $target = str_replace(' ','',$target_unstripped) ; 
	 $target = $target_unstripped;
	 echo "<br>".$target_unstripped;
	 echo "<br>".$target;
	 $ok=1; 
 
 	echo "<br><br>";
 
	 if ($_FILES["file"]["error"] > 0)
	  {
	  echo "Error: " . $_FILES["documentName"]["error"] . "<br />";
	  }
	else
	  {
	  echo "Upload: " . $_FILES["documentName"]["name"] . "<br />";
//	  echo "Type: " . $_FILES["documentName"]["type"] . "<br />";
	  echo "Size: " . ($_FILES["documentName"]["size"] / 1024) . " Kb<br />";
//	  echo "Stored in: " . $_FILES["documentName"]["tmp_name"];
 	 }
	 if(move_uploaded_file($_FILES['documentName']['tmp_name'], $target))  { 
		 echo "The file ". basename( $_FILES['documentName']['name']). " has been uploaded"; 
		$query = 'delete from lotDocuments where siteShortName =  "'.$siteShortName.'" and lotNumber = '.$lotNumber.' and documentName = "'.$newFileName.'"';
		$numberOfRows = $dbSingleUse->Query($query);
		$availableToPublic = $_POST['availableToPublic'];
		if ($availableToPublic == '') {
			$availableToPublic = 0;
		}
		//echo $availableToPublic;
		$query = 'insert into lotDocuments (userName, siteShortName, lotNumber, documentName, documentNotes, availableToPublic) values ("'.$userName.'", "'.$siteShortName.'", '.$lotNumber.',"'.$newFileName.'","'.$_POST['documentNotes'].'", '.$availableToPublic.')';
			//echo '<br>'.$query;
		$numberOfRows = $dbSingleUse->Query($query);
		if ($numberOfRows < 1) {
			echo "<br><br>ERROR - File was uploaded but not added to database.  Please try again.";
		}

	 }
	 else  { 
		 echo "Sorry, there was a problem uploading your file."; 
	 }
	 echo '</td></tr>';
}

	echo '<tr><td>';

include("uploaded_documents.php");

echo '</tr></td></table>';
?>
  
</p>
<p>&nbsp;</p>
<form  method="POST" enctype="multipart/form-data" target="_self">

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>Choose a File:</td>
      <td ><input name="documentName" type="file" size="60" />
    </tr>
    <tr>
      <td>Enter a Comment:</td>
      <td><textarea name="documentNotes" id="documentNotes" cols="80" rows="3"></textarea></td>
    </tr>
    <tr>
      <td>Available to Public:</td>
      <td><input name="availableToPublic" type="checkbox" value="1" checked /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" value="Upload" />
        <input name="myAction" type="hidden" id="myAction3" value="ProcessUploadFile" /></td>
    </tr>
  </table>
  <p><br />
  </p>
</form>
<p>&nbsp;</p>
