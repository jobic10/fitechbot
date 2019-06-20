<?php
$menuname=$_REQUEST['menuname'];
$menuitem=$_REQUEST['menuitem'];

require_once "secreet/confidential/db_connection.php";
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
require_once "fb_image.php";
$site_domain_fb=$_SERVER["SERVER_NAME"];
$site_domain_fb="http://".$site_domain_fb."/admin/$fb_pix";
$menuname=$_REQUEST['menuname'];
$menuitem=$_REQUEST['menuitem'];
$site_domain_fb_link="http://".$_SERVER["SERVER_NAME"]."/virtual_index.php?menuitem=$menuitem&menuname=$menuname";

?>









<!DOCTYPE html>
 <html>
  <head>
   <title> <?php  echo " $menuitem - $menuname";?> </title>
 <?php  echo "<link rel='shortcut icon' type='image/x-icon' href='admin/favicon/favicon.ico'/>";?>
<?php  echo "<meta name='description' content='$homepage' />
<meta property='og:image' content='$site_domain_fb' />
";
$menuitem2=$homepage;
$menuitem2=str_replace(","," ",$menuitem2);
$menuitem2=trim($menuitem2);
$menuitem2=preg_replace('/\s+/',',',$menuitem2);
echo " 
<meta name='keywords' content='$menuitem2'/> 
<meta property='og:title' content='$menuitem - $menuname'/>
<meta property='og:type' content='article'/>
<meta property='og:url' content='$site_domain_fb_link'/>
<meta property='og:description' content='$homepage'/>
<meta property='og:site_name' content='$banner'/>
"
;?>
<meta property='fb:admins' content='100006695830100'/>
<meta property='fb:app_id' content='215519668658462'/>
<meta name="viewport" content="width=device-width" />
<meta name="robots" content="index, follow"/> 
<meta name="revisit-after" content="1 day"/> 
<meta name="language" content="English"/> 
<meta name="generator" content="N/A"/> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
    <?php
    if (isset($_REQUEST['menuname']) && isset($_REQUEST['menuitem']))
{
    
header("location:index.php?menuitem=$menuitem&menuname=$menuname#$menuitem");
exit;
}
   ?> 
</body>
</html>