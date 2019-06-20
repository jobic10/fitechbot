<?php
require_once 'Classes/GetUserInputs.php';
$gUI =new GetUserInputs();
require_once 'Classes/SqlBasics.php';
$sqlB =new SqlBasics("cms");
$result = $sqlB->tmp_create_tb("SELECT * FROM `fbt`");
$validate = $result->fetch_array();
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
//$site_domain_fb_link="http://".$_SERVER["SERVER_NAME"]."/";
//$site_domain_fb_link_chat="http://".$_SERVER["SERVER_NAME"]."/chat/";

$site_domain_website_logo=$gUI ->get_site_domain_url(NULL,"admin");
$site_domain_website_logo=$site_domain_website_logo.$logo;
$site_domain=$gUI->get_site_domain_url(NULL);
$menuname=$gUI->getInputVal('menuname');
$menuitem=$gUI->getInputVal('menuitem');
if($menuname!==FALSE && $menuitem!==FALSE)
{
$link=$site_domain."index.php?menuitem=$menuitem&menuname=$menuname";
$site_domain_fb_link_chat=$link;
$about_chat=$menuname;
//$banner=$menuname;
if(isset($profilepix))
{
$site_domain_website_logo=$pix_actual_loc;
}
 $tray_contents_overlay=$menuname;
 $tray_contents=$menuitem;
}
else
{
$link=$site_domain;
}

?>