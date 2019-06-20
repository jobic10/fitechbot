<?php
    session_start();
    //require_once '../Classes/sessionBasics.php';
   //$sessionB =new sessionBasics();
    if(isset($_SESSION['welcome_sms']))
    {
    $_SESSION['welcome_sms']=$_SESSION['welcome_sms']+1;
    }
    else
    {
    $_SESSION['welcome_sms']=1;
    }
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();   
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    require_once "../fbt_codes.php";
    $sqlB =new SqlBasics("sms");
    if($sqlB->no_Tables())
    {
    require_once '../Classes/DirAndFiles.php';
    $DAF =new DirAndFiles();
    $zipFile=$DAF->sqlFiles."localhos_sms.zip";
    $a=$DAF->extractZip(dirname($zipFile).DIRECTORY_SEPARATOR,$zipFile); 
    $sqlB->importDb($a[0]);//$sqlB->tmp_create_tb($a[0]);
    unlink($a[0]);
    $sql="CREATE TABLE IF NOT EXISTS `students`(studentID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(studentID),UserName varchar(50),PassWord varchar(20),FullName varchar(50),Class varchar(10),Address varchar(400),Email varchar(100),PhoneNumber varchar(50),Sex varchar(50),BirthDate varchar(50),LocalGov varchar(50),Passport varchar(200),SubmitDate varchar(50),ip varchar(50),datetime varchar(50),datetime2 varchar(50),Pw varchar(50),Pn varchar(50),Nationality varchar(50),State varchar(50),Disability varchar(50),Sc varchar(20),RegNo varchar(50),classdivision varchar(50))";
    $sqlB->tmp_create_tb($sql);
    $sql="CREATE TABLE IF NOT EXISTS `staff`(staffID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(staffID),UserName varchar(50),PassWord varchar(50),FullName varchar(100),Class_taught varchar(50),Address varchar(500),Email varchar(100),PhoneNumber varchar(15),Sex varchar(10),BirthDate varchar(50),LocalGov varchar(50),Passport varchar(500),SubmitDate varchar(50),ip varchar(50),time varchar(50),Role varchar(50),Subject_taught varchar(50),Nationality varchar(50),State varchar(50),Disability varchar(50),staff_reg_id varchar(100),classdivision varchar(50))";
    $sqlB->tmp_create_tb($sql);
    $sql="CREATE TABLE IF NOT EXISTS `epass` (PINID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(PINID),pass varchar(100))";
    $sqlB->tmp_create_tb($sql);
    $sql="CREATE TABLE IF NOT EXISTS `newpin`(pinID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(pinID),pin varchar(50))";
    $sqlB->tmp_create_tb($sql);
    $sql="CREATE TABLE IF NOT EXISTS `upin`(pinID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(pinID),pin varchar(50),dateused varchar(50))";
    $sqlB->tmp_create_tb($sql);
    $sql="CREATE TABLE IF NOT EXISTS `bpin`(pinID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(pinID),pin varchar(50),datepurchased varchar(50))";
    $sqlB->tmp_create_tb($sql);
    $sql="CREATE TABLE IF NOT EXISTS `regpin`(regpinID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(regpinID),PIN varchar(50),schoolcode varchar(50))";
    $sqlB->tmp_create_tb($sql);
    $sql="CREATE TABLE IF NOT EXISTS `school_sub_list` (subID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(subID),subject varchar(300))";
    $sqlB->tmp_create_tb($sql);
    }
    ?>
    <!DOCTYPE html>
    <html lang="en-US">
    <head>
    <?php echo "<title>SCHOOL MANAGEMENT SYSTEM OF $banner</title>";
    require_once "../jss_css_dir.php.php";
    ?>
    </head>
    <body >
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
    <li><a href="confirmpin_student.php">REGISTRATION-NEW/FRESH STUDENTS</a></li>
    <li><a href="confirmpin_staff.php">STAFF REGISTRATION</a></li>
    <li><a href="../">GO BACK TO MAIN PORTAL</a></li> 
    </ul>
    </nav>
    </header>
    <div class="container">   
    <?php        
    require_once '../error_report.php';    
    ?>        
    <div class="row">
    <div class="col-sm-6">
    <?php        
    $htmlgen->createLoginPage($site_domain_scrp_img_chat,"loginportal_student.php","STUDENT LOGIN");
    ?>
    </div> 
    <div class="col-sm-6">         
    <?php    
    $img_src="../images/staff_login.png";
    $htmlgen->createLoginPage($site_domain_scrp_img_chat,"loginportal_staff.php","STAFF LOGIN","YES",$img_src);
    ?>        
    </div>
    </div>
    </div>               
    <?php
    require_once '../footer.php';
    if(isset($_SESSION['welcome_sms']))
    {
    if($_SESSION['welcome_sms']<2)
    {
    echo "
    <audio autoplay='true'>
    <source src='musics/song.ogg' type='audio/ogg'>
    Your browser does not support the audio element.
    </audio> ";  
    } 
    }
    ?>
    </body>
    </html>