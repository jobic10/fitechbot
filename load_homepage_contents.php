<?php
require "secreet/confidential/config.php";
$result5= $sqlB->tmp_create_tb($con,"SELECT * FROM `home` where menubarID=1") or die("error 404");
$validate = mysql_fetch_array($result5);
$homepage=$validate['contents'];
$length=strlen($homepage);
while(strpos($homepage,"\n\n")!==false)
{
$homepage=str_replace("\n\n","\n",$homepage);

}
$arr=array("\r\n","\r","\n");

$homepage=str_replace($arr,"<br/>",$homepage);
  

if($length<=6000)

{


echo "
<div id='ajax_post_wraper'>
</script>
<noscript>Either your browser does not support JavaScript or its is disabled </noscript>

$homepage
</div>
";

}
else
{

$break=substr($homepage,0,6000);
$break_more=substr($homepage,6000,500000);

       //$wrap=wordwrap($break,90,"<br/>",true);

  echo "
<div id='ajax_post_wraper'>
</script>
<noscript>Either your browser does not support JavaScript or its is disabled </noscript>

$break<span style='display:none;' id='hidepost_2'>$break_more</span><span>
  
 <a href='#hidepost_2-1'  id='hidepost_2' onclick=hidepost(this.id)></span><span id='changenav_hidepost_2'>read all>></span></a>

</div>
";



}

$menuname="home";


$menuitem="Welcome Remarks";


$site_domain=$_SERVER["SERVER_NAME"];
$site_domain="http://".$site_domain."/";

//$link=$site_domain."virtual_index.php?menuitem=$menuitem&menuname=$menuname";


$buttons=new social("$site_domain","$menuitem - $menuname ");




// available themes
/**
default
badges
heart-shaped
*/ 






echo $buttons->createCode('default');



?>
