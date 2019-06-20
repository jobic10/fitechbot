<?php 
    ob_start();
    require_once 'redir_admin.php';
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    require_once '../Classes/MediaBasics.php';
    $mB =new MediaBasics();
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    $menuname=$gUI->getInputVal('menuname');
    $linkname=$gUI->getInputVal('linkname');
    if (!isset($menuname) && !isset($linkname)) 
    {
    $gUI->closeWin();
    exit();
    }
    $caption=$gUI->getInputVal('caption');
    $caption=$gUI->ppbs($caption);
    $max_width = "500";	
    $result_c=$sqlB->tmp_create_tb("SELECT `contents` FROM `$menuname` where linkname='$linkname'");
    if($result_c->num_rows<1)
    {
    $result2=$sqlB->tmp_create_tb("SELECT * FROM `baby_sub_item` where name_of_babysubitem='$linkname'");
    if($result2->num_rows<1)
    {
    $gUI->closeWin();
    exit();
    }
    }
    if(!isset($_FILES["file"]["name"]) || empty($_FILES["file"]["name"]))
    {
    echo "<font color='red' size='5'>You did not choose any photograph !</font>";
    $gUI->closeWin();
    exit;
    }
    $username="FITECH_BOT";
    $upload_dir="owe/$username";
    $return_img= $mB->fitech_upload_img($username, $upload_dir,$max_width,FALSE,TRUE);
    $passloc=$return_img['resized'];
    $passloc_thumb=$return_img['thumb'];
    $insert = "INSERT INTO `owe_photo`(menuname,caption,photo) VALUES('$linkname','$caption','$passloc')";
    $sqlB->tmp_create_tb($insert);
    echo "<font color='green' size='5'>Photo has been successfully uploaded to $linkname Page</font>";
    $gUI->closeWin();
    exit();

?> 