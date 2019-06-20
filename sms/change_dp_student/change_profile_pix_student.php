<?php
session_start();
if(!isset($_SESSION['loginportal']) && !isset($_SESSION['result']) )
{

header("location:../index.php");

exit;


}

if(!isset($_REQUEST['submit']) || $_FILES["file"]["name"]=='' )
{



echo "<font color='red' size='10'>You did not choose any photograph !</font>";


exit;


}

$max_width = "500";	
require '../../resize_img_function.php';








//$name="FITECH_BOT";

$name=$_SESSION['student_username_stored_in_session'];
$regnosession=$_SESSION['student_regno_stored_in_session'];
$regnosession_pix=$regnosession;
$year=$_SESSION['present_year_stored_in_session'];
$termuse=$_SESSION['present_termuse_stored_in_session'];
$regnosession=strtolower($regnosession);

$term=strtolower($termuse);


if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 3000000))
  
{


  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else

  {
    

        
    if(!file_exists('../uploads/'.$name))
       {
          mkdir('../uploads/'.$name, 0755, true);


      
      //$passloc="../uploads/$name/" . $_FILES["file"]["name"];
      //$passloc_thumb="../uploads/$name/thumb". $_FILES["file"]["name"];



      $passloc="../uploads/$name/" . $_FILES["file"]["name"];
      $passloc_thumb="../uploads/$name/thumb". $_FILES["file"]["name"];
      move_uploaded_file($_FILES["file"]["tmp_name"],$passloc);
      $ext=pathinfo($passloc,PATHINFO_EXTENSION);
       $ext=strtolower($ext);
      rename($passloc,"../uploads/$name/"."$name.".$ext);
      $passloc="../uploads/$name/"."$name.".$ext;
      
       
                        $width = getWidth($passloc);
			$height = getHeight($passloc);
			//Scale the image if it is greater than the width set above
			if ($width > $max_width){
				$scale = $max_width/$width;
				$passloc = resizeImage($passloc,$width,$height,$scale);
                                copy($passloc,$passloc_thumb);
                                
			}else{
				$scale = 1;
				$passloc = resizeImage($passloc,$width,$height,$scale);
                                copy($passloc,$passloc_thumb);
			}
            rename($passloc_thumb,"../uploads/$name/thumb"."$name.".$ext);
            $passloc_thumb="../uploads/$name/thumb"."$name.".$ext;
        
     
       }
     else
      {    

       

      $passloc="../uploads/$name/" . $_FILES["file"]["name"];
      $passloc_thumb="../uploads/$name/thumb". $_FILES["file"]["name"];
      move_uploaded_file($_FILES["file"]["tmp_name"],$passloc);
      $ext=pathinfo($passloc,PATHINFO_EXTENSION);
       $ext=strtolower($ext);
      rename($passloc,"../uploads/$name/"."$name.".$ext);
      $passloc="../uploads/$name/"."$name.".$ext;
      
       
                        $width = getWidth($passloc);
			$height = getHeight($passloc);
			//Scale the image if it is greater than the width set above
			if ($width > $max_width){
				$scale = $max_width/$width;
				$passloc = resizeImage($passloc,$width,$height,$scale);
                                copy($passloc,$passloc_thumb);
                                
			}else{
				$scale = 1;
				$passloc = resizeImage($passloc,$width,$height,$scale);
                                copy($passloc,$passloc_thumb);
			}
            rename($passloc_thumb,"../uploads/$name/thumb"."$name.".$ext);
            $passloc_thumb="../uploads/$name/thumb"."$name.".$ext;


       }

     


    
  }
}


else
  {  

   if(!isset($_FILES["file"]["name"]))
{

   

echo "<font size='5' color='red'>You did not choose any logo......</font>";
exit;

}


else
{









echo "


<script type='text/javascript'>

function resize_window()
{

window.resizeTo(250,400);
window.moveTo(300,150);
window.focus();
}


setTimeout('resize_window()',100);
</script>





<script type='text/javascript'>

function close_window()
{
window.close();
}


setTimeout('close_window()',5000);
</script>

";







exit;
}
  


}








$width =getWidth($passloc_thumb);
 $height =getHeight($passloc_thumb);
 if($width>250)
 {
$scale= 0.3;
}
else if ($width>100)
{
$scale= 0.5;
}
else
{
$scale= 0.8;

}
	$cropped = resizeImage($passloc_thumb,$width,$height,$scale);


$passloc2="uploads/$name/"."$name.".$ext;



require_once "../../secreet/confidential/db_connection.php";

$return_con= db_connection("sms");
$con=$return_con[0];


mysql_query("UPDATE students SET Passport='$passloc2' WHERE UserName = '$name'") or die("error");


mysql_close($con);




$return_con= db_connection("chat");
$con=$return_con[0];


$dbpassport_thumb=str_replace("uploads/$name/","uploads/$name/thumb",$passloc2);
$dbpassport_thumb="../sms/$dbpassport_thumb";
$default_profile_pic="../sms/$passloc2";
mysql_query ("UPDATE `all_fans` SET `profilepic`='$default_profile_pic',`thumbprofilepic`='$dbpassport_thumb' WHERE username = '$name' ") or die(mysql_error());
mysql_close($con);
$both="_".$year."_".$term;
$both1="_".$year."_first term";
$both2="_".$year."_second term";
$return_con= db_connection("rsp");
$con=$return_con[0];
mysql_query("UPDATE studentinfo SET passport='$passloc2' WHERE regno = '$regnosession_pix'") or die("error");

$cacheFile ="../portal_student/reportsheet/$regnosession".$both.".html";

$dir="../portal_student/reportsheet";
 if(!file_exists($dir))
       {
          mkdir($dir, 0755, true);
       }
require_once "../RESULT_PROCESSOR/update_changes_on_html_report.php";



    ob_start();
    // write content
    require "../portal_student/done.php";
    $content = ob_get_contents();
    ob_end_clean();
    file_put_contents($cacheFile,$content);
   //echo $content;





echo "<font color='green' size='10'>Profile picture has been successfully changed !</font>";





?>