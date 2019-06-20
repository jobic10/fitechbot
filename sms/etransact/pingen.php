<?php
ini_set('max_execution_time',600000);

session_start();
if(!isset($_SESSION['role']))
{

header("location:index.php");
exit;

}



require_once "../../secreet/confidential/db_connection.php";

$return_con= db_connection("sms");
$con=$return_con[0];

for($x=0;$x<5010;$x++)
{
$pass=md5(uniqid(rand()));
$pass=Substr($pass,0,15);

mysql_query("INSERT INTO newpin (PIN)
VALUES ('$pass')");





echo $pass."<br/>";


}

?>