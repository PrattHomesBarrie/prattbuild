<?php  require_once('classes/report_replace_fields.php');?>

<table class="tableOfferEntry" width="100%" border="1" cellspacing="1" cellpadding="1" align="left">
<form action="" method="post" name="FeatureMainForm" target="_self" onsubmit="return checkFormData(this)">

<?php 

$id = $_GET['reportId'];

$inputDocument = getFileNameFromId($dbSingleUse,$id);

if (stripos($inputDocument,'APS') >= 0) {
	$query = 'select count(*) as featureCount from offerFeatures
				where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;
	if ($db->Query($query)) { 
		$resultRow = $db->Row();
		$featureCount = $resultRow->featureCount;
		if ($featureCount  > 15) {
			$extrasFileName = 'APS Extras Insert.xml';
			$inputFile = "uploadedItems/offerDocumentTemplates/".$extrasFileName;
			$outputDocument = date('Y-m-j-h-i-s').'-'.$siteShortName.'-'.$lotNumber.'-'.substr($extrasFileName,0,strlen($extrasFileName) -3).'doc';
			$outputFile = "uploadedItems/offerDocumentPrintouts/".$outputDocument;

			$fileContents = file_get_contents($inputFile, true);
			$query = 'select * from offerDetailView where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;
			if ($db->Query($query)) { 
				if ($resultRow = $db->Row()) {
					$offerInfo = $resultRow;
					$iCount = 1;
					while  ($iCount <=3) {
						if ($iCount == 1) {
							//[ExtraNot16]
							$partOfCode1 = 'ExtraNot';
							$partOfCode2 = '';
						}
						elseif ($iCount == 2) {
							//[ExtraNot16SubText]
							$partOfCode1 = 'ExtraNot';
							$partOfCode2 = 'SubText';
						}
						else {
							//[ExtraNot16Price]
							$partOfCode1 = 'ExtraNot';
							$partOfCode2 = 'Price';
						}
						$prCount = 16;
						while ($prCount <= 30) {
							$code = '['.$partOfCode1.$prCount.$partOfCode2.']';
							$replaceText = getOfferText($offerInfo,substr($code,1,strlen($code) -2),$dbSingleUse);
			//				echo '<br>'.$row->searchText.'-'.$replaceText;
							$pos = strpos($replaceText, '&');
							if ($pos > 0) {
								alertBox('An & was found in the text for tag '.$code.'.  It was replace with the word "and".');
								$replaceText = str_ireplace('&', 'and' , $replaceText);
							}
							$fileContents = str_ireplace($code, $replaceText, $fileContents);
							$prCount += 1;
						}
						$iCount += 1;
					}
				}
			}
			file_put_contents($outputFile, $fileContents);
			echo '<tr><th><h3><font color = "red">There are more than 15 Extras.  This document will also need to be inserted</font></h3></th></tr>';
			echo '<tr><td>';
			echo '<big>Extras 16 to 30:</big><h3><a target="_blank" href="'.$outputFile.'" title="'.$outputFile.'">'.$outputDocument.'</a></h3>';
			echo '</td></tr>';

		}
	}
}


$query = 'select * from fileLocations'
;

$query = $query.' order by fileDescription';

//echo '<tr><td colspan="4"><h1>Edit Offer Features</h1></td></tr>';

?>

</table>
