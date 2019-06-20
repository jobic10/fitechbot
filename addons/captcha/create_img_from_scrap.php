<?php
require_once '../../Classes/sessionBasics.php';
$sessionB =new sessionBasics();
require_once '../../Classes/DirAndFiles.php';
$DAF =new DirAndFiles();
require_once '../../Classes/GetUserInputs.php';
$gUI =new GetUserInputs();
//$ext_dir=$DAF->captchasrc;
$captch_ext=$gUI->getInputVal('captcha');
$x= mt_rand(1,20);
$y= mt_rand(21,40);
$captcha_ans= $x +  $y;
//$captcha_val= $x. " + " . $y . "= $captcha_ans";
$captcha_val= $x. " + " .$y;
if (isset($_SESSION['captcha'])) //great
{
$ext_dir=$DAF->captchasrc.$_SESSION['captcha'].".png";
if(file_exists($ext_dir))
{
unlink($ext_dir);   
}
}
$_SESSION['captcha']=$captcha_ans;
$font=$DAF->baseDir."font/";
$font .= 'ayobot.ttf';
$my_img = imagecreatetruecolor( 80, 20 );
$background = imagecolorallocate( $my_img, 0, 0, 255 );
$text_colour = imagecolorallocate( $my_img, 255, 255, 0 );
$line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
//imagestring( $my_img, 1, 20, 5, "$captch_val", $text_colour );
imagettftext($my_img, 17, 0, 0,  16 , $text_colour, $font , $captcha_val);
imagesetthickness ( $my_img, 100);
imageline( $my_img, 30, 45, 165, 45, $line_colour );
header( "Content-type: image/png");
if ($captch_ext!==FALSE && $captch_ext=='CAPTCHA')
{
//require_once "../../Classes/functions/get_site_domain_url.php";
$captch_src=$gUI->get_site_domain_url(NULL,"addons/captcha/captcha_imgs"); 
$ext_dir2=$captch_src.$captcha_ans.".png";//$ext_dir="captcha_imgs/".$captcha_ans.".png";
$ext_dir=$DAF->captchasrc.$captcha_ans.".png";
imagepng($my_img,$ext_dir);
echo $ext_dir2;
 exit();
}
 else
{
imagepng($my_img);    
}

/*
ob_start();
imagepng($my_img);    
$imagedata = ob_get_clean();
imagedestroy($my_img);
return $imagedata;
imagecolordeallocate( $line_color );
imagecolordeallocate( $text_color );
imagecolordeallocate( $background );
imagedestroy( $my_img);
header("Cache-Control: no-cache");
header('Content-Type: image/'.$ext);
header("Content-Disposition:attachment;filename=ayo.png");
*/
?>