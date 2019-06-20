<?php

$result=mysql_query("SELECT PRESENTTERM,PRESENTYEAR FROM `schinfo` ") or die("");

$validate= mysql_fetch_array($result);

$year=$validate['PRESENTYEAR'];

 // $term=$validate['PRESENTTERM'];  

$term=$term_to_check; 
  
$termuse=$term;
$term=strtolower($term);

//$year=date("Y");



$both="_".$year."_".$term;


$both1="_".$year."_first term";

$both2="_".$year."_second term";
?>

