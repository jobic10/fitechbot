<?php
    ob_start();
    require_once '../Classes/sessionBasics.php';
    $sessionB =new sessionBasics();
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    unset($_SESSION["role"]);
    unset($_SESSION['welcome_admin']);
    //session_unset();
    if(isset($_COOKIE['remember_login']))
    {
    unset($_COOKIE['remember_login']);
    setcookie("remember_login", "", time() - 3600,'/');
    }
    $f_cookie_msg="<font color='lightgreen'>You have been succesfully logged out.</font>";
    $gUI->redirPage($f_cookie_msg,"index.php#logout_portal");   
    exit();
?>



