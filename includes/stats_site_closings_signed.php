
<big><b>Signed Closings Summary </b></big><small> (includes calculation on amended closing date) </small> 
<?php

function siteSummaryHeaderSigned($startYear,$endYear) {
echo '
	<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tableLotData" >
  <tr>
    <th>'.$startYear.'-'.($endYear).'</th>
    <th align="center">MAY</th>
    <th align="center">JUN</th>
    <th align="center">JUL</th>
    <th align="center">AUG</th>
    <th align="center">SEP</th>
    <th align="center">OCT</th>
    <th align="center">NOV</th>
    <th align="center">DEC</th>
    <th align="center">JAN</th>
    <th align="center">FEB</th>
    <th align="center">MAR</th>
    <th align="center">APR</th>
    <th align="center">Total</th>
  </tr>';

}

//look up to this number of calendar years ahead, change this number to change number of years to look for
$yearDiff = 3;  

while ($yearDiff > -2) {
	$endYear =  date("Y") + $yearDiff;
	$endDate = $endYear.'-04-30';
	$yearDiff = $yearDiff - 1;
	$startYear =  date("Y") + $yearDiff;
	$startDate = $startYear.'-05-01';
	//echo '<br>'.$startDate;
	//echo '<br>'.$endDate;

$query= "SELECT siteName, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '04', 1, 0 ) ) AS APRx
, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '05', 1, 0 ) ) AS MAYx
, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '06', 1, 0 ) ) AS JUNx
, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '07', 1, 0 ) ) AS JULx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '08', 1, 0 ) ) AS AUGx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '09', 1, 0 ) ) AS SEPx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '10', 1, 0 ) ) AS OCTx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '11', 1, 0 ) ) AS NOVx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '12', 1, 0 ) ) AS DECx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '01', 1, 0 ) ) AS JANx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '02', 1, 0 ) ) AS FEBx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '03', 1, 0 ) ) AS MARx, COUNT(*) AS totalClosings
FROM offerDetailViewSignedOnly
WHERE (calculatedClosingDate IS NOT NULL 
and ( calculatedClosingDate >= '".$startDate."')
and ( calculatedClosingDate <= '".$endDate."'))
GROUP BY siteName";

//or (amendedClosingDate IS NOT NULL
//and (DATE_FORMAT( amendedClosingDate, '%X-%m-%d') >= '".$startDate."'))

//echo '<br>'.$query;
$rowNum = 0;

if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {
		if ($rowNum == 0) {
			siteSummaryHeaderSigned($startYear,$endYear);
		}
		$rowNum = $rowNum + 1;
		echo '<tr>';
	    echo '<td>'.$resultRow->siteName.'</td>';
   	 	echo '<td class="tableStatisticsData">'.nullToChar($resultRow->MAYx,'-').'</td>';
   	 	echo '<td class="tableStatisticsData">'.nullToChar($resultRow->JUNx,'-').'</td>';
   	 	echo '<td class="tableStatisticsData">'.nullToChar($resultRow->JULx,'-').'</td>';
   	 	echo '<td class="tableStatisticsData">'.nullToChar($resultRow->AUGx,'-').'</td>';
   	 	echo '<td class="tableStatisticsData">'.nullToChar($resultRow->SEPx,'-').'</td>';
   	 	echo '<td class="tableStatisticsData">'.nullToChar($resultRow->OCTx,'-').'</td>';
   	 	echo '<td class="tableStatisticsData">'.nullToChar($resultRow->NOVx,'-').'</td>';
   	 	echo '<td class="tableStatisticsData">'.nullToChar($resultRow->DECx,'-').'</td>';
   	 	echo '<td class="tableStatisticsData">'.nullToChar($resultRow->JANx,'-').'</td>';
   	 	echo '<td class="tableStatisticsData">'.nullToChar($resultRow->FEBx,'-').'</td>';
   	 	echo '<td class="tableStatisticsData">'.nullToChar($resultRow->MARx,'-').'</td>';
   	 	echo '<td class="tableStatisticsData">'.nullToChar($resultRow->APRx,'-').'</td>';
	    echo '<th align="center">'.$resultRow->totalClosings.'</th>';
		echo '</tr>';
	}
}


$query= "SELECT SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '04', 1, 0 ) ) AS APRx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '05', 1, 0 ) ) AS MAYx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '06', 1, 0 ) ) AS JUNx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '07', 1, 0 ) ) AS JULx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '08', 1, 0 ) ) AS AUGx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '09', 1, 0 ) ) AS SEPx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '10', 1, 0 ) ) AS OCTx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '11', 1, 0 ) ) AS NOVx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '12', 1, 0 ) ) AS DECx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '01', 1, 0 ) ) AS JANx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '02', 1, 0 ) ) AS FEBx, SUM( IF( DATE_FORMAT( calculatedClosingDate, '%m' ) = '03', 1, 0 ) ) AS MARx, COUNT(*) AS totalClosings
FROM offerDetailViewSignedOnly
WHERE closingDate IS NOT NULL 
and (calculatedClosingDate >= '".$startDate."')
and (calculatedClosingDate<= '".$endDate."')
";

if ($rowNum > 0) {
	if ($db2->Query($query)) { 
		while ($resultRow = $db2->Row() ) {
			echo '<tr>';
		    echo '<th>Total</th>';
	   	 	echo '<th align="center">'.nullToChar($resultRow->MAYx,'-').'</th>';
   		 	echo '<th align="center">'.nullToChar($resultRow->JUNx,'-').'</th>';
   	 		echo '<th align="center">'.nullToChar($resultRow->JULx,'-').'</th>';
		   	echo '<th align="center">'.nullToChar($resultRow->AUGx,'-').'</th>';
	 		echo '<th align="center">'.nullToChar($resultRow->SEPx,'-').'</th>';
   		 	echo '<th align="center">'.nullToChar($resultRow->OCTx,'-').'</th>';
   	 		echo '<th align="center">'.nullToChar($resultRow->NOVx,'-').'</th>';
	   	 	echo '<th align="center">'.nullToChar($resultRow->DECx,'-').'</th>';
   		 	echo '<th align="center">'.nullToChar($resultRow->JANx,'-').'</th>';
   	 		echo '<th align="center">'.nullToChar($resultRow->FEBx,'-').'</th>';
	   	 	echo '<th align="center">'.nullToChar($resultRow->MARx,'-').'</th>';
   	 		echo '<th align="center">'.nullToChar($resultRow->APRx,'-').'</th>';
		    echo '<th align="center">'.$resultRow->totalClosings.'</th>';
			echo '</tr>';
		}
	}
echo "</table>";
echo "<br>";
}
}
?>
  


