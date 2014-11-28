<? echo " -> ".$_GET["myTradeAction"];?>
<form method="post" action="index.php?myAction=Trade&myTradeAction=Save">
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" id="lotListTable">
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
$query='select * from tradeList where id='.$_GET["tradeID"]. ' limit 1';
$db2->Query($query);
//$row = mysql_fetch_row($db);

//echo $row;
?>
<tbody>
	<? 
	if($_GET["myTradeAction"]=="Add")
	{
		echo 
		'<tr>
		<td><input type="text" name="name" style="height:22px;width:99%;"/></td>
		<td><input type="text" name="address" style="height:22px;width:99%;"/></td>
		<td><input type="text" name="phone"  style="height:22px;width:99%;"/></td>
		<td><input type="text" name="fax"  style="height:22px;width:99%;"/></td>
		<td><input type="text" name="email" style="height:22px;width:99%;"/></td>
		<td align="center">
			<select name="status" style="height:28px;">
				<option value="1">
					Active
				</option>
				<option value="0">
					Deactive
				</option>
			</select>
		</td>
		
		<td align="center" style="width:100px;">
			<input type="image" src="./images/save_icon.png" width="28" title="Save" />
			<a title="Cancel" onclick="window.history.back();return false;" href="#">
			<img style="width:25px;" src="./images/cancel_icon.png" /></a>
		</td>
			
	</tr>';
	}
	if($_GET["myTradeAction"]=="Edit")
	{
		if ($db2->Query($query)) {
			while ($row = $db2->Row()) 
		{ 
	?>
	<tr>
		<input type="hidden" id="id" name="id" value="<? echo $row->id;  ?>" />
		<td align="center"><input type="hidden" name="name" value="<? echo $row->name;  ?>" style="height:22px;width:99%;"/><? echo $row->name;  ?></td>
		<td align="center"><input type="text" name="address" value="<? echo $row->address;  ?>" style="height:22px;width:99%;"/></td>
		<td align="center"><input type="text" name="phone" value="<? echo $row->phone;  ?>" style="height:22px;width:99%;"/></td>
		<td align="center"><input type="text" name="fax" value="<? echo $row->fax;  ?>" style="height:22px;width:99%;"/></td>
		<td align="center"><input type="text" name="email" value="<? echo $row->email;  ?>" style="height:22px;width:99%;"/></td>
		<td align="center">
			<select name="status" style="height:28px;">
				<option <? if($row->status==1) echo 'selected';?> value="1">
					Active
				</option>
				<option <? if($row->status==0) echo 'selected';?> value="0">
					Deactive
				</option>
			</select>
		</td>
		
		<td align="center" style="width:100px;">
			<input type="image" src="./images/save_icon.png" width="28" title="Save" />
			<a title="Cancel" onclick="window.history.back();return false;" href="#">
			<img style="width:25px;" src="./images/cancel_icon.png" /></a>
		</td>
			
	</tr>
	<?
		}
		} 
	}
	?>
</tbody>
</table>
</form>