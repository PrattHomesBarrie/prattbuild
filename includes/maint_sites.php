<style>
.ui-autocomplete-loading { background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat; }
.ui-autocomplete-input {  FONT-SIZE: 5px; }
.ui-menu {  FONT-SIZE: 12px; }
/*
#elevation { width: 20em; }
#modelName { width: 20em;  }
*/

</style>


<table class="tableOfferEntry"  border="1" cellspacing="1" cellpadding="2" align="left">
<form action="" method="post" name="SitesMainForm" target="_self" onsubmit="return checkFormData(this)">
<?php
$query = 'select *
			from sites where 1=1	' ;

if ($myEditAction == 'EditSingleSite') {
	$query = $query.' and siteShortName = "'.$_GET["siteShortName"].'"';
}

$query = $query.' order by siteName asc';
//echo $query;

//echo '<tr><td colspan="4"><h1>Edit Offer Features</h1></td></tr>';
echo '<tr>';
echo '<th width="80px" >id<small><br/>(3 to 5 letters)</small></th>';
echo '<th  >Site Name</th>';
echo '<th  align="center">Available Site Discount</th>';
echo '<th  align="center">Active Site</th>';
echo '<th align="center">Action</th>';
echo '</tr>';

$x=0;
if ($dbSingleUse->Query($query)) { 
	while ($sites = $dbSingleUse->Row()) {
		$x = $x + 1;
		if ($myEditAction == 'EditSingleSite') {
			$siteShortName = $sites->siteShortName;
			$siteName = $sites->siteName;
			$siteID = $sites->siteID;
			$availableSiteDiscount = $sites->availableSiteDiscount;
			$siteIsActive = $sites->siteIsActive;
		}
		else
		{
			echo '<tr>';
	    	echo '<td align="center">'.nullToChar($sites->siteShortName,'-').'</td>';
	    	echo '<td><b>'.nullToChar($sites->siteName,'-').'</b></td>';
	    	echo '<td>'.nullToChar($sites->availableSiteDiscount,'-').'</td>';
			echo '<td align="center">';
			echo '<input name="siteIsActive" id="siteIsActive" type="checkbox" value="1" disabled="disabled" ';
			if ($sites->siteIsActive == 1) {
				echo ' checked="checked" ';
			}
			echo '/>';
			echo '</td>';
			echo '<td align="center"><big><a href="index.php?myAction=Maintenance&myEditAction=EditSingleSite&siteShortName='.$sites->siteShortName.'">Edit</a></big></td>';
			echo '</tr>';
		}
	}
} 
?>

<tr><td align="center">
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="<?php if ($myEditAction == 'EditSingleSite') { echo 'SaveSite'; } else { echo 'AddSite'; } ?>" />
    <input name="siteID" type="hidden"  value="<?php if ($myEditAction == 'EditSingleSite') { echo $siteID; } ?>" />
    <input name="siteShortName" type="<?php if ($myEditAction == 'EditSingleSite') { echo 'hidden'; } else { echo 'text';} ?>" maxlength="5" size="3"  id="siteShortName" value="<?php if ($myEditAction == 'EditSingleSite') { echo $siteShortName; } ?>" onkeypress="return isAlphaNumberKey(event);"
 />
    <?php if ($myEditAction == 'EditSingleSite') { echo $siteShortName; } ?></td><td>
    <input <?php if ($myEditAction == 'EditSingleSite') {echo 'type="hidden"';} ?> id="siteName"  name="siteName" value="<?php if ($myEditAction == 'EditSingleSite') { echo htmlspecialchars($siteName); } ?>" size="40" maxlength="50" onkeypress="return isAlphaNumberKey(event);" /> 
 <?php if ($myEditAction == 'EditSingleSite') {echo '<b><big>'.htmlspecialchars($siteName).'</b></big>';} ?>
 </td>
 <td> <input id="availableSiteDiscount"  name="availableSiteDiscount" value="<?php echo htmlspecialchars($availableSiteDiscount);?>" size="5" maxlength="6" onkeypress="validateNumber(event)"/> </td>
  <td align="center">
 <input name="siteIsActive" id="siteIsActive" type="checkbox" value="1"  
<?php			if ($myEditAction == 'EditSingleSite') {
					if ($siteIsActive == 1) {
						echo ' checked="checked" ';
					}
				}
				else {
						echo ' checked="checked" ';
				}
			?>
/>
 </td>

<td align="right">
     	<button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 60px;"><?php if ($myEditAction == 'EditSingleSite') {echo '  Save ';} else {echo '  Add  ';} ?></button>

            </td></tr>

</form>
<tr>
    <td colspan = "5" align="right"><form action="index.php?myAction=Maintenance" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <?php if ($myEditAction == 'EditSingleSite') {
		echo '<input name="myEditAction" type="hidden" id="myEditAction" value="EditSite" />';
	}?>
    <button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges" style="width: 60px;"><?php if ($myEditAction == 'EditSingleSite') {echo 'Cancel';} else {echo 'Return';}?></button></form> </td>
</tr>

</table>
*Note:  Once you set the ID, it can not be changed.  Once a site is added, it can only be deleted by technical support.


	



