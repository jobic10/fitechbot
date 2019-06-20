<?php
session_start();
if(isset($_SESSION['pin_staff']))
{
header("location:staff_signup.php");
exit;
}
require_once "../secreet/confidential/db_connection.php";
$return_con= db_connection("cms");
$con=$return_con[0];
require_once "../fbt_codes.php";
mysql_close($con);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<?php echo "<title>Staff Registration @ $banner</title>
<link rel='shortcut icon' type='image/x-icon' href='../admin/favicon/favicon.ico'/>";
?>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" type="text/css" href="css/welcomemsg.css" />
<script type="text/javascript" src="javascript/welcomemsg.js"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/components.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="../css/menu.css">
<link rel="stylesheet" href="../css/template-style.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/modernizr.js"></script>  
<script type="text/javascript" src="../js/bootstrap.min.js"></script> 
<script type="text/javascript" src="../js/jquery.js"></script>   
<script type="text/javascript" src="../js/function.js"></script>
      <!--[if lt IE 9]> 
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
      <![endif]--> 
</head>
<body >
      <!-- TOP NAV WITH LOGO -->  
      <header>
          <div id='welcome_to_school'>
            <?php echo "STAFF REGISTRATION AT $banner" ;?> 
         </div>
          <div id='school_slogan'>
              <marquee>   <?php echo "$tray_contents_overlay" ;?> </marquee>
         </div>
   
			<a class="logo" href="#"><a id="menu-toggle" class="button dark" href="#"><i class="icon-reorder"></i></a></a>
			
			<nav id="navigation">
                            
           <ul id="main-menu">


<li><a href="index.php">GO BACK TO THE SCHOOL MANAGEMENT SYSTEM</a></li> 
</ul>


			</nav>

      </header>
    
    
      
    
      <div class="container">
          
                  <?php
if(isset($_COOKIE['up']))
{
$logout_portal=$_COOKIE['up'];
echo  "  
<row> <div id='logout_portal' class='hold_sms_login_form'><div class='login_error'>
$logout_portal
</div></div></row> ";
}
 ?>  
 <div class="row">
 <div class="col-sm-12">
<div class="login_form_sms_header">
    <span>PLEASE ENTER IN THE FORM BELOW THE SCHOOL CODE AND THE PIN ISSUED TO YOU BY THE SCHOOL AUTHORITY
    </span>
</div>
<div class='hold_sms_login_form'>    
<span class="login_form_sms">
<form  role='form' action='validatepin_staff.php' method='post'>
    <div class="form-group">
<label class="text-primary" for="usr">School Code:</label>
<input type="text"  class="form-control" id="usr" placeholder="Enter School code here" name='schoolcode'/>
</div>
    <div class="form-group">
<label class="text-primary" for="pwd">PIN:</label>
<input  type="password" class="form-control" id="pwd" placeholder="Enter PIN here" name='pin'/>
</div>
<div class="form-group">
<input class="btn btn-primary" style='float:right;' type='submit' value='Start registration' name='submit'/>
</div>
</form>
</span>
          </div>
          </div>
          </div>
      </div>  
      
     <footer>
         <div class="line">
            <div class="s-12 l-6">
                <?php $year=date('Y')?>
               <p> <?php echo "Copyright © $year, $banner";?>
               </p>
            </div>
              
            </div>
             
            <div class="s-12 l-6">
               <p class="right">
               <div id='fitech_ng'></div>
                  <a class="right" href="#fitech_ng" >POWERED BY <?php echo "$footer";?></a>
               </p>
            </div>
         
      </footer> 
      
</body>


</html>