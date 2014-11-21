<?php require_once('includes/check_session.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once('includes/head_text.php'); ?>
<!-- TemplateBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<link href="PrattTwoColFixLt.css" rel="stylesheet" type="text/css" />
<link href="js/css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>
<script src="js/jquery-1.6.2.js"></script>
<script src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="includes/javascripts/prattScripts.js"></script>
</head>

<body>

<div class="container">
  <div class="header">
  <?php 
  if ($printingFormat == "Yes") {
  }
  else
  {
echo '  <table width = "100%"><tr><td width="20%"><a href="#"><img src="./images/Pratt_Innisfil_Logo_Splash[1].png" width="80" height="40" /></a> </td><td width="80%"><h2>Pratt Sites and Lots</h2></td></tr></table>  ';
  }
  ?>
    <!-- end .header --></div>
    <?
     include ("includes/leftSideBar.php"); 
	?>
 <div class="content">	
<!-- TemplateBeginEditable name="EditRegion3" -->EditRegion3<!-- TemplateEndEditable --><!-- end .content --></div>
  <div class="footer">
  <?php //echo $_SERVER["PHP_SELF"];
  ?>  
    
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>
