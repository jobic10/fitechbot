<?php
require_once "../../start_custom_session.php";
require_once '../../Miscellaneous_Class.php';
$get_class_handle =new Miscellaneous_Class();
$err_f_cookie_name=$get_class_handle->err_f_cookie_name;
$fitech_get_arr=$get_class_handle->fitech_custom_input($_GET);
$nxt_index=50;
if(isset($fitech_get_arr['nxt']))
{
if(isset($_SESSION['return_row']))
{
 $_SESSION['return_row']=$_SESSION['return_row']+$nxt_index;
}  
else
{
$_SESSION['return_row']=($nxt_index*2);
}
}
elseif (isset($fitech_get_arr['prev']) && isset($_SESSION['return_row'])) 
{
if($_SESSION['return_row']>=($nxt_index*2))
{
 $_SESSION['return_row']=$_SESSION['return_row']-$nxt_index;
}
else
{
  unset($_SESSION['return_row']);
}
}
else
{
  unset($_SESSION['return_row']);
}
header("location:allstd.php");
?>