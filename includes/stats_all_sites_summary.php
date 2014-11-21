
<h2>Sites Statistics </h2>
(<small>Offer data is from signed offers only</small>) 
<?php

function siteStatisticsHeader() {
echo '
	<table width="100%"  border="1" cellpadding="0" cellspacing="0" class="tableLotData" >
  <tr>
    <th></th>
    <th></th>
    <th colspan="2" align="center"> Offers</th>
    <th colspan="6" align="center"> Closings</th>
    <th colspan="6" align="center"> Move-Ins</th>
  </tr>
  <tr>
    <th align="center">Site</th>
    <th align="center">Lots</th>
    <th align="center">Total</th>
    <th align="center">Last 30 Days</th>
    <th align="center">All Past</th>
    <th align="center">Past 30 </th>
    <th align="center">Past 7 </th>
    <th align="center">Next 7 </th>
    <th align="center">Next 30 </th>
    <th align="center">All Future</th>
    <th align="center">All Past</th>
    <th align="center">Past 30 </th>
    <th align="center">Past 7 </th>
    <th align="center">Next 7 </th>
    <th align="center">Next 30 </th>
    <th align="center">All Future</th>
  </tr>';

}
$query= "SELECT * from sitesSummaryView order by siteName";
//echo '<br>'.$query;
$rowNum = 0;

if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {
		if ($rowNum == 0) {
			siteStatisticsHeader();
		}
		$rowNum = $rowNum + 1;
		echo '<tr>';
	    echo '<th>'.$resultRow->siteName.'</th>';
	    echo '<td class="tableStatisticsData">'.$resultRow->numberOfLots.'</td>';
	    echo '<td class="tableStatisticsData">'.$resultRow->withOffers.'</td>';
	    echo '<td class="tableStatisticsData">'.$resultRow->offersPastThirty.'</td>';
	    echo '<td class="tableStatisticsData">'.$resultRow->pastClosings.'</td>';
	    echo '<td class="tableStatisticsData">'.$resultRow->closingsPastThirty.'</td>';
	    echo '<td class="tableStatisticsData">'.$resultRow->closingsPastSeven.'</td>';
	    echo '<td class="tableStatisticsData"><b>'.$resultRow->closingsNextSeven.'<b></td>';
	    echo '<td class="tableStatisticsData">'.$resultRow->closingsNextThirty.'</td>';
	    echo '<td class="tableStatisticsData">'.$resultRow->allFutureClosings.'</td>';
	    echo '<td class="tableStatisticsData">'.$resultRow->pastMoveIns.'</td>';
	    echo '<td class="tableStatisticsData">'.$resultRow->moveInsPastThirty.'</td>';
	    echo '<td class="tableStatisticsData">'.$resultRow->moveInsPastSeven.'</td>';
	    echo '<td class="tableStatisticsData">'.$resultRow->moveInsNextSeven.'</td>';
	    echo '<td class="tableStatisticsData">'.$resultRow->moveInsNextThirty.'</td>';
	    echo '<td class="tableStatisticsData">'.$resultRow->allFutureMoveIns.'</td>';
		echo '</tr>';
	}
}


echo "</table>";
echo "<br>";
?>
  


