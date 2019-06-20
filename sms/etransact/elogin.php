<?php
session_start();
if(!isset($_REQUEST['submit']) | !isset($_SESSION['role']))
{

die("<font color=red size=12>access denied</font>");

}
$pin=$_REQUEST['epin'];
if($pin=="")
{

      setcookie("etransact_empty","Sorry! password field cannot be left blank",time()+5);

      header("location:index.php#logout_portal");
exit;
}




require_once "../../secreet/confidential/db_connection.php";

$return_con= db_connection("sms");
$con=$return_con[0];






$result = mysql_query("SELECT Pass FROM `epass` ");



//$many=mysql_num_rows($result);



$validate = mysql_fetch_array($result);
$dbepass=$validate['Pass'];

if($pin==$dbepass)


{
$_SESSION['etransact']='etransact';
header("location:etransact.php");
exit;
}
else
{


 setcookie("etransact_error","Sorry!Make sure your password is entered correctly",time()+5);

      header("location:index.php#logout_portal");
exit;
}



mysql_close($con);
?>