<?php
ob_start();
session_start();
$up="up";
$pin=$_REQUEST['pin'];
$code=$_REQUEST['schoolcode'];
if (!isset($_REQUEST['submit']))
{
echo "thief";
exit;
}
require_once "../secreet/confidential/db_connection.php";
$return_con= db_connection("sms");
$con=$return_con[0];
$result = mysql_query("SELECT schoolcode FROM `regpin`")  or die(mysql_error());
if(mysql_num_rows($result)<1)
{
$insert = "INSERT INTO `regpin`(PIN,schoolcode) VALUES('1','1')";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 
$insert = "INSERT INTO `epass`(pass) VALUES ('bankname')";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}


}








if (!$_REQUEST['schoolcode'] | !$_REQUEST['pin']) 
{
setcookie($up,"something went wrong ! fields cannot be left blank",time()+5);
ob_end_clean();
header("location:confirmpin_student.php#logout_portal");
exit;
}
$schoolcoderesult=mysql_query("SELECT * FROM regpin where schoolcode='$code'");
if( mysql_num_rows($schoolcoderesult)<1)
{
setcookie($up,"Sorry you have entered an invalid school Code !",time()+5);
ob_end_clean();
header("location:confirmpin_student.php#logout_portal");
exit;
}
$pinresult=mysql_query("SELECT * FROM bpin where PIN='$pin'");
if( mysql_num_rows($pinresult)>0)
{
$_SESSION['pin_student']=$pin;
ob_end_clean();
header("location:student_signup.php"); 
exit;
}
$pinresult=mysql_query("SELECT * FROM upin where PIN='$pin'");
if( mysql_num_rows($pinresult)>0)
{
setcookie($up,"Sorry the PIN you entered  has already been used  !",time()+5);
ob_end_clean();
header("location:confirmpin_student.php#logout_portal");
exit;
}
else
{
setcookie($up,"Sorry the PIN you entered is invalid  !",time()+5);
ob_end_clean();
header("location:confirmpin_student.php#logout_portal");
exit;
}
mysql_close($con);
?>