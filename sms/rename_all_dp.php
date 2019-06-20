<?php
require_once "../secreet/confidential/db_connection.php";
$return_con= db_connection("sms14");
$con=$return_con[0];
$check = mysql_query("SELECT UserName,Passport FROM students ") or die(mysql_error());

while($row_algorithms = mysql_fetch_array($check))
{

$passloc=$row_algorithms['Passport'];
$name=$row_algorithms['UserName'];

$passloc_thumb=str_replace("uploads/$name/","uploads/$name/thumb",$passloc);

//echo $passloc_thumb ."<br/>" ;
if(file_exists($passloc))
       {
$ext=pathinfo($passloc,PATHINFO_EXTENSION);
      $ext=strtolower($ext);
      rename($passloc,"uploads/$name/"."$name.".$ext);
      $passloc="uploads/$name/"."$name.".$ext;
    
      rename($passloc_thumb,"uploads/$name/thumb"."$name.".$ext);
      $passloc_thumb="uploads/$name/thumb"."$name.".$ext;
            
           
mysql_query("UPDATE students SET Passport='$passloc' WHERE UserName ='$name'");
 
       }
       
}
?>