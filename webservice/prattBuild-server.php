<?php
function getLotInfo($pInput){
//$rot = getLotInfo($pInput);return($rot);
//$retString = '<b>Hello </b>'.$pInput;
require_once("lotStatus.php");

return($result);
}

function getMirror($pInput){
//$mirror = strrev($pInput);
$retString = '<b>Good bye </b>'.$pInput;

return($retString);
}

// turn off the wsdl cache
ini_set("soap.wsdl_cache_enabled", "0");

$server = new SoapServer("prattBuild.wsdl");

$server->addFunction("getLotInfo");
$server->addFunction("getMirror");

$server->handle();
?>