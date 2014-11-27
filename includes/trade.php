<? 
	if($_GET["myTradeAction"]=="Edit")
	{
		require_once ("trade_form.php");
	}
	
	else
	{
		require_once ("trade_list.php");
		
	}
?>
