<?php
require_once "../secreet/confidential/db_connection.php";
$return_con= db_connection("sms");
$con=$return_con[0];


$check = mysql_query("SELECT * FROM students ") or die(mysql_error());

while($row_algorithms = mysql_fetch_array($check))
{

$passloc=$row_algorithms['Passport'];
$name=$row_algorithms['UserName'];
$sex=$row_algorithms['Sex'];
$regno=$row_algorithms['RegNo'];
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
            
 $passloc="uploads/$name/"."$name.".$ext;          

mysql_query("UPDATE students SET Passport='$passloc' WHERE regno ='$regno'");   

       }
    

else
{
if($sex=="MALE")
{

$passloc="default/defaultboy.jpg";


}
else
{

$passloc="default/defaultgirl.jpg";

}
mysql_query("UPDATE students SET Passport='$passloc' WHERE UserName ='$name'");



}

  /*
$return_con= db_connection("rsp");
$con=$return_con[0];

mysql_query("UPDATE studentinfo SET passport='$passloc' WHERE regno ='$regno'");

*/

}
?>