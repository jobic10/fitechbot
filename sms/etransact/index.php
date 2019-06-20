<?php
session_start();
if(!isset($_SESSION['role']))
{

die("<font color=red size=12>access denied</font>");

}

require_once "../../secreet/confidential/db_connection.php";

$return_con= db_connection("cms");
$con=$return_con[0];

$result = mysql_query("SELECT * FROM `fbt`")  or die(mysql_error());

$validate = mysql_fetch_array($result);

$banner=$validate['banner'];
$footer=$validate['footer'];
$tray_contents=$validate['tray_contents'];
$tray_contents_overlay=$validate['tray_contents_overlay'];
$chat_icon=$validate['chat_icon'];
$chat_banner=$validate['chat_banner'];

$logo=$validate['site_logo'];

$logo_thumb=str_replace("website_logo/FITECH_BOT/","website_logo/FITECH_BOT/thumb",$logo);
$slogan=$validate['slogan'];
$about_chat=$validate['about_chat'];
 mysql_close($con);




$return_con= db_connection("sms");
$con=$return_con[0];


$sql="CREATE TABLE IF NOT EXISTS `epass` (PINID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(PINID),pass varchar(100))";

if (!mysql_query($sql,$con))
  {
  

echo "error bro";
exit;


  }



$new_msg="CREATE TABLE IF NOT EXISTS `newpin`(pinID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(pinID),pin varchar(50))";
if (!mysql_query($new_msg,$con))

{ 
 die("Error:table could not be created".mysql_error());
} 





$new_msg="CREATE TABLE IF NOT EXISTS `upin`(pinID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(pinID),pin varchar(50),dateused varchar(50))";
if (!mysql_query($new_msg,$con))

{ 
 die("Error:table could not be created".mysql_error());
} 



$new_msg="CREATE TABLE IF NOT EXISTS `bpin`(pinID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(pinID),pin varchar(50),datepurchased varchar(50))";
if (!mysql_query($new_msg,$con))

{ 
 die("Error:table could not be created".mysql_error());

}

$result = mysql_query("SELECT pass FROM `epass`")  or die(mysql_error());

if(mysql_num_rows($result)<1)
{





$insert = "INSERT INTO `epass`(pass) VALUES
('bankname')";

if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}


}



?>



<!DOCTYPE html>
<html lang="en-US">
<head>

<title><?php echo "$tray_contents -ETRANSACT";?> </title>
<?php
  require_once '../header_sub_sms.php';  
?>
</head>


<body >

    
    
      <!-- TOP NAV WITH LOGO -->  
      <header>
          <div id='welcome_to_school'>
            <?php echo "E-TRANZACT LOGIN AT $banner" ;?> 
         </div>
          <div id='school_slogan'>
              <marquee>   <?php echo "$tray_contents_overlay" ;?> </marquee>
         </div>
   

      </header>
    
    
      
    
      <div class="container">
          
                  <?php
                 if(isset($_COOKIE['etransact_error']))
{
$logout_portal=$_COOKIE['etransact_error'];
echo  "  
<row> <div id='logout_portal' class='hold_sms_login_form'><div class='login_error'>

$logout_portal
</div></div></row> ";
} 
                 if(isset($_COOKIE['etransact_empty']))
{
$logout_portal=$_COOKIE['etransact_empty'];
echo  "  
<row> <div id='logout_portal' class='hold_sms_login_form'><div class='login_error'>

$logout_portal
</div></div></row> ";
} 
                
                
 ?>  
          <div class="row">
          <div class="col-sm-12">
              

<div class="login_form_sms_header"><span><a href='../../admin/admin.php'>Back to the control Panel</a></span></div>


<div class="login_form_sms_header"><span>PLEASE ENTER IN THE FORM BELOW THE E-TRANZACT PASSWORD AND CLICK ON LOGIN</span></div>

          <div class='hold_sms_login_form'>


     
<span class="login_form_sms">
    <form  role='form' action='elogin.php' method='post'>
    
    <div class="form-group">
<label class="text-primary" for="pwd">E-TRANZACT PASSWORD:</label>
<input  type="password" class="form-control" id="pwd" placeholder="E-TRANZACT PASSWORD HERE"name='epin'/>
</div>
<div class="form-group">
<input class="btn btn-primary" style='float:right;' type='submit' value='Login' name='submit'/>
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