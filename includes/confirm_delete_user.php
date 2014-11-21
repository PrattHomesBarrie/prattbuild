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
</head>

<body>

<div class="container">
  <div class="header">
  
    <!-- end .header --></div>
    
 <div class="content">	

<h4>Are you sure you want to delete:&nbsp;<span style="color:red; font-size:15px;"><?php echo $_GET['userName'] ; ?></span>&nbsp;?</h4>&nbsp;&nbsp;
<button><a href= "index.php?myAction=Maintenance&myEditAction=DeleteSingleUser&userUniqueID=<?php echo $_GET['userUniqueID'];  ?>">Yes</a></button>&nbsp;&nbsp; 
<button><a href="javascript:history.go(-1);">No</a></button>
</div>
  <div class="footer">
  <?php //echo $_SERVER["PHP_SELF"];
  ?>  
    
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
