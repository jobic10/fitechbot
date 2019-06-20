<?php 
    require_once 'redir_admin.php';
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    $con=$sqlB->con;
    require_once '../Classes/DirAndFiles.php';
    $DAF =new DirAndFiles();
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    $admin_username=$gUI->getInputVal('admin_username');
    $admin_password_old=$gUI->getInputVal('admin_password_old');
    $admin_password=$gUI->getInputVal('admin_password');
    $admin_password_second=$gUI->getInputVal('admin_password_second');
    if(!$admin_username || !$admin_password || !$admin_password_second)
    {
    $f_cookie_msg="<font color='red'>Sorry ! You must fill all the fields first.</font>";
    $gUI->redirPage($f_cookie_msg,"change_pass.php#logout_portal"); 
    exit();  
    }
    $result3=$sqlB->tmp_create_tb("SELECT adminpassword FROM `admin` where adminpassword='$admin_password_old'");
    if ($result3->num_rows<1)
    {
    $f_cookie_msg="<font color='red'>Sorry ! The Current Admin Password you entered is incorrect.</font>";
    $gUI->redirPage($f_cookie_msg,"change_pass.php#logout_portal"); 
    exit();
    }
    if($admin_password!==$admin_password_second)
    {
    $f_cookie_msg="<font color='red'> Sorry the password you entered did not match.</font>";
    $gUI->redirPage($f_cookie_msg,"change_pass.php#logout_portal"); 
    exit();  
    }
    $sqlB->tmp_create_tb("UPDATE `admin` SET adminursername='$admin_username',adminpassword='$admin_password' WHERE adminID = '1'");
    echo "<font color='green' size='6'>ADMIN CREDENTIALS HAVE BEEN SUCCESSFULLY UPDATED</font>";
    $name_of_site=filter_input(INPUT_SERVER,'SERVER_NAME',FILTER_SANITIZE_STRING);
    $admin_mail_add="ayologbon4@gmail.com";
    $msg_subject="Change of admin credentials from". strtoupper($name_of_site)." .";
    $guest_msg="This message is to alert you that the admin credentials have just been changed"."\r\n"."Admin Username:$admin_username"."\r\n"."Admin Password:$admin_password"."\r\n"."On:$date @: $time";
    $sqlB->send_mail($admin_mail_add, $msg_subject, $guest_msg);
    ///////////////////////reload Db/////
    $sqlDir=$DAF->sqlFiles;
    $source_of_file=$sqlB->exportDb($sqlDir);
?> 
