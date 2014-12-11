<?
$date=date("Y-m-d h:i:sa");
if($_GET["myPOAction"]=="Save")
	{
			if($_GET["siteShortName"]=="")
			{
				if($_POST["siteShortName"]!="")
				{
					$poSiteShortName = $_POST["siteShortName"];
				}
			}
			else{
				$poSiteShortName = $_GET["siteShortName"];
			}
			
			if($_GET["lotNumber"]=="")
			{
				if($_POST["lotNumber"]!="")
				{
					$poLotNumber = $_POST["lotNumber"];
				}
			
				else{
					$poLotNumber = 0;
				}
			}
			else{
				$poLotNumber = $_GET["lotNumber"];
			}
		//verify site's name and lot# and building #
		$PHPcheckSiteName =="";	
		if($poSiteShortName=='')
		{
			$PHPcheckSiteName.="Site's name can not be blank!!! ";
		}
		if($_POST["buildingNumber"]=="" && $poLotNumber == 0)
		{
			$PHPcheckSiteName.="Lot # or Building # can not be blank!!!";
		}
		//If ID is invalid -> Add a PO
		if($_POST["id"]=="" && $PHPcheckSiteName=="")
		{
		$query='INSERT INTO poList VALUES(NULL,"'.$date.'","'.$poSiteShortName.'",'.$poLotNumber.','.$_POST["vendorID"].',"'.$_POST["shiptoAdd"].'",';
		if($_POST["buildingNumber"]) $query.=$_POST["buildingNumber"].',';
		else $query.= 'NULL,';
		$query.=$_POST["poStatus"].')';
		$lineNumber = $_POST["lineNumber"];
		$db->Query($query);
		$lastPOID= mysql_insert_id();
		//echo $query;
		//echo "last POID ".$lastPO;
		//echo 'lineNumber '.$lineNumber;
		for($i=1;$i<= $lineNumber;$i++)
			{
				$quantity= "quantity_".$i;
				$accountType= "accountType_".$i;
				$description= "description_".$i;
				$unitPrice= "unitPrice_".$i;
				$extPrice= "extPrice_".$i;
			
		$query1='INSERT INTO lineList VALUES(NULL,'.$lastPOID.','.$i.','.$_POST[$quantity].',"'.$_POST[$accountType].'","'.$_POST[$description].'",'.$_POST[$unitPrice].','.$_POST[$extPrice].')';
		$db->Query($query1);
		//echo $query1;
		}
		if($lastPOID!=0)
		{
		$query2='INSERT INTO poHistory VALUES(NULL,"'.$_SESSION["userName"].'","Add","'.$lastPOID.'","'.$date.'")';
		$db->Query($query2);
		//echo $query;
		//echo '<br>'.$query2;
		}
		
		}
		// If ID is valid ->Edit a PO
		if($_POST["id"]!="")
		{
		$query='UPDATE poList SET siteShortName="'.$poSiteShortName.'",lotNumber="'.$poLotNumber.'",vendorID="'.$_POST["vendorID"].'", shiptoAdd="'.$_POST["shiptoAdd"].'",';
		if($_POST["buildingNumber"]) $query.= 'buildingNumber='.$_POST["buildingNumber"].',';
		else $query.= 'buildingNumber= NULL,';
		$query.='poStatus='.$_POST["poStatus"];
		$query.=' where id='.$_POST["id"].' limit 1';
		$db->Query($query);
		//echo $query;
		$lineNumber = $_POST["lineNumber"];
		//echo '<br>'.$query2;
		for($i=1;$i<= $lineNumber;$i++)
			{
				$quantity= "quantity_".$i;
				$accountType= "accountType_".$i;
				$description= "description_".$i;
				$unitPrice= "unitPrice_".$i;
				$extPrice= "extPrice_".$i;
			
		$query1='UPDATE lineList SET lineNumber='.$i.',quantity='.$_POST[$quantity].',accountType="'.$_POST[$accountType].'",description="'.$_POST[$description].'",unitPrice='.$_POST[$unitPrice].',extPrice='.$_POST[$extPrice];
		$query1.=' where poID='.$_POST["id"].' and lineNumber='.$i.' limit 1';
		$db->Query($query1);
		//echo '<br>'.$query1;
		}
		$query2='INSERT INTO poHistory VALUES(NULL,"'.$_SESSION["userName"].'","Edit","'.$_POST["id"].'","'.$date.'")';
		$db->Query($query2);
		}
	}
	?>
	
	<? 
	//if site's name or lot# and building # are blank -> print out error
	if($PHPcheckSiteName!=''){ ?>
	<script>
		var PHPcheckSiteName = <?php echo json_encode($PHPcheckSiteName) ?>;
		alert(PHPcheckSiteName);
		javascript:window.history.back();
	</script>
	<? } ?>