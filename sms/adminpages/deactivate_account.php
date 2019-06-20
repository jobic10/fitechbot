<?php
$regno=$_REQUEST['regno'];
$password=$_REQUEST['password'];

$regnosession=strtolower($regno);

require_once "../../secreet/confidential/db_connection.php";

$return_con= db_connection("sms");
$con=$return_con[0];
if (strpos($password,"_ex_5%*j")!==false)
{

$password=str_replace("_ex_5%*j","",$password);
  
mysql_query("UPDATE `students` SET PassWord = '$password'  WHERE RegNo='$regno'");
    
}
 else 
     
     {
      $password=$password."_ex_5%*j";
      
      mysql_query("UPDATE `students` SET PassWord = '$password'  WHERE RegNo='$regno'");
 
     }





?>