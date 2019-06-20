<?php
    require_once 'redir_admin.php';
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    $contents=$gUI->getInputVal('contents');
    $news_id=$gUI->getInputVal('contentsid');
    date_default_timezone_set('Africa/Lagos');
    $date=date('l: Y-m-d ');
    $time=date('h:i:s A');
    $time2=time();
    $contents=$gUI->ppbs($contents); 
    //$contents=mysql_real_escape_string($contents);
    $result =$sqlB->tmp_create_tb("UPDATE `news_and_adverts` SET `contents`='$contents',`time`='$time',`time2`='$time2',`date`='$date' where `news_and_advertsID`='$news_id'");
    echo "<font color='green' size='5'>this news has been successfuly Updated</font>";
?>




