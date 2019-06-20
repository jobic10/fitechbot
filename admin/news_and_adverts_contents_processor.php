<?php
    require_once 'redir_admin.php';
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    require_once '../fbt_codes.php';
    $contents=$gUI->getInputVal('contents');
    if($contents=="")
    {
    echo "<font color='red' size='10'>Please input something first</font>";
    $gUI->closeWin();
    exit();
    } 
    date_default_timezone_set('Africa/Lagos');
    $date=date('l: Y-m-d ');
    $time=date('h:i:s A');
    $time2=time();
    $contents=$gUI->ppbs($contents); 
    //$contents=mysqli_real_escape_string($con,$contents);
    //echo $contents; exit;
    $insert = "INSERT INTO `news_and_adverts`(contents,time,time2,date) VALUES ('$contents','$time','$time2','$date')";
    $sqlB->tmp_create_tb($insert);
    echo "<font color='green' size='10'>The news_and_adverts page has been successfully updated!</font>";
    $gUI->closeWin();

?>
