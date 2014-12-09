
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
$date=date("Y-m-d h:i:sa");
if($_GET["myPOAction"]=="Save"  && $_POST["id"]=="")
	{
		$query='INSERT INTO poList VALUES(NULL,"'.$date.'","'.$_GET["siteShortName"].'",'.$_GET["lotNumber"].','.$_POST["lineNumber"].','.$_POST["vendorID"].',"'.$_POST["shiptoAdd"].'",';
		if($_POST["buildingNumber"]) $query.=$_POST["buildingNumber"].',';
		else $query.= 'NULL,';
		$query.='"'.$_POST["poStatus"].'",'.$_POST["quantity_1"].',"'.$_POST["accountType_1"].'","'.$_POST["description_1"].'",'.$_POST["unitPrice_1"].','.$_POST["extPrice_1"].')';
		//$db->Query($query);
		//$query2='INSERT INTO poHistory VALUES(NULL,"'.$_SESSION["userName"].'","'.$_GET["myTradeAction"].'","'.$_POST["name"].'","'.$date.'")';
		//$db->Query($query2);
		echo $query;
		//echo '<br>'.$query2;
		
	}
	?>
<? echo ' - Site: <b>'.$siteName.'</b>';
 if(isset($_GET["lotNumber"]))
 echo ' - Lot: <b>'.$_GET["lotNumber"].'</b>';?>
<small><br>Note: Click on a column title to sort by that column</small>

<ul class="tabs">	
	<li <? if($_GET["poStatus"]==0 or !isset($_GET["poStatus"])) echo 'class="current"'; ?>>
		<a href='index.php?myAction=PO&lotStatus=0<? if(isset($_GET["lotNumber"])) echo "&lotNumber=".$_GET["lotNumber"]; 
		if(isset($_GET["siteShortName"])) echo "&siteShortName=".$_GET["siteShortName"];
		?>'>Outstanding</a>
	</li>
	<li <? if($_GET["poStatus"]==1) echo 'class="current"'; ?>>
		<a href='index.php?myAction=PO&lotStatus=1<? if(isset($_GET["lotNumber"])) echo "&lotNumber=".$_GET["lotNumber"]; 
		if(isset($_GET["siteShortName"])) echo "&siteShortName=".$_GET["siteShortName"];
		?>'>Completed</a>
	</li>
	<li <? if($_GET["poStatus"]==2) echo 'class="current"'; ?>>
		<a href='index.php?myAction=PO&lotStatus=2<? if(isset($_GET["lotNumber"])) echo "&lotNumber=".$_GET["lotNumber"]; 
		if(isset($_GET["siteShortName"])) echo "&siteShortName=".$_GET["siteShortName"];
		?>'>Paid</a>
	</li>
	<li <? if($_GET["poStatus"]==3) echo 'class="current"'; ?>>
		<a href='index.php?myAction=PO&lotStatus=3<? if(isset($_GET["lotNumber"])) echo "&lotNumber=".$_GET["lotNumber"]; 
		if(isset($_GET["siteShortName"])) echo "&siteShortName=".$_GET["siteShortName"];
		?>'>History</a>
	</li>
</ul>
<form>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" id="lotListTable">
<thead>
  <tr>
	<th align="center" style="width:80px !important;">PO #</th>
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

$query = 'select * from poList';
if(isset($_GET["poStatus"]))
{
$query = $query." where poStatus = ".$_GET["poStatus"];
}
else
{
$query = $query." where poStatus = 1";
}
if(isset($_GET["siteShortName"]))
{
	$query = $query. ' and siteShortName="'.$_GET["siteShortName"].'"';
}
if(isset($_GET["lotNumber"]))
{
	$query = $query. " and lotNumber=".$_GET["lotNumber"];
}
$query.= " order by id DESC";
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
			<a title="Add" href="<? echo 'index.php?myAction=PO&lotStatus='.$_GET["poStatus"].'&siteShortName='.$_GET["siteShortName"].'&lotNumber='.$_GET["lotNumber"].'&myPOAction=Add'?>">
			<img style="width:28px;" src="./images/add_icon.png" /></a>
		</td>
	</tr>
	
	<? 
	if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {?>
	<tr>
		<td align="center">
			<?= $resultRow->id ?>
		</td>
		<td align="center">
			<?= $resultRow->dateCreated ?>
		</td>
		<td align="center">
			<?= $resultRow->accountType ?>
		</td>
		<td align="center">
			<?= $resultRow->description ?>
		</td>
		<td align="center">
			<?= $resultRow->vendorID ?>
		</td>
		<td align="center">
			<input style="min-height:24px;" type="checkbox" name="">
		</td>
		<td align="center">
			<a title="Edit" href="<? echo 'index.php?myAction=PO&lotStatus='.$_GET["poStatus"].'&siteShortName='.$_GET["siteShortName"].'&lotNumber='.$_GET["lotNumber"].'&PONum='.$resultRow->id.'&myPOAction=Edit' ?>"><img  src="./images/edit_icon1.png" /></a>
			<a title="View" href="<? echo 'index.php?myAction=PO&lotStatus='.$_GET["poStatus"].'&siteShortName='.$_GET["siteShortName"].'&lotNumber='.$_GET["lotNumber"].'&PONum='.$resultRow->id.'&myPOAction=View' ?>"><img  src="./images/view_icon1.png" /></a>
		</td>
	</tr>
	<?}}?>
</tbody>
</table>
</form>