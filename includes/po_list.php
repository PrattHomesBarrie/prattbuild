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

<?
	require_once ("po_process.php");
?>
<? 
if(isset($_GET["siteName"]))
echo ' - Site: <b>'.$_GET["siteName"].'</b>';
else if(isset($_GET["siteShortName"]))
echo ' - Site: <b>'.$siteName.'</b>';
if(isset($_GET["lotNumber"]))
echo ' - Lot: <b>'.$_GET["lotNumber"].'</b>';
 ?>
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
<form>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" id="lotListTable">
<thead>
  <tr>
	<th align="center" style="width:60px !important;">PO #</th>
	<th align="center" style="width:60px !important;">Lot</th>
	<th align="center" style="width:150px !important;">Site</th>
	<th align="center" style="width:90px !important;">Date Created</th>
    <th align="center" style="width:80px !important;">Account</th>
	<th align="center" style="width:250px !important;">Description</th>
	<th align="center" style="width:150px !important;">Trade assigned</th>
	<!--<th align="center" style="width:40px !important;">Completed</th>-->
    <th align="center" style="width:100px !important;">Actions</th>
</tr>
</thead>
<?php

require_once ("classes/misc_functions.php");

$query = 'select poList.*,tradeList.name, lineList.accountType, lineList.description, lineList.quantity, lineList.unitPrice, lineList.extPrice, sites.siteName from poList 
			left join sites on sites.siteShortName = poList.siteShortName
			left join lineList on poList.id = lineList.poID
			left join tradeList on poList.vendorID= tradeList.id ';
if(isset($_GET["poStatus"]))
{
$query = $query." where poList.poStatus = ".$_GET["poStatus"];
}
else
{
$query = $query." where poList.poStatus = 0";
}
if($_GET["siteShortName"]!="")
{
	$query = $query. ' and poList.siteShortName="'.$_GET["siteShortName"].'"';
}
if($_GET["lotNumber"]!="")
{
	$query = $query. " and poList.lotNumber=".$_GET["lotNumber"];
}
$query.= " order by poList.id DESC";
?>
<tbody>
	<tr>
		<!--<td ></td>-->
		<td ></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="center" style="width:100px;">
			<a title="Add" href="<? echo 'index.php?myAction=PO&poStatus='.$_GET["poStatus"].'&siteShortName='.$_GET["siteShortName"].'&lotNumber='.$_GET["lotNumber"].'&myPOAction=Add'?>">
			<img style="width:28px;" src="./images/add_icon.png" /></a>
		</td>
	</tr>
	
	<? 
	if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {?>
	<tr>
		<td align="center">
			<?= $resultRow->id?>
		</td>
		<td align="center">
			<? echo '<b><a href="index.php?myAction=PO';
			if($resultRow->lotNumber >0) echo '&lotNumber='.$resultRow->lotNumber;
			echo '&siteShortName='.$resultRow->siteShortName.'&siteName='.$resultRow->siteName.'">'.$resultRow->lotNumber.'</a></b>';?>
		</td>
		<td align="center">
			<? echo '<b><a href="index.php?myAction=PO&siteShortName='.$resultRow->siteShortName.'&siteName='.$resultRow->siteName.'">'.$resultRow->siteName.'</a></b>';?>
		</td>
		<td align="center">
			<?= date('Y-m-d', strtotime($resultRow->dateCreated)) ?>
		</td>
		<td align="center">
			<?= $resultRow->accountType ?>
		</td>
		<td>
			<?= $resultRow->description ?>
		</td>
		<td align="center">
			<b><?= $resultRow->name ?></b>
		</td>
		<!--<td align="center">
			<input style="min-height:24px;" type="checkbox" name="">
		</td> -->
		<td align="center">
			<a title="Edit" href="<? echo 'index.php?myAction=PO&poStatus='.$_GET["poStatus"].'&siteShortName='.$resultRow->siteShortName.'&lotNumber='.$resultRow->lotNumber.'&PONum='.$resultRow->id.'&myPOAction=Edit' ?>"><img  src="./images/edit_icon1.png" /></a>
			<a title="View" href="<? echo 'index.php?myAction=PO&poStatus='.$_GET["poStatus"].'&siteShortName='.$resultRow->siteShortName.'&lotNumber='.$resultRow->lotNumber.'&PONum='.$resultRow->id.'&myPOAction=View' ?>"><img  src="./images/view_icon1.png" /></a>
		</td>
	</tr>
	<?}}?>
</tbody>
</table>
</form>