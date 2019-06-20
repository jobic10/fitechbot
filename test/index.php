<?php 

session_start(); 

if (!isset($_SESSION["role"])) 
                                
 
{
           
session_destroy();

header("location:../index.php");

}
else
{

 echo "<font size='8'>Sorry Directory Idexing has been disabled by the Developer</font>";

}

?>