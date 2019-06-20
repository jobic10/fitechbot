<?php



if (!$_REQUEST['username'] | !$_REQUEST['pass'])



{

      setcookie("blank","Sorry!both username and password cannot be left blank",time()+5);

      header("location:index.php");

exit;

}





session_start();
if (isset($_SESSION['admin']))

{
header("location:admin.php");
}









$username=$_REQUEST['username'];


$password=$_REQUEST['pass'];

//require_once "../secreet/confidential/config.php";

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
   $db_name=$site_domain."cms";
   mysql_query("CREATE DATABASE IF NOT EXISTS $db_name",$con);
   mysql_select_db("$db_name", $con) or die("cannot select database:".msql_error());
   $db_name=$site_domain."bot";
   mysql_query("CREATE DATABASE IF NOT EXISTS $db_name",$con);
 










$adminresult=mysql_query("SELECT * FROM admin where adminID=1");

$validateadmin = mysql_fetch_array($adminresult);

$adminusername=$validateadmin['adminursername'];

$adminpassword=$validateadmin['adminpassword'];

$role=$validateadmin['role'];



if( ($username===$adminusername) && ($password===$adminpassword))
{
session_start();


$_SESSION["role"]="$role";


header("location:admin.php");


}

else

{


   
     
     setcookie("incorrect","Sorry!Make sure your username and password is entered correctly",time()+5);




date_default_timezone_set('Africa/Lagos');
$date=date('l: Y-m-d ');


$time=date('h:i:s A');

  
$toay="ayologbon@gmail.com";
$subjectay="Website Security Alert ";
$msgay="Attention Admin,$username has made a failed Atempt to Login Into your Control Panel:"  ."\r\n"."This message is to alert you of any unlawful attempt to login into the Control Panel of your Site,and can thus  be ignored if you are the one"."\r\n"."On:$date @: $time" ;
$headersay="From:Ayobot"."\r\n"."cc:Ayobot";

 mail($toay,$subjectay,$msgay,$headersay);

      header("location:index.php");

exit;


   }











?>
