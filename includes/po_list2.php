
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
<br>
<small><br>Note: Click on a column title to sort by that column</small>

<ul class="tabs">	
	<li <? if($_GET["lotStatus"]==0 or !isset($_GET["lotStatus"])) echo 'class="current"'; ?>>
		<a href='index.php?myAction=PO&lotStatus=0<? if(isset($_GET["lotNumber"])) echo "&lotNumber=".$_GET["lotNumber"]; 
		if(isset($_GET["siteShortName"])) echo "&siteShortName=".$_GET["siteShortName"];
		?>'>Outstanding</a>
	</li>
	<li <? if($_GET["lotStatus"]==1) echo 'class="current"'; ?>>
		<a href='index.php?myAction=PO&lotStatus=1<? if(isset($_GET["lotNumber"])) echo "&lotNumber=".$_GET["lotNumber"]; 
		if(isset($_GET["siteShortName"])) echo "&siteShortName=".$_GET["siteShortName"];
		?>'>Completed</a>
	</li>
	<li <? if($_GET["lotStatus"]==2) echo 'class="current"'; ?>>
		<a href='index.php?myAction=PO&lotStatus=2<? if(isset($_GET["lotNumber"])) echo "&lotNumber=".$_GET["lotNumber"]; 
		if(isset($_GET["siteShortName"])) echo "&siteShortName=".$_GET["siteShortName"];
		?>'>Paid</a>
	</li>
	<li <? if($_GET["lotStatus"]==3) echo 'class="current"'; ?>>
		<a href='index.php?myAction=PO&lotStatus=3<? if(isset($_GET["lotNumber"])) echo "&lotNumber=".$_GET["lotNumber"]; 
		if(isset($_GET["siteShortName"])) echo "&siteShortName=".$_GET["siteShortName"];
		?>'>History</a>
	</li>
</ul>
<form>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" id="lotListTable">
<thead>
  <tr>
	<th align="center" style="width:100px !important;">PO #</th>
	<th align="center" style="width:100px !important;">Site</th>
	<th align="center" style="width:100px !important;">Lot</th>
	<th align="center" style="width:90px !important;">Date Created</th>
    <th align="center" style="width:80px !important;">Account</th>
	<th align="center" style="width:300px !important;">Description</th>
	<th align="center" style="width:120px !important;">Trade assigned</th>
	<th align="center" style="width:40px !important;">Completed</th>
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
			5
		</td>
		<td>Lot#</td>
		<td align="center">
			Site name
		</td>
		<td align="center">
			15 Sep 2014
		</td>
		<td align="center">
			Painting
		</td>
		<td>Kitchen - Plumbing - faucet is loose at base and homeowner has undermount sink ** PO . 20916</td>
		<td align="center">
			Northern Plumbing Systems Inc
		</td>
		<td align="center">
			<input style="min-height:24px;" type="checkbox" name="">
		</td>
		<td align="center">
			<? $PONum=123456?>
			<a title="Edit" href="<? echo 'index.php?myAction=PO&lotStatus='.$_GET["lotStatus"].'&siteShortName='.$_GET["siteShortName"].'&lotNumber='.$_GET["lotNumber"].'&PONum='.$PONum.'&myPOAction=Edit' ?>"><img  src="./images/edit_icon1.png" /></a>
			<a title="View" href="<? echo 'index.php?myAction=PO&lotStatus='.$_GET["lotStatus"].'&siteShortName='.$_GET["siteShortName"].'&lotNumber='.$_GET["lotNumber"].'&PONum='.$PONum.'&myPOAction=View' ?>"><img  src="./images/view_icon1.png" /></a>
		</td>
	</tr>
	
</tbody>
</table>
</form>