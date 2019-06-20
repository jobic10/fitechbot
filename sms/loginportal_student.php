<?php
    ob_start();
    require_once '../Classes/sessionBasics.php';
    $sessionB =new sessionBasics();
    require_once '../Classes/SqlBasics.php';
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    $logout_portal="error_report";
    $username=$gUI->getInputVal('username');
    $password=$gUI->getInputVal('password');
    if (!$username | !$password)
    {
    $f_cookie_msg="<font color='red'>Sorry!both username and password cannot be left blank.</font>";
    $gUI->redirPage($f_cookie_msg,"index.php#logout_portal"); 
    exit(); 
    }
    $sqlB =new SqlBasics("sms");
    if(isset($_SESSION['loginportal']))
    {
    $out= "<a href='../logout.php'><font size='5' color=red>click here to logout</font></a>";
    setcookie("logoff","You are already logged in. $out",time()+5);
    header("location:portal_student/portal.php");
    exit;
    }

    //$username=mysql_real_escape_string($username);   
    //$password=mysql_real_escape_string($password);

    $result=$sqlB->tmp_create_tb("SELECT * FROM students where UserName='$username'AND PassWord='$password'");
    $validate = $result->fetch_array();
    $dbusername=$validate['UserName'];
    $dbpassword=$validate['PassWord'];
    if ($result->num_rows>0)
    {
    $time=time();
    $ip=$_SERVER['REMOTE_ADDR'];
    $sqlB->tmp_create_tb("UPDATE students SET datetime= '$time',ip='$ip' WHERE UserName = '$dbusername'");

    /*/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $sqlB =new SqlBasics("rsp");
    $result_rsp=$sqlB->tmp_create_tb("SELECT PRESENTTERM,PRESENTYEAR FROM schinfo ");
    $validate= $result_rsp->fetch_array();
    $term=$validate['PRESENTTERM'];
    $termuse=$term;
    $term=strtolower($term);
    $pyear=$validate['PRESENTYEAR'];
    $pyear=trim($pyear);
    $table_name="e_tranzact_student_".$pyear."_".$term;
    $new_user_e_tranzact="CREATE TABLE IF NOT EXISTS `$table_name`(etranzactstudentID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(etranzactstudentID),UserName varchar(50),PassWord varchar(20),amount_paid varchar(20),paid_or_not varchar(20),term varchar(20),year varchar(50),time varchar(50),reg_status varchar(50))";
    $sqlB->tmp_create_tb($new_user_e_tranzact);
    $checkq = $sqlB->tmp_create_tb("SELECT UserName FROM `$table_name` WHERE UserName = '$dbusername'");
    if ($checkq->num_rows== 0) 
    {
    $time=time();
    $year=date("Y");
    $insert = "INSERT INTO `$table_name`(UserName,PassWord,amount_paid,paid_or_not,term,year,time,reg_status) VALUES('$dbusername','$dbpassword',' ','NO',' ','$year','$time','rip')";
    $sqlB->tmp_create_tb($insert);
    }
    $_SESSION['loginportal_tb']="$table_name";
    */////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    
    //$a=$sessionB->portalStudentSessionVars;
    $a=array("loginportal");
    $b=array($username);
    $c= array_combine($a, $b);
    $sessionB->set_custom_sesion($c);
    //$_SESSION['loginportal']="$username";
    ob_end_clean();
    header("location:portal_student/portal.php");
    }
    else
    {
    $gUI->trigCaptcha();
    $f_cookie_msg="<font color='red'>Sorry ! Make sure your username and password is entered correctly.</font>";
    $gUI->redirPage($f_cookie_msg,"index.php#logout_portal"); 
    exit();
    } 
?>
