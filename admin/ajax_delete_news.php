<?php
    require_once 'redir_admin.php';
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    $photo_name=$gUI->getInputVal('filename');
    $news_id=$gUI->getInputVal('fileid');
    //$news_id=$_REQUEST['news_id'];
    $sqlB->tmp_create_tb("DELETE  FROM `news_and_adverts` where `news_and_advertsID`='$news_id'");
    echo "<font color='green' size='5'>this news has been successfuly deleted</font>";
?>




