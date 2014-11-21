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
<ul class="tabs">	
	<li class="current">
		<a href="#">Outstanding</a>
	</li>
	<li>
		<a href="#">Completed</a>
	</li>
</ul>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" id="lotListTable">
<thead>
  <tr>
	<th align="center">Lot</th>
	<th align="center" style="width:170px !important;">Site</th>
	<th align="center">Created Date</th>
	<th align="center" style="width:150px !important;">Trade</th>
	<th align="center">Type</th>
	<th align="center" style="width:300px !important;">Description</th>
    <th align="center" >RTO Date</th>
	<th align="center">Completion Date</th>
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
		echo '<td class="lotLinkCellInTable" ><a href="index.php?myAction=PO&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'&siteName='.$resultRow->siteName.'">';
		echo '<small>'.$resultRow->siteShortName.'</small>-';
		echo '<strong>'.str_pad($resultRow->lotNumber,4,'0',STR_PAD_LEFT).'</strong>';
		echo '</a></td>';
		
		echo '<td class="lotLinkCellInTable" align="center"><a href="index.php?myAction=PO&siteShortName='.$resultRow->siteShortName.'&siteName='.$resultRow->siteName.'"><b>'.$resultRow->siteName.'</b></a></td>';
		echo '<td>Work Order date testing words</td>';
		echo '<td>Trade testing words</td>';
		echo '<td>Type testing words</td>';
		echo '<td>Description testing words</td>';
		echo '<td>Appointment date testing words</td>';
		echo '<td>Days Out testing words</td>';
		echo '</tr>';
	}
}
echo '</tbody>		';

?>

</table>
