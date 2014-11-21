<?php
session_start();
header("Cache-control: private"); //IE 6 Fix
if(!$_SESSION['count']){
    $_SESSION['count'] = 1;
} else {
    $_SESSION['count']++;
}
echo $_SESSION['count'];
?>

