
<SCRIPT LANGUAGE='Javascript'> 
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

</SCRIPT>
<?
	require_once ("trade_process.php");
?>
<small><br>Note: Click on a column title to sort by that column</small>

<ul class="tabs">
	<li <? if($_GET["tradeStatus"]==1 or !isset($_GET["tradeStatus"])) echo 'class="current"'; ?>>
		<a href='index.php?myAction=Trade&tradeStatus=1'>Active</a>
	</li>
	<li <? if($_GET["tradeStatus"]==0 && isset($_GET["tradeStatus"])) echo 'class="current"'; ?>>
		<a href='index.php?myAction=Trade&tradeStatus=0'>Deactive</a>
	</li>
	<li <? if($_GET["tradeStatus"]==3 && isset($_GET["tradeStatus"])) echo 'class="current"'; ?>>
		<a href='index.php?myAction=Trade&tradeStatus=3'>History</a>
	</li>
</ul>

<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" id="lotListTable">
<form method="post" action="index.php?myAction=Trade&myTradeAction=Add">
<thead>
  <tr>
	<th align="center" style="width:200px !important;">Name</th>
    <th align="center" style="width:300px !important;">Address</th>
	<th align="center" style="width:100px !important;">Phone</th>
	<th align="center" style="width:100px !important;">Fax</th>
	<th align="center" style="width:150px !important;">Email</th>
	<th align="center" style="width:90px !important;">Status</th>
    <th align="center" style="width:80px !important;">Actions</th>
</tr>
</thead>
<?php

require_once ("classes/misc_functions.php");

$query = 'select * from tradeList';
if(isset($_GET["tradeStatus"]))
{
$query = $query." where status = ".$_GET["tradeStatus"];
}
else
{
$query = $query." where status = 1";
}
$query.= " order by name ASC";
?>
<tbody>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="center" style="width:100px;">
			<a title="Add" href="index.php?myAction=Trade&myTradeAction=Add"><img  src="./images/add_icon.png" /></a>
		</td>
	</tr>
	<? 
	if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {?>
	<tr>
		<td align="center">
			<?= $resultRow->name ?>
		</td>
		<td align="center">
			<?= $resultRow->address ?>
		</td>
		<td align="center">
			<?= $resultRow->phone ?>
		</td>
		<td align="center">
			<?= $resultRow->fax ?>
		</td>
		<td align="center">
			<?= $resultRow->email ?>
		</td>
		<td align="center">
			<? if($resultRow->status ==1) echo "Active" ; ?>
			<? if($resultRow->status==0) echo "Deactive"; ?>	
		</td>
		<td align="center">
			<a title="Edit" href="<? echo 'index.php?myAction=Trade&tradeStatus='.$_GET["tradeStatus"].'&myTradeAction=Edit&tradeID='.$resultRow->id ?>"><img  src="./images/edit_icon1.png" /></a>
			<a title="Delete" href="<? echo 'index.php?myAction=Trade&tradeStatus='.$_GET["tradeStatus"].'&myTradeAction=Delete&tradeID='.$resultRow->id.'&tradeName='.$resultRow->name ?>"onClick= "return confirm('Do you want to delete');"><img style="width:30px;" src="./images/delete_icon.png" /></a>
		</td>
	</tr>
	
	<?}}?>
	
	
</tbody>
</form>
</table>
