<ul id="main-menu">
<?php
$result = $sqlB->tmp_create_tb("SELECT * FROM `menubar` LIMIT 0,6")  or die(mysqli_error());
while($validate = mysqli_fetch_array($result))
 { 
$menuname=$validate['name_of_menubar'];
$menuitem=$validate['default_menubar_item'];
$menuname=strtoupper($menuname);
echo "	
<li>
<a href='#'  >$menuname";
 if($menuname=="HOME")
 {
  echo " <i class='icon-home'> </i>" ;  
 }
if($menuname=="ABOUT US")
 {
  echo " <i class='icon-folder-open'> </i>" ;  
 }
 
if($menuname=="CONTACTS")
 {
  echo " <i class='icon-phone'> </i>" ;  
 }
 if($menuname=="ANNOUNCEMENTS")
 {
  echo " <i class='icon-bell'> </i>" ;  
 }
echo "</a>
<ul class='sub-menu'>";
require "load_sub_menu_mobile.php";
echo " </ul>
</li>";
}   
?>    
<li>
<a href="index.php?menuitem=fitechbot_media&menuname=fitechbot_media#fitechbot_media" >MEDIA <i class='icon-briefcase'> </i></a>
</li>
 <li>
<a href='sms/' target='_blank'>S.M.S <i class='icon-flag'> </i></a>
</li>
<li>
<a href='chat/web' target='_blank'>O.S.N <i class='icon-file'> </i></a>
</li>

<li>
<a href='www.w3schools.com/' target='_blank'>W3Schools Offline 2015 -ARSDK<i class='icon-file'> </i></a>
</li>

</ul>

