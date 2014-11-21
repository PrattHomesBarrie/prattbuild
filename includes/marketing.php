


<form action="" method="get" name="ChooseSiteForLots" target="_self" >
    <input name="myAction" type="hidden" id="myAction" value="Marketing" />

 <table width="200px" border="0" cellpadding="0" cellspacing="0" class="tableSitesMenu">
 <tr>

<?php 
$x=0;  
$query = ' SELECT * FROM `sites` order by siteName';
if ($db2->Query($query)) { 
	while ($resultRow = $db2->Row() ) {
		$x = $x + 1;
		echo '<td>';
		echo '<label>';
        echo '<input type="radio" name="siteShortName" value="';
		echo $resultRow->siteShortName;
		echo '" id="siteShortName"';
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
echo '<td>';
echo '<label>';
echo '<input type="radio" name="siteShortName" value="All"  id="siteShortName"';
if ($siteShortName == "") {
	echo ' checked="checked" ';
}
echo ' onclick="this.form.submit();"/>';
if ($siteShortName == "") {
	echo '<b>';
}
echo 'All';
if ($siteShortName == "") {
	echo '</b>';
}
echo '</label>';

?>
</tr>
</table>
</form>
<?php 
echo 'Site Involved: '.$siteShortName;
?>
<br>
<script>

  $(function() {

    $( "#accordion" ).accordion({
            collapsible: true,
            autoHeight: false
	});

  });

  </script>
  <style>
  #accordion h3 { padding-left: 22px; }
  </style>
 <div id="accordion">
 <h3>     Ages</h3>
<div>

<table>
<?php
$query = "select avg(age) averageAge , min(age) as minAge, max(age) as maxAge from
(SELECT DATE_FORMAT(FROM_DAYS(TO_DAYS(offerDate)-TO_DAYS(birthDate1)), '%Y')+0 AS age FROM offerDetailViewSignedOnly";
if ($siteShortName > "") {
	$query = $query.'  where siteShortName="'.$siteShortName.'" ';
}
else {
	$query = $query.'  where 1=1 ';
}
$query .= "and birthDate1 is not null ) x where age > 0	";
				;
//echo $query;
if ($db->HasRecords($query)) { 
	$dbArray = $db->QueryArray($query);
	foreach ($dbArray as $j => $dataRow) {
		echo '<tr>';
		echo '<td align="right">Youngest Age of Primary Person on Offer:</td><td><b>'.$dataRow["minAge"].'</b></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td align="right">Oldest Age of Primary Person on Offer:</td><td><b>'.$dataRow["maxAge"].'</b></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td align="right">Average Age of Primary Person on Offer:</td><td><b>'.$dataRow["averageAge"].'</b></td>';
		echo '</tr>';
	}
}

?>
</table>
</div>
 <h3>Cities</h3>
<div>
<table class="tableStatistics" border="1" >
<tr>
<th>Most Popular Client City</th>
</tr>
<?php

$query = "select trim(clientCity) as clientCity, count(*) as howMany from offers ";
if ($siteShortName > "") {
	$query = $query.'  where siteShortName="'.$siteShortName.'" ';
}
else {
	$query = $query.'  where 1=1 ';
}
$query.= "and offerDate is not null
and clientCity is not null
and trim(clientCity)> ''
group by trim(clientCity)
order by 2 desc";

				;
//echo $query;
if ($db->HasRecords($query)) { 
	$dbArray = $db->QueryArray($query);
	foreach ($dbArray as $j => $dataRow) {
		echo '<tr><td>'.$dataRow["clientCity"].'</td><td><b>'.$dataRow["howMany"].'</b></td></tr>';
	}
}

?>
</table>
<small>*Note - Signed Offers Only</small>
<br />
</div>
 <h3>Features</h3>
<div>

<SCRIPT LANGUAGE='Javascript'>    $(document).ready(function() {
                  oTable = $("#featureTable").dataTable({
									"bJQueryUI": true,
                                    "bPaginate": false,
								    /*"sScrollY": "600px",*/
                                    "bLengthChange": false,
                                    "bFilter": true,
                                    "bSort": true,
                                    "bInfo": true,
    								 "bProcessing": false
                         });
               } );    </SCRIPT>

<table class="tableStatistics" width="100%" border="1" id="featureTable" >
<thead>
<tr>
<th>Most Popular Features(top 30)</th><th>How Many</th><th>Min Price</th><th>Max Price</th>
</tr>
</thead>
<tbody>
<?php

$query = "Select featureText, count(*) howMany, max(featureResalePrice) as maxPrice, min(featureResalePrice) as minPrice from offerFeatures f, offerDetailViewSignedOnly o ";
if ($siteShortName > "") {
	$query = $query.'  where featureText is not null and featureText > " " and f.siteShortName="'.$siteShortName.'" ';
}
else {
	$query = $query.'  where 1=1 ';
}
$query .= ' and f.lotNumber = o.lotNumber and f.siteShortName = o.siteShortName ';
$query.= " group by featureText order by howMany desc ";
				;
//echo $query;
if ($db->HasRecords($query)) { 
	$dbArray = $db->QueryArray($query);
	foreach ($dbArray as $j => $dataRow) {
		echo '<tr><td >'.$dataRow["featureText"].'</td><td class="tableStatisticsData">'.$dataRow["howMany"].'</td><td align="right">'.$dataRow["minPrice"].'</td><td  align="right">'.$dataRow["maxPrice"].'</td></tr>';
	}
}

?>
</tbody>
</table>
<small>*Note - Feature Price Does Not Include Discount</small>
<small>*Note - Signed Offers Only</small>
</div> 
<h3>Models</h3>
<div>

<SCRIPT LANGUAGE='Javascript'>    $(document).ready(function() {
                  oTable = $("#modelTable").dataTable({
									"bJQueryUI": true,
                                    "bPaginate": false,
								    /*"sScrollY": "600px",*/
                                    "bLengthChange": false,
                                    "bFilter": true,
                                    "bSort": true,
                                    "bInfo": true,
    								 "bProcessing": false
                         });
               } );    </SCRIPT>

<table class="tableStatistics" width="100%" border="1" id="modelTable" >
<thead>
<tr>
<th>Model</th>
<th>Count</th>
<th>Average<br/>Base Price</th>
<th>Average<br />Features</th>
<th>Average<br />Base + Upgrades</th>
<th>Average<br />Discount<br/><small>(includes zero)</small></th>
<th>Average<br />% Discount<br/><small>(on upgrades)</small></th>
<th>Average<br />% Discount<br/><small>(on base + upgrades)</small></th>
<th>Average<br />Price<br/><small>after discount</small></th>
</tr>
</thead>
<tbody>
<?php

$query = "select modelName
, count(*) as numOfModels
, avg(ifnull(ofvs.offerDiscountAmount,0)) as avgDiscount
, avg(offerPrice) averageOfferPrice  
, avg(offerPrice + IFNULL(
                    (select 
							        sum(of.featureResalePrice)  
								          from offerFeatures of 
          									where of.lotNumber = ofvs.lotNumber 
					        					and of.siteShortName = ofvs.siteShortName
                     )
                     ,0)) as avgWithFeatures
, avg(IFNULL(
                    (select 
							        sum(of.featureResalePrice)  
								          from offerFeatures of 
          									where of.lotNumber = ofvs.lotNumber 
					        					and of.siteShortName = ofvs.siteShortName
                     )
                     ,0)) as avgFeatures
, avg(offerPrice - ifnull(offerDiscountAmount,0) + IFNULL(
                    (select 
							        sum(of.featureResalePrice)  
								          from offerFeatures of 
          									where of.lotNumber = ofvs.lotNumber 
					        					and of.siteShortName = ofvs.siteShortName
                     )
                     ,0)) as avgPriceWithDiscount
, avg(offerPrice - ifnull(offerDiscountAmount,0) + IFNULL(
                    (select 
							        sum(of.featureResalePrice)  
								          from offerFeatures of 
          									where of.lotNumber = ofvs.lotNumber 
					        					and of.siteShortName = ofvs.siteShortName
                     )
                     ,0)) as avgDiscountPercent
, avg(  CASE 
    WHEN ifnull(offerDiscountAmount,0) = 0 
      THEN 0
    ELSE 
	offerDiscountAmount /
    (offerPrice  + IFNULL(
                    (select 
							        sum(of.featureResalePrice)  
								          from offerFeatures of 
          									where of.lotNumber = ofvs.lotNumber 
					        					and of.siteShortName = ofvs.siteShortName
                     )
                     ,0)) 
    END 
	* 100
    ) as avgDiscountPercent
, avg(  CASE 
    WHEN ifnull(offerDiscountAmount,0) = 0 
      THEN 0
    ELSE 
	offerDiscountAmount /
    (IFNULL(
                    (select 
							        sum(of.featureResalePrice)  
								          from offerFeatures of 
          									where of.lotNumber = ofvs.lotNumber 
					        					and of.siteShortName = ofvs.siteShortName
                     )
                     ,0)) 
    END 
	* 100
    ) as avgDiscountPercentFeatures
FROM offerDetailViewSignedOnly ofvs";
if ($siteShortName > "") {
	$query = $query.'  where offerPrice >= 1 and siteShortName="'.$siteShortName.'" ';
}
else {
	$query = $query.'  where offerPrice >= 1  ';
}
$query .= "	group by modelName";

				;
//echo $query;
if ($db->HasRecords($query)) { 
	$dbArray = $db->QueryArray($query);
	foreach ($dbArray as $j => $dataRow) {
		echo '<tr><td >'.$dataRow["modelName"].'</td>';
		echo '<td align="center">'.$dataRow["numOfModels"].'</td>';
		echo '<td align="right">'.money_format('%#12n',$dataRow["averageOfferPrice"]).'</td>';
		echo '<td align="right">'.money_format('%#12n',$dataRow["avgFeatures"]).'</td>';
		echo '<td align="right">'.money_format('%#12n',$dataRow["avgWithFeatures"]).'</td>';
		echo '<td align="right">'.money_format('%#12n',$dataRow["avgDiscount"]).'</td>';
		echo '<td align="right">'.money_format('%#12n',$dataRow["avgDiscountPercentFeatures"]).'</td>';
		echo '<td align="right">'.money_format('%#12n',$dataRow["avgDiscountPercent"]).'</td>';
		echo '<td align="right">'.money_format('%#12n',$dataRow["avgPriceWithDiscount"]).'</td>';
		echo '</tr>';
	}
}

?>
</tbody>
</table>
<small>*Note - Signed Offers Only</small>
</div>
<h3>Models (totals with Amendments)</h3>
<div>

<SCRIPT LANGUAGE='Javascript'>    $(document).ready(function() {
                  oTable = $("#modelTableWithAmendments").dataTable({
									"bJQueryUI": true,
                                    "bPaginate": false,
								    /*"sScrollY": "600px",*/
                                    "bLengthChange": false,
                                    "bFilter": true,
                                    "bSort": true,
                                    "bInfo": true,
    								 "bProcessing": false
                         });
               } );    </SCRIPT>

<table class="tableStatistics" width="100%" border="1" id="modelTableWithAmendments" >
<thead>
<tr>
<th>Model</th>
<th>Count</th>
<th>Average<br/>Base Price</th>
<th>Average<br />Features</th>
<th>Average<br />Base + Upgrades</th>
<th>Average<br />Amendments</th>
<th>Average<br />Base + Upgrades + Amendments</th>
<th>Average<br />Discount<br/><small>(includes zero)</small></th>
<th>Average<br />Price<br/><small>after discount</small></th>
</tr>
</thead>
<tbody>
<?php

$query = "select modelName
, count(*) as numOfModels
, avg(ifnull(ofvs.offerDiscountAmount,0)) as avgDiscount
, avg(offerPrice) averageOfferPrice  
, avg(offerPrice + IFNULL(
                    (select 
							        sum(of.featureResalePrice)  
								          from offerFeatures of 
          									where of.lotNumber = ofvs.lotNumber 
					        					and of.siteShortName = ofvs.siteShortName
                     )
                     ,0)) as avgWithFeatures
, avg(offerPrice + IFNULL(
                    (select 
							        sum(of.featureResalePrice)  
								          from offerFeatures of 
          									where of.lotNumber = ofvs.lotNumber 
					        					and of.siteShortName = ofvs.siteShortName
                     )
                     ,0)
                     +
                      IFNULL(
                    (select 
							        sum(oa.amendmentResalePrice)  
								          from offerAmendments oa 
          									where oa.lotNumber = ofvs.lotNumber 
					        					and oa.siteShortName = ofvs.siteShortName
                            and oa.dateDocumentSigned Is Not null
                     )
                     ,0)
                     ) as avgWithFeaturesAndAmendments
, avg(IFNULL(
                    (select 
							        sum(of.featureResalePrice)  
								          from offerFeatures of 
          									where of.lotNumber = ofvs.lotNumber 
					        					and of.siteShortName = ofvs.siteShortName
                     )
                     ,0)) as avgFeatures
, avg(IFNULL(
                    (select 
							        sum(oa.amendmentResalePrice)  
								          from offerAmendments oa 
          									where oa.lotNumber = ofvs.lotNumber 
					        					and oa.siteShortName = ofvs.siteShortName
                            and oa.dateDocumentSigned Is Not null
                     )
                     ,0)) as avgAmendments
, avg(offerPrice - ifnull(offerDiscountAmount,0) + IFNULL(
                    (select 
							        sum(of.featureResalePrice)  
								          from offerFeatures of 
          									where of.lotNumber = ofvs.lotNumber 
					        					and of.siteShortName = ofvs.siteShortName
                     )
                     ,0)) as avgPriceWithDiscount
, avg(offerPrice - ifnull(offerDiscountAmount,0) + IFNULL(
                    (select 
							        sum(of.featureResalePrice)  
								          from offerFeatures of 
          									where of.lotNumber = ofvs.lotNumber 
					        					and of.siteShortName = ofvs.siteShortName
                     )
                     ,0) +
                     IFNULL(
                    (select 
							        sum(oa.amendmentResalePrice)  
								          from offerAmendments oa 
          									where oa.lotNumber = ofvs.lotNumber 
					        					and oa.siteShortName = ofvs.siteShortName
                            and oa.dateDocumentSigned Is Not null
                     )
                     ,0)) as avgPriceWithDiscountAndAmendments
, avg(offerPrice - ifnull(offerDiscountAmount,0) + IFNULL(
                    (select 
							        sum(of.featureResalePrice)  
								          from offerFeatures of 
          									where of.lotNumber = ofvs.lotNumber 
					        					and of.siteShortName = ofvs.siteShortName
                     )
                     ,0)) as avgDiscountPercent
, avg(  CASE 
    WHEN ifnull(offerDiscountAmount,0) = 0 
      THEN 0
    ELSE 
	offerDiscountAmount /
    (offerPrice  + IFNULL(
                    (select 
							        sum(of.featureResalePrice)  
								          from offerFeatures of 
          									where of.lotNumber = ofvs.lotNumber 
					        					and of.siteShortName = ofvs.siteShortName
                     )
                     ,0)) 
    END 
	* 100
    ) as avgDiscountPercent
, avg(  CASE 
    WHEN ifnull(offerDiscountAmount,0) = 0 
      THEN 0
    ELSE 
	offerDiscountAmount /
    (IFNULL(
                    (select 
							        sum(of.featureResalePrice)  
								          from offerFeatures of 
          									where of.lotNumber = ofvs.lotNumber 
					        					and of.siteShortName = ofvs.siteShortName
                     )
                     ,0)) 
    END 
	* 100
    ) as avgDiscountPercentFeatures
FROM offerDetailViewSignedOnly ofvs";
if ($siteShortName > "") {
	$query = $query.'  where offerPrice >= 1 and siteShortName="'.$siteShortName.'" ';
}
else {
	$query = $query.'  where offerPrice >= 1  ';
}
$query .= "	group by modelName";

				;
//echo $query;
if ($db->HasRecords($query)) { 
	$dbArray = $db->QueryArray($query);
	foreach ($dbArray as $j => $dataRow) {
		echo '<tr><td >'.$dataRow["modelName"].'</td>';
		echo '<td align="center">'.$dataRow["numOfModels"].'</td>';

		echo '<td align="right">'.money_format('%#12n',$dataRow["averageOfferPrice"]).'</td>';
		echo '<td align="right">'.money_format('%#12n',$dataRow["avgFeatures"]).'</td>';
		echo '<td align="right">'.money_format('%#12n',$dataRow["avgWithFeatures"]).'</td>';
		echo '<td align="right">'.money_format('%#12n',$dataRow["avgAmendments"]).'</td>';
		echo '<td align="right">'.money_format('%#12n',$dataRow["avgWithFeaturesAndAmendments"]).'</td>';
		echo '<td align="right">'.money_format('%#12n',$dataRow["avgDiscount"]).'</td>';
		echo '<td align="right">'.money_format('%#12n',$dataRow["avgPriceWithDiscountAndAmendments"]).'</td>';
		echo '</tr>';
	}
}

?>
</tbody>
</table>
<small>*Note - Signed Offers Only</small>
</div>
</div>


