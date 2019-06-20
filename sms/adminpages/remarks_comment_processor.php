<?php
 session_start();
 $session_to_check=$_SESSION['session_to_check'];
 $term=$_SESSION['term_to_check'];
require_once "../../secreet/confidential/db_connection.php";
if($session_to_check=="rsp")
{
$return_con= db_connection("rsp");

}
else
{
  $return_con= db_connection($session_to_check);  
 
}
$con=$return_con[0];

$result=mysql_query("SELECT PRESENTTERM,PRESENTYEAR FROM `schinfo` ") or die("");

$validate= mysql_fetch_array($result);

$year=$validate['PRESENTYEAR'];

//$term=$validate['PRESENTTERM'];

$termuse=$term;

$term=strtolower($term);

  
//$year=date("Y");

$both="_".$year."_".$term;

$new_msg="CREATE TABLE IF NOT EXISTS `remarks$both`(remarksID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(remarksID),name varchar(200),regno varchar(50),class varchar(10),classdivision varchar(10),premarks varchar(500),fremarks varchar(500),sremarks varchar(50),ndp varchar(10),ndpt varchar(10),nda varchar(10))";
if (!mysql_query($new_msg,$con))

{ 
 die("Error:table could not be created".mysql_error());
} 

$class_in=$_REQUEST['class'];
$cd_in=$_REQUEST['cd'];

$result = mysql_query("SELECT * FROM `studentinfo` where class='$class_in' AND classdivision='$cd_in' ORDER BY `name` ASC ");
while($row = mysql_fetch_array($result))
  {

$sn=$row['name'];
$c=$row['class'];
$cd=$row['classdivision'];
$regno=$row['regno'];
$sn=strtoupper($sn);
$pri="premarks_".$regno;
$fri="fremarks_".$regno;
$sri="sremarks_".$regno;
$ni="sn_".$regno;
$ri="regno_".$regno;
$ndpi="ndp_".$regno;
$ndai="nda_".$regno;
$ndpti="ndpt_".$regno;
$ndp=$_REQUEST[$ndpi];
$ndpt=$_REQUEST[$ndpti];
$nda=$_REQUEST[$ndai];
$premarks=$_REQUEST[$pri];
$fremarks=$_REQUEST[$fri];
$sremarks=$_REQUEST[$sri];
$student_surname=$_REQUEST[$ni];
$incoming_regno=$_REQUEST[$ri];



//echo $regno . $incoming_regno . $student_surname .$premarks.$fremarks.$sremarks;


$result_remarks = mysql_query("SELECT regno FROM `remarks$both` where regno='$regno' ");
$check_no = mysql_num_rows($result_remarks);
if(mysql_num_rows($result_remarks)<1)
{
    
$insert_user = "INSERT INTO `remarks$both` (`name`,`regno`,`class`,`classdivision`,`premarks`,`fremarks`,`sremarks`,`ndp`,`ndpt`,`nda`) VALUES ('$student_surname','$incoming_regno','$class_in','$cd_in','$premarks','$fremarks','$sremarks','$ndp','$ndpt','0')";
if (!mysql_query($insert_user,$con))
{ 
 die("Error:Message could not be sent !".mysql_error());
} 

}
else
{

$udatesch=mysql_query("UPDATE `remarks$both` SET premarks='$premarks',fremarks='$fremarks',sremarks='$sremarks',ndp='$ndp',ndpt='$ndpt',nda='$nda' WHERE regno = '$incoming_regno'") or die(mysql_error());

}
  
  }  
  
  echo "<font color='green' size='5'> Comment/s has/have been made successfully ! </font>";