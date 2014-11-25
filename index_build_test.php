<?php
// if (empty($_SERVER['HTTPS'])) {
//		header('Location: https://prattbarriebuild.com');
//    exit;
//}
require_once('includes/check_session.php'); 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/PrattTemplate1.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<?php require_once('includes/head_text.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<?php require_once("includes/initialize_logic.php"); ?>
<title>Pratt-Hansen Build Management</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="PrattTwoColFixLt.css" rel="stylesheet" type="text/css" />
<link href="js/css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>
<script src="js/jquery-1.6.2.js"></script>
<script src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="includes/javascripts/prattScripts.js"></script>
<script type="text/javascript" src="./jquery-1.7.min.js"></script>
</head>

<body>

<div class="container">
  <div class="header">
  <?php 
  if ($printingFormat == "Yes") {
  }
  else
  {
echo '  <table width = "100%"><tr><td width="20%"><a href="#"><img src="./images/Pratt_Innisfil_Logo_Splash[1].png" /></a> </td><td width="80%"><h2><span style="color:red; font-size:1.5em">Testing</span> Pratt Sites and Lots</h2></td></tr></table>  ';
  }
  ?>
    <!-- end .header --></div>
    <?
     //include ("includes/leftSideBar.php"); 
	?>
 <div class="content">	
<!-- InstanceBeginEditable name="EditRegion3" --><?php include("includes/index_logic.php"); ?><!-- InstanceEndEditable --><!-- end .content --></div>
  <? prattDebug($query);?>
  <div class="footer">
  <?php //echo $_SERVER["PHP_SELF"];
  ?>  
    
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
