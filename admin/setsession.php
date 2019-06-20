<?php
session_start();
if(isset($_SESSION['return_row']))
{
 $_SESSION['return_row']=$_SESSION['return_row']+50;

}
  
else
{
$_SESSION['return_row']=100;

}

header("location:allstd.php");
?>