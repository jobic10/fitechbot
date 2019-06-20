<?php
session_start();
if (!isset($_SESSION['loginportal']))
{
 header("location:../index.php");
exit;
}
else
{

$destroy=$_SESSION['loginportal'];

if(!isset($_COOKIE['cookie_username_etranzact_rip']))
{

setcookie("cookie_username_etranzact_rip",$destroy,time()+3600);

}
}


?>
<!DOCTYPE html>
<html>
<head>
<?php

require "../secreet/confidential/config.php";

$result = mysql_query("SELECT * FROM `fbt`")  or die(mysql_error());

$validate = mysql_fetch_array($result);

$banner=$validate['banner'];
$footer=$validate['footer'];
$tray_contents=$validate['tray_contents'];
$tray_contents_overlay=$validate['tray_contents_overlay'];



$banner=strtoupper($banner);

$footer=strtoupper($footer);
$tray_contents=strtoupper($tray_contents);





echo "<title>TRANSACT@$banner</title>
<link rel='shortcut icon' type='image/x-icon' href='../admin/favicon/favicon.ico'>


";
?>
<link rel="stylesheet" type="text/css" href="css/body.css" />


</head>


<body>



<table class="bodycontrol">

<tr valign="center" align="center">
<td>



<div class="banner">

<?php echo" <h1 class='sname'> E-TRANSACT @$banner</h1>";?>



</div>


<div class='welcomemsg'>


<font size=6 color=yellow>Please <?php 
if(isset($_SESSION['loginportal']))
{

echo $_SESSION['loginportal'].",";
}
?>
 enter in the form below the E-transact  PIN issued to you at the bank of payment and click on pay</font>
</div>
<hr/>

<br/>

<div style="float:left; width:100%; margin-top:30px;">






<form method ="POST" action="https://www.etranzact.net/WebConnectPlus/query.jsp">
<table bgcolor="#00aaff" style="border:2px groove #0a0a0a;" width="300px">
<tr>
<?php
if(isset($_COOKIE['etranzact_failure_msg']))
{

echo "<td bgcolor='white' style='border:2px groove #0a0a0a;' bordercollapse='collapse'>";
echo "<font color='red'>". $_COOKIE['etranzact_failure_msg']."</font>";
"</td>";
}
?>
</tr>

<tr><td bgcolor="000066" style="border:2px groove #0a0a0a;">
<font color="white"><b>E-TRANSACT PIN:</b><br /></font>

<input class="resultt" type='hidden' size='60' name = "TERMINAL_ID" value="0115700221" />

<input class="resultt" type='password' size='60' name = "CONFIRMATION_NO"  />
</td></tr>
<tr><td>

<input type="hidden" name = "RESPONSE_URL" value="http://www.fggckabba.com.ng/sms/demo_etransact_processor.php"/>



<input class="resultb" type='submit' value='pay' name='submit'/>
</td></tr>
</table>
</form>
</div>


</td>
</tr>

</table>
<?php echo "<div class='footing' align='center'><h1>$footer</h1></div>";?>

</body>

</html>