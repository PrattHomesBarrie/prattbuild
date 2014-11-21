<?php 

include("classes/offer_discount_values.php");

$query = 'select *
			from offerFeatures 	
				where   siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;

$query = $query.' order by id ';
//echo $query;
$x=0;
if ($dbSingleUse->Query($query)) { 
	while ($rowFeatures = $dbSingleUse->Row()) {
		$x = $x + 1;
		if ($x==1) {
			echo '<table class="clsPrattTable" width="100%" border="1" cellspacing="1" cellpadding="1" align="left">';
			echo '<tr><td width="6%" class="apsHeaderStandard" >ITEM</td>
			    <td class="apsHeaderLarge" width="71%">EXTRA DETAIL</td>';
			if ($securityLevelOneCheck) {
					echo '<td width="13%" class="apsHeaderStandard" >MSRP</td>';
					echo '<td width="13%" class="apsHeaderStandard" >PRICE</td>';
			}
			echo '</tr>';
		}
		echo '<tr>';
	    echo '<td rowspan="2" align="center"><strong>'.$x.'</strong></td>';
    	echo '<td><strong>'.nullToChar($rowFeatures->featureText,'-').'</strong></td>';
		if ($securityLevelOneCheck) {
			$featureAfterDiscount = 0;
			if ($sumResalePriceDiscoutAllowed > 0 and $rowFeatures->featureDiscountAllowed == 1) {
				$featureAfterDiscount = $rowFeatures->featureResalePrice - ( $offerDiscountAmount*($rowFeatures->featureResalePrice/$sumResalePriceDiscoutAllowed)) ;
			}
			else {
				$featureAfterDiscount = $rowFeatures->featureResalePrice ;
			}
			$sumDiscounts = $sumDiscounts + $featureAfterDiscount;			
		    echo '<td rowspan="2" align="right"><strong>$';
			echo $rowFeatures->featureResalePrice;
			echo '</strong></td>';
		    echo '<td rowspan="2" align="right"><strong>';
			echo money_format('%.2n',$featureAfterDiscount);
			echo '</strong></td>';
		}
		echo '</tr>';
	    echo '<tr>';
    		echo '<td><small>'.nullToChar($rowFeatures->featureSubText,'&nbsp;').'</small></td>';
	 	echo '</tr>';
	}
	} 
	if ($x > 0) {
		echo '</table>'; 
	}
	?>
