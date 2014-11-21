<?php

if ($myAction == 'DeleteLotDocument') {
	
	$table = "lotDocuments";
	$where["id"] = $_GET['id'];	
//	print_r($where);
//	print "<br />";
	$result = $dbSingleUse->DeleteRows($table, $where);
}

$query = 'select *
			from lotDocuments 	
				where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;
$query = $query.' order by dateAdded';
$rowNumm = 0;
if ($db->Query($query)) { 

	while ($resultRow = $db->Row()) {

		$rowNumm = $rowNumm + 1;
		if ($rowNumm == 1) {
			echo '<table class="clsPrattTable">';
			echo '<tr>';
			echo '<th>Document</th>';
			echo '<th>Notes</th>';
			echo '<th width="10%" align="center">Date Added</th>';
			echo '<th width="15%">User</th>';
			echo '<th width="3%">Public?</th>';
			$currentSettingCheck = 'Allow Deleting of Uploaded Documents';
			$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
			if ($settingValue == '1') {
				echo '<th width="3%">Action</th>';
			}
			echo '</tr>';
		}
		echo '<tr>';
		echo '<td class="tableDataSmall"><a target="_blank" href="uploadedItems/'.$resultRow->documentName.'">'.$resultRow->documentName.'</a></td>';
		echo '<td class="tableDataSmall">'.$resultRow->documentNotes.'</td>';
		echo '<td class="tableDataSmall" >'.substr($resultRow->dateAdded, 0,10).'</td>';
		echo '<td class="tableDataSmall">'.$resultRow->userName.'</td>';
		if ($resultRow->availableToPublic == 1) {
			$checked = 'checked="checked"';
			$tdbgcolor = 'bgcolor="green"';
		}
		else {
			$checked = '';
			$tdbgcolor = 'bgcolor="yellow"';
		}
		
		echo '<td  align="center" '.$tdbgcolor.'>'; 
		$formAction = 'index.php?myAction=ChangeLotDocument&lotNumber='.$lotNumber.'&siteShortName='.$siteShortName;
		echo '<form action="'.$formAction.'" method="post" name="form1" target="_self" id="form1">
			  	<input '.$checked.'  name="availableToPublic" type="checkbox" id="availableToPublic" value="1" onclick="this.form.submit();"/>
  				<label for="watch"></label>
  				<input name="id" type="hidden" id="id" value="'.$resultRow->id.'" /></form>';
		echo '</td>';
		if ($securityLevelOneCheck ) {
			$currentSettingCheck = 'Allow Deleting of Uploaded Documents';
			$settingValue = getSettingValue($dbSingleUse, $currentSettingCheck) ;
			if ($settingValue == '1') {
				echo '<td><a href="index.php?myAction=DeleteLotDocument&id='.$resultRow->id.'" onclick="if (confirm('."'Are you sure you want to permanently delete this attachment?'".')) submit();" ><b>Delete</b></a></td>';
			}
		}
		echo '</tr>';
	}
}

if ($rowNumm > 0) {
	echo '</table>';
}
?>