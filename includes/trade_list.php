
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
<?
if($_GET["myTradeAction"]=="Add")
	{
	$query='INSERT INTO tradeList VALUES(NULL,"'.$_POST["name"].'","'.$_POST["address"].'","'.$_POST["phone"].'","'.$_POST["fax"].'","'.$_POST["email"].'",'.$_POST["status"].')';
	$db->Query($query);
	/*
	$table = "tradeList";
	$arr["name"] = MySQL::SQLValue($_POST["name"]);	
	$arr["address"] = MySQL::SQLValue($_POST["address"]);	
	$arr["phone"] = MySQL::SQLValue($_POST["phone"]);	
	$arr["fax"] = MySQL::SQLValue($_POST["fax"]);	
	$arr["email"] = MySQL::SQLValue($_POST["email"]);
	$arr["status"] = MySQL::SQLValue($_POST["status"]);
	
	$result = $dbSingleUse->InsertRow($table, $arr);
	//echo $result."result";*/
	}
	if($_GET["myTradeAction"]=="Save")
	{
	$query='UPDATE tradeList SET name="'.$_POST["name"].'", address="'.$_POST["address"].'",phone="'.$_POST["phone"].'",fax="'.$_POST["fax"].'",email="'.$_POST["email"].'",status='.$_POST["status"];
	$query.=' where id='.$_POST["id"].' limit 1';
	$db->Query($query);
	}
	if($_GET["myTradeAction"]=="Delete")
	{
		{
			if(isset($_GET["tradeID"]))
			$query='delete from tradeList where id='.$_GET["tradeID"].' limit 1';
			$db->Query($query);
		}
		header('Location: index.php?myAction=Trade');
	}
	?>
<small><br>Note: Click on a column title to sort by that column</small>

<ul class="tabs">
	<li <? if($_GET["tradeStatus"]==1 or !isset($_GET["tradeStatus"])) echo 'class="current"'; ?>>
		<a href='index.php?myAction=Trade&tradeStatus=1'>Active</a>
	</li>
	<li <? if($_GET["tradeStatus"]==0 && isset($_GET["tradeStatus"])) echo 'class="current"'; ?>>
		<a href='index.php?myAction=Trade&tradeStatus=0'>Deactive</a>
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
?>
<tbody>
	<tr>
		<td><input type="text" id="name" name="name" style="height:22px; width:99%;" /></td>
		<td><input type="text" id="address" name="address" style="height:22px;width:99%;" /></td>
		<td><input type="text" id="phone" name="phone" style="height:22px;width:99%;" /></td>
		<td><input type="text" id="fax" name="fax" style="height:22px;width:99%;" /></td>
		<td><input type="text" id="email" name="email" style="height:22px;width:99%;" /></td>
		<td align="center">
			<select name="status" style="height:28px;">
				<option <? if($_GET["tradeStatus"]==1 or !isset($_GET["tradeStatus"])) echo 'selected';?> value="1">
					Active
				</option>
				<option <? if($_GET["tradeStatus"]==0 && isset($_GET["tradeStatus"])) echo 'selected';?> value="0">
					Deactive
				</option>
			</select>
		</td>
		<td align="center" style="width:100px;">
			<input type="image" src="./images/add_icon.png" width="28" title="Add" />
		</td>
	<tr>
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
			<a title="Delete" href="<? echo 'index.php?myAction=Trade&tradeStatus='.$_GET["tradeStatus"].'&myTradeAction=Delete&tradeID='.$resultRow->id ?>"onClick= "return confirm('Do you want to delete');"><img style="width:30px;" src="./images/delete_icon.png" /></a>
		</td>
	<tr>
	
	<?}}?>
	
	
</tbody>
</form>
</table>
