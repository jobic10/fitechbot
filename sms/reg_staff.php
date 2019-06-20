<?php 
ob_start();
session_start(); 
$im="im";
if (!isset($_REQUEST['submit']))
{
echo "<font size=18 color=white>ACCESS DENIED</font>";
exit;
}
$max_width = "300";	
require_once '../resize_img_function.php';
require_once "../secreet/confidential/db_connection.php";
$return_con= db_connection("sms");
$con=$return_con[0];
$name=$_REQUEST['username'];
$name=mysql_real_escape_string($name);
$class="NAY";
$address=$_REQUEST['address'];
$address=mysql_real_escape_string($address);
$email=$_REQUEST['email'];
$number=$_REQUEST['number'];
$sex=$_REQUEST['sex'];
$birth=$_REQUEST['birth'];
$localgov=$_REQUEST['localgov'];
$role=$_REQUEST['ris'];
$subject_taught="NAY";
$state=$_REQUEST['state'];
$nationality=$_REQUEST['nationality'];
$disability=$_REQUEST['disability'];
$cd="NAY";
$fullname=$_REQUEST['fullname'];
$fullname=strtoupper($fullname);
$fullname=mysql_real_escape_string($fullname);
$pass=$_REQUEST['pass'];
$pass=mysql_real_escape_string($pass);
$name=strtolower($name);
while(strpos($name," ")!==false)
{
$name=str_replace(" ","",$name);
}
$arr=array("\r\n","\r","\n",""," ");
$name=str_replace($arr,"",$name);
if($email=="")
{
$email="Nill";
}
if($number=="")
{
$number="Nill";
}
if (!$_REQUEST['username'] | !$_REQUEST['pass'] | !$_REQUEST['pass2'] | !$fullname  | !$address | !$localgov | !$role | !$nationality | !$state) 

  { 
   setcookie($im,"Sorry ! You can only submit when all necessary fields have been  filled.",time()+5);
   ob_end_clean();
   header("location:staff_signup.php#logout_portal");
   exit; 
  }  

if ($_REQUEST['pass'] != $_REQUEST['pass2']) 
{
  
   setcookie($im,"Sorry! the password you entered did not match.",time()+5);
   ob_end_clean();
   header("location:staff_signup.php#logout_portal");
   exit; 
}


 
$usercheck = $name; 
$check = mysql_query("SELECT UserName FROM staff WHERE UserName = '$usercheck'") or die(mysql_error());
$check2 = mysql_num_rows($check);//if the name exists it gives an error
if ($check2 != 0) 
{
   
   setcookie($im,"Sorry, the username  ,$usercheck = $name;  is already in use.",time()+5);
   ob_end_clean();
   header("location:staff_signup.php#logout_portal");

   exit; 

} 

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
     
    if(!file_exists('uploads_staff/'.$name))
       {
          mkdir('uploads_staff/'.$name, 0755, true);




      $passloc="uploads_staff/$name/" . $_FILES["file"]["name"];
      $passloc_thumb="uploads_staff/$name/thumb". $_FILES["file"]["name"];
      move_uploaded_file($_FILES["file"]["tmp_name"],$passloc);


       
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
      


        
     
       }
     else
      {    

       $rename=uniqid($name);
     
     $passloc="uploads_staff/$name/" .$rename. $_FILES["file"]["name"];
     $passloc_thumb="uploads_staff/$name/thumb" .$rename. $_FILES["file"]["name"];
     move_uploaded_file($_FILES["file"]["tmp_name"],$passloc);



         
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




       }

     


    
  }
}


else
  {  

   if(!isset($_FILES["file"]["name"]))
{
   setcookie($im,"choose a photo first.",time()+5);
   ob_end_clean();
   header("location:staff_signup.php#logout_portal");
     exit; 
}


else
{

   setcookie($im,"Passport size too large or invalid file format.",time()+5);
   ob_end_clean();
   header("location:staff_signup.php#logout_portal");
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
date_default_timezone_set('Africa/Lagos');
$submitdate=date('l: Y-m-d ');
$time=date('h:i:s A');
$ip=$_SERVER['REMOTE_ADDR'];
$dbpassport_thumb=str_replace("uploads_staff/$name/","uploads_staff/$name/thumb",$passloc);
$dbpassport_thumb="../sms/$dbpassport_thumb";
$default_profile_pic="../sms/$passloc";  	
$insert = "INSERT INTO staff (UserName,PassWord,FullName,Class_taught,Address,Email,PhoneNumber,Sex,BirthDate,LocalGov,Passport,SubmitDate,ip,time,Role,Subject_taught,Nationality,State,Disability,staff_reg_id,classdivision) VALUES('$name','".$_REQUEST['pass']."','$fullname','$class','$address','$email','$number','$sex','$birth','$localgov','$passloc','$submitdate','$ip','$time','$role','$subject_taught','$nationality','$state','$disability','','$cd')";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 
else
{
$result=mysql_query("SELECT staffID FROM staff where UserName='$name'");
$validate = mysql_fetch_array($result);
$dbstdID=$validate['staffID'];
if($dbstdID < 10)
{
$subcode="000";
}
else if($dbstdID > 9)
{
$subcode="00";
}
else if($dbstdID > 99)
{
$subcode="0";
}
else
{
$subcode="";
}

$regno=date("Y").$subcode.$dbstdID."FGCS";
mysql_query("UPDATE staff SET `staff_reg_id`='$regno' WHERE UserName = '$name'") or die("error");
$date=date("Y/m/d");
if(isset($_SESSION['pin_staff']))
{ 
$pin=$_SESSION['pin_staff'];
mysql_query("INSERT INTO upin (pin,dateused) VALUES ('$pin','$date')");
mysql_query("DELETE  FROM bpin where PIN='$pin'");
}
mysql_close($con);
session_destroy();
echo " <p><font color=green size=5>Submission  successful,pls take note of your login details below:-<br/>USERNAME:$name<br/>PASSWORD:$pass</font></p><br/>
 <a href='index.php' >click here to register another staff</a>

";
}
?> 