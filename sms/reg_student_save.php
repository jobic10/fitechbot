<?php 
session_start(); 
if(!isset($_SESSION['pin_student']))
{


echo "<font size=18 color=white>ACCESS DENIED</font>";
exit;

}
 $reg_pin=$_SESSION['pin_student'];



$max_width = "300";	



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

$ip=$_SERVER['REMOTE_ADDR'];
$time=time();
$submitdate=date("Y/m/d");

if($email=="")
{

$email="Nill";

}


if($number=="")
{
$number="Nill";
}

$passloc="not uploaded yet";


$new_user="CREATE TABLE IF NOT EXISTS `students_save`(studentID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(studentID),UserName varchar(50),PassWord varchar(20),FullName varchar(50),Class varchar(50),Address varchar(400),Email varchar(100),PhoneNumber varchar(50),Sex varchar(50),BirthDate varchar(50),LocalGov varchar(50),Passport varchar(200),SubmitDate varchar(50),ip varchar(50),datetime varchar(50),datetime2 varchar(50),Pw varchar(50),Pn varchar(50),Nationality varchar(50),State varchar(50),Disability varchar(50),Sc varchar(20),RegNo varchar(50),classdivision varchar(50),reg_pin varchar(50))";
if (!mysql_query($new_user,$con))

{ 
 die("Error:table could not be created".mysql_error());
}

$check = mysql_query("SELECT UserName FROM `students_save` WHERE reg_pin ='$reg_pin'") or die(mysql_error());
$check2 = mysql_num_rows($check);
if ($check2 != 0) 
{
mysql_query("DELETE  FROM `students_save` WHERE reg_pin ='$reg_pin'");
	
$insert = "INSERT INTO `students_save` (UserName,PassWord,FullName,Class,Address,Email,PhoneNumber,Sex,BirthDate,LocalGov,Passport,SubmitDate,ip,datetime,datetime2,Pw,Pn,Nationality,State,Disability,Sc,RegNo,classdivision,reg_pin) VALUES('$name','$pass','$fullname','$class','$address','$email','$number','$sex','$birth','$localgov','$passloc','$submitdate','$ip','$time','$time','$pw','$pn','$nationality','$state','$disability','1','','$cd','$reg_pin')";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 
}
else
{
	
$insert = "INSERT INTO `students_save` (UserName,PassWord,FullName,Class,Address,Email,PhoneNumber,Sex,BirthDate,LocalGov,Passport,SubmitDate,ip,datetime,datetime2,Pw,Pn,Nationality,State,Disability,Sc,RegNo,classdivision,reg_pin) VALUES('$name','$pass','$fullname','$class','$address','$email','$number','$sex','$birth','$localgov','$passloc','$submitdate','$ip','$time','$time','$pw','$pn','$nationality','$state','$disability','1','','$cd','$reg_pin')";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 
}

 
 

   setcookie("ef","Your application was saved successfully !",time()+5);

   header("location:student_signup.php#logout_portal");



   exit; 

?> 