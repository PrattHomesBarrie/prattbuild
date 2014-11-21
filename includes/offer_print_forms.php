<?php
	$currentSettingCheck = 'HTML at Top of Offer Print Forms';
	echo getSettingValue($dbSingleUse, $currentSettingCheck) ;

?>
<table class="tableOfferEntry" width="100%" border="1" cellspacing="1" cellpadding="1" align="left">
  
  
  <?php 

$query = 'select * from fileLocations'
;

$query = $query.' order by fileDescription';


//echo '<tr><td colspan="4"><h1>Edit Offer Features</h1></td></tr>';
echo '<tr>';
echo '<th>Document</th>';
echo '<th>Date File Name</th>';
echo '</tr>';

$x=0;
if ($dbSingleUse->Query($query)) { 
	while ($rowFiles = $dbSingleUse->Row()) {
		$x = $x + 1;
			echo '<tr>';
	    	echo '<td><b><a href="index.php?myAction=EditOffer&myEditAction=PrintSingleForm&reportId='.$rowFiles->id.'&lotNumber='.$lotNumber.'&siteShortName='.$siteShortName.'" >'.$rowFiles->fileDescription.'</a></b></td>';
	    	echo '<td><small>'.$rowFiles->fileName.'</small></td>';
			echo '</tr>';
	}
} 
?>
  <tr>
      <td>&nbsp;</td>
      <td colspan="3"><form action="index.php?myAction=EditOffer" method="post" name="form2" target="_self">
      <input name="myEditAction" type="hidden" id="myEditAction" value="FinishedPrinting" />
    <button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges"  style="width: 200px;" />Return</button></form> </td>
    </tr>
</table>