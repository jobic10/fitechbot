<?php
    ob_start();
    require_once "redir_admin.php";
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    require_once '../Classes/MediaBasics.php';
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    $con=$sqlB->con;
    $mB =new MediaBasics();
    if(!isset($_FILES["file"]["name"]) || empty($_FILES["file"]["name"]))
    {
    echo "<font color='red' size='5'>You did not choose any File !</font>";
    $gUI->closeWin();
    exit;
    }
    $username="FITECH_BOT";
    $file_default_name=$_FILES["file"]["name"];
    $file_temp_dir=$_FILES["file"]["tmp_name"];
    $file_type=$_FILES["file"]["type"];
    $file_default_size=$_FILES["file"]["size"];
    $file_error_code=$_FILES["file"]["error"];
    //$allowed_file_type=array("audio/mpeg","audio/ogg","audio/wav","video/ogg","video/mp4","video/3gpp");in_array($file_type, $allowed_file_type) && 
    if ($file_default_size >0 && $file_default_size < 100000000 )
    {     
    $upload_dir="media_files/$username";
    $f_msg="The Media File has been Successfully Uploaded";
    $passloc= $mB->fitech_upload_file($username, $upload_dir);
    }
    else
    {  
    echo "<font color='red' size='5'>  File Type Not Allowed !</font>";
    $gUI->closeWin();
    exit;  
    }
    //require_once '../timezone.php';
    $date=date('l: Y-m-d ');
    $time=date('h:i:s A');
    $time2=time();
    $caption_of_file=$gUI->getInputVal('caption');
    $caption_of_file=$gUI->ppbs($caption_of_file);
    $caption_of_file=mysqli_real_escape_string($con,$caption_of_file);
    $file_name=basename($passloc);
    $caption_of_file.=" uploaded on $date at $time";
    $sqlB->tmp_create_tb("INSERT INTO `media_files`(media_url,media_caption,time,time2,date) VALUES('$passloc','$caption_of_file','$time','$time2','$date')");
    echo "<font color='green' size='10'>$f_msg</font>";
    $gUI->closeWin();
?>
