
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
    								 "bProcessing": false,
									 "aaSorting": []
                         });
               } );    

</SCRIPT>

<small><br>Note: Click on a column title to sort by that column</small>

<ul class="tabs">
	<li <? if($_GET["poStatus"]==0 or $_GET["poStatus"]==0 or !isset($_GET["poStatus"])) echo 'class="current"'; ?>>
		<a href='index.php?myAction=PO&poStatus=0<? if(isset($_GET["lotNumber"])) echo "&lotNumber=".$_GET["lotNumber"]; 
		if(isset($_GET["siteShortName"])) echo "&siteShortName=".$_GET["siteShortName"];
		?>'>Outstanding</a>
	</li>
	<li <? if($_GET["poStatus"]==1) echo 'class="current"'; ?>>
		<a href='index.php?myAction=PO&poStatus=1<? if(isset($_GET["lotNumber"])) echo "&lotNumber=".$_GET["lotNumber"]; 
		if(isset($_GET["siteShortName"])) echo "&siteShortName=".$_GET["siteShortName"];
		?>'>Completed</a>
	</li>
	<li <? if($_GET["poStatus"]==2) echo 'class="current"'; ?>>
		<a href='index.php?myAction=PO&poStatus=2<? if(isset($_GET["lotNumber"])) echo "&lotNumber=".$_GET["lotNumber"]; 
		if(isset($_GET["siteShortName"])) echo "&siteShortName=".$_GET["siteShortName"];
		?>'>Paid</a>
	</li>
	<li <? if($_GET["poStatus"]==3) echo 'class="current"'; ?>>
		<a href='index.php?myAction=PO&poStatus=3<? if(isset($_GET["lotNumber"])) echo "&lotNumber=".$_GET["lotNumber"]; 
		if(isset($_GET["siteShortName"])) echo "&siteShortName=".$_GET["siteShortName"];
		?>'>History</a>
	</li>
</ul>

<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" id="lotListTable">
<thead>
  <tr>
	<th align="center" style="width:150px !important;">Last Update</th>
	<th align="center" style="width:100px !important;">User</th>
    <th align="center" style="width:100px !important;">Action</th>
	<th align="center" style="width:300px !important;">PO Number</th>
</tr>
</thead>
<?php
require_once ("classes/misc_functions.php");
$query = 'select * from poHistory order by id DESC';
?>
<tbody>
	<? 
	if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {?>
	<tr>
		<td align="center">
			<?= $resultRow->date ?>
		</td>
		<td align="center">
			<?= $resultRow->user ?>
		</td>
		<td align="center">
			<?= $resultRow->action ?>
		</td>
		<td align="center">
			<?= $resultRow->poID ?>
		</td>
	</tr>
	
	<?}}?>
</tbody>
</table>
