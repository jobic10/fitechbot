<?php
session_start(); 
require_once "../secreet/confidential/db_connection.php";
$return_con= db_connection("sms");
$con=$return_con[0];
if(isset($_SESSION['loginportal']))
{
$destroy=$_SESSION['loginportal'];
$time=(time())-(3600*9);
$ip=$_SERVER['REMOTE_ADDR'];
mysql_query("UPDATE students SET datetime= '$time',ip='$ip' WHERE UserName = '$destroy'");
mysql_close($con);
unset($_SESSION['loginportal']);
unset($_SESSION['result']);
unset($_SESSION['fullname']);
}
else
{
$destroy=$_SESSION['loginportal_staff'];
$time=(time())-(3600*9);
$ip=$_SERVER['REMOTE_ADDR'];
mysql_query("UPDATE staff SET datetime= '$time',ip='$ip' WHERE UserName = '$destroy'");
mysql_close($con);
unset($_SESSION['loginportal_staff']);
unset($_SESSION['subject']);
unset($_SESSION['cd']);
unset($_SESSION['Class_taught']);
unset($_SESSION['fullname']);

}
setcookie("error_report","You have been successfully logged out !",time()+5);
header('location:index.php#logout_portal');
 ?>



