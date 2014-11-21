
<form action="" method="get" name="ChooseSiteForModels" target="_self" >
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="ChooseSiteForModels" />

 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableSitesMenu">
 <tr>

<?php 

$x=0;  
$query = ' SELECT * FROM `sites`';
if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {
		$x = $x + 1;
		echo '<td>';
		echo '<label>';
        echo '<input type="radio" name="siteShortName" value="';
		echo $resultRow->siteShortName;
		echo '" id="siteShortName"';
		if ($siteShortName == null && $x == 1) {
			echo ' checked="checked" ';
			$siteShortName =  $resultRow->siteShortName;
		}
		if ($resultRow->siteShortName == $siteShortName) {
			echo ' checked="checked" ';
		}
		echo ' onclick="this.form.submit();"/>';
		if ($resultRow->siteShortName == $siteShortName) {
			echo '<b>';
		}
		echo $resultRow->siteName;
		if ($resultRow->siteShortName == $siteShortName) {
			echo '</b>';
		}
		echo '</label>';
	}
}

?>
</tr>
</table>
</form>


<table class="tableOfferEntry" width="100%" border="1" cellspacing="1" cellpadding="1" align="left">
<form action="" method="post" name="ModelsMainForm" target="_self" onsubmit="return checkFormData(this)">
<input name="siteShortName" type="hidden" id="siteShortName" value="<?php echo $siteShortName; ?>" />
<?php
$query = 'select * from lookupSiteModels where siteShortName = "'.$siteShortName.'"' ;

if ($myEditAction == 'EditSingleModel') {
	$query = $query.' and modelID = '.$_GET["modelID"];
}

$query = $query.' order by modelName asc';
//echo $query;

//echo '<tr><td colspan="4"><h1>Edit Offer Models</h1></td></tr>';
echo '<tr>';
echo '<th  align="center">Model</th>';
echo '<th align="center">Action</th>';
echo '</tr>';

$x=0;
if ($dbSingleUse->Query($query)) { 
	while ($models = $dbSingleUse->Row()) {
		$x = $x + 1;
		
		if ($myEditAction == 'EditSingleModel') {
			$modelID = $models->modelID;
			$modelName = $models->modelName;
		}
		else
		{
			echo '<tr>';
	    	echo '<td><b>'.nullToChar($models->modelName,'-').'</b>';
			echo '<td align="center"><big><a href="index.php?myAction=Maintenance&myEditAction=EditSingleModel&modelID='.$models->modelID.'">Edit</a></big></td>';
			echo '</tr>';
		}
	}
} 

?>

<tr><td>
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="<?php if ($myEditAction == 'EditSingleModel') { echo 'SaveModel'; } else { echo 'AddModel'; } ?>" />
    <input name="modelID" type="hidden" id="modelID" value="<?php echo $modelID; ?>" />
	<input name="siteShortName" type="hidden" id="siteShortName" value="<?php echo $siteShortName; ?>" />
</td></tr>
<tr>
 <td><span class="ui-widget">
        <input id="modelName"  name="modelName" value="<?php echo htmlspecialchars($modelName);?>" size="30" maxlength="30" />
      </span></td>                    
<td>
     	<button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 60px;"><?php if ($myEditAction == 'EditSingleModel') {echo '  Save ';} else {echo '  Add  ';} ?></button>

            </td></tr>
<tr ><td></td></tr>
</form>
<tr>
    <td></td>
    <td><form action="index.php?myAction=Maintenance" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <?php if ($myEditAction == 'EditSingleModel') {
		echo '<input name="myEditAction" type="hidden" id="myEditAction" value="EditModels" />';
	}?>
    <button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges" style="width: 60px;"><?php if ($myEditAction == 'EditSingleModel') {echo 'Cancel';} else {echo 'Return';}?></button></form> </td>
</tr>
</table>