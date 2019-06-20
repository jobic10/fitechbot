<?php

    require_once 'redir_admin.php';
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    $media_name=$gUI->getInputVal('filename');
    $media_id=$gUI->getInputVal('fileid');
    $result =$sqlB->tmp_create_tb("DELETE  FROM `media_files` where mediaID='$media_id' AND media_url='$media_name'");
    unlink($media_name);
    echo "<font color='green' size='5'>this File has been successfuly deleted</font>";
?>




