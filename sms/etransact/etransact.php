<?php
session_start();
if(!isset($_SESSION['role']) | !isset($_SESSION['etransact']))
{

header("location:index.php");
exit;

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



?>

<!DOCTYPE html>
<html>
<head>

<title><?php echo "$tray_contents -ETRANSACT";?></title>
<?php
  require_once '../header_sub_sms.php';  
?>
</head>


<body>



<body >

    
    
      <!-- TOP NAV WITH LOGO -->  
      <header>
          <div id='welcome_to_school'>
            <?php echo "E-TRANZACT AT $banner" ;?> 
         </div>
          <div id='school_slogan'>
              <marquee>   <?php echo "$tray_contents_overlay" ;?> </marquee>
         </div>
   

      </header>
    
    
      
    
      <div class="container">
          
      <div class="row">
          <div class="col-sm-12">
              

<div class="login_form_sms_header"><span><a href='../../admin/admin.php'>Back to the control Panel</a></span></div>


<div class='hold_sms_login_form'>


     
<span class="login_form_sms">
<form action="buypin.php" method="post" onsubmit="return confirm(' press OK if u are sure of the amount you order for')" >

<div class="form-group">
    <label class="text-primary" for="se1">choose the amount of pins to order:</label>
    <select class="form-control" name="pin" size="1">

<?php 
for ($x=1;$x<=500;$x++)
{

echo "<option size=34 value=".$x.">Order for ".$x. " PINS</option>";
}
?>


</select>
</div>

<div class="form-group">
<input class="btn btn-primary" style='float:right;' type='submit'  value="ORDER" name='submit'/>
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