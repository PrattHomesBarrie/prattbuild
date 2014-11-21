<SCRIPT LANGUAGE='Javascript'>    $(document).ready(function() {
                  oTable = $("#lotListTable").dataTable({
									"bJQueryUI": true,
                                    "bPaginate": false,
								    /*"sScrollY": "600px",*/
                                    "bLengthChange": false,
                                    "bFilter": true,
                                    "bSort": true,
                                    "bInfo": true,
    								 "bProcessing": false
                         });
               } );    
</SCRIPT>

<small><br>Note: Click on a column title to sort by that column</small>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" id="lotListTable">
<thead>
  <tr>
	<th align="center">Lot</th>
    <th align="center">Model on Offer<br />
      (or Designated Model)</th>
	<th align="center">Site</th>
	 <th align="center" style="width:300px !important;">Customer's Name</th>
	 <th align="center" style="width:300px !important;">Address</th>
    <th align="center" >Completion Date</th>
</tr>
</thead>
<?php

require_once ("classes/misc_functions.php");

if ($debug == "Yes") {
	echo 'Watch='.$watch;
	echo 'updatelotNumber='.$updatelotNumber;
}

 if (strlen($siteShortName) > 10) {
	 echo "<br><b>Error:something wrong with length of siteShortName";
	 exit;
 }
 
//$filterOfferStatusGroup;
if ( $securityLevelOneCheck != true ) {
	   $query = 'select * from offerDetailViewSignedOnly';
}
else {
		$query = 'select * from offerDetailView';
	}
	$query = $query.'  where 1=1 ';


$query = $query." order by ".$lotSortList;

if ($lotSortList > '') {
	$query = $query.",";
}

$query = $query."siteShortName, lotNumber ";
//echo '<br>'.$query;
echo '<tbody>';
$prevTimelineMasterID = 0;
if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {
		echo '<tr>';
		echo '<td class="lotLinkCellInTable" ><a href="index.php?myAction=Deficiency&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'&siteName='.$resultRow->siteName.'">';
		echo '<small>'.$resultRow->siteShortName.'</small>-';
		echo '<strong>'.str_pad($resultRow->lotNumber,4,'0',STR_PAD_LEFT).'</strong>';
		echo '</a></td>';
		
		echo '<td align="center">' ;
		$modelName =  '-';
		if ($resultRow->modelName > '') {
			$modelName = $resultRow->modelName;
		}
		else {
			if ($resultRow->designatedModelName > '') {
				$modelName = $resultRow->designatedModelName.'(d)';
			}
		}
		echo $modelName.'</td>';
		echo '<td align="center">'.$resultRow->siteName.'</td>';
		echo '<td align="center">'.'<b>'.$resultRow->firstName1.' '.$resultRow->lastName1.'</b>';
		if(($resultRow->firstName2 !="") && ($resultRow->lastName2 !=""))
			{
				echo ' and '.'<b>'.$resultRow->firstName1.' '.$resultRow->lastName1.'</b>';
			}
		echo '</td>';
		echo '<td align="center">'.$resultRow->clientAddress.' '.$resultRow->clientCity.'</td>';
		echo '<td align="center"> '.nullToChar($resultRow->calculatedBuildCompletionDate,'-');
		if ($securityLevelOneCheck) {
			echo $resultRow->calculatedBuildCompletionDateText;
		}
		echo '</td>';
		echo '</tr>';
	}
}
echo '</tbody>		';

?>

</table>
