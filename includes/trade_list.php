
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

<small><br>Note: Click on a column title to sort by that column</small>

<ul class="tabs">
	<li <? if($_GET["tradeStatus"]==1 or $_GET["tradeStatus"]=='') echo 'class="current"'; ?>>
		<a href='index.php?myAction=Trade&tradeStatus=1'>Active</a>
	</li>
	<li <? if($_GET["tradeStatus"]==0) echo 'class="current"'; ?>>
		<a href='index.php?myAction=Trade&tradeStatus=0'>Deactive</a>
	</li>
</ul>
<form>
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
/*
if ($debug == "Yes") {
	echo 'Watch='.$watch;
	echo 'updatelotNumber='.$updatelotNumber;
}

 if (strlen($siteShortName) > 10) {
	 echo "<br><b>Error:something wrong with length of siteShortName";
	 exit;
 }
 
//$filterOfferStatusGroup;
if ( $securityLevelOneCheck != true ) {
	   $query = 'select * from offerDetailViewSignedOnly';
}
else {
		$query = 'select * from offerDetailView';
	}
	$query = $query.'  where 1=1 ';


$query = $query." order by ".$lotSortList;

if ($lotSortList > '') {
	$query = $query.",";
}

$query = $query."siteShortName, lotNumber ";
//echo '<br>'.$query;
echo '<tbody>';
$prevTimelineMasterID = 0;
if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {
		echo '<tr>';
		echo '<td class="lotLinkCellInTable" ><a href="index.php?myAction=PO&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">';
		echo '<small>'.$resultRow->siteShortName.'</small>-';
		echo '<strong>'.str_pad($resultRow->lotNumber,4,'0',STR_PAD_LEFT).'</strong>';
		echo '</a></td>';
		
		echo '<td align="center">' ;
		$modelName =  '-';
		if ($resultRow->modelName > '') {
			$modelName = $resultRow->modelName;
		}
		else {
			if ($resultRow->designatedModelName > '') {
				$modelName = $resultRow->designatedModelName.'(d)';
			}
		}
		echo $modelName.'</td>';
		echo '<td align="center">'.$resultRow->siteName.'</td>';
		echo '<td align="center">'.'<b>'.$resultRow->firstName1.' '.$resultRow->lastName1.'</b>';
		if(($resultRow->firstName2 !="") && ($resultRow->lastName2 !=""))
			{
				echo ' and '.'<b>'.$resultRow->firstName1.' '.$resultRow->lastName1.'</b>';
			}
		echo '</td>';
		echo '<td align="center">'.$resultRow->clientAddress.' '.$resultRow->clientCity.'</td>';
		echo '<td align="center"> '.nullToChar($resultRow->calculatedBuildCompletionDate,'-');
		if ($securityLevelOneCheck) {
			echo $resultRow->calculatedBuildCompletionDateText;
		}
		echo '</td>';
		echo '</tr>';
	}
}
echo '</tbody>		';
*/
?>
<tbody>
	<tr>
		<!--<td align="center">
			<input style="min-height:24px; width:98%;" type="text" name="">
		</td>
		<td align="center">
			<input style="min-height:24px; width:98%;" type="text" name="">
		</td>
		<td align="center">
			<input style="min-height:24px; width:98%;" type="text" name="">
		</td>
		<td align="center">
			<input style="min-height:24px; width:99%;" type="text" name="">
		</td>
		<td align="center">
			<input style="min-height:24px; width:98%;" type="text" name="">
		</td>
		<td align="center">
			<input style="min-height:24px; width:98%;" type="text" name="">
		</td>
		<td align="center">
			<input style="min-height:24px;" type="checkbox" name="">
		</td> -->
		<td><input type="text" name="" style="width:99%;"/></td>
		<td><input type="text" name="" style="width:99%;"/></td>
		<td><input type="text" name="" style="width:99%;"/></td>
		<td><input type="text" name="" style="width:99%;"/></td>
		<td><input type="text" name="" style="width:99%;"/></td>
		<td align="center">
			<select>
				<option <? if($_GET["tradeStatus"]==1 or !isset($_GET["tradeStatus"])) echo 'selected';?> value="1">
					Active
				</option>
				<option <? if($_GET["tradeStatus"]==0) echo 'selected';?> value="0">
					Deactive
				</option>
			</select>
		</td>
		<td align="center" style="width:100px;">
			<a title="Add" href="<? echo 'index.php?myAction=Trade&myTradeAction=Add&tradeStatus='?>">
			<img style="width:28px;" src="./images/add_icon.png" /></a>
		</td>
	<tr>
	
	<tr>
		<td align="center">
			Trade's name
		</td>
		<td align="center">
			Trade adress
		</td>
		<td align="center">Trade's phone</td>
		<td align="center">
			Trade's fax
		</td>
		<td align="center">
			Trade's email
		</td>
		<td align="center">
			<select>
				<option <? if($_GET["tradeStatus"]==1) echo 'selected';?> value="1">
					Active
				</option>
				<option <? if($_GET["tradeStatus"]==0) echo 'selected';?> value="0">
					Deactive
				</option>
			</select>
		</td>
		<td align="center">
			<a title="Edit" href="<? echo 'index.php?myAction=Trade&tradeStatus='.$_GET["tradeStatus"].'&myTradeAction=Edit' ?>"><img  src="./images/edit_icon1.png" /></a>
		</td>
	<tr>
	
	
	<tr>
		<td align="center">
			Trade's name
		</td>
		<td align="center">
			Trade adress
		</td>
		<td align="center">Trade's phone</td>
		<td align="center">
			Trade's fax
		</td>
		<td align="center">
			Trade's email
		</td>
		<td align="center">
			<select>
				<option <? if($_GET["tradeStatus"]==1) echo 'selected';?> value="1">
					Active
				</option>
				<option <? if($_GET["tradeStatus"]==0) echo 'selected';?> value="0">
					Deactive
				</option>
			</select>
		</td>
		<td align="center">
			<a title="Edit" href="<? echo 'index.php?myAction=Trade&tradeStatus='.$_GET["tradeStatus"].'&myTradeAction=Edit' ?>"><img  src="./images/edit_icon1.png" /></a>
		</td>
	<tr>
	
	
	<tr>
		<td align="center">
			Trade's name
		</td>
		<td align="center">
			Trade adress
		</td>
		<td align="center">Trade's phone</td>
		<td align="center">
			Trade's fax
		</td>
		<td align="center">
			Trade's email
		</td>
		<td align="center">
			<select>
				<option <? if($_GET["tradeStatus"]==1) echo 'selected';?> value="1">
					Active
				</option>
				<option <? if($_GET["tradeStatus"]==0) echo 'selected';?> value="0">
					Deactive
				</option>
			</select>
		</td>
		<td align="center">
			<a title="Edit" href="<? echo 'index.php?myAction=Trade&tradeStatus='.$_GET["tradeStatus"].'&myTradeAction=Edit' ?>"><img  src="./images/edit_icon1.png" /></a>
		</td>
	<tr>
	
	
	<tr>
		<td align="center">
			Trade's name
		</td>
		<td align="center">
			Trade adress
		</td>
		<td align="center">Trade's phone</td>
		<td align="center">
			Trade's fax
		</td>
		<td align="center">
			Trade's email
		</td>
		<td align="center">
			<select>
				<option <? if($_GET["tradeStatus"]==1) echo 'selected';?> value="1">
					Active
				</option>
				<option <? if($_GET["tradeStatus"]==0) echo 'selected';?> value="0">
					Deactive
				</option>
			</select>
		</td>
		<td align="center">
			<a title="Edit" href="<? echo 'index.php?myAction=Trade&tradeStatus='.$_GET["tradeStatus"].'&myTradeAction=Edit' ?>"><img  src="./images/edit_icon1.png" /></a>
		</td>
	<tr>
	
	
	<tr>
		<td align="center">
			Trade's name
		</td>
		<td align="center">
			Trade adress
		</td>
		<td align="center">Trade's phone</td>
		<td align="center">
			Trade's fax
		</td>
		<td align="center">
			Trade's email
		</td>
		<td align="center">
			<select>
				<option <? if($_GET["tradeStatus"]==1) echo 'selected';?> value="1">
					Active
				</option>
				<option <? if($_GET["tradeStatus"]==0) echo 'selected';?> value="0">
					Deactive
				</option>
			</select>
		</td>
		<td align="center">
			<a title="Edit" href="<? echo 'index.php?myAction=Trade&tradeStatus='.$_GET["tradeStatus"].'&myTradeAction=Edit' ?>"><img  src="./images/edit_icon1.png" /></a>
		</td>
	<tr>
</tbody>
</table>
</form>