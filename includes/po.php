<? 
	if($_GET["myPOAction"]=="Add" or $_GET["myPOAction"]=="Edit")
	{
		require_once ("po_form.php");
		exit();
	}
	else
	{
		if(isset($_GET["lotNumber"])or isset($_GET["siteShortName"]))
		{
			if(isset($_GET["lotNumber"]))
			{
				require_once ("po_lot_detail.php");
			}
			else {
				require_once ("po_detail.php");
			}
		
		}
		else
		{
			require_once ("po_list.php");
		}
	}
?>
