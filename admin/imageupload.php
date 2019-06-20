<?php
session_start();
$dirName="media_files";
if (isset($_POST['id'])) 
{
  @mkdir($dirName,0777);
  $uploadFile="$dirName/".$_FILES[$_POST['id']]['name'];
if(!is_dir($dirName)) 
{
echo '<script> alert("Failed to find the final upload directory: $dirName");</script>';
exit;
}
            
$key = ini_get("session.upload_progress.prefix") ."123";
if (!empty($_SESSION[$key]) OR isset($_SESSION[$key])) 
{
    //var_dump($_SESSION[$key]);
    $current = $_SESSION[$key]["bytes_processed"];
    $total = $_SESSION[$key]["content_length"];
    echo $current < $total ? ceil($current / $total * 100) : 100;
  
}
else 
{
echo 100;
}

 if (!move_uploaded_file($_FILES[$_POST['id']]['tmp_name'], $uploadFile)) 
{	
echo '<script> alert("Failed to upload file");</script>';
exit;
}
require_once '../timezone.php';
$date=date('l: Y-m-d ');
$time=date('h:i:s A');
$time2=time();
require_once "../secreet/confidential/db_connection.php";
$return_con= db_connection("cms");
$con=$return_con[0];
$contents=mysql_real_escape_string($contents);
$sql="CREATE TABLE IF NOT EXISTS `media_files` (mediaID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(mediaID),`media_url` varchar(500),`media_caption` varchar(5000),`time` varchar(100),`time2` varchar(100),`date` varchar(100))";
if (!mysql_query($sql,$con))
 {
echo "error bro";
exit;
 }
$file_name=basename($uploadFile);
$msg="$file_name uploaded on $date at $time";
$insert = "INSERT INTO `media_files`(media_url,media_caption,time,time2,date) VALUES('$uploadFile','$msg','$time','$time2','$date')";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 
 }
else
{
echo "upload completed";
exit;
}


?>