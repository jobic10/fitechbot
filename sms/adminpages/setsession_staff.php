<?php
session_start();
if(isset($_SESSION['return_row_staff']))
{
 $_SESSION['return_row_staff']=$_SESSION['return_row_staff']+50;

}
  
else
{
$_SESSION['return_row_staff']=100;

}

header("location:allstd_staff.php");
?>