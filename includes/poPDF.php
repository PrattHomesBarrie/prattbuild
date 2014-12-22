<?
require_once('check_session.php');
require_once ("classes/login_functions.php");
require_once ("classes/misc_functions.php");
require_once('initialize_logic.php');
require_once('vars.php');
require_once("classes/mysql_ultimate.php");  
$db = new MySQL(); 
$db2 = new MySQL(); 
$dbSingleUse = new MySQL(); 
$db->Query("SET time_zone = '-4:00';");
$db2->Query("SET time_zone = '-4:00';");
$dbSingleUse->Query("SET time_zone = '-4:00';");

$date=date("Y-m-d h:i:sa");
	
	if($_GET["myPOAction"]=="Print")
	{
		$query='INSERT INTO poHistory VALUES(NULL,"'.$_SESSION["userName"].'","Print",'.$_GET["PONum"].',"'.$date.'")';
		//$db->Query($query);
		//echo $query;
	}
	
	$query = 'select poList.*,sites.siteName, users.firstName, users.lastName from poList left join sites on sites.siteShortName = poList.siteShortName left join users on users.userName = poList.createdBy where id='.$_GET["PONum"];
if ($db->Query($query)) 
	{ 
		while ($resultRow = $db->Row() ) {
			$buildingNumber = $resultRow->buildingNumber;
			$tradeID = $resultRow->vendorID;
			$shiptoAdd = $resultRow->shiptoAdd;
			//$description = $resultRow->description;
			//$accountType = $resultRow->accountType;
			$poStatus = $resultRow->poStatus;
			$poSiteName = $resultRow->siteName;
			$firstName = $resultRow->firstName;
			$lastName = $resultRow->lastName;
			$createdDate = date('Y-M-d', strtotime($resultRow->dateCreated));
		}
	}
	
	$query3 = 'select * from tradeList where status = 1';
if($_GET["myPOAction"]=="Print") {$query3 .= ' and id='.$tradeID;}
$query3 .= ' order by name ASC';

$query1 = 'select * from offerDetailView where 1=1';
if(isset($_GET["lotNumber"])) 
$query1 .=' and lotNumber = "'.$_GET["lotNumber"].'"';
if(isset($_GET["siteShortName"])) 
$query1 .=' and siteShortName = "'.$_GET["siteShortName"].'"';

$query2 = 'select * from sites where siteID > 2';
if($_GET["siteShortName"]!="" && $_GET["myPOAction"]=="Print")
$query2 .= ' and siteShortName='.$_GET["siteShortName"];

$query4 = 'select * from lineList where 1=1';
if($_GET["PONum"]!="")
$query4 .= ' and poID='.$_GET["PONum"];
	ob_start();
    
	$content='<page style="font-size: 12pt;margin:0 auto;width:800px;">
<span style="width:800px;clear:both;">
</span>';
$content.='<table  style="width:800px;"><tr>
	<td style="width:100px;"></td>
	<td style="width:300px;">
	<h3>';
	if($_GET["siteShortName"] == "MAN" or $_GET["siteShortName"] == "UWS" or $_GET["siteShortName"] == "YST" or $_GET["siteShortName"] == "ESV") $content.= 'Pratt Hansen Grougp Inc.';
	else $content.= 'H.Hansen Development Inc.';
	$content.= '</h3>
	301 King Street
	<br>Barrie, Ontario
	<br>L4N 6B5
	<br>Phone: (705) 728-0033
	<br>Fax  : (705) 733-0073
	</td>
	<td style="width:50px;"></td>
	<td style="width:300px;">
	<h3>Purchase Order</h3>
	PO #: '.$_GET["PONum"].
	'<br>Created By: '.$firstName.' '.$lastName.
	'<br>Created date: '.$createdDate.
	'<br><br><br>
	</td>
</tr></table>
<span style="width:750px;clear:both;">
<br>
<hr>
</span>
<table style="width:800px;"><tr>
	<td style="width:250px;">
	<h3 style="padding-left: 0px;">Vendor</h3>';
	if ($db->Query($query3) && $_GET["myPOAction"]=="Print") 
		{
		while ($resultRow = $db->Row() ) {
		$content.= 
	$resultRow->name.
	'<br>'.$resultRow->address.
	'<br>Phone: '.$resultRow->phone.
	'<br>Fax: '.$resultRow->fax;
	}}
	$content.='</td>';
	$content.= '<td align="center" style="width:270px;height:150px;">
	<h3 style="padding-left: 0px;">Ship To</h3>';
	$content.='<span style="margin-top:0px;">'.$shiptoAdd.'</span>';
	$content.='<br><br><br><br><br></td>';
	if ($db->Query($query1) && isset($_GET["lotNumber"])) 
		{
		$content.= '<td style="width:230px;">
				<h3 style="padding-left: 0px;">Reference</h3>';
		while ($resultRow = $db->Row()) {
			$content.= 'Homeowner: '.$resultRow->firstName1.' '.$resultRow->lastName1.
				 '<br>Phone: '.$resultRow->homePhone.
				 '<br>Cell: '.$resultRow->otherPhone.
				 '<br>Address: '.$resultRow->munStreetNumber.' '.$resultRow->munStreetAddress.' '.$resultRow->postalCode
			;
			$modelName = $resultRow->modelName;
		}
		}
	if((!isset($_GET["lotNumber"]) or $_GET["lotNumber"]==0) && $_GET["myPOAction"]=="Print") 
	$content.='Homeowner:
			<br>Phone:
			<br>Cell:
			<br>Address:';
	$content.='<br><br></td>';
	$content.='</tr></table>';
	$content.='<table style="width:800px;"><tr>
	<br>
	<td style="width:400px">
	<br><br><br><b>Re: </b>
	Lot:';
	if($_GET["siteShortName"]!=''){
					if($_GET["lotNumber"]=='' or $_GET["lotNumber"]==0)
					{
						$content.= ' Common Elements<br> Phase: Building ';
						if($_GET["myPOAction"]=="Print") $content.= $buildingNumber.'<br>';
					}
				else if(($_GET["lotNumber"])!='' and $_GET["lotNumber"]!=0) $content.= " ".$_GET["lotNumber"].", ";	
				if(isset($poSiteName)) $content.= "Site: ".$poSiteName;	
				}
	$content.='</td>
	<td style="width:120px;"></td>
	<td style="width:280px;">';
		if(isset($modelName)) $content.= '<br><br><br><b>Model: </b>'.$modelName;
	$content.='</td></tr></table><br>';
	
	$content.='
	<table style="width:100%;" border="1" cellpadding="0" cellspacing="0">
		<thead>
		  <tr>
			<th align="center" style="width:80px;height:20px;">Quantity</th>
			<th align="center" style="width:150px;">Account</th>
			<th align="center" style="width:300px;">Description</th>
			<th align="center" style="width:200px;">Note</th>
			<!--<th align="center" style="width:100px;">Ext. Price</th>-->
		</tr>
		</thead>
		<tbody>';
		if ($db->Query($query4) && $_GET["myPOAction"]!="Add") 
				{ 
				$lineNumberTotal=0;
					while ($resultRow = $db->Row()) 
					{
					$content.='<tr>
				<td align="center" style="height:20px;">
					1
				</td>
				<td align="center">'
				 .$resultRow->accountType.
				'</td>
				<td align="center">'
					.$resultRow->description.
				'</td>
				<td align="center">'
					.$resultRow->note.
				'</td>
				<!--<td align="center">
					$0.00
				</td>-->
				
			</tr>';
					}
				}
		$content.='<tr style="background-color:lightgrey;">
				<!--<td colspan="4">
				
				</td>
				<td align="center">
					<b>Total:</b>
				</td>
				<td align="center">
				 <b>$0.00</b>
				</td>-->
			</tr>';
	$content.='</tbody></table><br><br>';
	$content.='<table border="1" style="width:800px;" cellpadding="0" cellspacing="0">';
	$content.='<tr><td style="width:742px;height:20px;"><b>Notes</b></td></tr>';
	$content.='<tr><td style="width:740px;"><br>- All above amounts are net of taxes.<br>';
	$content.='- Not final until Approved.<br>';
	$content.='- All invoice must quote a PO Number and delivery address. All materials and/or work must comply with all applicable building codes and regulations. All deliveries must be authorized by the site superintendent.
				</td></tr>';
	$content.='</table>';
	$content.='</page>';
	
    require_once('html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','A4','fr');
    $html2pdf->WriteHTML($content);
	$todayDate = date('Y-m-d');
	$file_name='PO_'.$_GET["PONum"].'_'.$todayDate.'.pdf';
    //$file_name='PO.pdf';
	$html2pdf->Output($file_name);
	
?>