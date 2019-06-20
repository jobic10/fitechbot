<?php
    require_once 'redir_admin.php';
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    $photo_name=$gUI->getInputVal('filename');
    $photo_id=$gUI->getInputVal('fileid');
    $thumb_photo=str_replace("owe/FITECH_BOT/","owe/FITECH_BOT/thumb",$photo_name);
    $result =$sqlB->tmp_create_tb("DELETE  FROM `owe_photo` where photoID='$photo_id'");
    unlink($photo_name);
    unlink($thumb_photo);
    //echo "this photo has been successfuly deleted";
?>




