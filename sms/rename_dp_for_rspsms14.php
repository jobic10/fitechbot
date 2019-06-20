<?php
require_once "../secreet/confidential/db_connection.php";
$return_con= db_connection("sms");
$con=$return_con[0];


$check = mysql_query("SELECT * FROM students ") or die(mysql_error());
while($row_algorithms = mysql_fetch_array($check))
{

$passloc=$row_algorithms['Passport'];

$regno=$row_algorithms['RegNo'];

/*
$return_con= db_connection("sms14");
$con=$return_con[0];

$name=$row_algorithms['UserName'];
mysql_query("UPDATE students SET Passport='$passloc' WHERE UserName ='$name'");   

*/
  
$return_con= db_connection("rsp14");
$con=$return_con[0];

mysql_query("UPDATE studentinfo SET passport='$passloc' WHERE regno ='$regno'");



}
?>