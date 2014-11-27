<?
if($_GET["myTradeAction"]=="Add")
	{
	var_dump($_POST);
	$query='INSERT INTO tradeList VALUES(NULL,"'.$_POST["name"].'","'.$_POST["address"].'","'.$_POST["phone"].'","'.$_POST["fax"].'","'.$_POST["email"].'",'.$_POST["status"].')';
	$db->Query($query);
	$table = "tradeList";
	echo $query;
	/*$arr["name"] = MySQL::SQLValue($_POST["name"]);	
	$arr["address"] = MySQL::SQLValue($_POST["address"]);	
	$arr["phone"] = MySQL::SQLValue($_POST["phone"]);	
	$arr["fax"] = MySQL::SQLValue($_POST["fax"]);	
	$arr["email"] = MySQL::SQLValue($_POST["email"]);
	$arr["status"] = MySQL::SQLValue($_POST["status"]);
	
	$result = $dbSingleUse->InsertRow($table, $arr);
	//echo $result."result";*/
	}
	?>