
<?
	$date=date("Y-m-d h:i:sa");
	//If ID is invalid -> Add a Trade
	if($_GET["myTradeAction"]=="Save"  && !isset($_POST["id"]))
	{
		if($_POST["name"]=='')
		{
		$PHPcheckTradeName ="Trade's name can not be blank!!!";
		}
		else if($_POST["name"]!='')
		{
		$query='INSERT INTO tradeList VALUES(NULL,"'.$_POST["name"].'","'.$_POST["userName"].'","'.$_POST["password"].'","'.$_POST["address"].'","'.$_POST["phone"].'","'.$_POST["fax"].'","'.$_POST["email"].'",'.$_POST["status"].')';
		$db->Query($query);
		$query2='INSERT INTO tradeHistory VALUES(NULL,"'.$_SESSION["userName"].'","'.$_GET["myTradeAction"].'","'.$_POST["name"].'","'.$date.'")';
		$db->Query($query2);
		//echo $query;
		//echo '<br>'.$query2;
		}
	}
	//If ID is valid -> Edit a Trade
	if($_GET["myTradeAction"]=="Save" && isset($_POST["id"]))
	{
	$query='UPDATE tradeList SET name="'.$_POST["name"].'",userName="'.$_POST["userName"].'",password="'.$_POST["password"].'", address="'.$_POST["address"].'",phone="'.$_POST["phone"].'",fax="'.$_POST["fax"].'",email="'.$_POST["email"].'",status='.$_POST["status"];
	$query.=' where id='.$_POST["id"].' limit 1';
	$db->Query($query);
	$query2='INSERT INTO tradeHistory VALUES(NULL,"'.$_SESSION["userName"].'","Edit","'.$_POST["name"].'","'.$date.'")';
	$db->Query($query2);
	//echo $query;
	//echo '<br>'.$query2;
	}
	if($_GET["myTradeAction"]=="Delete" && isset($_GET["tradeID"]))
	{
		$query='delete from tradeList where id='.$_GET["tradeID"].' limit 1';
		$db->Query($query);
		$query2='INSERT INTO tradeHistory VALUES(NULL,"'.$_SESSION["userName"].'","'.$_GET["myTradeAction"].'","'.$_GET["tradeName"].'","'.$date.'")';
		$db->Query($query2);
		//echo $query;
		//echo '<br>'.$query2;
		header('Location: index.php?myAction=Trade');
	}
	?>
	<? if($PHPcheckTradeName!=''){ ?>
	<script>
		var checkTradeName = <?php echo json_encode($PHPcheckTradeName) ?>;
		alert(checkTradeName);
	</script>
	<? } ?>