<?php

echo 'read the file';

$fileContents = file_get_contents('testword.xml', true);

$outputFile = 'testwordout.doc';
unlink($outputFile);
$code = array("[LotNum]", "vegetables", "fiber");
$replaceText   = array("The Lot Number", "beer", "ice cream");
$newContents = str_replace($code, $replaceText, $fileContents);

file_put_contents($outputFile, $newContents);

echo '<br>saving the file<br><br>';

?>
<a href="testwordout.doc" target="_blank">Click here to open file</a>