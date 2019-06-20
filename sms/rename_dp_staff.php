<?php



require_once "../secreet/confidential/db_connection.php";
$return_con= db_connection("sms");
$con=$return_con[0];


$check = mysql_query("SELECT * FROM staff ") or die(mysql_error());

while($row_algorithms = mysql_fetch_array($check))
{

$passloc=$row_algorithms['Passport'];
$name=$row_algorithms['UserName'];
$sex=$row_algorithms['Sex'];
$passloc_thumb=str_replace("uploads_staff/$name/","uploads_staff/$name/thumb",$passloc);

//echo $passloc_thumb ."<br/>" ;
if(file_exists($passloc))
       {
$ext=pathinfo($passloc,PATHINFO_EXTENSION);
      $ext=strtolower($ext);
      rename($passloc,"uploads_staff/$name/"."$name.".$ext);
      $passloc="uploads_staff/$name/"."$name.".$ext;
    
      rename($passloc_thumb,"uploads_staff/$name/thumb"."$name.".$ext);
      $passloc_thumb="uploads_staff/$name/thumb"."$name.".$ext;
            
           
mysql_query("UPDATE staff SET Passport='$passloc' WHERE UserName ='$name'");
 
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
mysql_query("UPDATE staff SET Passport='$passloc' WHERE UserName ='$name'");



}
       
}
?>