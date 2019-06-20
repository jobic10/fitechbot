<?php
    ob_start();
    require_once "redir_admin.php";
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    require_once '../Classes/MediaBasics.php';
    $mB =new MediaBasics();
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    $con=$sqlB->con;
    //require_once 'timezone.php';
    $max_width ="500";
    if(!isset($_FILES["file"]["name"]) || empty($_FILES["file"]["name"]))
    {
    $banner=$gUI->getInputVal('banner');
    $footer=$gUI->getInputVal('footer');
    $uptray=$gUI->getInputVal('uptray');
    $uptray_float=$gUI->getInputVal('uptray_float');
    $chat_icon=$gUI->getInputVal('chat_icon');
    $chat_banner=$gUI->getInputVal('chat_banner');
    $about_chat=$gUI->getInputVal('about_chat');
    $slogan=$gUI->getInputVal('slogan');
    $banner=mysqli_real_escape_string($con,$banner);
    $footer=mysqli_real_escape_string($con,$footer);
    $uptray=mysqli_real_escape_string($con,$uptray);
    $slogan=mysqli_real_escape_string($con,$slogan);
    $about_chat=mysqli_real_escape_string($con,$about_chat);
    $uptray_float=mysqli_real_escape_string($con,$uptray_float);
    $chat_icon=mysqli_real_escape_string($con,$chat_icon);
    $chat_banner=mysqli_real_escape_string($con,$chat_banner);
    $sqlB->tmp_create_tb("UPDATE `fbt` SET banner = '$banner',footer='$footer',tray_contents='$uptray',tray_contents_overlay='$uptray_float',chat_banner='$chat_banner',chat_icon='$chat_icon',about_chat='$about_chat',slogan='$slogan' WHERE itemID='1'");
    echo "<font color='green' size='10'>page has been successfully updated !</font>";
    $gUI->closeWin();
    exit();
    }
    else
    {
    $username="FITECH_BOT";
    $upload_dir="website_logo/$username";
    $return_img= $mB->fitech_upload_img($username, $upload_dir,$max_width,FALSE,FALSE);
    $passloc=$return_img['resized'];
    $passloc_thumb=$return_img['thumb'];
    $sqlB->tmp_create_tb("UPDATE `fbt` SET site_logo='$passloc' WHERE itemID = '1'");
    $faviconDir= $mB->genFavicon($passloc);
    echo "<font color='green' size='10'>Website Logo has been successfully uploaded !</font>";
    }
   

?>