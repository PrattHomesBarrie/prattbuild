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
</head>

<body>

<div class="container">
  <div class="header">
  
    <!-- end .header --></div>
    <?
    // include ("includes/check_session.php"); 
	require_once("classes/mysql_ultimate.php");
	?>
 <div class="content">	
<?
	
		echo 'User was deleted <br>';
		echo '<a href="index.php?myAction=Maintenance&myEditAction=EditUsers">click here to return</a>';
	
?>
</div>
  <div class="footer">
  <?php //echo $_SERVER["PHP_SELF"];
  ?>  
    
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
