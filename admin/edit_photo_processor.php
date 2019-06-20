<?php
    require_once 'redir_admin.php';
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    $con=$sqlB->con;
    $result = $sqlB->tmp_create_tb("SELECT * FROM `owe_photo`");
    while($validate = $result-> fetch_array())
    {
    $photoid=$validate['photoID'];
    $caption=$validate['caption'];
    $photo=$validate['photo'];
    $new_caption=$_REQUEST[$photoid];
    //$new_caption=mysqli_real_escape_string($con,$new_caption);
    $sqlB->tmp_create_tb("UPDATE `owe_photo` SET caption = '$new_caption' WHERE caption='$caption' AND photoID='$photoid'");
    }
    echo "<font color='green' size='10'>Photo caption has been successfully updated !</font>";
    $gUI->closeWin();
    exit();

?>