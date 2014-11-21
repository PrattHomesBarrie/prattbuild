<?php
session_start();
echo "<h2>Session at Start</h2>";
echo "<br>session save path:".session_save_path ().'<br>';
echo "<br>session name:".session_name ().'<br>';
print_r($_SESSION);

$_SESSION["Mike"] = "Hello There";
$_SESSION["Date"] = time();

echo "<h2>Session after first set</h2>";
print_r($_SESSION);

ob_start();
phpinfo();
$phpinfo = array('phpinfo' => array());
print_r($phpinfo);

?>