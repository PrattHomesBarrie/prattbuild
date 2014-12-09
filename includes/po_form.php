&nbsp;<? if(isset($_GET["PONum"])) echo '#'.$_GET["PONum"];?>
<br><br>
<form method="post" action="index.php?myAction=PO&myPOAction=Save<? if(isset($_GET["lotNumber"])) echo "&lotNumber=".$_GET["lotNumber"]; 
		if(isset($_GET["siteShortName"])) echo "&siteShortName=".$_GET["siteShortName"];
		?>">
<input type="hidden" name="id" value="<?= $_GET["PONum"]?>"/>
<?php
	if($_GET["myPOAction"]=="View")
	{
		echo "<button>Print</button>";
		echo '&nbsp;<input type="button" value="Back" onclick="javascript:window.history.back();">';
	}
	
	if($_GET["myPOAction"]=="Edit" or $_GET["myPOAction"]=="Add")
	{
		echo '<button type="submit">Save</button>';
		echo '&nbsp;<input type="button" value="Cancel" onclick="javascript:window.history.back();">';
	}
?>
<? 
$query = 'select poList.*,sites.siteName from poList left join sites on sites.siteShortName = poList.siteShortName where id='.$_GET["PONum"];
if ($db->Query($query)) 
	{ 
		while ($resultRow = $db->Row() ) {
			$buildingNumber = $resultRow->buildingNumber;
			$tradeID = $resultRow->vendorID;
			$shiptoAdd = $resultRow->shiptoAdd;
			//$description = $resultRow->description;
			//$accountType = $resultRow->accountType;
			$poStatus = $resultRow->poStatus;
			$poSiteName = $resultRow->siteName;;
		}
	}
	
$query3 = 'select * from tradeList where status = 1';
if($_GET["myPOAction"]=="View") {$query3 .= ' and id='.$tradeID;}
$query3 .= ' order by name ASC';

$query1 = 'select * from offerDetailView where 1=1';
if(isset($_GET["lotNumber"])) 
$query1 .=' and lotNumber = "'.$_GET["lotNumber"].'"';
if(isset($_GET["siteShortName"])) 
$query1 .=' and siteShortName = "'.$_GET["siteShortName"].'"';

$query2 = 'select * from sites where siteID > 2';
if($_GET["siteShortName"]!="" && $_GET["myPOAction"]=="View")
$query2 .= ' and siteShortName='.$_GET["siteShortName"];

$query4 = 'select * from lineList where 1=1';
if($_GET["PONum"]!="")
$query4 .= ' and poID='.$_GET["PONum"];

?>
<div style="width:1000px;clear:both;">
<hr>
</div>
<? if($_GET["siteShortName"]=='' && $_GET["myPOAction"]=="Add"){ ?>
<div style="width:1000px;clear:both;" id="poTypeForm">
	<b>Create a PO for:&nbsp;<label for="po_for_lot">Lot</label><input type="radio" checked name="poType" value="0" class="poType" id="po_for_lot" />
				   <label for="po_for_site">Site</label><input type="radio" name="poType" class="poType" value="1" id="po_for_site" />
	</b>
</div>
<? } ?>
<script type="text/javascript" src="js/jquery-1.7.min.js"></script>
<script>
	$(function() {
	var poTypeValue = $("#poTypeForm input[type='radio']:checked").val();
    $('#poTypeForm input').on('change', function(){
	poTypeValue = $("#poTypeForm input[type='radio']:checked").val();
		//console.log(poTypeValue);
        if(poTypeValue == 0) {
            $('#poLotForm').show();
			$('#poSiteForm').hide();
        } else {
			$('#poLotForm').hide();
            $('#poSiteForm').show();
        } 
    });
});
</script>
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
	'<select name="vendorID" style="height:29px;width:270px">
		<option value="">
			Vendor\'s Name
		</option>';
	?>
	<?
	if ($db->Query($query3) && $_GET["myPOAction"]!="View") 
	{ 
		while ($resultRow = $db->Row() ) {
		echo '<option value="'.$resultRow->id.'"';
		if($tradeID == $resultRow->id) echo 'selected';
		echo '>'. $resultRow->name.'</option>';
	 }
	echo '</select><span style="color:red;margin-left:5px;">*</span>';
	}
	else if ($db->Query($query3) && $_GET["myPOAction"]=="View") 
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
	<? if($_GET["myPOAction"]=="View") echo $shiptoAdd;
		else {
	?>
	<input type="text" name="shiptoAdd" value="<?= $shiptoAdd?>" placeholder="Ship to address" style="height:22px;width:275px;"/>
	<span style="color:red;">*</span>
	<? } ?>
	</div>
	
	
	<? if ($db->Query($query1) && isset($_GET["lotNumber"])) 
		{ 
		echo '<div style="width:300px !important; float:left;margin-left:50px;">
				<h3 style="padding-left: 0px;">Reference</h3>';
		while ($resultRow = $db->Row()) {
			echo 'Homeowner: '.$resultRow->firstName1.' '.$resultRow->lastName1.
				 '<br>Phone: '.$resultRow->homePhone.
				 '<br>Cell: '.$resultRow->otherPhone.
				 '<br>Address: '.$resultRow->munStreetNumber.' '.$resultRow->munStreetAddress.' '.$resultRow->postalCode
			;
		}
		
		}
		if((!isset($_GET["lotNumber"]) or $_GET["lotNumber"]==0) && $_GET["myPOAction"]=="View")
		echo 
		'
			Homeowner:
			<br>Phone:
			<br>Cell:
			<br>Address:';
	?>
	</div>
	
</div>
<div style="width:1000px;">
	<br>
	<div style="width:450px;float:left;clear:both;">
	<br><b>Re: </b>
	Lot: <? 
				if($_GET["siteShortName"]!=''){
					if($_GET["lotNumber"]=='' or $_GET["lotNumber"]==0)
					{
						echo ' Common Elements<br> Phase: Building ';
						if($_GET["myPOAction"]=="View") echo $buildingNumber.'<br>';
						else echo '<input type="text" placeholder="building #" name="buildingNumber" value="'.$buildingNumber.'" style="width:60px;"/><span style="color:red;margin-left:5px;">*</span><br>';
					}
				else if(($_GET["lotNumber"])!='' and $_GET["lotNumber"]!=0) echo " ".$_GET["lotNumber"].", ";	
				if(isset($poSiteName)) echo "Site: ".$poSiteName;	
				}
				else {
				echo ' <span id="poLotForm"><input type="text" style="width:60px;" name="lotNumber" id="lotNumber" value="'.$_GET["lotNumber"].'"/><span style="color:red;margin-left:5px;">*</span></span> ';
				echo ' <span style="display:none" id="poSiteForm">Common Elements<br> Phase: Building <input type="text" placeholder="building #" name="buildingNumber" style="width:60px;" value="'.$buildingNumber.'"/><span style="color:red;margin-left:5px;">*</span></span><br>';
				echo 'Site: ';
				
				
				
				echo 
				'<select name="siteShortName" style="height:29px;width:200px">
					<option value="">
						Site\'s Name
					</option>';
				
				if ($db->Query($query2) && $_GET["myPOAction"]!="View") 
				{ 
					while ($resultRow = $db->Row() ) {
					echo '<option value="'.$resultRow->siteShortName.'">'. $resultRow->siteName.'</option>';
				 }
				echo '</select><span style="color:red;margin-left:5px;">*</span>';
				}
				else if ($db->Query($query2) && $_GET["myPOAction"]=="View") 
					{
					while ($resultRow = $db->Row() ) {
					echo $resultRow->siteName;
				}}
				
				
				}
			?>
	
	</div>
	<div style="width:300px;float:left;margin-left:250px;">
		<br><b>Model:</b>
	</div>
</div>

<div style="width:1000px; clear:both;">	
	<div style="width:250px;float:left;">
	<br>
	<b>
		
		<? 
		if($_GET["myPOAction"]=="View")
		{/*
			if($poStatus==0)
			echo "Outstanding";
			if($poStatus==1)
			echo "Completed";
			if($poStatus==2)
			echo "Paid";
			*/
		}
		else {
		?>PO Status: &nbsp;
		<select name="poStatus">
			<option value="0">
				Outstanding
			</option>
			<? if($_GET["myPOAction"]=="Edit")
			{
				echo 
				'<option value="1"';
				if($poStatus == 1)
				echo 'selected';
				echo '>
					Completed
				</option>
				<option value="2"';
				if($poStatus == 2)
				echo 'selected';
				echo '>
				Paid
				</option>';
			}
			?>
		</select>
		<? } ?>
		</b>
	</div>
	<? if($_GET["myPOAction"]=="Add") echo
	'<div style="float:right;">
		<br><a href="#"class="addRow" >+ Add Row</a>
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
			<? //if($_GET["myPOAction"]=="Add" or $_GET["myPOAction"]=="Edit") echo '<th align="center">Action</th>' ;?>
		</tr>
		</thead>
		<tbody>
			<? if ($db->Query($query4) && $_GET["myPOAction"]!="Add") 
				{ 
				$lineNumberTotal=0;
					while ($resultRow = $db->Row()) 
					{
			?>
			<tr>
				<td align="center">
					1<input type="hidden" name="quantity_<?=  $resultRow->lineNumber?>" style="width:99%;" value ="1" />
				</td>
				<td align="center">
					<? if($_GET["myPOAction"]=="View") echo $resultRow->accountType; 
					else {
					?>
					<input type="text" style="width:99%;" placeholder="Account" name="accountType_<?=  $resultRow->lineNumber?>" value ="<?= $resultRow->accountType ?>" />
					<? } ?>
				</td>
				<td align="center">
					<?
					if($_GET["myPOAction"]=="View") echo $resultRow->description;
					else echo '<input type="text" name="description_'.$resultRow->lineNumber.'" style="width:99%;" placeholder="Description" value ="'.$resultRow->description.'" />';
				
				?>
				</td>
				<td align="center">
					$0.00<input type="hidden" name="unitPrice_<?=  $resultRow->lineNumber?>" style="width:99%;" value ="0" />
				</td>
				<td align="center">
					$.00<input type="hidden" name="extPrice_<?=  $resultRow->lineNumber?>" style="width:99%;" value ="0" />
				</td>
				<? //if($_GET["myPOAction"]=="Add" or $_GET["myPOAction"]=="Edit") echo '<td align="center"><input class="del" type="button" value="Delete" /></td>'; ?>
			</tr>
			
			<? 
			$lineNumberTotal++;
				}
				echo '<input type="hidden" name="lineNumber" id="lineNumber" value="'.$lineNumberTotal.'"/>';
			}
			else {?>
			<tr>
				<td align="center">
					1<input type="hidden" name="quantity_1" style="width:99%;" value ="1" />
				</td>
				<td align="center">
					<input type="text" style="width:99%;" placeholder="Account" name="accountType_1" value ="" />
				</td>
				<td align="center">
					<input type="text" name="description_1" style="width:99%;" placeholder="Description" value ="" />
				</td>
				<td align="center">
					$0.00<input type="hidden" name="unitPrice_1" style="width:99%;" value ="0" />
				</td>
				<td align="center">
					$.00<input type="hidden" name="extPrice_1" style="width:99%;" value ="0" />
				</td>
				<? //if($_GET["myPOAction"]=="Add" or $_GET["myPOAction"]=="Edit") echo '<td align="center"><input class="del" type="button" value="Delete" /></td>'; ?>
				<input type="hidden" name="lineNumber" id="lineNumber" value="1"/>
			</tr>
			<? } ?>
			<tr style="background-color:grey;">
				<td colspan="3">
				
				</td>
				<td align="center">
					<b>Total:</b>
				</td>
				<td align="center">
				 <b>$0.00</b>
				</td>
				<? //if($_GET["myPOAction"]=="Add" or $_GET["myPOAction"]=="Edit") echo '<td></td>' ;?>
			</tr>
		</tbody>
		
		
	</table>
		<script type="text/javascript">
			$(document).ready(function(){		
				var lineNumber = $("#lineNumber").val();
				
				$('.del').live('click',function(){
				if(lineNumber>1){
					$(this).parent().parent().remove();
					lineNumber--;
					console.log(lineNumber);
					$("#lineNumber").val(lineNumber);
				}
				else alert("PO need at least 1 line item");
				});
				
				$('.addRow').live('click',function(){
					//$(this).val('Delete');
					//$(this).attr('class','del');
					lineNumber++;
					console.log(lineNumber);
					var appendTxt = '<tr>'+
					'<td align="center">1<input type="hidden" name="quantity_'+lineNumber+'" style="width:99%;" value ="1" />'+
					'</td><td align="center"><input type="text" style="width:99%;" placeholder="Account" name="accountType_'+lineNumber+'" value ="" />'+
					'</td><td align="center"><input type="text" name="description_'+lineNumber+'" style="width:99%;" placeholder="Description"  value ="" /></td>'+
					'<td align="center">$0.00<input type="hidden" name="unitPrice_'+lineNumber+'" style="width:99%;" value ="0" /></td>'+
					'<td align="center">$0.00<input type="hidden" name="extPrice_'+lineNumber+'" style="width:99%;" value ="0" /></td>'+
					'</tr>';
					$("tr:last").prev().after(appendTxt);
					$("#lineNumber").val(lineNumber);
				});        
			});
		</script>
</div>
<br>
</form>