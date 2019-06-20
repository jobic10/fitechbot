<style>
.social_buttons li
{ 
float:right;
margin-right:10px;
list-style-type:none;
}
</style>
<?php
$self_url=filter_input(INPUT_SERVER,'PHP_SELF',FILTER_SANITIZE_STRING);
//echo $self_url; exit();
$dd=mt_rand(5,6);
require_once 'Classes/GetUserInputs.php';
$gUI =new GetUserInputs();
require_once 'Classes/DirAndFiles.php';
$DAF =new DirAndFiles();
$site_dir_css=$DAF->baseDir."css"; 
$site_dir_js=$DAF->baseDir."js"; 
$site_dir_js_chat=$DAF->baseDir."chat/web/js"; 
$site_domain_css=$gUI ->get_site_domain_url(NULL,"css"); 
$site_domain_js=$gUI ->get_site_domain_url(NULL,"js"); 
$site_domain_js_chat=$gUI ->get_site_domain_url(NULL,"chat/web/js"); 
$site_domain_ico=$gUI ->get_site_domain_url(NULL,"admin/favicon"); 
$site_domain_fb_link_chat=$gUI ->get_site_domain_url(NULL,"chat");
$site_domain_scrp_img_chat=$gUI ->get_site_domain_url(NULL,"addons/captcha"); 
$css_cmd="link rel='stylesheet' type='text/css'";
$jss_cmd="script type='text/javascript'";
//define('CSS_CMD', $css_cmd);
$rt_dirs_css=scandir($site_dir_css);
$rt_dirs_js=scandir($site_dir_js);
$rt_dirs_js_chat=scandir($site_dir_js_chat);


echo "
<link rel='shortcut icon' type='image/x-icon' href='$site_domain_ico"."favicon.ico'>
<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
<meta name='viewport' content='width=device-width' />
<!--
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
-->
<!--[if lt IE 9]> 
< $jss_cmd src='http://html5shiv.googlecode.com/svn/trunk/html5.js'></script> 
<![endif]--> 
";
echo "\n";
foreach ($rt_dirs_css as $value) 
{
 if((stripos( $value,".css")!=FALSE))
 {
 echo "<$css_cmd href='".$site_domain_css."$value'>\n";
 }
}
echo "\n";
 foreach ($rt_dirs_js as $value) 
{
 if((stripos( $value,".js")!=FALSE))
 {
 echo "<$jss_cmd src='".$site_domain_js."$value'></script> \n";
 }
}
echo "\n";
foreach ($rt_dirs_js_chat as $value) 
{
 if((stripos( $value,".js")!=FALSE) && $value!="ControlFive.js" && $value!="ControlSix.js" )
 {
 echo "<$jss_cmd src='".$site_domain_js_chat."$value'></script> \n";  
 }
}
echo "\n";
if(stripos($self_url,"web/index.php")!=FALSE ||  stripos($self_url,"chat/groups")!=FALSE)
{
if($dd==5)
{
 $value="ControlFive.js";
 echo "<$jss_cmd src='".$site_domain_js_chat."ControlFive.js'></script> \n";    
}
else
{
$value!="ControlSix.js"; 
echo "<$jss_cmd src='".$site_domain_js_chat."ControlSix.js'></script> \n";  
}
}
//var_dump($rt_dirs); exit();       
        
        ;?>   