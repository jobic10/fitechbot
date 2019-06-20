<?php
session_start();
if(!isset($_SESSION['role']))
{

header("location:../index.php");

exit;


}



if (!isset($_REQUEST['submit']))
 
{


echo "<font size=18 color=white>ACCESS DENIED</font>";
exit;

}





$max_width = "500";	



require '../width_height_function.php';


require '../resize_img_function.php';

require_once "../secreet/confidential/db_connection.php";

$return_con= db_connection("cms");
$con=$return_con[0];


$name="FITECH_BOT";




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
    

        
    if(!file_exists('background_picture/'.$name))
       {
          mkdir('background_picture/'.$name, 0755, true);




      $passloc="background_picture/$name/" . $_FILES["file"]["name"];
      $passloc_thumb="background_picture/$name/thumb". $_FILES["file"]["name"];
      move_uploaded_file($_FILES["file"]["tmp_name"],$passloc);
      $ext=pathinfo($passloc,PATHINFO_EXTENSION);
       $ext=strtolower($ext);
      rename($passloc,"background_picture/$name/"."background_picture.".$ext);
      $passloc="background_picture/$name/"."background_picture.".$ext;
      
       
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
            rename($passloc_thumb,"background_picture/$name/thumb"."background_picture.".$ext);
            $passloc_thumb="background_picture/$name/thumb"."background_picture.".$ext;
        
     
       }
     else
      {    

       

      $passloc="background_picture/$name/" . $_FILES["file"]["name"];
      $passloc_thumb="background_picture/$name/thumb". $_FILES["file"]["name"];
      move_uploaded_file($_FILES["file"]["tmp_name"],$passloc);
      $ext=pathinfo($passloc,PATHINFO_EXTENSION);
       $ext=strtolower($ext);
      rename($passloc,"background_picture/$name/"."background_picture.".$ext);
      $passloc="background_picture/$name/"."background_picture.".$ext;
      
       
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
            rename($passloc_thumb,"background_picture/$name/thumb"."background_picture.".$ext);
            $passloc_thumb="background_picture/$name/thumb"."background_picture.".$ext;


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

echo "<font size='5' color='red'>You did not choose any logo......</font>";
exit;


}
}






$resulto = mysql_query("SELECT * FROM `owe_photo` WHERE `menuname`='bgp'")  or die(mysql_error());


$validatefbt = mysql_num_rows($resulto);
  

if($validatefbt<1)
{


$caption="Website Background Picture";
$passloc15="background_picture/FITECH_BOT/back.jpg";	
$insert = "INSERT INTO `owe_photo`(menuname,caption,photo) VALUES('bgp','$caption','$passloc15')";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 

}



$insert =mysql_query("UPDATE `owe_photo` SET `photo` = '$passloc'
WHERE `menuname` = 'bgp'");

echo "

<script type='text/javascript'>

function close_window()
{
window.close();
}


setTimeout('close_window()',5000);
</script>


";



echo "<font size='5' color='green'>The website background picture has been successfully changed </font>";

?>
