<?php

require_once 'clases/ChangeString.php';
require_once 'clases/CompleteRange.php';
require_once 'clases/ClearPar.php';



$cs = new ChangeString();
echo $cs->build("abcdefghijklmnopqrstuvwxyz") . "<br/>";
echo $cs->build("*****Casa 52") . "<br/>";
echo $cs->build("*****Casa 52Z") . "<br/>";
echo $cs->build("*sss****Casa 52") . "<br/>";


$cr = new CompleteRange();
$result = $cr->build(array(1, 4, 7, 10));
$result = $cr->build(array(3, 10, 15, 17));


print_r($result);

echo "<br/>";

$cp = new ClearPar();
echo $cp->build("()())()"). "<br/>";

echo $cp->build("()(()"). "<br/>";

echo $cp->build(")("). "<br/>";

echo $cp->build("((()"). "<br/>";

echo "<br/>";
echo "<br/>";

?>