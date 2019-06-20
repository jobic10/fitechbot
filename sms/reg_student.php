<?php 
ob_start();
session_start(); 
$im="im";
if (!isset($_POST['submit']))
{
echo "<font size=18 color=white>ACCESS DENIED</font>";
exit;
}
$max_width = "300";	
require_once '../resize_img_function.php';
require_once "../secreet/confidential/db_connection.php";
$return_con= db_connection("sms");
$con=$return_con[0];
$name=$_POST['username'];
$name=mysql_real_escape_string($name);
$class=$_POST['class'];
$address=$_POST['address'];
$address=mysql_real_escape_string($address);
$email=$_POST['email'];
$email=mysql_real_escape_string($email);
$number=$_POST['number'];
$sex=$_POST['sex'];
$birth=$_POST['birth'];
$localgov=$_POST['localgov'];
$pw=$_POST['pw'];
$pn=$_POST['pn'];
$state=$_POST['state'];
$nationality=$_POST['nationality'];
$disability=$_POST['disability'];
$cd=$_POST['cd'];
$fullname=$_REQUEST['fullname'];
$fullname=strtoupper($fullname);
$fullname=mysql_real_escape_string($fullname);
$pass=$_REQUEST['pass'];
$pass=mysql_real_escape_string($pass);
$name=trim($name);
$pass=trim($pass);
$pass25=$pass;
$name=strtolower($name);
while(strpos($name," ")!==false)
{
$name=str_replace(" ","",$name);

}
$arr=array("\r\n","\r","\n",""," ");

$name=str_replace($arr,"",$name);

$name25=$name;

if($email=="")
{

$email="Nill";

}


if($number=="")
{
$number="Nill";
}
if (!preg_match("/^[a-zA-Z ]*$/",$fullname)) 
 {
   setcookie($im,"Only letters and white space allowed in Fullname",time()+5);
   ob_end_clean();
   header("location:student_signup.php#logout_portal"); 
}
if (!$name || !$_POST['pass'] || !$_POST['pass2'] || !$fullname || !$class || !$address || !$localgov || !$pw || !$pn) 

  { 
   setcookie($im,"Sorry! You can only submit when all necessary fields have been  filled.",time()+5);
   ob_end_clean();
   header("location:student_signup.php#logout_portal");
   exit; 
  }  

if ($_POST['pass'] != $_POST['pass2']) 
{
   setcookie($im,"Sorry! the password you entered did not match.",time()+5);
   ob_end_clean();
   header("location:student_signup.php#logout_portal");
   exit; 
}
$usercheck = $name; 
$check = mysql_query("SELECT UserName FROM students WHERE UserName = '$usercheck'") or die(mysql_error());
$check2 = mysql_num_rows($check);
if ($check2 != 0) 
{
$person=$_REQUEST['username'];  
setcookie($im,"Sorry, the username  ,$person is already in use.",time()+5);
ob_end_clean();
header("location:student_signup.php#logout_portal");
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
    

        
    if(!file_exists('uploads/'.$name))
       {
          mkdir('uploads/'.$name, 0755, true);

       }


      $passloc="uploads/$name/" . $_FILES["file"]["name"];
      $passloc_thumb="uploads/$name/thumb". $_FILES["file"]["name"];
      move_uploaded_file($_FILES["file"]["tmp_name"],$passloc);

      $ext=pathinfo($passloc,PATHINFO_EXTENSION);
      $ext=strtolower($ext);
      rename($passloc,"uploads/$name/$name.".$ext);
      $passloc="uploads/$name/$name.".$ext;
       
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


else
  {  

   if(!isset($_FILES["file"]["name"]))
{

   setcookie($im,"choose a photo first.",time()+5);
   ob_end_clean();
   header("location:student_signup.php#logout_portal");
     exit; 
}


else
{
   setcookie($im,"Passport size too large or invalid file format.",time()+5);
   ob_end_clean();
   header("location:student_signup.php#logout_portal");
   exit; 
}
  }


$width =getWidth($passloc_thumb);
$height =getHeight($passloc_thumb);
 if($width>250)
 {
$scale= 0.1;
}
else if ($width>100)
{
$scale= 0.3;
}
else
{
$scale= 0.6;

}
$cropped = resizeImage($passloc_thumb,$width,$height,$scale);
$ext=pathinfo($cropped,PATHINFO_EXTENSION);
$ext=strtolower($ext);
rename($cropped,"uploads/$name/thumb$name.".$ext);
$cropped="uploads/$name/thumb$name.".$ext;
$ip=$_SERVER['REMOTE_ADDR'];
$time=time();
$submitdate=date("Y/m/d");
$dbpassport_thumb=str_replace("uploads/$name/","uploads/$name/thumb",$passloc);
$dbpassport_thumb="../sms/$dbpassport_thumb";
$default_profile_pic="../sms/$passloc"; 	
$insert = "INSERT INTO students (UserName,PassWord,FullName,Class,Address,Email,PhoneNumber,Sex,BirthDate,LocalGov,Passport,SubmitDate,ip,datetime,datetime2,Pw,Pn,Nationality,State,Disability,Sc,RegNo,classdivision) VALUES('$name','$pass','$fullname','$class','$address','$email','$number','$sex','$birth','$localgov','$passloc','$submitdate','$ip','$time','$time','$pw','$pn','$nationality','$state','$disability','1','','$cd')";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 

else
{
if($class=="JSS 1")
{
$subcode="01";
}
else if($class=="JSS 2")
{
$subcode="02";
}
else if($class=="JSS 3")
{
$subcode="03";
}
else if($class=="SSS 1")
{
$subcode="04";
}
else if($class=="SSS 2")
{
$subcode="05";
}
else
{
$subcode="06";
}
$result=mysql_query("SELECT studentID FROM students where UserName='$name'");
$validate = mysql_fetch_array($result);
$dbstdID=$validate['studentID'];
$regno=date("Y").$subcode.$dbstdID."FGC";
mysql_query("UPDATE students SET RegNo='$regno' WHERE UserName = '$name'") or die("error");
require_once "subjectlist_processor.php";
$return_con= db_connection("sms");
$con=$return_con[0];

$date=date("Y/m/d");

if(isset($_SESSION['pin_student']))
{
$pin=$_SESSION['pin_student'];
mysql_query("INSERT INTO `upin` (pin,dateused)
VALUES ('$pin','$date')");
mysql_query("DELETE  FROM bpin where PIN='$pin'");
$check = mysql_query("SELECT UserName FROM `students_save` WHERE reg_pin ='$pin'") or die(mysql_error());
$check2 = mysql_num_rows($check);
if ($check2 != 0) 
{
mysql_query("DELETE  FROM `students_save` WHERE reg_pin ='$pin'");
	
}
}
mysql_close($con);
session_destroy();

echo " <p><font color=green size=5>Submission  successful,You can now login to pay Your school fees,please take note of your login details below:-<br/>USERNAME:$name25<br/>PASSWORD:$pass25</font></p><br/>


 <a href='index.php' >click here to login</a>

";

  
  
}
?> 