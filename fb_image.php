<?php
if (!isset($_REQUEST['menuname']) || !isset($_REQUEST['menuitem']))
{
header("location:index.php");
exit;
}

$result = mysql_query("SELECT * FROM `owe_photo` WHERE `menuname`='$menuitem' ORDER BY RAND() LIMIT 0,1;")  or die(mysql_error());
if(mysql_num_rows($result)>0)
{
$validate = mysql_fetch_array($result);
$fullname=$validate['caption'];
$fb_pix=$validate['photo'];
}
else
{
$menuname=$_REQUEST['menuname'];
$menuitem=$_REQUEST['menuitem'];
$fullname="$menuitem , $menuname -website logo";
$fb_pix=$logo;
}

$result=mysql_query("SELECT * FROM `$menuname` where linkname='$menuitem'")  or die("post not found");
$outcome=mysql_num_rows($result);
if($outcome!==0)
{
$validate = mysql_fetch_array($result);
$homepage=$validate['contents'];
$homepage=substr($homepage,0,500);
}
else
{
$result=mysql_query("SELECT * FROM `baby_sub_item` where name_of_babysubitem='$menuitem'");
$outcome2=mysql_num_rows($result);
$validate = mysql_fetch_array($result);
if($outcome2==0)
{
$homepage="post not found";
}
else
{
$homepage=$validate['contents'];
$homepage=substr($homepage,0,500);
}
}
?>