<?php
ob_start();
session_start();
$logout_portal="error_report";
if (!$_REQUEST['username'] | !$_REQUEST['pass'])
{
setcookie($logout_portal,"<font color='red'>Sorry!both username and password cannot be left blank</font>",time()+50);
ob_end_clean();
header("location:index.php#logout_portal");
exit;
}
$username=$_REQUEST['username'];
$password=$_REQUEST['pass'];
require_once "../secreet/confidential/db_connection.php";
$return_con= db_connection("sms");
$con=$return_con[0];
if(isset($_SESSION['loginportal_staff']))

   {
    $out= '<a href="../logout.php"><font color=green>click here to logout</font></a>';
    setcookie("logoff_staff","You are already logged in. $out",time()+5);
    header("location:portal_staff/portal.php");
    exit;
  }
$username=mysql_real_escape_string($username);  
$password=mysql_real_escape_string($password);
$result=mysql_query("SELECT * FROM staff where UserName='$username'AND PassWord='$password'");
$validate = mysql_fetch_array($result);
$dbusername=$validate['UserName'];
$dbpassword=$validate['PassWord'];
if ($username===$dbusername && $password===$dbpassword)
 {
$_SESSION[loginportal_staff]="$username";
$time=time();
$ip=$_SERVER['REMOTE_ADDR'];
mysql_query("UPDATE `staff` SET datetime= '$time',ip='$ip' WHERE UserName = '$dbusername'");
ob_end_clean();
header("location:portal_staff/portal.php");
   }
else
 {  
 setcookie($logout_portal,"<font color='red'>Sorry ! Make sure your username and password is entered correctly</font>",time()+5);
 ob_end_clean();
 header("location:index.php#logout_portal");
exit;
 }
?>
