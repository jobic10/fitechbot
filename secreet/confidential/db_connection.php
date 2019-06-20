<?php 
    
    $path_separator = DIRECTORY_SEPARATOR;
    $thisConfigFolder2 = __DIR__ . $path_separator;
    //chdir($thisConfigFolder);
    $parentFolder2 = str_replace($path_separator.'secreet'.$path_separator . 'confidential', '', $thisConfigFolder2);
    $baseURL2 = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
    $docRoot2 = $_SERVER['DOCUMENT_ROOT'];
    define('_BASE_DIRF_', $parentFolder2);
    define('_BASE_URLF_', $baseURL2);
   
   $time_zone_locale = 'Africa/Lagos';
   //@date_default_timezone_set($time_zone_locale);
  //print_r($time_zone_locale);
  //print_r(date_default_timezone_get());

function db_connection($incomming_db_name)
{
$return_con=array();
//"you don't have to change the name of your product b4 you can improve on its efficiency or value";->food for thought bitches
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

$return_site_domain=$site_domain;


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

if($site_domain=="16925415" || $site_domain=="localhos" || $site_domain=="19216817" || $site_domain=="19216843" || $site_domain=="19216813" || $site_domain=="127001"  || $site_domain=="16925412")
{
  $site_domain="localhos"; 
}

$site_domain=$site_domain."_";
$user=$site_domain."fitech";

}
$db_password="^%_&Fg_2";
$mysql_host = 'localhost';
$con = mysqli_connect($mysql_host , $user, $db_password);
if (!$con)
{
  die('Could not connect: ' . mysqli_error());
}

   $db_name=$site_domain."$incomming_db_name";
   $return_db_name=$db_name;
   mysqli_query($con,"CREATE DATABASE IF NOT EXISTS $db_name");
   mysqli_select_db($con,"$db_name") or die("cannot select database:".  mysqli_error());
   return array($con,$user,$return_db_name,$return_site_domain,$db_password,$mysql_host);

 
}

function mysqli_field_array($query)
{
$field=mysql_num_fields($query);
For($i=0;$i<$field;$i++)
{
$names[]=mysql_field_name($query,$i);
}
$names=implode(",", $names);

return $names;
}

function remove_Multiple_Lines($in_String)
{

while(strpos($in_String,"\n\n")!==false)
{
$rtn_string=str_replace("\n\n","\n",$in_String);
return $rtn_string;
}

}

?>


