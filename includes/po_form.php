&nbsp;#<?= $_GET["PONum"]?>
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
			<th align="center" style="width:150px !important;">Account</th>
			<!--<th align="center" style="width:150px !important;">Build Action</th> -->
			<th align="center" style="width:350px !important;">Description</th>
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
					Painting
				</td>
				<td align="center">
					<?
					if($_GET["myPOAction"]=="View") echo 'Condo model 1445/ 3 Bedroom / 2 bathroom / spec unit Condo model 1445/ 3 Bedroom / 2 bathroom / spec unit';
					else echo '<input type="text" style="width:99%;" value ="" />';
				
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
				
				$('.del').live('click',function(){
					$(this).parent().parent().remove();
				});
				
				$('.addRow').live('click',function(){
					//$(this).val('Delete');
					//$(this).attr('class','del');
					var appendTxt = '<tr><td align="center">1</td><td align="center">Painting</td><td align="center"><input type="text" style="width:99%;" value ="" /></td><td align="center">$0.00</td><td align="center">$0.00</td><td align="center"><input class="del" type="button" value="Delete" /></td></tr>';
					$("tr:last").prev().after(appendTxt);			
				});        
			});
		</script>
</div>
<br>