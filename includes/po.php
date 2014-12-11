<? 
	
	if($_GET["poStatus"]==3)
	{
		require_once ("po_history.php");
		exit();
	}
	if($_GET["myPOAction"]=="Add" or $_GET["myPOAction"]=="Edit" or $_GET["myPOAction"]=="View")
	{
		require_once ("po_form.php");
		exit();
	}
	else
	{
		/*if(isset($_GET["lotNumber"])or isset($_GET["siteShortName"]) or $_GET["myPOAction"]=="Save")
		{
			require_once ("po_detail.php");		
		
		}
		else
		{
			require_once ("po_list.php");
		}*/
		require_once ("po_list.php");
	}
?>
