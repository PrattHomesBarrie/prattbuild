<?
	$date=date("Y-m-d h:i:sa");
	if($_GET["myPOAction"]=="View")
	{
		$query='INSERT INTO poHistory VALUES(NULL,"'.$_SESSION["userName"].'","View",'.$_GET["PONum"].',"'.$date.'")';
		$db->Query($query);
		//echo $query;
	}
	
	$query = 'select poList.*,sites.siteName, users.firstName, users.lastName from poList left join sites on sites.siteShortName = poList.siteShortName left join users on users.userName = poList.createdBy where id='.$_GET["PONum"];
	//echo $query;
	if ($db->Query($query)) 
	{ 
		while ($resultRow = $db->Row() ) {
			$buildingNumber = $resultRow->buildingNumber;
			$tradeID = $resultRow->vendorID;
			$tradeIDBackCharge = $resultRow->vendorIDBackCharge;
			$shiptoAdd = $resultRow->shiptoAdd;
			//$description = $resultRow->description;
			//$accountType = $resultRow->accountType;
			$poStatus = $resultRow->poStatus;
			$poSiteName = $resultRow->siteName;
			$firstName = $resultRow->firstName;
			$lastName = $resultRow->lastName;
			$createdDate = date('Y-M-d', strtotime($resultRow->dateCreated));
		}
	}
?>
&nbsp;<? if(isset($_GET["PONum"])) echo '#'.$_GET["PONum"];?>
<br><br>
<form method="post" action="index.php?myAction=PO&myPOAction=Save<? if(isset($_GET["lotNumber"])) echo "&lotNumber=".$_GET["lotNumber"]; 
		if(isset($_GET["siteShortName"])) echo "&siteShortName=".$_GET["siteShortName"];
		echo '&siteName='.$poSiteName;
		?>">
<input type="hidden" name="id" value="<?= $_GET["PONum"]?>"/>
<?php
	if($_GET["myPOAction"]=="View")
	{
		echo '<a target="_blank" href="./includes/poPDF.php?poStatus='.$poStatus.'&siteShortName='.$_GET["siteShortName"].'&lotNumber='.$_GET["lotNumber"].'&PONum='.$_GET["PONum"].'&myPOAction=Print"><input type="button" value="Print" /></a>';
		echo '&nbsp;<input type="button" value="Back" onclick="javascript:window.history.back();">';
	}
	
	if($_GET["myPOAction"]=="Edit" or $_GET["myPOAction"]=="Add")
	{
		echo '<button type="submit">Save</button>';
		echo '&nbsp;<input type="button" value="Cancel" onclick="javascript:window.history.back();">';
	}
?>
<? 
$query3 = 'select * from tradeList where status = 1';
if($_GET["myPOAction"]=="View") {$query3 .= ' and id='.$tradeID;}
$query3 .= ' order by name ASC';

$query5 = 'select * from tradeList where status = 1';
if($_GET["myPOAction"]=="View") {$query5 .= ' and id='.$tradeIDBackCharge;}
$query5 .= ' order by name ASC';

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

$(function() {
	
    $('#backCharge').on('change', function(){
	console.log($('#backCharge').is(':checked'));
	 
        if($('#backCharge').is(':checked')) {
            $('#vendorBackCharge').show();
        } else {
			$('#vendorBackCharge').hide();
        } 
    });
});
</script>
<?
if($_GET["myPOAction"]=="View")
echo
'<div style="width:1000px;display:block">
	<div style="width:350px;float:left;margin-left:100px;">
	<h3>';
	if($_GET["siteShortName"] == "MAN" or $_GET["siteShortName"] == "UWS" or $_GET["siteShortName"] == "YST" or $_GET["siteShortName"] == "ESV") echo 'Pratt Hansen Grougp Inc.';
	else echo 'H.Hansen Development Inc.';
	echo '</h3>
	301 King Street
	<br>Barrie, Ontario
	<br>L4N 6B5
	<br>Phone: (705) 728-0033
	<br>Fax  : (705) 733-0073
	</div>

	<div style="width:300px;float:left;margin-left:150px;">
	<h3>Purchase Order</h3>
	PO #: '.$_GET["PONum"].'
	<br>Created date: '.$createdDate.
	'<br>Created By: '.$firstName.' '.$lastName.
	'</div>
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
		<option value="0">
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
			$modelName = $resultRow->modelName;
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
	<div style="width:350px;float:left;clear:both;">
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
				if($_GET["myPOAction"]!="View") echo "Site: ".$siteName;	
				else if($_GET["myPOAction"]=="View") echo "Site: ".$poSiteName;	
				}
				else {
				echo ' <span id="poLotForm"><input type="text" style="width:60px;" name="lotNumber" id="lotNumber" value="'.$_GET["lotNumber"].'"/><span style="color:red;margin-left:5px;">*</span></span> ';
				echo ' <span style="display:none" id="poSiteForm">Common Elements<br> Phase: Building <input type="text" placeholder="building #" name="buildingNumber" style="width:60px;" value="'.$buildingNumber.'"/><span style="color:red;margin-left:5px;">*</span></span><br>';
				echo '&nbsp;Site: ';
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
	<? if($_GET["myPOAction"]!="View") {?>
	<div style="width:350px;float:left;">
	<br><b><label for="backCharge">Backcharge</label></b><input type="checkbox" <? if($tradeIDBackCharge) echo "checked ";?>id="backCharge" name="backCharge" />
	<br>
		<?if($_GET["myPOAction"]!="View")
		{
			echo 
			'<div id="vendorBackCharge"';
				if(!isset($tradeIDBackCharge))echo 'style="display:none;"';
				echo '><select name="vendorIDBackCharge" style="height:29px;width:270px">
				<option value="0">
					Vendor\'s Name
				</option>';
			if ($db->Query($query3)) 
			{ 
				while ($resultRow = $db->Row() ) {
				echo '<option value="'.$resultRow->id.'"';
				if($tradeIDBackCharge == $resultRow->id) echo 'selected';
				echo '>'. $resultRow->name.'</option>';
			 }
			echo '</select></div>';
			}
		}
		echo '</div>';
	} 
	else if(isset($tradeIDBackCharge)){?>
		<div style="width:350px;float:left;">
		<br><b>Backcharge</b>
		<br>
		<? if ($db->Query($query5) && $_GET["myPOAction"]=="View") 
		{
		while ($resultRow = $db->Row() ) {
		echo $resultRow->name;
		}
		echo '</div>';}?>
	<? } ?>
	
	<? if(isset($modelName)) { 
	echo '<div style="width:300px;float:left;">
		<br><b>Model: </b>'.$modelName.
	'</div>';
	} ?>
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
		<br><button type="button" href="#" class="addRow" title="Add Row">+ Add Row</button>
	</div>';
	?>
</div>
<div style="width:1000px;clear:both;">
	<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" id="lotListTable">
		<thead>
		  <tr>
			<th align="center" style="width:100px !important;height:20px;">Quantity</th>
			<th align="center" style="width:150px !important;">Account<span style="color:red;margin-left:5px;">*</span></th>
			<!--<th align="center" style="width:150px !important;">Build Action</th> -->
			<th align="center" style="width:350px !important;">Description<span style="color:red;margin-left:5px;">*</span></th>
			<th align="center" style="width:150px !important;">Note</th>
			<th align="center" style="width:150px !important;">Completed</th>
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
				<td align="center" style="height:20px;">
					<input type="text" name="quantity_<?=  $resultRow->lineNumber?>" style="height:24px;width:99%;" value ="<?=  $resultRow->quantity?>" />
				</td>
				<td align="center">
					<? if($_GET["myPOAction"]=="View") echo $resultRow->accountType; 
					else {
					?>
					<input type="text" style="height:24px;width:99%;" placeholder="Account" name="accountType_<?=  $resultRow->lineNumber?>" value ="<?= $resultRow->accountType ?>" />
					<? } ?>
				</td>
				<td align="center">
					<?
					if($_GET["myPOAction"]=="View") echo $resultRow->description;
					else echo '<input type="text" name="description_'.$resultRow->lineNumber.'" style="height:24px;width:99%;" placeholder="Description" value ="'.$resultRow->description.'" />';
				
				?>
				</td>
				<td align="center">
					<input type="text" name="note_<?=  $resultRow->lineNumber?>" placeholder="Note" style="height:24px;width:99%;" value ="<?=  $resultRow->note?>" />
				</td>
				<td align="center">
					<input style="min-height:24px;" type="checkbox" name="lineStatus_<?=  $resultRow->lineNumber?>" <? if($resultRow->lineStatus == 1) echo "checked";?> value="<?=  $resultRow->lineStatus?>">
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
				<td align="center" style="height:20px;">
					<input type="text" name="quantity_1" style="height:24px;width:99%;" value ="1" />
				</td>
				<td align="center">
					<input type="text" style="height:24px;width:99%;" placeholder="Account" name="accountType_1" value ="" />
				</td>
				<td align="center">
					<input type="text" name="description_1" style="height:24px;width:99%;" placeholder="Description" value ="" />
				</td>
				<td align="center">
					<input type="text" name="note_1" placeholder="Note" style="height:24px;width:99%;" value ="" />
				</td>
				<td align="center">
					<input style="min-height:24px;" type="checkbox" name="lineStatus_1" value="">
				</td>
				<? //if($_GET["myPOAction"]=="Add" or $_GET["myPOAction"]=="Edit") echo '<td align="center"><input class="del" type="button" value="Delete" /></td>'; ?>
				<input type="hidden" name="lineNumber" id="lineNumber" value="1"/>
			</tr>
			<? } ?>
			<tr style="background-color:grey;height:20px;">
				<td colspan="5">
				
				</td>
				<!--<td align="center">
					<b>Total:</b>
				</td>
				<td align="center">
				 <b>$0.00</b>
				</td> -->
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
					'<td align="center" style="height:20px;"><input type="text" name="quantity_'+lineNumber+'" style="width:99%;height:24px;" value ="1" />'+
					'</td><td align="center"><input type="text" style="width:99%;height:24px;" placeholder="Account" name="accountType_'+lineNumber+'" value ="" />'+
					'</td><td align="center"><input type="text" name="description_'+lineNumber+'" style="width:99%;height:24px;" placeholder="Description"  value ="" /></td>'+
					'<td align="center"><input type="text" name="note_'+lineNumber+'" placeholder="Note" style="width:99%;height:24px;" value ="" /></td>'+
					'<td align="center"><input type="checkbox" name="lineStatus_'+lineNumber+'" value ="" /></td>'+
					'</tr>';
					$("tr:last").prev().after(appendTxt);
					$("#lineNumber").val(lineNumber);
				});        
			});
		</script>
</div>
<br>
</form>