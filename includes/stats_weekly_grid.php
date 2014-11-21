

<h2>Weekly Move-ins </h2>
<?php

function fnDisplayLotsForDate($dbSingleUse,$detailShow, $detailDate){
	$query = "select lotNumber, siteShortName from offerDetailViewSignedOnly where";
	if ($detailShow == 'MoveIns') {
		$query .= " moveInDate";
	}
	else {
		$query .= " dateDocumentSigned";
	}
	$query .= " = '".$detailDate."'";
	$query .= " order by siteShortName, lotNumber";
	echo '<table align="center"><tr>';
//	echo $query;
	$comma = '';
	if ($dbSingleUse->Query($query)) {
		while ($resultRow = $dbSingleUse->Row()) {
		    echo '<td align="center"><a href="index.php?myAction=Lot&lotNumber='.$resultRow->lotNumber.'&siteShortName='.$resultRow->siteShortName.'">'.$comma.$resultRow->siteShortName.'-'.$resultRow->lotNumber.'</a></td>';
			$comma = ",";
		}
	}
	echo '</tr></table>';
}

function weeklyStatsHeader() {
echo '
	<table width="40%"  border="1" cellpadding="0" cellspacing="0" class="tableLotData" >
  <tr>
    <th align="center">Dates</th>
    <th align="center">Mon</th>
    <th align="center">Tue</th>
    <th align="center">Wed</th>
    <th align="center">Thu</th>
    <th align="center">Fri</th>
    <th align="center">Sat</th>
    <th align="center">Sun</th>
    <th align="center">Total</th>
  </tr>';

}
$detailShow = $_GET['detailShow'];
$detailDate = $_GET['detailDate'];

$query= "select moveInDate, dayname(moveInDate) as dayOfWeekname,dayOfWeek(moveInDate) as dayOfWeekValue,dayOfYear(moveInDate) as dayOfYearValue
,year(moveInDate) as moveInYear, 
month(moveInDate) as moveInMonth, 
monthName(moveInDate) as moveInMonthName, 
day(moveInDate) as moveInDay, count(*) as howMany from offerDetailViewSignedOnly where
moveInDate > DATE_ADD(NOW(), INTERVAL - 3 MONTH)
and moveInDate <= DATE_ADD(NOW(), INTERVAL + 1 MONTH)
group by 
moveInDate, dayOfWeek(moveInDate), dayOfYear(moveInDate) , year(moveInDate), month(moveInDate),
monthName(moveInDate), day(moveInDate)
order by 1,2,4";
//echo '<br>'.$query;
$rowNum = 0;
$weekTotal = 0;
$firstRecord = true;

weeklyStatsHeader();

if ($db2->Query($query)) {
//	$resultRow = $db2->Row();
	 
//	while ($resultRow->moveInYear > 0 ) {
	while ($resultRow = $db2->Row()) {

    	$recordDate = date("Y-m-d", strtotime($resultRow->moveInDate));
		$dayOfWeek = $resultRow->dayOfWeekValue - 1;

		if ($dayOfWeek == 0) {
			$dayOfWeek = 7;
		}
//		echo '<br>-------<br>Record Date: '.$recordDate.' Calculated Day of Week:'.$dayOfWeek." ".date("D", strtotime($resultRow->moveInDate));;

		if ($firstRecord == true) {
			if ($dayOfWeek == 1) {
				$expectedDate = $resultRow->moveInDate;
				$expectedDate = date("Y-m-d", strtotime($expectedDate." - 1 days"));
				$dayFillAmount = '0';
			}
			else {
				$expectedDate = date("Y-m-d", strtotime($resultRow->moveInDate." - ".$dayOfWeek ." days"));
				$dayFillAmount = 'x';
			}
			$workingDay = 7;
			$workingDate = $expectedDate;
		}
		
//		echo "<br>Current Week = ".$weekBeginDate." to ".$weekEndDate;
//		echo "<br>before loop: WorkingDate = ".$workingDate." RecordDate ".$recordDate;
		$count = 0;
		while ($workingDate < $recordDate and $count < 100 ) {
     		$workingDate = date("Y-m-d", strtotime($workingDate." + 1 days"));
    		$workingDay += 1;
			$count += 1;
			if ($workingDay > 7) {
				$workingDay = 1;
			}
//    		echo "<br> begin loop:".$workingDay." - WorkingDate = ".$workingDate." RecordDate ".$recordDate." - working day".$workingDay;
			if ($workingDay == 1) {
				$weekBeginDate = $workingDate;
     			$weekEndDate = date("Y-m-d", strtotime($workingDate." + 6 days"));
				echo '<tr>';
				echo '<td class="tableStatisticsData">'.$weekBeginDate.' - '.$weekEndDate.'</td>';
//				echo "<br> new week";
			}

			$tdClass = "tableStatisticsData";
			if ($detailDate == $workingDate and $detailShow == 'MoveIns') {
				$detailShowDateFound = true;
				$tdClass = "tableStatisticsDataSelected";
			}
			if ($workingDate == $recordDate ) {
//				echo "<br>Detail Value:".$resultRow->howMany;
				echo '<td class="'.$tdClass.'">';
				echo '<a href="index.php?myAction=StatsWeekly&detailShow=MoveIns&detailDate='.$workingDate.'">';
				echo $resultRow->howMany;
				echo '</a>';
				echo '</td>';
        		$weekTotal += $resultRow->howMany;
				$dayFillAmount = '0'; //changing the X to 0 for all the rest of the fill-ins

			}
			else {
				echo '<td class="tableStatisticsData">'.$dayFillAmount.'</td>';
			}
			if  ($workingDay == 7) {
				echo '<td class="tableStatisticsData"><b>'.$weekTotal.'</b></td>';
				echo '</tr>';
				$weekTotal = 0;
			}
			
			if  ($workingDay == 7) {
				if ($detailShowDateFound == true ) {
				echo '<tr>';
				echo '<td align="right"> Lots for '.$detailDate.' : </td>';
				echo '<td colspan="8">';
				fnDisplayLotsForDate($dbSingleUse,$detailShow, $detailDate);
				echo '</td>';
				echo '</tr>';
				}
				$detailShowDateFound = false;
			}

			
//    		echo "<br> end loop:".$workingDay." - WorkingDate = ".$workingDate." RecordDate ".$recordDate;
		}
//    	echo "<br> after loop:".$workingDay." - WorkingDate = ".$workingDate." RecordDate ".$recordDate;
//		print_r($resultRow);
		$firstRecord = false;		
	}
}
if ($detailShowDateFound == true and $detailShow == 'MoveIns') {
echo '<tr>';
echo '<td align="right"> Lots for '.$detailDate.' : </td>';
echo '<td colspan="8">';
fnDisplayLotsForDate($dbSingleUse,$detailShow, $detailDate);
echo '</td>';
echo '</tr>';
}
$detailShowDateFound = false;


echo "</table>";
echo "<br>";
?>
<h2>Weekly Offer Signings </h2>

<?php

$query= "select dateDocumentSigned, dayname(dateDocumentSigned) as dayOfWeekname,dayOfWeek(dateDocumentSigned) as dayOfWeekValue,dayOfYear(dateDocumentSigned) as dayOfYearValue
,year(dateDocumentSigned) as moveInYear, 
month(dateDocumentSigned) as moveInMonth, 
monthName(dateDocumentSigned) as moveInMonthName, 
day(dateDocumentSigned) as moveInDay, count(*) as howMany from offerDetailViewSignedOnly where
dateDocumentSigned > DATE_ADD(NOW(), INTERVAL - 3 MONTH)
and dateDocumentSigned <= DATE_ADD(NOW(), INTERVAL + 1 MONTH)
group by 
dateDocumentSigned, dayOfWeek(dateDocumentSigned), dayOfYear(dateDocumentSigned) , year(dateDocumentSigned), month(dateDocumentSigned),
monthName(dateDocumentSigned), day(dateDocumentSigned)
order by 1,2,4";

//echo '<br>'.$query;
$rowNum = 0;
$weekTotal = 0;
$firstRecord = true;

weeklyStatsHeader();

if ($db2->Query($query)) {
//	$resultRow = $db2->Row();
	 
//	while ($resultRow->moveInYear > 0 ) {
	while ($resultRow = $db2->Row()) {

    	$recordDate = date("Y-m-d", strtotime($resultRow->dateDocumentSigned));
		$dayOfWeek = $resultRow->dayOfWeekValue - 1;

		if ($dayOfWeek == 0) {
			$dayOfWeek = 7;
		}
//		echo '<br>-------<br>Record Date: '.$recordDate.' Calculated Day of Week:'.$dayOfWeek." ".date("D", strtotime($resultRow->moveInDate));;

		if ($firstRecord == true) {
			if ($dayOfWeek == 1) {
				$expectedDate = $resultRow->dateDocumentSigned;
				$expectedDate = date("Y-m-d", strtotime($expectedDate." - 1 days"));
			}
			else {
				$expectedDate = date("Y-m-d", strtotime($resultRow->dateDocumentSigned." - ".$dayOfWeek ." days"));
			}
			$workingDay = 7;
			$workingDate = $expectedDate;
		}
		
//		echo "<br>Current Week = ".$weekBeginDate." to ".$weekEndDate;
//		echo "<br>before loop: WorkingDate = ".$workingDate." RecordDate ".$recordDate;
		$count = 0;
		while ($workingDate < $recordDate and $count < 100 ) {
     		$workingDate = date("Y-m-d", strtotime($workingDate." + 1 days"));
    		$workingDay += 1;
			$count += 1;
			if ($workingDay > 7) {
				$workingDay = 1;
			}
//    		echo "<br> begin loop:".$workingDay." - WorkingDate = ".$workingDate." RecordDate ".$recordDate." - working day".$workingDay;
			if ($workingDay == 1) {
				$weekBeginDate = $workingDate;
     			$weekEndDate = date("Y-m-d", strtotime($workingDate." + 6 days"));
				echo '<tr>';
				echo '<td class="tableStatisticsData">'.$weekBeginDate.' - '.$weekEndDate.'</td>';
//				echo "<br> new week";
			}

			$tdClass = "tableStatisticsData";
			if ($detailDate == $workingDate and $detailShow == 'OfferSignings') {
				$detailShowDateFound = true;
				$tdClass = 'tableStatisticsDataSelected';
			}
			if ($workingDate == $recordDate ) {
//				echo "<br>Detail Value:".$resultRow->howMany;
				echo '<td class="'.$tdClass.'">';
				echo '<a href="index.php?myAction=StatsWeekly&detailShow=OfferSignings&detailDate='.$workingDate.'">';
				echo $resultRow->howMany;
				echo '</a>';
				echo '</td>';
        		$weekTotal += $resultRow->howMany;
			}
			else {
				echo '<td class="tableStatisticsData">0</td>';
			}
			
			if  ($workingDay == 7) {
				echo '<td class="tableStatisticsData"><b>'.$weekTotal.'</b></td>';
				echo '</tr>';
				$weekTotal = 0;
			}
			
			if  ($workingDay == 7) {
				if ($detailShowDateFound == true ) {
				echo '<tr>';
				echo '<td align="right"> Lots for '.$detailDate.' : </td>';
				echo '<td colspan="8">';
				fnDisplayLotsForDate($dbSingleUse,$detailShow, $detailDate);
				echo '</td>';
				echo '</tr>';
				}
				$detailShowDateFound = false;
			}
			
//    		echo "<br> end loop:".$workingDay." - WorkingDate = ".$workingDate." RecordDate ".$recordDate;
		}
//    	echo "<br> after loop:".$workingDay." - WorkingDate = ".$workingDate." RecordDate ".$recordDate;
//		print_r($resultRow);
		$firstRecord = false;		
	}
}
if ($detailShowDateFound == true ) {
echo '<tr>';
echo '<td align="right"> Lots for '.$detailDate.' : </td>';
echo '<td colspan="8">';
fnDisplayLotsForDate($dbSingleUse,$detailShow, $detailDate);
echo '</td>';
echo '</tr>';
}
$detailShowDateFound = false;


echo "</table>";
echo "<br>";


?>
  


