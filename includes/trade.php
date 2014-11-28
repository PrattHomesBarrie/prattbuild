<? 
	
	if($_GET["tradeStatus"]==3)
	{
		require_once ("trade_history.php");
		exit();
	}
	if($_GET["myTradeAction"]=="Edit" or $_GET["myTradeAction"]=="Add")
	{
		require_once ("trade_form.php");
	}
	
	else
	{
		require_once ("trade_list.php");
		
	}
?>
