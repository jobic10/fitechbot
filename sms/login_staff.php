<!DOCTYPE html>
<html>
<head>
<?php

//require "../secreet/confidential/config.php";



//$myfile=fopen("header.txt","w") or die ("unable to open file");


//$txt=var_dump($_SESSION);

//fwrite($myfile,$txt);
//fclose($myfile);





//print_r($_SESSION);
//print_r($_COOKIE,TRUE);
$host_server= shell_exec('hostname');

$host_server=trim($host_server);
$host_server=strtolower($host_server);

//echo $_SERVER["SERVER_ADDR"];

//echo $host_server;


$site_domain=$_SERVER["SERVER_NAME"];


//echo $site_domain;


//$site_domain="www.".$site_domain.".com";

$site_domain=trim($site_domain);

$site_domain=strtolower($site_domain);




if (strpos($site_domain,"www.")!==false)
{
$site_domain=str_replace("www.","",$site_domain);
}


if ($host_server===$site_domain)
{

//echo "$site_domain";





if (strpos($site_domain,"www.")!==false)
{
$site_domain=str_replace("www.","",$site_domain);
}


if (strpos($site_domain,".")!==false)
{
$site_domain=str_replace(".","",$site_domain);
}


$site_domain=trim("localhost");
$site_domain=substr($site_domain,0,8);

//echo "$site_domain";


$site_domain=$site_domain."_";
$user=$site_domain."fitech";
}
else
{
//echo "$host_server";



if (strpos($site_domain,"www.")!==false)
{
$site_domain=str_replace("www.","",$site_domain);
}


if (strpos($site_domain,".")!==false)
{
$site_domain=str_replace(".","",$site_domain);
}

$site_domain=trim($site_domain);
$site_domain=substr($site_domain,0,8);


//echo "$site_domain";


$site_domain=$site_domain."_";
$user=$site_domain."fitech";
}
$con = mysql_connect('localhost', $user, '^%_&Fg_2');




if (!$con)
  {


  die('Could not connect: ' . mysql_error());
  


   }
   //$db_name="smckabba_schooldb";

   $db_name=$site_domain."cms";
   mysql_query("CREATE DATABASE IF NOT EXISTS $db_name",$con);
   mysql_select_db("$db_name", $con) or die("cannot select database:".msql_error());
   $db_name=$site_domain."bot";
   mysql_query("CREATE DATABASE IF NOT EXISTS $db_name",$con);
 



$result = mysql_query("SELECT * FROM `fbt`")  or die(mysql_error());

$validate = mysql_fetch_array($result);

$banner=$validate['banner'];
$footer=$validate['footer'];
$tray_contents=$validate['tray_contents'];
$tray_contents_overlay=$validate['tray_contents_overlay'];



$banner=strtoupper($banner);

$footer=strtoupper($footer);
$tray_contents=strtoupper($tray_contents);





echo "<title>STAFF LOGIN @$banner</title>
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

<?php echo" <h1 class='sname'>$banner-STAFF LOGIN</h1>";?>



</div>


<div class='welcomemsg'>


<font size=6 color=yellow>Please enter in the form below your username and password and then click on login</font>
</div>
<hr/>

<br/>

<div style="float:left; width:100%; margin-top:30px;">
<form action='loginportal_staff.php' method='post'>
<table bgcolor="#00aaff" style="border:2px groove #0a0a0a;" width="300px">
<tr>

<?php


if(isset($_COOKIE['incorrect_staff']))
{
echo "<td bgcolor='white' style='border:2px groove #0a0a0a;' bordercollapse='collapse'>";
echo "<font color='red'>". $_COOKIE['incorrect_staff']."</font>";
echo "</td>";
}




if(isset($_COOKIE['blank_staff']))
{
echo "<td bgcolor='white' style='border:2px groove #0a0a0a;' bordercollapse='collapse'>";
echo "<font color='red'>".$_COOKIE['blank_staff']."</font>";
"</td>";
}

?>

</tr>



<tr>
<td bgcolor="#000066" style="border:2px groove #0a0a0a;">
<font color="white"><b>Staff Username:</b><br /></font>
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