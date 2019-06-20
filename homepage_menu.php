<!------Menu Div Start------!>




    <div id="menu">
<!------Menu contaner start------!>
     <div id="menucon">

<ul class='sf-menu' id='example'>
   
<?php
$sql="CREATE TABLE IF NOT EXISTS `menubar` (menubarID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(menubarID),name_of_menubar varchar(500),`default_menubar_item` varchar(500))";

if (!mysql_query($sql,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());

}
$sql="CREATE TABLE IF NOT EXISTS `baby_sub_item`(subitemID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(subitemID),contents text(20000),`name_of_subitem` varchar(500),`name_of_babysubitem` varchar(500))";

if (!mysql_query($sql,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 
$result9 = mysql_query("SELECT * FROM `menubar` where name_of_menubar='home' ")  or die(mysql_error());

$validate = mysql_num_rows($result9);
  

if($validate<1)
{

$insert = "INSERT INTO `menubar`(name_of_menubar,default_menubar_item) VALUES
('home','sub-item 1')";

if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}
$sql="CREATE TABLE IF NOT EXISTS `home`(menubarID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(menubarID),contents text(20000),`menu` varchar(100),`linkname` varchar(100))";

if (!mysql_query($sql,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 
$menuitem="Welcome Remarks";
$menuitem1="Mission and Vission Statements";
$smsg="$menuitem \n $msg";
$smsg1="$menuitem1 \n $msg
";
$insert = "INSERT INTO `home`(contents,menu,linkname) VALUES
('$smsg','home','$menuitem'),
('$smsg1','home','$menuitem1'),
('','home',''),
('','home',''),
('','home',''),
('','home',''),
('','home',''),
('','home',''),
('','home',''),
('','home','')
";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}

if($menuitem!=='')
{
$insert = "INSERT INTO `baby_sub_item`(contents,name_of_subitem,name_of_babysubitem) VALUES
('$msg','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem','')
";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}
}


if($menuitem1!=='')
{
$insert = "INSERT INTO `baby_sub_item`(contents,name_of_subitem,name_of_babysubitem) VALUES
('$msg','$menuitem1',''),
('','$menuitem1',''),
('','$menuitem1',''),
('','$menuitem1',''),
('','$menuitem1',''),
('','$menuitem1',''),
('','$menuitem1',''),
('','$menuitem1',''),
('','$menuitem1',''),
('','$menuitem1','')
";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}
}

}
$sql="CREATE TABLE IF NOT EXISTS `about us`(menubarID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(menubarID),contents text(20000),`menu` varchar(100),`linkname` varchar(100))";
if (!mysql_query($sql,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}

$result9 = mysql_query("SELECT * FROM `menubar` where name_of_menubar='about us' ")  or die(mysql_error());
$validate = mysql_num_rows($result9);
if($validate<1)
{
$insert = "INSERT INTO `menubar`(name_of_menubar,default_menubar_item) VALUES
('about us','sub-item 1')";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}
$menuitem="about us";
$smsg="$menuitem \n $msg";
$insert = "INSERT INTO `about us`(contents,menu,linkname) VALUES
('$smsg','about us','$menuitem'),
('','about us',''),
('','about us',''),
('','about us',''),
('','about us',''),
('','about us',''),
('','about us',''),
('','about us',''),
('','about us',''),
('','about us','')
";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}
if($menuitem!=='')
{

$insert = "INSERT INTO `baby_sub_item`(contents,name_of_subitem,name_of_babysubitem) VALUES
('$msg','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem','')
";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}
}
}
$result9 = mysql_query("SELECT * FROM `menubar` where name_of_menubar='contacts' ")  or die(mysql_error());
$validate = mysql_num_rows($result9);
if($validate<1)
{
$insert = "INSERT INTO `menubar`(name_of_menubar,default_menubar_item) VALUES
('contacts','sub-item 1')";

if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}
$sql="CREATE TABLE IF NOT EXISTS `contacts`(menubarID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(menubarID),contents text(20000),`menu` varchar(100),`linkname` varchar(100))";
if (!mysql_query($sql,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 
$menuitem="Our contact Address";
$smsg="$menuitem \n $msg";
$menuitem="Our contact Address";
$insert = "INSERT INTO `contacts`(contents,menu,linkname) VALUES
('$smsg','contacts','$menuitem'),
('','contacts',''),
('','contacts',''),
('','contacts',''),
('','contacts',''),
('','contacts',''),
('','contacts',''),
('','contacts',''),
('','contacts',''),
('','contacts','')
";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}

if($menuitem!=='')
{

$insert = "INSERT INTO `baby_sub_item`(contents,name_of_subitem,name_of_babysubitem) VALUES
('$msg','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem','')
";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}
}
$sql="CREATE TABLE IF NOT EXISTS `gallery`(menubarID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(menubarID),contents text(20000),`menu` varchar(100),`linkname` varchar(100))";
if (!mysql_query($sql,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}
$result9 = mysql_query("SELECT * FROM `menubar` where name_of_menubar='gallery' ")  or die(mysql_error());
$validate = mysql_num_rows($result9);
if($validate<1)
{
$insert = "INSERT INTO `menubar`(name_of_menubar,default_menubar_item) VALUES
('gallery','sub-item 1')";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}


$sql="CREATE TABLE IF NOT EXISTS `gallery`(menubarID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(menubarID),contents text(20000),`menu` varchar(100),`linkname` varchar(100))";

if (!mysql_query($sql,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 
$menuitem="gallery";
$smsg="$menuitem \n $msg";
$insert = "INSERT INTO `gallery`(contents,menu,linkname) VALUES
('$smsg','gallery','$menuitem'),
('','gallery',''),
('','gallery',''),
('','gallery',''),
('','gallery',''),
('','gallery',''),
('','gallery',''),
('','gallery',''),
('','gallery',''),
('','gallery','')
";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}

if($menuitem!=='')
{

$insert = "INSERT INTO `baby_sub_item`(contents,name_of_subitem,name_of_babysubitem) VALUES
('$msg','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem',''),
('','$menuitem','')
";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
}
}
}
 // include class
include 'SitemapGenerator.php';
// create object
$site_domain=$_SERVER["SERVER_NAME"];
$site_domain="http://".$site_domain."/";
$sitemap = new SitemapGenerator("$site_domain");
$result = mysql_query("SELECT * FROM `menubar` ORDER BY `menubarID` DESC;")  or die(mysql_error());
//$result = mysql_query("SELECT * FROM `menubar` ORDER BY RAND() LIMIT 0,2;")  or die(mysql_error());DESC
while($validate = mysql_fetch_array($result))
  {
$menuname=$validate['name_of_menubar'];
$menuitem=$validate['default_menubar_item'];
$menuname=strtolower($menuname);
//<a href='#'>$menuname</a>;
$result2=mysql_query("SELECT * FROM `$menuname`");
while ($all = mysql_fetch_array($result2))
{
$menu=$all['menu'];
$linkname=$all['linkname'];
//$id=$all['ID'];
$link=$site_domain."virtual_index.php?menuitem=$linkname&menuname=$menu";
if($linkname!=="")
{
$sitemap->addUrl("$link",                date('c'),  'daily',    '1');  
//echo $link;
$result3=mysql_query("SELECT * FROM `baby_sub_item` where name_of_subitem='$linkname' LIMIT 0,10");
while ($all2 = mysql_fetch_array($result3))
{   
$name_of_babysubitem=$all2['name_of_babysubitem'];
if($name_of_babysubitem!=="")
{
$link=$site_domain."virtual_index.php?menuitem=$name_of_babysubitem&menuname=$menu";
$sitemap->addUrl("$link",                date('c'),  'daily',    '1');
}					
}

}

}
}

$sitemap->createSitemap();
$sitemap->writeSitemap();
$sitemap->updateRobots();  
$sitemap->submitSitemap();
        
}

$result = mysql_query("SELECT * FROM `menubar` LIMIT 0,4")  or die(mysql_error());
while($validate = mysql_fetch_array($result))
  {
$menuname=$validate['name_of_menubar'];
$menuitem=$validate['default_menubar_item'];
$menuname=strtoupper($menuname);
echo "	
<li><a href='#'  >$menuname</a>
         <ul>";

require "loadmenu.php";

        echo " </ul>
      </li>";
}
?>    

     <li><a href='#' onclick='toggleOverlayreg()'>MEDIA</a></li>
      
  

 <li>

<a href='http://www.gsssokedayo.com.ng/chat_bot/' target='_blank'>CHAT BOT</a>

      </li>



 <li>

<a href='sms/' target='_blank'>S.M.S</a>

      </li>




</ul>

<!------ <?php echo "<div id='watch_word'><marquee >$slogan</marquee></div>";?>------!>


     </div>
<!------Menu contaner end------!>
    </div><!------Menu Div End------!>