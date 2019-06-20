<?php
session_start();
ob_start();
if(!isset($_SESSION['pin_staff']))
{
    ob_end_clean();
header("location:index.php");
exit;

}
require_once "../secreet/confidential/db_connection.php";
$return_con= db_connection("cms");
$con=$return_con[0];
require_once '../fbt_codes.php';
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<?php echo "<title>Staff Registration @ $banner</title>";?>

<meta content="text/html; charset=utf-8" http-equiv="Content-Type">

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

 <?php  echo "<link rel='shortcut icon' type='image/x-icon' href='../admin/favicon/favicon.ico'/>";?>
</head>
<body>

      <!-- TOP NAV WITH LOGO -->  
      <header>
          <div id='welcome_to_school'>
            <?php echo "SCHOOL MANAGEMENT SYSTEM OF $banner" ;?> 
         </div>
          <div id='school_slogan'>
              <marquee>   <?php echo " $tray_contents_overlay" ;?> </marquee>
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
 if(isset($_COOKIE['im']))
{
$logout_portal=$_COOKIE['im'];
echo  "  
<row> <div id='logout_portal' class='hold_sms_login_form'><div class='login_error'>

$logout_portal
</div></div></row> ";
} 
 ?>  
    
    <row>
        <div class="login_form_sms_header"><span>Please Kindly fill the form below, when you are done click submit</span></div>
        <form action="reg_staff.php" method="post"  role="form" role="form" enctype="multipart/form-data" >

        <div class="col-sm-6">
 <div class="hold_sms_login_form">

<div class='form-group'>
    <label class="text-primary" for="usr">choose your passport photograph:</label>
<input type='file' size='34' class="form-control" name='file' id='file'/><font color='green'>&nbsp*&nbsp.jpeg .png .gif
</div>


<div class='form-group'>
<label class="text-primary">Username:</label>
<input type="text" placeholder="Choose a username" class="form-control" size="34" name="username"/><font color='blue'>
</div>


<div class='form-group'>
<label class="text-primary" for='sel1'>Role in School:</label>
<select class="form-control" id="sel1" name="ris" size="1">
<option placeholder="none">SELECT YOUR ROLE IN SCHOOL BELOW</option>
<option  size="34"  value="HOD">HOD</option>
<option  size="34"  value="HOUSE MISTRESS">HOUSE MISTRESS</option>
<option  size="34"  value="SPORT MASTER">SPORT MASTER</option>
<option  size="34"  value="HOUSE MASTER">HOUSE MASTER</option>
<option  size="34"  value="FORM MASTER">FORM MASTER</option>
<option  size="34"  value="ELECTRICIAN">ELECTRICIAN</option>
<option  size="34"  value="PRINCIPAL">PRINCIPAL</option>
<option  size="34"  value="VICE PRINCIPAL ACAD">VICE PRINCIPAL ACAD 1</option>
<option  size="34"  value="VICE PRINCIPAL ACAD">VICE PRINCIPAL ACAD 2</option>
<option  size="34"  value="VICE PRINCIPAL ACAD">VICE PRINCIPAL ACAD 3</option>
<option  size="34"  value="VICE PRINCIPAL ADMIN">VICE PRINCIPAL ADMIN</option>
<option  size="34"  value="NURSE">NURSE</option>
<option  size="34"  value="MATRON">MATRON</option>
<option  size="34"  value="COOK">COOK</option>
<option  size="34"  value="TEACHER">TEACHER</option>
<option  size="34"  value="GATE MAN">GATE MAN</option>
<option  size="34"  value="CLERK">CLERK</option>
<option  size="34"  value="OTHERS">OTHERS</option>

</select>


</div>


<div class='form-group'>
<label class="text-primary" for="pwd">Password:</label>
<input type="password" class="form-control" size="34" placeholder="choose a password" name="pass"/><font color='blue'>
</div>

<div class='form-group'>
<label class="text-primary" for="usr">Confirm Password:</label>
<input type="password" class="form-control" placeholder="Re-enter password" size="34" name="pass2"/>
</div>

<div class='form-group'>

<label class="text-primary" for="usr">Local Government:</label>
<input type="text" class="form-control" placeholder="e.g Kabba/Bunu" size="34" name="localgov"/>
</div>





<div class='form-group'>
<label class="text-primary" for="usr">Nationality:</label>
<input type="text" class="form-control" placeholder="Nigerian" value="Nigerian" size="34" name="nationality"/>
</div>


<div class='form-group'>
<label class="text-primary" for="usr">Full Name:</label>
<input type="text" class="form-control" placeholder="Your Name in Full" size="34" name="fullname" />

</div>
</div>
        </div>
             
        <div class="col-sm-6">
<div class="hold_sms_login_form">
<div class='form-group'>
<label class="text-primary" for="usr">State of Origin:</label>
<input type="text" class="form-control" placeholder="Kogi state" size="34" name="state"/>
</div>




<div class='form-group'>
<label class="text-primary" for="usr">SEX:</label>
<input type="radio" name="sex" value="MALE" checked>MALE
<input type="radio" name="sex" value="FEMALE">FEMALE
</div>


<div class='form-group'>
<label class="text-primary" for="usr">Disability:</label>
<input type="radio" name="disability" value="NO" checked>NO
<input type="radio" name="disability" value="YES">YES

</div>



<div class='form-group'>
<label class="text-primary" for="usr">Date of Birth:</label>
<input type="text" class="form-control" placeholder="e.g 11th Feb 1990" size="34" name="birth"/>
</div>


<div class='form-group'>
<label class="text-primary" for="usr">Email Address:</label>
<input type="text"  placeholder="e.g ayologbon@gmail.com" class="form-control" size="34" name="email"/>
</div>



<div class='form-group'>
<label  class="text-primary" for="usr">Permanent Address:</label>
<textarea name="address" class="form-control"  placeholder="Your permanent Home Address Here" rows="5" cols="37"></textarea>
</div>




<div class='form-group'>
<label class="text-primary" for="usr"> Staff Phone Number:</label>
<input type="text" class="form-control" placeholder="e.g 07032067571" size="34" name="number"/>
</div>




<div class='form-group'>
 <input class="btn btn-primary" type="reset" value="Reset"/>
<input class="btn btn-primary" type="submit" value="Submit Form" name="submit"/>

</div>
</div>
        </div>
            </form>
         </row>
</div>
   



     <footer>
         <div class="line">
            <div class="s-12 l-6">
                <?php $year=date('Y')?>
               <p> <?php echo "Copyright $year, $banner";?>
               </p>
            </div>
              
            </div>
             
            <div class="s-12 l-6">
               <p class="right">
               <div id='fitech_ng'></div>
                  <a class="right" href="#fitech_ng" title="Responsee - lightweight responsive framework">POWERED BY <?php echo "$footer";?></a>
               </p>
            </div>
         
      </footer> 
      
</body>


</html>