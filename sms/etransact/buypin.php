<?php
session_start();
ini_set('max_execution_time',600);

if(!isset($_REQUEST['submit']) | !isset($_SESSION['etransact']))
{

header("location:index.php");
exit;
}



require_once "../../secreet/confidential/db_connection.php";

$return_con= db_connection("cms");
$con=$return_con[0];

$result = mysql_query("SELECT * FROM `fbt`")  or die(mysql_error());

$validate = mysql_fetch_array($result);

$banner=$validate['banner'];
$footer=$validate['footer'];
$tray_contents=$validate['tray_contents'];
$tray_contents_overlay=$validate['tray_contents_overlay'];
$chat_icon=$validate['chat_icon'];
$chat_banner=$validate['chat_banner'];

$logo=$validate['site_logo'];

$logo_thumb=str_replace("website_logo/FITECH_BOT/","website_logo/FITECH_BOT/thumb",$logo);
$slogan=$validate['slogan'];
$about_chat=$validate['about_chat'];
 mysql_close($con);



?>
<!DOCTYPE html>
<html>
<head>


<title><?php echo "$tray_contents -ETRANSACT";?></title>
   
 
<link rel="stylesheet" type="text/css" href="../../css/body.css" />
 









</head>


<body>







<TABLE bgcolor="white" border=0  align=center style="border-collapse:collapse">

<TR valign=center align=center>
<TD colspan=3>

















<?php

$amt=$_REQUEST['pin'];


$return_con= db_connection("sms");
$con=$return_con[0];



echo "<b>FITECH SOLUTIONS E-TRANSACT</b><br/><br/>";


$result = mysql_query("SELECT `pin` FROM newpin");

if(mysql_num_rows($result)>0 && mysql_num_rows($result)>$amt)
{

for ($x=0;$x<$amt;$x++)
{
$result = mysql_query("SELECT `pin` FROM newpin limit 1");


$validate=mysql_fetch_array($result);

$pin=$validate['pin'];

$date=date("Y/m/d");


mysql_query("INSERT INTO bpin (pin,datepurchased)
VALUES ('$pin','$date')");

mysql_query("DELETE  FROM newpin where pin='$pin'");
        
echo "


<table cellpadding=5  cellspacing=5 border=1>

<tr>

<td width=200 align=center>

<b>PIN: $pin</b>

</td>

</tr>


</table>";

}

unset($_SESSION['etransact']);

$at_site=$return_con[3];

$to="ayologbon@yahoo.com";
$subject="PIN SOLD at $at_site";
$msg="$amt pin(s) has/hava just been  bought now.";
$headers="From:webmaster@fitech.com"."\r\n"."cc:webmanager@fitech.com";

 mail($to,$subject,$msg,$headers);









mysql_close($con);

}
else
{




//mail(to,subject,message,headers,parameters);

$to="ayologbon@yahoo.com";
$subject="OUT OF PINS";
$msg="WE are currently out of pin please generate more now.";
$headers="From:webmaster@webtronet.com"."\r\n"."cc:webmanager@webtronet.com";

 mail($to,$subject,$msg,$headers);


echo "<font color='red' size='7'>SORRY,Your Transaction could not be processsed due to shortage of PINS,An admin has been rightly notified.Please check back in an's Hour time.We sincerely apologise for the inconvenience</font><br/>";
echo "<a href='index.php'>Go Back Home</a>";
exit;


}












?>
<br/>
<B>NOTE:<em>Please be informed that this PIN is not tranferable as it can <br/>only be used once.Under no circumstances should you then reveal it to others</em></b>
<br/>
<script type="text/javascript" src="../javascript//print.js"></script>





















































</td>
</tr>

</table>

</body>
</html>