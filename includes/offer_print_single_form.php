
<?php  require_once('classes/report_replace_fields.php');?>

<table class="tableOfferEntry" width="100%" border="1" cellspacing="1" cellpadding="1" align="left">
<form action="" method="post" name="FeatureMainForm" target="_self" onsubmit="return checkFormData(this)">

<?php 

$id = $_GET['reportId'];

$inputDocument = getFileNameFromId($dbSingleUse,$id);

$inputFile = "uploadedItems/offerDocumentTemplates/".$inputDocument;
$outputDocument = date('Y-m-j-h-i-s').'-'.$siteShortName.'-'.$lotNumber.'-'.substr($inputDocument,0,strlen($inputDocument) -3).'doc';
$outputFile = "uploadedItems/offerDocumentPrintouts/".$outputDocument;

$fileContents = file_get_contents($inputFile, true);


$query = 'select *
			from offerDetailView 	
				where siteShortName = "'.$siteShortName.'" and lotNumber ='.$lotNumber;

//printf( '<tr><td>'.$query.'</td></tr>');
$rowNumm = 0;
if ($db->Query($query)) { 

	while ($resultRow = $db->Row()) {
		$offerInfo = $resultRow;
	}
}

$query = 'select * from searchAndReplace'; 
$query = $query.' where 1=1';
$query = $query.' and searchText not like "[2ndPayment%" ';
$query = $query.' and searchText not like "[3rdPayment%" ';
$query = $query.' and searchText not like "[4thPayment%" ';
$query = $query.' and searchText not like "[5thPayment%" ';
$x=0;
if ($db->Query($query)) { 
	while ($row = $db->Row()) {
			$x=$x+1;
			$code = $row->searchText;
			$replaceText = getOfferText($offerInfo,substr($row->searchText,1,strlen($row->searchText) -2),$dbSingleUse);
		//	echo '<br>'.$row->searchText.'-'.$replaceText;
			$pos = strpos($replaceText, '&');
			if ($pos > 0) {
				alertBox('An & was found in the text for tag '.$row->searchText.'.  It was replace with the word "and".');
				$replaceText = str_ireplace('&', 'and' , $replaceText);
			}
			$fileContents = str_ireplace($row->searchText, $replaceText, $fileContents);
	}
}

file_put_contents($outputFile, $fileContents);
echo '<tr><th><h3>Printing Results</h3></th></tr>';
echo '<tr><td>';
echo '<big>Click on link to see file:</big><h3><a target="_blank" href="'.$outputFile.'" title="'.$outputFile.'">'.$outputDocument.'</a></h3>';
echo '</td></tr>';
$query = 'select * from fileLocations'
;

$query = $query.' order by fileDescription';

//echo '<tr><td colspan="4"><h1>Edit Offer Features</h1></td></tr>';

?>

</table>