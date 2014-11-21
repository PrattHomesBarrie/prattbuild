<?php
// turn off the WSDL cache
ini_set("soap.wsdl_cache_enabled", "0");

//$client = new SoapClient("http://www.softmv.com/PrattBuild/webservice/scramble.wsdl");
$client = new SoapClient("scramble.wsdl");

$origtext = "mike";

print("<br>The original text : $origtext");
$scramble = $client->getRot13($origtext);

print("<br>The scrambled text : $scramble");

$mirror = $client->getMirror($scramble);
print("<br>The mirrored text : $mirror");
?>