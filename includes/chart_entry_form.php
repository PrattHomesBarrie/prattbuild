<script>
function clearData(pInput)
 {
 if (pInput == 'dateDocumentSigned') {
 	document.forms["ChartMainForm"].elements["dateDocumentSigned"].value = '';
 	document.forms["ChartMainForm"].elements["dateDocumentSignedDisplay"].value = '';
 }

 }
</script>


  <table width="100%" class="tableOfferEntry">
<form action="" method="post" name="ChartMainForm" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="EditChart" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="SaveChart" onsubmit="return checkFormData(this)"/>
    <input name="chartNumber" type="hidden" id="chartNumber" value="<?php echo $chartNumber; ?>" />

<style>
.ui-autocomplete-loading { background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat; }
.ui-autocomplete-input {  FONT-SIZE: 5px; }
.ui-menu {  FONT-SIZE: 12px; }
/*
#elevation { width: 20em; }
#modelName { width: 20em;  }
*/

</style>

 <script>
	$(function() {
		$( "#textValue_1_1" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=featureCategory&"
		});
	});
	$(function() {
		$( "#featureName" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=featureName&"
//		 }).focus(function(){             
  //          $(this).trigger('keydown.autocomplete'); 
		});
	});
	$(function() {
		$( "#featureName2" ).autocomplete({
			//source: availableTags
			minLength: 0,
			source: "webservice/json_data_service.php?currentField=featureName2&"
//		 }).focus(function(){             
  //          $(this).trigger('keydown.autocomplete'); 
		});
	});
	</script>
<?php 

$query = "select * from charts where id=".$chartNumber;
//echo $query;
$chartsArray = $db->QueryArray($query);
//print_r($chartsArray);
echo '<a target="_blank" href="index.php?myAction=ColourChart&chartNumber=2&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">Colour Chart Print View</a>';
if ($chartsArray[0]["showChartTitle"]) {
	echo '<h1>'.$chartsArray[0]["chartDisplayTitle"].'</h1>';
}

$query = "select * from chartSections where chartId=".$chartsArray[0]["id"]." order by sortSequence, sectionDisplayTitle";
$chartSectionsArray = $db->QueryArray($query);
//print_r($chartSectionsArray );
foreach ($chartSectionsArray as $i => $sectionRow) 
{ 
	$displayValue = "";
	if ($sectionRow["showSectionTitle"]) {
		$displayValue = $sectionRow["sectionDisplayTitle"];
	}
	echo '<tr><td><table class="tableOfferEntry"  width= "100%"><tr>';
	echo '<td class="chartSectionTitle" height="25px" width="20%" bgcolor="#CCCCCC" >'.$displayValue.'</td>';
	$query = "select * from chartSectionCategories where chartSectionId=".$sectionRow["id"].' order by sortSequence, categoryDisplayTitle';
	//echo '<br>'.$query;
	//print_r($chartCategoriesArray );
	$numberOfCategories = 0;
	if ($db->HasRecords($query)) {
		$chartCategoriesArray = $db->QueryArray($query);
		foreach ($chartCategoriesArray as $i => $categoryRow) 
		{
			$displayValue = "";
			if ($categoryRow["showCategoryTitle"]) {
				$displayValue = $categoryRow["categoryDisplayTitle"];
			}
			echo '<td class="chartSectionTitle" width="150px" bgcolor="#CCCCCC"><b>'.$displayValue.'</b></td>';
			$numberOfCategories +=1;
		}
	}
	echo '</tr>';
	$query = "select * from chartSectionItems where chartSectionId=".$sectionRow["id"].' order by sortSequence, itemDisplayTitle';
	//echo '<br>'.$query;
	//print_r($chartItemsArray );
	if ($db->HasRecords($query)) {
		$chartItemsArray = $db->QueryArray($query);
		foreach ($chartItemsArray as $i => $itemRow) 
		{
			echo '<tr>';
			$showItemTitle = $itemRow["showItemTitle"];
			if ($showItemTitle) {
				echo '<td class="chartItemTitle">'.$itemRow["itemDisplayTitle"].'</td>';
				$columns["fieldLength"][0] = 18;
				$columns["textAreaLength"][0] = 18;
			}


			$query = "select * from chartSectionCategories where chartSectionId=".$sectionRow["id"].' order by sortSequence, categoryDisplayTitle';
			//print_r($chartCategoriesArray );
			
			if ($db->HasRecords($query)) {
				$entryItemsArray = $db->QueryArray($query);
				foreach ($entryItemsArray as $j => $entryItemRow) 
				{
					$query = "select * from offerChartData where lotNumber = ".$lotNumber." and siteShortName = '".$siteShortName."'";
					$query = $query." and itemId=".$itemRow["id"];
					$query = $query." and categoryId=".$entryItemRow["id"];
				//	echo $query;								
				//print_r($chartCategoriesArray );
					$textValue = "";
					$currencyValue = "";
					if ($db->HasRecords($query)) {
    					$itemDataArray = $db->QueryArray($query);
						$textValue = $itemDataArray[0]["textValue"];
						$currencyValue = $itemDataArray[0]["currencyValue"];
					}
						$fieldLength = 83/$numberOfCategories ;
						$columns["fieldLength"][$j+1] = $fieldLength;
						$textAreaLength = 75/$numberOfCategories ;
						$columns["textAreaLength"][$j+1] = $textAreaLength;
						$itemFormName = 'textValue_'.$itemRow["id"].'_'.$entryItemRow["id"];
						if ($sectionRow["entryTextBoxHeight"] == 1) {
							echo '<script>
								$(function() {
									$( "#'.$itemFormName.'" ).autocomplete({
										minLength: 0,
									source: "webservice/json_data_service.php?currentField=chartTextValue'.
									    '&site='.$siteShortName
										.'&sectionId='.$sectionRow["id"]
										.'&categoryId='.$entryItemRow["id"]
										.'&itemId='.$itemRow["id"]
										.'&limitToCategory='.$entryItemRow["limitPrevItemsToCategory"]
										.'&limitToItem='.$itemRow["limitPrevItemsToThisItem"]
										.'&"
									});
								});
							    </script>';
						}
						echo '<td class="chartItemEntryText" ><span class="ui-widget">';
						if ($sectionRow["entryTextBoxHeight"] > 1) {
							echo '<textarea name="'.$itemFormName.'" id="'.$itemFormName.'" cols="'.$textAreaLength.'"';
							echo ' rows="'.$sectionRow["entryTextBoxHeight"].'">'.htmlspecialchars($textValue).'</textarea>';
						}
						else {
							
    						echo '<input type="text" name="'.$itemFormName.'" id="'.$itemFormName.'"';
							echo ' value="'.htmlspecialchars($textValue).'" size="'.$fieldLength.'" maxlength="1000" />';
						}
						echo '</span></td>';

				}
			}



			echo '</tr>';
		}
		if ($sectionRow["allowExtraItems"]) {
			echo '<tr>';
			echo '<td> Extra Items:</td>';
			echo '</tr>';
		}
		$rowNumber = 0;
		if ($sectionRow["allowExtraItems"]) {
			$query = "select * from offerChartAdditionalItems where lotNumber = ".$lotNumber." and siteShortName = '".$siteShortName."'";
			$query = $query." and chartSectionId=".$sectionRow["id"];
			$query = $query."  order by rowNumber, columnNumber";
			//echo  $query;
			//print_r($chartCategoriesArray );
			
            $prevRowNumber = -1;
			if ($db->HasRecords($query)) {
				$entryItemsArray = $db->QueryArray($query);
				foreach ($entryItemsArray as $j => $entryItemRow) 
				{
					if ($entryItemRow["rowNumber"] > $prevRowNumber) {
						$rowNumber += 1;
						if ($prevRowNumber != -1) {
							echo "</tr>";
						}
						echo "<tr>";
						$columnNumber=0;
					}
					$prevRowNumber = $entryItemRow["rowNumber"];
					$itemFormName = 'extraItem_textValue_'.$sectionRow["id"].'_'.$entryItemRow["categoryId"].'_'.$rowNumber.'_'.$columnNumber;
						if ($sectionRow["entryTextBoxHeight"] == 1) {
							echo '<script>
								$(function() {
									$( "#'.$itemFormName.'" ).autocomplete({
										minLength: 0,
									source: "webservice/json_data_service.php?currentField=chartTextValue'.
									    '&site='.$siteShortName
										.'&sectionId='.$sectionRow["id"]
										.'&categoryId='.$entryItemRow["id"]
										.'&itemId='.$itemRow["id"]
										.'&limitToCategory='.$entryItemRow["limitPrevItemsToCategory"]
										.'&limitToItem='.$itemRow["limitPrevItemsToThisItem"]
										.'&"
									});
								});
							    </script>';
						}
					echo '<td class="chartItemEntryText" ><span class="ui-widget">';
					echo '<input type="text" name="'.$itemFormName.'" id="'.$itemFormName.'"';
					echo ' value="'.$entryItemRow["textValue"].'" size="'.$columns["fieldLength"][$columnNumber].'" maxlength="1000" />';
					echo '</span></td>';
					$columnNumber += 1;
				}
			}
		}

		if ($sectionRow["allowExtraItems"]) {
			$rowNumber += 1;	
			echo '<tr>';
			if ($showItemTitle) {
				$columnNumber=0;
				echo '<td class="chartItemEntryText" ><span class="ui-widget">';
				$itemFormName = 'extraItem_textValue_'.$sectionRow["id"].'_0'.'_'.$rowNumber.'_'.$columnNumber;
				echo '<input type="text" name="'.$itemFormName.'" id="'.$itemFormName.'"';
				echo ' value="" size="18" maxlength="1000" />';
				echo '</span></td>';
			}
			foreach ($chartCategoriesArray as $i => $categoryRow) {
				$columnNumber += 1;
				echo '<td class="chartItemEntryText" ><span class="ui-widget">';
				$itemFormName = 'extraItem_textValue_'.$sectionRow["id"].'_'.$categoryRow["id"].'_'.$rowNumber.'_'.$columnNumber;
				if ($sectionRow["entryTextBoxHeight"] == 1) {
					echo '<script>
						$(function() {
							$( "#'.$itemFormName.'" ).autocomplete({
								minLength: 0,
							source: "webservice/json_data_service.php?currentField=chartTextValue'.
							    '&site='.$siteShortName
								.'&sectionId='.$sectionRow["id"]
								.'&categoryId='.$entryItemRow["id"]
								.'&itemId='.$itemRow["id"]
								.'&limitToCategory='.$entryItemRow["limitPrevItemsToCategory"]
								.'&limitToItem='.$itemRow["limitPrevItemsToThisItem"]
								.'&"
							});
						});
					    </script>';
				}

				if ($sectionRow["entryTextBoxHeight"] > 1) {
					echo '<textarea name="'.$itemFormName.'" id="'.$itemFormName.'" cols="'.$textAreaLength.'"';
					echo ' rows="'.$sectionRow["entryTextBoxHeight"].'"></textarea>';
				}
				else {
					echo '<input type="text" name="'.$itemFormName.'" id="'.$itemFormName.'"';
					echo ' value="" size="'.$fieldLength.'" maxlength="1000" />';
				}
				echo '</span></td>';
			}
			echo '</td>';
			echo '</tr>';
		}
	}
	echo '</table></td></tr>';
} 


?>
<tr>
<td>
<?php

if ($chartsArray[0]["requiresApprovalForPublic"]) {

	$query = "select * from offerChartHeaderData where lotNumber = ".$lotNumber." and siteShortName = '".$siteShortName."'";
	$query = $query." and chartId=".$chartsArray[0]["id"];
	//echo $query;								
	//print_r($chartCategoriesArray );
	if ($db->HasRecords($query)) {
		$headerDataArray = $db->QueryArray($query);
		$availableToPublic = $headerDataArray[0]["availableToPublic"];
	}
	else {
		$availableToPublic = 0;
	}

	echo '<tr><td><table class="tableOfferEntry"  width= "100%"><tr>';
	echo '<td width="20%" class="chartItemTitle">Available To Public/Trades</td>';

		if ($availableToPublic == 1) {
			$checked = 'checked="checked"';
			$tdbgcolor = 'bgcolor="green"';
		}
		else {
			$checked = '';
			$tdbgcolor = 'bgcolor="yellow"';
		}
		
		echo '<td  align="center" '.$tdbgcolor.'>'; 
		echo '<input '.$checked.'  name="availableToPublic" type="checkbox" id="availableToPublic" value="1" />';
		echo '</td>';
	echo '</tr></table></td></tr>';
}

unset($dateValue);
if (isset($offerInfo->dateDocumentSigned)) {
	//this logic needs to change once we stat using the document signed date
	$dateValue =  formatDateForHTML($offerInfo->dateDocumentSigned,NULL);
	} 
if ($chartsArray[0]["requiresSignature"]) {
	echo '<tr><td><table class="tableOfferEntry"  width= "100%"><tr>';
	echo '<td class="chartSectionTitle" height="25px" width="20%" bgcolor="#CCCCCC" >'.'Signature'.'</td>';
	echo '<td class="chartSectionTitle" width="150px" bgcolor="#CCCCCC"><b>'.''.'</b></td>';
	echo '</tr><tr>';
	echo '<td class="chartItemTitle">Date Chart Signed</td>';
    echo '  <td><SCRIPT>$(function() {
                       $("#dateDocumentSigned").datepicker({ 
					     altField: ('."'".'#dateDocumentSignedDisplay'."'".'),
					    numberOfMonths: 1,
						showOn: "button",
						changeMonth: true,
						changeYear: true,
						buttonImage: "images/calendar.gif",
						yearRange: '."'".'c-80:c+10'."'".',
						buttonImageOnly: true,
                		showButtonPanel: true,
				        dateFormat: '."'".'dd-M-yy'."'".',
					    showAnim: '."'".'fadeIn'."'".'});
                        }); 

                        
                        </SCRIPT>';
	echo '<IMG SRC="images/delete-icon.gif" name="a1" width="15" height="15"  border="0" usemap="#pswd" style="cursor:hand" 	onclick="clearData('."'".'dateDocumentSigned'."'".')">';
	echo '<input name="dateDocumentSignedDisplay" type="text" value="'.$dateValue.'" id="dateDocumentSignedDisplay" style="width:80px;" disabled="disabled"  />';
  	echo '<input name="dateDocumentSigned" type="hidden" value="'.$dateValue.'" id="dateDocumentSigned" style="width:76px;" /></td>';
	echo '</tr>';
	echo '</table></td></tr>';
}

?>
</td>
</tr>
<tr><td><table><tr>
<td width= "400">
<td width= "400">
<button type="submit" class="formbutton" name="saveData" id="saveChart" style="width: 60px;">Save</button></td>
<td></td>
</tr></table></td></tr>
</form>
  </table>

<p>&nbsp;</p>
<p>&nbsp;</p>