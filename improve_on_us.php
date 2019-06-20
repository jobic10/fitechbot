<?php
require_once 'Classes/Miscellaneous_Class.php';
require_once 'timezone.php';
$date=date('l: Y-m-d ');
$time=date('h:i:s A');
$get_class_handle =new Miscellaneous_Class();
require_once 'Classes/SqlBasics.php';
$sqlB =new SqlBasics("cms");
$con=$sqlB->con;
$err_f_cookie_name=$get_class_handle->err_f_cookie_name;
$fitech_post_arr=$_FITECH_CLEAN_GET['POST']=$get_class_handle->fitech_custom_input($_POST);
//$prevent_url_submit=$get_class_handle->fitech_sanitate_str('post_submit');
if(!isset($fitech_post_arr['post_submit']) )
{
header("location:index.php");
exit;
}
if ($fitech_post_arr['guest_title'] =="" || $fitech_post_arr['guest_name'] == "" || $fitech_post_arr['guest_post']=="" )
{
setcookie("error_report","<font color='red'>None of the available fields can be left empty,please fill them and try again</font>",time()+5);
header('location:index.php?menuitem=Our contact Address&menuname=contacts#logout_portal');
exit;
}
$title=$get_class_handle->fitech_sanitate_str('guest_title');
$guest_name=$get_class_handle->fitech_sanitate_str('guest_name');
$guest_post=$get_class_handle->fitech_sanitate_str('guest_post');
$title=mysqli_real_escape_string($con,$title);
$guest_name=mysqli_real_escape_string($con,$guest_name);
$guest_post=mysqli_real_escape_string($con,$guest_post);
$sql = "INSERT INTO `guest_post` (`guest_name`,`guest_title`,`guest_post`,`time`,`date`) VALUES ('$guest_name','$title','$guest_post','$time','$date')";
$sqlB->tmp_create_tb($sql);
mysqli_close($con);
$admin_mail_add="admin@mail.com"; //this will be stored on the server as a session variable or in an sql db which can be editted from the admin back-end.
$msg_subject="$title";
$guest_msg="Attention Admin,$guest_name has just Submitted a post for Review:";
$sqlB->send_mail($admin_mail_add, $msg_subject, $guest_msg);
//mail($admin_mail_add,$msg_subject,$guest_msg,$msg_headers);
setcookie("error_report","<font color='green'>Thank you for contacting us,your point is <em>NOTED</em> we will get back to you ASAP !</font>",time()+5);
header('location:index.php?menuitem=Our contact Address&menuname=contacts#logout_portal');
exit;

?>
