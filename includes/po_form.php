&nbsp;#123456
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
<!--
<div style="width:1000px;display:block">
	<div style="width:300px;float:left;margin-left:150px;">
	<h2>Pratt Hansen Grougp Inc.</h2>
	301 King Street
	<br>Barrie, Ontario
	<br>L4N 6B5
	<br>Phone: (705) 728-0033
	<br>Fax  : (705) 733-0073
	</div>

	<div style="width:300px;float:left;margin-left:150px;">
	<h2>Purchase Order</h2>
	PO #:
	<br>Created date:
	<br>Required date:
	</div>
</div>-->
<div style="width:1000px;clear:both;">

<hr>
</div> 
<div style="width:1000px;">
	<div style="width:300px !important; float:left;">
	<h3 style="padding-left: 0px;">Vendor</h3>
	Vendor's name Vendor's name
	<br>Vendor's address:
	<br>Phone:
	<br>Fax:
	</div>
	
	<div style="width:300px !important; float:left;margin-left:50px;">
	<h3 style="padding-left: 0px;">Ship To</h3>
	Address
	</div>
	
	<div style="width:300px !important; float:left;margin-left:50px;">
	<h3 style="padding-left: 0px;">Reference</h3>
	Homeowner: 
	<br>Phone:
	<br>Cell:
	<br>Address:
	
	</div>
</div>
<div style="width:1000px;">
	<br>
	<div style="width:450px;float:left;">
	<br><b>Re: </b>
	Lot: <? 
				if($_GET["lotNumber"]=='') echo " Common Elements, Phase: Building list<br>";
				else if(($_GET["lotNumber"])!='') echo " ".$_GET["lotNumber"].", ";
				
			?>
	Site:<? if(isset($_GET["siteName"])) echo " ".$_GET["siteName"];
		?>
	
	</div>
	<div style="width:300px;float:left;margin-left:250px;">
		<br><b>Model:</b>
	</div>
</div>

<div style="width:1000px; clear:both;">
<br>PO Status: &nbsp;
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
<div style="width:1000px;clear:both;">
	<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" id="lotListTable">
		<thead>
		  <tr>
			<th align="center" style="width:100px !important;">Quantity</th>
			<th align="center" style="width:150px !important;">Account</th>
			<!--<th align="center" style="width:150px !important;">Build Action</th> -->
			<th align="center" style="width:350px !important;">Description</th>
			<th align="center" style="width:150px !important;">Unit Price</th>
			<th align="center" style="width:150px !important;">Ext. Price</th>
		</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					1
				</td>
				<td>
					Painting
				</td>
				<td>
				<?
					if($_GET["myPOAction"]=="View") echo 'Condo model 1445/ 3 Bedroom / 2 bathroom / spec unit';
					else echo '<input type="text" style="width:99%;" value ="Condo model 1445/ 3 Bedroom / 2 bathroom / spec unit" />';
				
				?>
				</td>
				<td>
					$0.00
				</td>
				<td>
					$0.00
				</td>
			</tr>
			
			<tr>
				<td>
					1
				</td>
				<td>
					Painting
				</td>
				<td>
					<?
					if($_GET["myPOAction"]=="View") echo 'Condo model 1445/ 3 Bedroom / 2 bathroom / spec unit Condo model 1445/ 3 Bedroom / 2 bathroom / spec unit';
					else echo '<input type="text" style="width:99%;" value ="Condo model 1445/ 3 Bedroom / 2 bathroom / spec unit Condo model 1445/ 3 Bedroom / 2 bathroom / spec unit" />';
				
				?>
				</td>
				<td>
					$0.00
				</td>
				<td>
					$0.00
				</td>
			</tr>
			
			<tr style="background-color:grey;">
				<td colspan="3">
				</td>
				<td>
					<b>Total:</b>
				</td>
				<td>
				 <b>$0.00</b>
				</td>
			</tr>
		</tbody>
		
		
	</table>
</div>
<br>