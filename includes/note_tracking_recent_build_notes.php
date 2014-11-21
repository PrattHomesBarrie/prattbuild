
<?php


$query = 'select *
			from lotBuildResultsNotes';
//				where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;
$query = $query.' order by noteDate desc limit 25';
$rowNumm = 0;
//echo $query;
if ($db->Query($query)) { 

	while ($resultRow = $db->Row()) {

		$rowNumm = $rowNumm + 1;
		if ($rowNumm == 1) {
			echo '<h3>Recent Build Related Notes</h3>';
			echo '<table class="clsPrattTable">';
			echo '<tr>';
		    echo '<th align="center" >Site</th>';
		    echo '<th align="center" >Lot</th>';
			echo '<th width="15%">Build Item</th>';
			echo '<th width="50%">Note</th>';
			echo '<th width="15%" align="center">Date Added</th>';
			echo '<th width="20%">User</th>';
			echo '</tr>';
		}
		echo '<tr>';
	    echo '<td class="tableDataSmall" >'.$resultRow->siteShortName.'</td>';
	    echo '<td class="tableDataSmall" align="center"><a href="index.php?myAction=Lot&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.$resultRow->lotNumber.'</a></td>';
		echo '<td class="tableDataSmall" >'.$resultRow->buildAction.'</td>';
		echo '<td class="tableDataNotes" >'.$resultRow->noteText.'</td>';
		echo '<td class="tableDataSmall" align="center">'.substr($resultRow->noteDate, 0,10).'</td>';
		echo '<td class="tableDataSmall" align="center">'.$resultRow->userName.'<p></p></td>';
		echo '</tr>';
	}
}

if ($rowNumm > 0) {
	echo '</table>';
}
?>