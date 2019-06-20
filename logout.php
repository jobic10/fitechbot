<?php
 
session_start(); 




















unset($_SESSION['user']);


unset($_SESSION['welcome']);







$_SESSION["logout"]="<font color='red'>You have been succesfully logged out</font>";



header('location:index.php');


 ?>



