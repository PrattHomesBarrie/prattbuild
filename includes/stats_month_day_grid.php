
<h2>Monthly Build Completions</h2>
<small>(with signed offers)</small>
<?php

function moveInsHeader() {
echo '
	<table width="100%"  border="1" cellpadding="0" cellspacing="0" class="tableLotData" >
  <tr>
    <th align="center">Year</th>
    <th align="center">Month</th>
    <th align="center">1</th>
    <th align="center">2</th>
    <th align="center">3</th>
    <th align="center">4</th>
    <th align="center">5</th>
    <th align="center">6</th>
    <th align="center">7</th>
    <th align="center">8</th>
    <th align="center">9</th>
    <th align="center">10</th>
    <th align="center">11</th>
    <th align="center">12</th>
    <th align="center">13</th>
    <th align="center">14</th>
    <th align="center">15</th>
    <th align="center">16</th>
    <th align="center">17</th>
    <th align="center">18</th>
    <th align="center">19</th>
    <th align="center">20</th>
    <th align="center">21</th>
    <th align="center">22</th>
    <th align="center">23</th>
    <th align="center">24</th>
    <th align="center">25</th>
    <th align="center">26</th>
    <th align="center">27</th>
    <th align="center">28</th>
    <th align="center">29</th>
    <th align="center">30</th>
    <th align="center">31</th>
    <th align="center"></th>
  </tr>';

}

$query= "select 
year(calculatedBuildCompletionDate) as moveInYear, 
month(calculatedBuildCompletionDate) as moveInMonth, 
monthName(calculatedBuildCompletionDate) as moveInMonthName, 
day(calculatedBuildCompletionDate) as moveInDay, count(*) as howMany from offerDetailViewSignedOnly 
where calculatedBuildCompletionDate > curdate()
group by 
year(calculatedBuildCompletionDate), month(calculatedBuildCompletionDate),
monthName(calculatedBuildCompletionDate), day(calculatedBuildCompletionDate)
order by 1,2,4";
//echo '<br>'.$query;
$rowNum = 0;
moveInsHeader();

if ($db2->Query($query)) {
	$resultRow = $db2->Row();
	 
	while ($resultRow->moveInYear > 0 ) {
		if ($rowNum == 0) {
		}
		$rowNum = $rowNum + 1;
		echo '<tr>';
	    echo '<th>'.$resultRow->moveInYear.'</th>';
		$currentYear = $resultRow->moveInYear;
		$currentMonth = $resultRow->moveInMonth;
	    echo '<td class="tableStatisticsData">'.$resultRow->moveInMonthName.'</td>';
		$xDay = 1;
		$monthTotal = 0;
		while ($xDay < 32)
		{
		    echo '<td class="tableStatisticsData">';
			if ($xDay == $resultRow->moveInDay and $currentYear == $resultRow->moveInYear and $currentMonth == $resultRow->moveInMonth) 
			{
				echo $resultRow->howMany;
				$monthTotal = $monthTotal + $resultRow->howMany;
				$resultRow = $db2->Row();
			}
			
			echo '</td>';

			$xDay = $xDay + 1;			
		}
		echo '<td><b>'.$monthTotal.'</b></td>';
		echo '</tr>';
	}
}


echo "</table>";
echo "<br>";
echo '<h2>Monthly Move-Ins </h2>';
$query= "select 
year(moveInDate) as moveInYear, 
month(moveInDate) as moveInMonth, 
monthName(moveInDate) as moveInMonthName, 
day(moveInDate) as moveInDay, count(*) as howMany from offerDetailViewSignedOnly where
moveInDate > curdate()
group by 
year(moveInDate), month(moveInDate),
monthName(moveInDate), day(moveInDate)
order by 1,2,4";
//echo '<br>'.$query;
$rowNum = 0;
moveInsHeader();

if ($db2->Query($query)) {
	$resultRow = $db2->Row();
	 
	while ($resultRow->moveInYear > 0 ) {
		if ($rowNum == 0) {
		}
		$rowNum = $rowNum + 1;
		echo '<tr>';
	    echo '<th>'.$resultRow->moveInYear.'</th>';
		$currentYear = $resultRow->moveInYear;
		$currentMonth = $resultRow->moveInMonth;
	    echo '<td class="tableStatisticsData">'.$resultRow->moveInMonthName.'</td>';
		$xDay = 1;
		$monthTotal = 0;
		while ($xDay < 32)
		{
		    echo '<td class="tableStatisticsData">';
			if ($xDay == $resultRow->moveInDay and $currentYear == $resultRow->moveInYear and $currentMonth == $resultRow->moveInMonth) 
			{
				echo $resultRow->howMany;
				$monthTotal = $monthTotal + $resultRow->howMany;
				$resultRow = $db2->Row();
			}
			
			echo '</td>';

			$xDay = $xDay + 1;			
		}
		echo '<td><b>'.$monthTotal.'</b></td>';
		echo '</tr>';
	}
}


echo "</table>";
echo "<br>";
?>
  


