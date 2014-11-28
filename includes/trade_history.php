
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
<thead>
  <tr>
	<th align="center" style="width:100px !important;">User</th>
    <th align="center" style="width:100px !important;">Action</th>
	<th align="center" style="width:300px !important;">Trade's Name</th>
	<th align="center" style="width:150px !important;">Last Update</th>
</tr>
</thead>
<?php
require_once ("classes/misc_functions.php");
$query = 'select * from tradeHistory order by date DESC';
?>
<tbody>
	<? 
	if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {?>
	<tr>
		<td align="center">
			<?= $resultRow->user ?>
		</td>
		<td align="center">
			<?= $resultRow->action ?>
		</td>
		<td align="center">
			<?= $resultRow->tradename ?>
		</td>
		<td align="center">
			<?= $resultRow->date ?>
		</td>
	</tr>
	
	<?}}?>
</tbody>
</table>
