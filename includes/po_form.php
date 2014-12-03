&nbsp;<? echo '#'.$_GET["PONum"]?>
<br><br>
<?php
	if($_GET["myPOAction"]=="View")
	{
		echo "<button>Print</button>";
		echo '&nbsp;<input type="button" value="Back" onclick="javascript:window.history.back();">';
	}
	
	if($_GET["myPOAction"]=="Edit" or $_GET["myPOAction"]=="Add")
	{
		echo "<button>Save</button>";
		echo '&nbsp;<input type="button" value="Cancel" onclick="javascript:window.history.back();">';
	}
?>
<? 
$query = 'select * from tradeList where status = 1';
if($_GET["myPOAction"]=="View")
$query .= ' and id='.$_GET["tradeID"];
$query .= ' order by name ASC';

$query1 = 'select * from offerDetailView where 1=1';
if(isset($_GET["lotNumber"])) 
$query1 .=' and lotNumber = "'.$_GET["lotNumber"].'"';
if(isset($_GET["siteShortName"])) 
$query1 .=' and siteShortName = "'.$_GET["siteShortName"].'"';
?>
<div style="width:1000px;clear:both;">
<hr>
</div> 
<?
if($_GET["myPOAction"]=="View")
echo
'<div style="width:1000px;display:block">
	<div style="width:300px;float:left;margin-left:150px;">
	<h3>Pratt Hansen Grougp Inc.</h3>
	301 King Street
	<br>Barrie, Ontario
	<br>L4N 6B5
	<br>Phone: (705) 728-0033
	<br>Fax  : (705) 733-0073
	</div>

	<div style="width:300px;float:left;margin-left:150px;">
	<h3>Purchase Order</h3>
	PO #: '.$_GET["PONum"].'
	<br>Created date:
	<br>Required date:
	</div>
</div>
<div style="width:1000px;clear:both;">
<br>
<hr>
</div> '; ?>
<div style="width:1000px;clear:both;">
	<div style="width:300px !important; float:left;">
	<h3 style="padding-left: 0px;">Vendor</h3>
	<? 
	if($_GET["myPOAction"]!="View")
	echo 
	'<select style="height:29px;width:270px">
		<option value="">
			Vendor\'s Name
		</option>';
	?>
	<?
	if ($db->Query($query) && $_GET["myPOAction"]!="View") 
	{ 
		while ($resultRow = $db->Row() ) {
		echo '<option value="'.$resultRow->id.'">'. $resultRow->name.'</option>';
	 }
	echo '</select><span style="color:red;margin-left:5px;">*</span>';
	}
	else if ($db->Query($query) && $_GET["myPOAction"]=="View") 
		{
		while ($resultRow = $db->Row() ) {
		echo 
	$resultRow->name.
	'<br>'.$resultRow->address.
	'<br>Phone: '.$resultRow->phone.
	'<br>Fax: '.$resultRow->fax;
	}}
	?>
	<br>
	</div>
	
	<div style="width:300px !important; float:left;margin-left:50px;">
	<h3 style="padding-left: 0px;">Ship To</h3>
	<input type="text" name="ship_to_address" placeholder="Ship to address" style="height:22px;width:275px;"/>
	<span style="color:red;">*</span>
	</div>
	
	<div style="width:300px !important; float:left;margin-left:50px;">
	<h3 style="padding-left: 0px;">Reference</h3>
	<? if ($db->Query($query1) && isset($_GET["lotNumber"])) 
		{ 
		while ($resultRow = $db->Row()) {
			echo 'Homeowner: '.$resultRow->firstName1.' '.$resultRow->lastName1.
				 '<br>Phone: '.$resultRow->homePhone.
				 '<br>Cell: '.$resultRow->otherPhone.
				 '<br>Address: '.$resultRow->munStreetNumber.' '.$resultRow->munStreetAddress.' '.$resultRow->postalCode
			;
		}
		}
		if(!isset($_GET["lotNumber"]))
		echo 
		'Homeowner:
		<br>Phone:
		<br>Cell:
		<br>Address:
		';
	?>
	
	</div>
</div>
<div style="width:1000px;">
	<br>
	<div style="width:450px;float:left;clear:both;">
	<br><b>Re: </b>
	Lot: <? 
				if($_GET["lotNumber"]=='') echo ' Common Elements<br> Phase: Building <input type="text" placeholder="building #" name="building" style="width:60px;"/><span style="color:red;margin-left:5px;">*</span><br>';
				else if(($_GET["lotNumber"])!='') echo " ".$_GET["lotNumber"].", ";
				
			?>
	Site:<? if(isset($siteName)) echo " ".$siteName;
		?>
	
	</div>
	<div style="width:300px;float:left;margin-left:250px;">
		<br><b>Model:</b>
	</div>
</div>

<div style="width:1000px; clear:both;">	
	<div style="width:250px;float:left;">
	<br>
		PO Status: &nbsp;
		<select>
			<option>
				Outstanding
			</option>
			<? if($_GET["myPOAction"]=="Edit")
			echo 
			'<option>
				Completed
			</option>
			<option>
			Paid
			</option>';
			?>
		</select>
	</div>
	<? if($_GET["myPOAction"]=="Add" or $_GET["myPOAction"]=="Edit") echo
	'<div style="float:right;">
		<br><Button class="addRow" >+ Add Row</button>
	</div>';
	?>
</div>
<div style="width:1000px;clear:both;">
	<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" id="lotListTable">
		<thead>
		  <tr>
			<th align="center" style="width:100px !important;">Quantity</th>
			<th align="center" style="width:150px !important;">Account<span style="color:red;margin-left:5px;">*</span></th>
			<!--<th align="center" style="width:150px !important;">Build Action</th> -->
			<th align="center" style="width:350px !important;">Description<span style="color:red;margin-left:5px;">*</span></th>
			<th align="center" style="width:150px !important;">Unit Price</th>
			<th align="center" style="width:150px !important;">Ext. Price</th>
			<? if($_GET["myPOAction"]=="Add" or $_GET["myPOAction"]=="Edit") echo '<th align="center">Action</th>' ;?>
		</tr>
		</thead>
		<tbody>
			<tr>
				<td align="center">
					1
				</td>
				<td align="center">
					<input type="text" style="width:99%;" placeholder="Account" name="account_type" value ="" />
				</td>
				<td align="center">
					<?
					if($_GET["myPOAction"]=="View") echo 'Condo model 1445/ 3 Bedroom / 2 bathroom / spec unit Condo model 1445/ 3 Bedroom / 2 bathroom / spec unit';
					else echo '<input type="text" name="description" style="width:99%;" placeholder="Description" value ="" />';
				
				?>
				</td>
				<td align="center">
					$0.00
				</td>
				<td align="center">
					$0.00
				</td>
				<? if($_GET["myPOAction"]=="Add" or $_GET["myPOAction"]=="Edit") echo '<td align="center"><input class="del" type="button" value="Delete" /></td>'; ?>
			</tr>
			
			<tr style="background-color:grey;">
				<td colspan="3">
				<input type="hidden" name="total_line_number" id="total_line_number" value="1"/>
				</td>
				<td align="center">
					<b>Total:</b>
				</td>
				<td align="center">
				 <b>$0.00</b>
				</td>
				<? if($_GET["myPOAction"]=="Add" or $_GET["myPOAction"]=="Edit") echo '<td></td>' ;?>
			</tr>
		</tbody>
		
		
	</table>
		<script type="text/javascript">
			$(document).ready(function(){		
				var total_line_number = $("#total_line_number").val();
				
				$('.del').live('click',function(){
				if(total_line_number>1){
					$(this).parent().parent().remove();
					total_line_number--;
					console.log(total_line_number);
					$("#total_line_number").val(total_line_number);
				}
				else alert("PO need at least 1 line item");
				});
				
				$('.addRow').live('click',function(){
					//$(this).val('Delete');
					//$(this).attr('class','del');
					var appendTxt = '<tr><td align="center">1</td><td align="center"><input type="text" style="width:99%;" placeholder="Account" name="account_type" value ="" /></td><td align="center"><input type="text" name="description" style="width:99%;" placeholder="Description"  value ="" /></td><td align="center">$0.00</td><td align="center">$0.00</td><td align="center"><input class="del" type="button" value="Delete" /></td></tr>';
					$("tr:last").prev().after(appendTxt);
					total_line_number++;
					console.log(total_line_number);
					$("#total_line_number").val(total_line_number);
				});        
			});
		</script>
</div>
<br>