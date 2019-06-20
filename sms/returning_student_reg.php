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





echo "<title>STUDENT LOGIN@$banner</title>
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

<?php echo" <h1 class='sname'>$banner-Returning Student Login</h1>";?>



</div>


<div class='welcomemsg'>


<font size='5' color=yellow>Please Take Note that before you can pay your school fees as a retuning student you will have to first login into your account using the form below </font>
</div>
<hr/>

<br/>

<div style="float:left; width:100%; margin-top:30px;">
<form action='loginportal_student.php' method='post'>
<table bgcolor="#00aaff" style="border:2px groove #0a0a0a;" width="300px">
<tr>













<?php
if(isset($_COOKIE['blank']))
{

echo "<td bgcolor='white' style='border:2px groove #0a0a0a;' bordercollapse='collapse'>";
echo "<font color='red'>".$_COOKIE['blank']."</font>";
echo "</td>";
}





if(isset($_COOKIE['incorrect']))
{

echo "<td bgcolor='white' style='border:2px groove #0a0a0a;' bordercollapse='collapse'>";
echo "<font color='red'>". $_COOKIE['incorrect']."</font>";
"</td>";
}





?>
















</tr>



<tr>
<td bgcolor="#000066" style="border:2px groove #0a0a0a;">
<font color="white"><b>Student Username:</b><br /></font>
<input class="resultt" type='text' size='60' name='username'/>
</td></tr>
<tr><td bgcolor="000066" style="border:2px groove #0a0a0a;">
<font color="white"><b>Password:</b><br /></font>
<input class="resultt" type='password' size='60' name='pass'/>
</td></tr>
<tr><td>
<input class="resultb" type='submit' value='login' name='submit'/>
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