<? 
	if($_GET["myDeficiencyAction"]=="Add" or $_GET["myDeficiencyAction"]=="Edit")
	{
		require_once ("deficiency_form.php");
	}
	else if(!isset($_GET["myDeficiencyAction"]))
	{
		if(!isset($_GET["lotNumber"])or !isset($_GET["siteShortName"]))
		{
			require_once ("deficiency_list.php");
		}
		else
		{
			require_once ("deficiency_detail.php");
		}
	}
?>
