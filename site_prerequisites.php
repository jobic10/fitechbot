<?php
require_once "Classes/Mobile_Detect.php";
require_once "Classes/Miscellaneous_Class.php";
require_once 'Classes/GetUserInputs.php';
$gUI =new GetUserInputs();
require_once "Classes/share.php";
require_once 'Classes/HtmlGen.php';
$htmlgen =new HtmlGen();
require_once 'Classes/SqlBasics.php';
$get_class_handle =new Miscellaneous_Class();
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$mobilegrade = $detect->getUserAgent();
ob_clean();
if(isset($_SESSION['welcome']))
{
 $_SESSION['welcome']=$_SESSION['welcome']+1;
}
else
{
$_SESSION['welcome']=1;
}
session_write_close();
//require_once "Classes/functions/get_site_domain_url.php";
$site_domain=$gUI->get_site_domain_url(NULL); 
$site_sharer=$gUI->get_site_domain_url(NULL,"test");
/////////////////////////////////loadbotDBFromServer//////////////////////////////////////////////////
$sqlB =new SqlBasics("bot");
if($sqlB->no_Tables())
{
require_once 'Classes/DirAndFiles.php';
$DAF =new DirAndFiles();
$zipFile=$DAF->sqlFiles."localhos_bot.zip"; //rootDir
$a=$DAF->extractZip(dirname($zipFile).DIRECTORY_SEPARATOR,$zipFile); 
$sqlB->importDb($a[0]);
//filesize($zipFile);
unlink($a[0]);
}
/*//////////////////////////////////////////////////////////////////////////////////
$sqlB =new SqlBasics("chat");
$con=$sqlB->con;
require_once 'Classes/DirAndFiles.php';
$DAF =new DirAndFiles();
$sqlDir=$DAF->sqlFiles;
$source_of_file=$sqlB->exportDb($sqlDir);
/*$ext=pathinfo($source_of_file,PATHINFO_EXTENSION);
$dest=  str_replace($ext,"zip", $source_of_file);
$files_to_zip = array($source_of_file);
$DAF->zipFile($files_to_zip,$dest);
unlink($source_of_file);
*///////////////////////////////////////////////////////////////////////////////////

$sqlB =new SqlBasics("cms");
$con=$sqlB->con;
if($sqlB->no_Tables())
{
require_once 'Classes/DirAndFiles.php';
$DAF =new DirAndFiles();
$zipFile=$DAF->sqlFiles."localhos_cms.zip";
$a=$DAF->extractZip(dirname($zipFile).DIRECTORY_SEPARATOR,$zipFile); 
$sqlB->importDb($a[0]);//$sqlB->tmp_create_tb($a[0]);
unlink($a[0]);
}
else 
{
$sql_ltv="CREATE TABLE IF NOT EXIST `ltv` (ltvID int NOT NUL AUTO_INCREMENT,PRIMARY KEY(ltvID),";

$sql="CREATE TABLE IF NOT EXISTS `owe_photo` (photoID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(photoID),menuname varchar(100),caption text(1000),photo varchar(500))";
$sqlB->tmp_create_tb($sql);

$sql="CREATE TABLE IF NOT EXISTS `news_and_adverts` (news_and_advertsID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(news_and_advertsID),contents text(30000),`time` varchar(100),`time2` varchar(100),`date` varchar(100))";
$sqlB->tmp_create_tb($sql);

$sql="CREATE TABLE IF NOT EXISTS `admin` (adminID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(adminID),`adminursername` varchar(300),`adminpassword` varchar(50),`role` varchar(50),`datetime` varchar(50))";
$sqlB->tmp_create_tb($sql);

$sql="CREATE TABLE IF NOT EXISTS `fbt` (itemID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(itemID),`banner` varchar(300),`footer` varchar(500),`tray_contents` text(5000),`tray_contents_overlay` text(5000),`site_logo` varchar(500),`chat_banner` varchar(500),`chat_icon` varchar(500),`about_chat` text(5000),`slogan` varchar(500))";
$sqlB->tmp_create_tb($sql);

$sql="CREATE TABLE IF NOT EXISTS `guest_post`(postID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(postID),guest_name varchar(50),guest_title varchar(100),guest_post text(2000),time varchar(50),date varchar(50))";
$sqlB->tmp_create_tb($sql);

$sql="CREATE TABLE IF NOT EXISTS `media_files` (mediaID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(mediaID),media_url varchar(500),`media_caption` varchar(500),`time` varchar(500),`time2` varchar(500),`date` varchar(500))";
$sqlB->tmp_create_tb($sql);
   

$sql="SELECT * FROM `fbt`";
$result=$sqlB->tmp_create_tb($sql);
$validatefbt =$result->num_rows;
if($validatefbt<1)
{
require_once "msg.php";
$msg=$gUI->ppbs($msg);
$msg=  mysqli_real_escape_string($con,$msg);
$caption="thank you for using our CMS known as Fitech_bot,regards from Fitech Team";
$passloc11="owe/FITECH_BOT/banner.jpg";	
$insert = "INSERT INTO `owe_photo`(menuname,caption,photo) VALUES('home','$caption','$passloc11')";
$sqlB->tmp_create_tb($insert);
require_once "time_and_date.php";
$contents="you can use this place for daily news and adverts,regards from Fitech Team";
$insert = "INSERT INTO `news_and_adverts`(contents,time,time2,date) VALUES
('$contents','$time','$time2','$date')";
$sqlB->tmp_create_tb($insert);
$f_rand_id=uniqid(rand());
$hashed_id="admin".$f_rand_id;
$hashed_usr=  md5($hashed_id);
$hashed_usr=  substr($hashed_usr,0,11);
$insert = "INSERT INTO `admin`(adminursername,adminpassword,role,datetime) VALUES
('admin','$hashed_usr','Super Administrator','')";
$sqlB->tmp_create_tb($insert);
$temp_link="website_logo/FITECH_BOT/websitelogo.jpg";
$insert = "INSERT INTO `fbt`(banner,footer,tray_contents,tray_contents_overlay,site_logo,chat_banner,chat_icon,about_chat,slogan) VALUES ('site banner here','site footer here','$msg','$msg','$temp_link','$msg','name of chat','$msg','Hello World! My name is Fitechbot.')";
$sqlB->tmp_create_tb($insert);
$sql="CREATE TABLE IF NOT EXISTS `menubar` (menubarID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(menubarID),name_of_menubar varchar(500),`default_menubar_item` varchar(100),`time` varchar(100),`time2` varchar(100),`date` varchar(100))";
$sqlB->tmp_create_tb($sql);
//$tbname="menubar";
//$fn1="time";$fn2="time";$fn3="time";
//$dtp="varchar (100)";
//$sqlB->altTbAddCol($tbname,$fn,$dtp);$sqlB->altTbAddCol($tbname,$fn2,$dtp);$sqlB->altTbAddCol($tbname,$fn3,$dtp);
$sql="CREATE TABLE IF NOT EXISTS `baby_sub_item`(subitemID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(subitemID),contents text(20000),`name_of_subitem` varchar(500),`name_of_babysubitem` varchar(500))";
$sqlB->tmp_create_tb($sql);
$result9 = $sqlB->tmp_create_tb("SELECT * FROM `menubar` where name_of_menubar='home' ")  or die(mysqli_error());
$validate = mysqli_num_rows($result9);
if($validate<1)
{
$insert = "INSERT INTO `menubar`(name_of_menubar,default_menubar_item,time,time2,date) VALUES
('home','sub-item 1','$time','$time2','$date')";
$sqlB->tmp_create_tb($insert);
$sql="CREATE TABLE IF NOT EXISTS `home`(menubarID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(menubarID),contents text(20000),`menu` varchar(100),`linkname` varchar(100))";
$sqlB->tmp_create_tb($sql);
$menuitem="Welcome Remarks";
$menuitem1="Mission and Vission Statements";
$smsg="$menuitem \n $msg";
$smsg1="$menuitem1 \n $msg
";
$insert = "INSERT INTO `home`(contents,menu,linkname) VALUES
('$smsg','home','$menuitem'),
('$smsg1','home','$menuitem1'),";
$InsertQryValPatt="('','home','')";
$insert.=$sqlB->genInsertSqlValPatt($InsertQryValPatt,8);
$sqlB->tmp_create_tb($insert);
if($menuitem!=='')
{
$insert = "INSERT INTO `baby_sub_item`(contents,name_of_subitem,name_of_babysubitem) VALUES
('$msg','$menuitem',''),";
$InsertQryValPatt="('','$menuitem','')";
$insert.=$sqlB->genInsertSqlValPatt($InsertQryValPatt,9);
$sqlB->tmp_create_tb($insert);
}
if($menuitem1!=='')
{
$insert = "INSERT INTO `baby_sub_item`(contents,name_of_subitem,name_of_babysubitem) VALUES
('$msg','$menuitem1',''),";
$InsertQryValPatt="('','$menuitem1','')";
$insert.=$sqlB->genInsertSqlValPatt($InsertQryValPatt,9);
$sqlB->tmp_create_tb($insert);
}

}
$sql="CREATE TABLE IF NOT EXISTS `about us`(menubarID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(menubarID),contents text(20000),`menu` varchar(100),`linkname` varchar(100))";
$sqlB->tmp_create_tb($sql);
$result9 = $sqlB->tmp_create_tb("SELECT * FROM `menubar` where name_of_menubar='about us' ")  or die(mysqli_error());
$validate = mysqli_num_rows($result9);
if($validate<1)
{
$insert = "INSERT INTO `menubar`(name_of_menubar,default_menubar_item) VALUES
('about us','sub-item 1')";
$sqlB->tmp_create_tb($insert);
$menuitem="about us";
$smsg="$menuitem \n $msg";
$insert = "INSERT INTO `about us`(contents,menu,linkname) VALUES
('$smsg','about us','$menuitem'),";
$InsertQryValPatt="('','about us','')";
$insert.=$sqlB->genInsertSqlValPatt($InsertQryValPatt,9);
$sqlB->tmp_create_tb($insert);
if($menuitem!=='')
{
$insert = "INSERT INTO `baby_sub_item`(contents,name_of_subitem,name_of_babysubitem) VALUES
('$msg','$menuitem',''),";
$InsertQryValPatt="('','$menuitem','')";
$insert.=$sqlB->genInsertSqlValPatt($InsertQryValPatt,9);
$sqlB->tmp_create_tb($insert);
}
}

$result9 = $sqlB->tmp_create_tb("SELECT * FROM `menubar` where name_of_menubar='contacts' ")  or die(mysqli_error());
$validate = mysqli_num_rows($result9);
if($validate<1)
{
$insert = "INSERT INTO `menubar`(name_of_menubar,default_menubar_item) VALUES
('contacts','sub-item 1')";
$sqlB->tmp_create_tb($insert);
$sql="CREATE TABLE IF NOT EXISTS `contacts`(menubarID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(menubarID),contents text(20000),`menu` varchar(100),`linkname` varchar(100))";
$sqlB->tmp_create_tb($sql);
$menuitem="Our contact Address";
$smsg="$menuitem \n $msg";
$menuitem="Our contact Address";
$sql = "INSERT INTO `contacts`(contents,menu,linkname) VALUES
('$smsg','contacts','$menuitem'),";
$InsertQryValPatt="('','$menuitem','')";
$sql.=$sqlB->genInsertSqlValPatt($InsertQryValPatt,9);
$sqlB->tmp_create_tb($sql);
if($menuitem!=='')
{
$sql = "INSERT INTO `baby_sub_item`(contents,name_of_subitem,name_of_babysubitem) VALUES
('$msg','$menuitem',''),";
$InsertQryValPatt="('','$menuitem','')";
$sql.=$sqlB->genInsertSqlValPatt($InsertQryValPatt,9);
$sqlB->tmp_create_tb($sql);
}
}
$sql="CREATE TABLE IF NOT EXISTS `gallery`(menubarID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(menubarID),contents text(20000),`menu` varchar(100),`linkname` varchar(100))";
$sqlB->tmp_create_tb($sql);
$result9 =$sqlB->tmp_create_tb("SELECT * FROM `menubar` where name_of_menubar='gallery' ")  or die(mysqli_error());
$validate = mysqli_num_rows($result9);
if($validate<1)
{
$insert = "INSERT INTO `menubar`(name_of_menubar,default_menubar_item) VALUES
('gallery','sub-item 1')";
$sqlB->tmp_create_tb($insert);
$menuitem="gallery";
$smsg="$menuitem \n $msg";
$insert = "INSERT INTO `gallery`(contents,menu,linkname) VALUES
('$smsg','gallery','$menuitem'),";
$InsertQryValPatt="('','gallery','')";
$insert.=$sqlB->genInsertSqlValPatt($InsertQryValPatt,9);
$sqlB->tmp_create_tb($insert);
if($menuitem!=='')
{
$insert = "INSERT INTO `baby_sub_item`(contents,name_of_subitem,name_of_babysubitem) VALUES
('$msg','$menuitem',''),";
$InsertQryValPatt="('','$menuitem','')";
$insert.=$sqlB->genInsertSqlValPatt($InsertQryValPatt,9);
$sqlB->tmp_create_tb($insert);
}
}
require_once 'Classes/SitemapGenerator.php';
$sitemap = new SitemapGenerator("$site_domain");
}

}

require_once 'fbt_codes.php';
?>

