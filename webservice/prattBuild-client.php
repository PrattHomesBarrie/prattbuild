<?php
// turn off the WSDL cache
ini_set("soap.wsdl_cache_enabled", "0");

//start SAOP
$client = new SoapClient("http://www.softmv.com/PrattBuild/webservice/prattBuild.wsdl");

//set lot number
$lot = "1073";

//get status
$lotStatus = $client->getLotInfo($lot);

//print results
print("<br>".$lotStatus);

?>