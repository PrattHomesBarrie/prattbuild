<? 
	if($_GET["myTradeAction"]=="Edit")
	{
		require_once ("trade_form.php");
	}
	else
	{
		if(!isset($_GET["tradeID"]) or $_GET["tradeID"]=='')
		{
			require_once ("trade_list.php");
		}
		else
		{
			require_once ("trade_detail.php");
		}
	}
?>
