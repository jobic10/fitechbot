<?php
ob_start();
require_once 'Classes/sessionBasics.php';
$sessionB =new sessionBasics();
require_once 'Classes/Concurrency.php';
$concurrency =new Concurrency();
require_once 'site_prerequisites.php';
$main_menuname=$gUI->getInputVal('menuname');
$main_menuitem=$gUI->getInputVal('menuitem');

?> 
<!DOCTYPE html>
<html lang="en-US">
<head>     
<?php
require_once 'head_tag_codes_mobile.php';
?>
</head>
<body onresize='f_resize()'>
       
        <!-- TOP NAV WITH LOGO -->  
 <header>
 <div id='welcome_to_school'>
 <?php echo $banner ;?> 
 </div>
 <div id='school_slogan'>
 <marquee>   
 <?php  echo $slogan ;
              
              if(isset($_COOKIE['ltv']))
              {
                  
                if(isset($_SESSION['welcome']) && $_SESSION['welcome']<2 )
              {  
                    
               //unset($_COOKIE['ltv']);
               //unset($_COOKIE['ltv2']);
               $cookie_name = "ltv";
               $cookie_name2 = "ltv2";   
               $cookie_value = time();
               $cookie_value2 = date('h:i:s A');
               setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); 
               setcookie($cookie_name2, $cookie_value2, time() + (86400 * 365), "/"); 
              }
               //require_once 'chat/web/timing_algorithm.php';
               $rtime2=time();
               $c_date=$_COOKIE['ltv2'];
               $time2=$_COOKIE['ltv'];
               $ty=$rtime2-$time2;
               $ty=$concurrency->fitech_timing($ty);
               echo "Your last Visit was $ty";
              }
              else
              {
               $cookie_name = "ltv";
               $cookie_name2 = "ltv2";   
               $cookie_value = time();
               $cookie_value2 = date('h:i:s A');
               setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); 
               setcookie($cookie_name2, $cookie_value2, time() + (86400 * 365), "/"); 
               
              }
              
              ?>
 </marquee>
 </div>
   
<a class="logo" href="#">
<a id="menu-toggle" class="button dark" href="#">
<i class="icon-reorder"></i>
</a>
</a>
			
<nav id="navigation">                          
<?php          
require_once 'load_menu_mobile.php';
?>
</nav>
</header>
  
<div class="container">
<?php
if($deviceType == "computer" || $deviceType == "tablet")
{
echo " 
<div class='img_con' id='img_con' onclick='large_image_close()'></div>
<div id='overlay' ></div> 
</div>";
}
?>  
    
<div class="row">
<div class="col-sm-12">
<?php                 
if($main_menuname!==FALSE && $menuitem!==FALSE)
{
if($main_menuname=='home')
{
require_once "carousel_mobile.php";
}

}
else
{
require_once "carousel_mobile.php";  
//exit();
}
?>
</div> 
</div>
         
<div class="row">
<div class="col-sm-3 col-md-3">
<div id="sitemap_con">
<?php          
require 'fans_con_codes.php';
?>
</div>
</div>
    
<div class="col-sm-5 col-md-6">
<div id="third-block">               
<div id="waiting_for_server_response"></div>
<div id="returned_pst">
<?php
if($main_menuname!==FALSE && $menuitem!==FALSE)
{
if($main_menuname=='home')
{
require_once "contents.php";
}
elseif ($main_menuname=='fitechbot_news')
{
require_once 'get_full_news.php';
}
elseif($main_menuname=='fitechbot_media')
{
require_once "media_file.php";
}
else
{
require_once "getcontent_mobile.php";
}       
}
else
{  
require_once "contents.php";   
}
?>
</div>
</div>              
</div>
    
<div class="col-sm-4 col-md-3">     
<div id="news_con">
<?php         
require 'artist_con_codes.php';
?>                  
</div>
</div>
</div>
</div>
        
<?php
require_once 'footer.php';
?>
        
      <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>   
      <script type="text/javascript">
         jQuery(document).ready(function($) {  
           $("#owl-demo").owlCarousel({
         	slideSpeed : 300,
         	autoPlay : true,
         	navigation : false,
         	pagination : false,
         	singleItem:true
           });
           $("#owl-demo2").owlCarousel({
         	slideSpeed : 300,
         	autoPlay : true,
         	navigation : false,
         	pagination : true,
         	singleItem:true
           });
         });	
          
      </script> 
   </body>
</html>