
<SCRIPT LANGUAGE='Javascript'>    
/*
$(document).ready(function() {
                  oTable = $("#lotListTable").dataTable({
									"bJQueryUI": true,
                                    "bPaginate": false,
								    //"sScrollY": "600px",
                                    "bLengthChange": false,
                                    "bFilter": true,
                                    "bSort": true,
                                    "bInfo": true,
    								 "bProcessing": false
                         });
               } );    
*/
</SCRIPT>
<? echo ' - Site: <b>'.$_GET["siteName"].'</b>';
 if(isset($_GET["lotNumber"]))
 echo ' - Lot: <b>'.$_GET["lotNumber"].'</b>';?>
<small><br>Note: Click on a column title to sort by that column</small>

<ul class="tabs">	
	<li class="current">
		<a href="#">Outstanding</a>
	</li>
	<li>
		<a href="#">Completed</a>
	</li>
</ul>
<form>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" id="lotListTable">
<thead>
  <tr>
	<th align="center" style="width:100px !important;">Date Reported</th>
    <th align="center" style="width:80px !important;">Type</th>
	<th align="center" style="width:50px !important;">Number</th>
	<th align="center" style="width:300px !important;">Description</th>
	<th align="center" style="width:120px !important;">Trade assigned</th>
	<th align="center" style="width:50px !important;">Completed</th>
    <th align="center" style="width:100px !important;">Actions</th>
</tr>
</thead>
<?php

require_once ("classes/misc_functions.php");
/*
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
		echo '<td class="lotLinkCellInTable" ><a href="index.php?myAction=PO&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">';
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
*/
?>
<tbody>
	<tr>
		<td align="center">
			<input style="min-height:24px; width:98%;" type="text" name="">
		</td>
		<td align="center">
			<input style="min-height:24px; width:98%;" type="text" name="">
		</td>
		<td align="center">
			<input style="min-height:24px; width:98%;" type="text" name="">
		</td>
		<td align="center">
			<input style="min-height:24px; width:99%;" type="text" name="">
		</td>
		<td align="center">
			<input style="min-height:24px; width:98%;" type="text" name="">
		</td>
		<td align="center">
			<input style="min-height:24px;" type="checkbox" name="">
		</td>
		<td align="center" style="width:100px;">
			<a title="Quick Add" href="index.php?myAction=PO&myPOAction=Add"><img style="width:28px;" src="./images/add_icon.png" /></a>
		</td>
	<tr>
	
	<tr>
		<td align="center">
			15 Sep 2014
		</td>
		<td align="center">
			Interval
		</td>
		<td align="center">
			5
		</td>
		<td align="center">
			Kitchen - Plumbing - faucet is loose at base and homeowner has undermount sink ** PO . 20916
		</td>
		<td align="center">
			Northern Plumbing Systems Inc
		</td>
		<td align="center">
			<input style="min-height:24px;" type="checkbox" name="">
		</td>
		<td align="center">
			
			<a title="Edit" href="index.php?myAction=PO&myPOAction=Edit"><img  src="./images/edit_icon1.png" /></a>
			<a title="View" href="#"><img  src="./images/view_icon1.png" /></a>
		</td>
	<tr>
	
	<tr>
		<td align="center">
			15 Sep 2014
		</td>
		<td align="center">
			Interval
		</td>
		<td align="center">
			5
		</td>
		<td align="center">
			Kitchen - Plumbing - faucet is loose at base and homeowner has undermount sink ** PO . 20916
		</td>
		<td align="center">
			Northern Plumbing Systems Inc
		</td>
		<td align="center">
			<input style="min-height:24px;" type="checkbox" name="">
		</td>
		<td align="center">
			
			<a title="Edit" href="index.php?myAction=PO&myPOAction=Edit"><img  src="./images/edit_icon1.png" /></a>
			<a title="View" href="#"><img  src="./images/view_icon1.png" /></a>
		</td>
	<tr>
	
	<tr>
		<td align="center">
			15 Sep 2014
		</td>
		<td align="center">
			Interval
		</td>
		<td align="center">
			5
		</td>
		<td align="center">
			Kitchen - Plumbing - faucet is loose at base and homeowner has undermount sink ** PO . 20916
		</td>
		<td align="center">
			Northern Plumbing Systems Inc
		</td>
		<td align="center">
			<input style="min-height:24px;" type="checkbox" name="">
		</td>
		<td align="center">
			
			<a title="Edit" href="index.php?myAction=PO&myPOAction=Edit"><img  src="./images/edit_icon1.png" /></a>
			<a title="View" href="#"><img  src="./images/view_icon1.png" /></a>
		</td>
	<tr>
	
	<tr>
		<td align="center">
			15 Sep 2014
		</td>
		<td align="center">
			Interval
		</td>
		<td align="center">
			5
		</td>
		<td align="center">
			Kitchen - Plumbing - faucet is loose at base and homeowner has undermount sink ** PO . 20916
		</td>
		<td align="center">
			Northern Plumbing Systems Inc
		</td>
		<td align="center">
			<input style="min-height:24px;" type="checkbox" name="">
		</td>
		<td align="center">
			
			<a title="Edit" href="index.php?myAction=PO&myPOAction=Edit"><img  src="./images/edit_icon1.png" /></a>
			<a title="View" href="#"><img  src="./images/view_icon1.png" /></a>
		</td>
	<tr>
	
	<tr>
		<td align="center">
			15 Sep 2014
		</td>
		<td align="center">
			Interval
		</td>
		<td align="center">
			5
		</td>
		<td align="center">
			Kitchen - Plumbing - faucet is loose at base and homeowner has undermount sink ** PO . 20916
		</td>
		<td align="center">
			Northern Plumbing Systems Inc
		</td>
		<td align="center">
			<input style="min-height:24px;" type="checkbox" name="">
		</td>
		<td align="center">
			
			<a title="Edit" href="#"><img  src="./images/edit_icon1.png" /></a>
			<a title="View" href="#"><img  src="./images/view_icon1.png" /></a>
		</td>
	<tr>
	
	<tr>
		<td align="center">
			15 Sep 2014
		</td>
		<td align="center">
			Interval
		</td>
		<td align="center">
			5
		</td>
		<td align="center">
			Kitchen - Plumbing - faucet is loose at base and homeowner has undermount sink ** PO . 20916
		</td>
		<td align="center">
			Northern Plumbing Systems Inc
		</td>
		<td align="center">
			<input style="min-height:24px;" disabled checked type="checkbox" name="">
		</td>
		<td align="center">
			
			<a title="Edit" href="#"><img  src="./images/edit_icon1.png" /></a>
			<a title="View" href="#"><img  src="./images/view_icon1.png" /></a>
		</td>
	<tr>
</tbody>
</table>
</form>