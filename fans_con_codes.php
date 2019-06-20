<div id="sitemap_head">
<?php 
echo 
"
<img id='voll' width='35px' class='img-circle' style='float:left;' height='35px' src='admin/".$logo_thumb."'/>
<span id='sitemap_headtext'>   
SITE MAP
</span>
<img id='volr' width='35px' height='35px' style='float:right;' class='img-circle' src='admin/$logo_thumb'/>
";?>
</div>
<div id="panel1">
<?php
if(!$deviceType == "computer" || $deviceType == "tablet")
{
echo "<a href='chat/'>FORUM</a>
";
}
$result = $sqlB->tmp_create_tb("SELECT * FROM `menubar` ORDER BY `menubarID` DESC;")  or die(mysqli_error());  
//$result = mysql_query("SELECT * FROM `menubar` ORDER BY RAND() LIMIT 0,2;")  or die(mysql_error());DESC
while($validate = mysqli_fetch_array($result))
  {
$menuname=$validate['name_of_menubar'];
$menuitem=$validate['default_menubar_item'];
$menuname=strtolower($menuname);
$result2=$sqlB->tmp_create_tb("SELECT * FROM `$menuname`");
while ($all = mysqli_fetch_array($result2))
{
$menu=$all['menu'];
$linkname=$all['linkname'];
//$id=$all['ID']
$link="<a href='index.php?menuitem=$linkname&menuname=$menu#$linkname' name='$menu' >".strtoupper($linkname)."</a>";
if($linkname!=="")
{
echo $link;
$result3=$sqlB->tmp_create_tb("SELECT * FROM `baby_sub_item` where name_of_subitem='$linkname' LIMIT 0,10");
while ($all2 = mysqli_fetch_array($result3))
{  
$name_of_babysubitem=$all2['name_of_babysubitem'];
if($name_of_babysubitem!=="")
{
echo "							
<a href='index.php?menuitem=$name_of_babysubitem&menuname=$menu#$name_of_babysubitem' name='$menu'>".strtoupper($name_of_babysubitem)."</a>												
";
}					
}




}

}
}

/*
<a href="#"   onclick="toggleOverlay()">Login</a>
<a href="#" onmousedown="toggleOverlayreg()">Register</a>
*/

 
?>
</div>