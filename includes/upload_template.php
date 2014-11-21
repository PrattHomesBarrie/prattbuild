<?php
require_once ("classes/misc_functions.php");
require_once ("classes/login_functions.php");


//echo $myAction;

if ($myEditAction == "AddTemplate"){ 
	echo "<tr><td>";
	echo "Current Folder;".getcwd() . "\n";
	echo "<br>File to Upload:".$_FILES['fileName']['name'];
	$name = basename( $_FILES['fileName']['name']);
//     $name_stripped =  str_replace(' ','',$name) ; 
	$documentPrefix = '';
	$newFileName = $documentPrefix.basename( $_FILES['fileName']['name']);
	$target_unstripped = "uploadedItems/offerDocumentTemplates/"; 
	$target_unstripped = $target_unstripped . $newFileName ; 
	$target = $target_unstripped;
	$target_unstripped_backup = "uploadedItems/offerDocumentTemplates/backup/"; 
	$target_unstripped_backup = $target_unstripped_backup . $newFileName.date('Y-m-j-h-i-s') ; 
	if (file_exists($target_unstripped)) {
		 copy($target_unstripped,$target_unstripped_backup);
		 echo '<br><br>original file backed up to :'.$target_unstripped_backup;
	}
//	 $target = str_replace(' ','',$target_unstripped) ; 
	 //echo "<br>".$target_unstripped;
	 //echo "<br>".$target;
	$ok=1; 
 
 	echo "<br><br>";
 
	 if ($_FILES["file"]["error"] > 0)
	  {
	  echo "Error: " . $_FILES["fileName"]["error"] . "<br />";
	  }
	else
	  {
	  echo "Upload: " . $_FILES["fileName"]["name"] . "<br />";
//	  echo "Type: " . $_FILES["fileName"]["type"] . "<br />";
	  echo "Size: " . ($_FILES["fileName"]["size"] / 1024) . " Kb<br />";
//	  echo "Stored in: " . $_FILES["fileName"]["tmp_name"];
 	 }
	 if(move_uploaded_file($_FILES['fileName']['tmp_name'], $target))  { 
		 echo "The file ". basename( $_FILES['fileName']['name']). " has been uploaded"; 
		$query = 'delete from fileLocations where fileName = "'.$newFileName.'"';
		$numberOfRows = $dbSingleUse->Query($query);
		$newFileDescription = $_POST['fileDescription'];
		if ($newFileDescription == '') {
			$newFileDescription = $newFileName;
		}
		$query = 'insert into fileLocations (fileType,  fileDescription,  fileName  ) values ("Word Document","'.$newFileDescription.'","'.$newFileName.'")';
		//echo '<br>'.$query;
		$numberOfRows = $dbSingleUse->Query($query);
		if ($numberOfRows < 1) {
			echo "<br><br>ERROR - File ".$newFileName." was uploaded but not added to database.  Please try again.";
		}

	 }
	 else  { 
		 echo "Sorry, there was a problem uploading your file:".$newFileName; 
	 }
	 echo '</td></tr>';
}

	echo '<tr><td>';


echo '</tr></td></table>';
?>
  
</p>
<p>&nbsp;</p>
<form  method="POST" target="_self" enctype="multipart/form-data">
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="AddTemplate" />

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>Choose a File:</td>
      <td ><input name="fileName" type="file" size="100" />
    </tr>
    <tr>
      <td>File Description:</td>
      <td><input id="fileDescription" name="fileDescription" type="text" size="100" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" value="Upload" />
       </td>
    </tr>
  </table>
  <p><br />
  </p>
</form>
<p>&nbsp;</p>
