<?php
ob_start();
session_start();
if(!isset($_SESSION['pin_student']))
{
ob_end_clean();
header("location:index.php");
exit;
}
else
{
$pin=$_SESSION['pin_student'];
}
require_once "../secreet/confidential/db_connection.php";
$return_con= db_connection("cms");
$con=$return_con[0];
require_once '../fbt_codes.php';
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<?php echo "<title>Student Registration @ $banner</title>";?>

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
     <script type="text/javascript" src="javascript/changeeventspix.js"></script>

      <!--[if lt IE 9]> 
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
      <![endif]--> 

 <?php  echo "<link rel='shortcut icon' type='image/x-icon' href='../admin/favicon/favicon.ico'/>";?>
  <script type="text/javascript" src="../js/function.js"></script>

</head>


<body>
    <?php
$return_con= db_connection("sms");
$con=$return_con[0];
    
$new_user="CREATE TABLE IF NOT EXISTS `students_save`(studentID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(studentID),UserName varchar(50),PassWord varchar(20),FullName varchar(50),Class varchar(50),Address varchar(400),Email varchar(100),PhoneNumber varchar(50),Sex varchar(50),BirthDate varchar(50),LocalGov varchar(50),Passport varchar(200),SubmitDate varchar(50),ip varchar(50),datetime varchar(50),datetime2 varchar(50),Pw varchar(50),Pn varchar(50),Nationality varchar(50),State varchar(50),Disability varchar(50),Sc varchar(20),RegNo varchar(50),classdivision varchar(50),reg_pin varchar(50))";
if (!mysql_query($new_user,$con))

{ 
 die("Error:table could not be created".mysql_error());
}

$query_pin = mysql_query("SELECT * FROM `students_save` WHERE reg_pin ='$pin'") or die(mysql_error());

$confirm_pin = mysql_num_rows($query_pin);



    ?>
    
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
                  if ($confirm_pin != 0) 
                  {
$get_info_from_db=  mysql_fetch_array($query_pin);
$saved_username= $get_info_from_db['UserName'];
$dbsurname=  $get_info_from_db['FullName'];
$dbclass=  $get_info_from_db['Class'];
$cd=  $get_info_from_db['classdivision'];
$dbaddress=  $get_info_from_db['Address'];
$dbemail=  $get_info_from_db['Email'];
$dbnumber=  $get_info_from_db['PhoneNumber'];
$dbsex=  $get_info_from_db['Sex'];
$dbbirth=  $get_info_from_db['BirthDate'];
$dblocalgov=  $get_info_from_db['LocalGov'];
$dbpassport=  $get_info_from_db['Passport'];
$dbpassword=  $get_info_from_db['PassWord'];
$dbsubmitdate=  $get_info_from_db['SubmitDate'];
$pw=  $get_info_from_db['Pw'];
$pn=  $get_info_from_db['Pn'];
$nationality=  $get_info_from_db['Nationality'];
$state=  $get_info_from_db['State'];
$disability=  $get_info_from_db['Disability'];
$date=  $get_info_from_db['SubmitDate'];
$regno=  $get_info_from_db['RegNo'];
$sc=  $get_info_from_db['Sc'];

                     echo  "  
<row> <div id='logout_portal' class='hold_sms_login_form'><div class='login_error'>
Welcome back  $saved_username,Continue with your registration.
</div></div></row> "; 
                      
                  }
 if(isset($_COOKIE['im']))
{
$logout_portal=$_COOKIE['im'];
echo  "  
<row> <div id='logout_portal' class='hold_sms_login_form'><div class='login_error'>

$logout_portal
</div></div></row> ";
} 
 ?>  
          <span id="form_con" class="login_form_sms">
    <form action="reg_student.php" method="post"  role="form" role="form" enctype="multipart/form-data" >

          <row>
              <div class="login_form_sms_header"><span>Please Kindly fill the form below, when you are done click submit</span></div>
               
        <div class="col-sm-6">
 <div class="hold_sms_login_form">

<div class='form-group'>
    <label class="text-primary" for="usr">choose your passport photograph:</label>
<input type='file' size='34' class="form-control" name='file' id='file'/><font color='green'>&nbsp*&nbsp.jpeg .png .gif
</div>



<div class='form-group'>
<label class='text-primary' for='usr'>Full Name:</label>
<input type='text' class='form-control'   <?php if($confirm_pin != 0){echo "value='$dbsurname' "; }?> placeholder='Your Name in Full' size='34' name='fullname' />

</div>
<div class='form-group'>
<label class='text-primary'>Username:</label>
<input type='text'   <?php if($confirm_pin != 0){echo "value='$saved_username' "; }?> placeholder='Choose a username' class='form-control' size='34' name='username'/><font color='blue'>
</div>


<div class='form-group'>
<label class='text-primary' for='pwd'>Password:</label>
<input type='password' class='form-control' size='34'   <?php if($confirm_pin != 0){echo "value=' $dbpassword  ' "; }?> placeholder='choose a password' name='pass'/><font color='blue'>
</div>

<div class='form-group'>
<label class='text-primary' for='usr'>Confirm Password:</label>
<input type='password' class='form-control'   <?php if($confirm_pin != 0){echo "value=' $dbpassword  ' "; }?> placeholder='Re-enter password' size='34' name='pass2'/>
</div>
     
<div class='form-group'>


<?php require_once 'class_list_sec.php';?>

</div>

                 

<div class='form-group'>

<label class='text-primary' for='usr'>Local Government:</label>
<input type='text' class='form-control'   <?php if ($confirm_pin != 0){echo " value='$dblocalgov'"; }?> placeholder='e.g Kabba/Bunu' size='34' name='localgov'/>
</div>





<div class='form-group'>
<label class='text-primary' for='usr'>Nationality:</label>
<input type='text' class='form-control'   <?php if($confirm_pin != 0){echo "value=' $nationality  ' "; }?> placeholder='Nigerian' value='Nigerian' size='34' name='nationality'/>
</div>


</div>
        </div>
             
        <div class='col-sm-6'>
<div class='hold_sms_login_form'>
<div class='form-group'>
<label class='text-primary' for='usr'>State of Origin:</label>
<input type='text' class='form-control'   <?php if($confirm_pin != 0){echo "value=' $state  ' "; }?> placeholder='Kogi state' size='34' name='state'/>
</div>




<div class='form-group'>
<label class='text-primary' for='usr'>SEX:</label>
<input type='radio' name='sex' value='MALE'  <?php if($confirm_pin != 0){ if($dbsex=='MALE'){echo 'checked';}} ?> >MALE
<input type='radio' name='sex' value='FEMALE' <?php if($confirm_pin != 0){if($dbsex=='FEMALE'){echo 'checked' ;}}else{echo "checked";} ?>  >FEMALE
</div>


<div class='form-group'>
<label class='text-primary' for='usr'>Disability:</label>
<input type='radio' name='disability' value='NO' <?php if($confirm_pin != 0){if($disability=='NO'){echo 'checked';}}else{echo "checked";} ?> >NO
<input type='radio' name='disability' value='YES'  <?php if($confirm_pin != 0){if($disability=='YES'){echo 'checked';}} ?> >YES

</div>



<div class='form-group'>
<label class='text-primary' for='usr'>Date of Birth:</label>
<input type='text' class='form-control'   <?php if($confirm_pin != 0){echo "value=' $dbbirth  ' "; }?> placeholder='e.g 11th Feb 1990' size='34' name='birth'/>
</div>


<div class='form-group'>
<label class='text-primary' for='usr'>Email Address:</label>
<input type='text'    <?php if($confirm_pin != 0){echo "value=' $dbemail  ' "; }?> placeholder='e.g ayologbon@gmail.com' class='form-control' size='34' name='email'/>
</div>



<div class='form-group'>
<label  class='text-primary' for='usr'>Permanent Address:</label>
<textarea name='address' class='form-control'     placeholder='Your permanent Home Address Here' rows='5' cols='37'><?php if($confirm_pin != 0){echo "$dbaddress"; }?></textarea>
</div>




<div class='form-group'>
<label class='text-primary' for='usr'> Student Phone Number:</label>
<input type='text' class='form-control'   <?php if($confirm_pin != 0){echo "value=' $dbnumber  ' "; }?> placeholder='e.g 07032067571' size='34' name='number'/>
</div>



<div class='form-group'>
<label class='text-primary' for='usr'> Parent/Guardian Number:</label>
<input type='text' class='form-control'   <?php if($confirm_pin != 0){echo "value=' $pn ' "; }?> placeholder='e.g 08034431549' size='34' name='pn'/>
</div>

<div class='form-group'>
<label class='text-primary' for='usr'> Parent/Guardian Profession:</label>
<input type='text' class='form-control'   <?php if($confirm_pin != 0){echo "value=' $pw  ' "; }?> placeholder='e.g Doctor' size='34' name='pw'/>
</div>


</div>
        </div>
            
             
          </row>
          <row>
              <div class="col-sm-12">
         <div class="hold_sms_login_form"> 
             <div class="table table-responsive">
 <?php require_once "subject_list_in_student_signup.php";?>
         </div>
<div class='form-group'>
   
    <input type="submit"  formaction="reg_student_save.php" class="btn btn-primary"    value="Save Application"/>
    <input class="btn btn-primary" style="float: right;" type="submit" value="Submit Form" name="submit"/>

</div>
        </div>
              </div>   
          </row>
          </form>
          </span>
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




    
