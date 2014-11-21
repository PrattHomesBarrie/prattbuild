<?php
require_once("upload_template.php");

$query = 'select *
			from fileLocations' ;	
$query = $query.' order by fileDescription';
$rowNumm = 0;
if ($db->Query($query)) { 

	while ($resultRow = $db->Row()) {

		$rowNumm = $rowNumm + 1;
		if ($rowNumm == 1) {
			echo '<table class="clsPrattTable" width="100%">';
			echo '<tr>';
			echo '<th  width="40%">File Name</th>';
			echo '<th  width="40%">File Description</th>';
			echo '<th align="center" width="60px">Date Updated</th>';
			echo '<th align="center" width="50px">Action</th>';
			echo '</tr>';
		}
		echo '<tr>';
		echo '<td class="tableDataSmall" ><a target="_blank" href="uploadedItems/offerDocumentTemplates/'.$resultRow->fileName.'">'.$resultRow->fileName.'</a></td>';
		echo '<td class="tableDataSmall" >'.$resultRow->fileDescription.'</td>';
		echo '<td class="tableDataSmall" >'.substr($resultRow->dateModified, 0,10).'</td>';
		echo '<td ><a onclick="return confirm('."'".'Are you sure you want to delete?'."'".')" href="?myAction=Maintenance&myEditAction=DeleteTemplate&id='.$resultRow->id.'">Delete</a></td>';
		echo '</tr>';
	}
}

if ($rowNumm > 0) {
	echo '</table>';
}
?>