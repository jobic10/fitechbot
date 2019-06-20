<?php
$menuname=strtolower($menuname);
$result2= $sqlB->tmp_create_tb("SELECT * FROM `$menuname` LIMIT 0,5");
while ($all = mysqli_fetch_array($result2))
{
$menu=$all['menu'];
$linkname=$all['linkname'];
//$id=$all['ID'];
if($linkname!=="")
{
$linkname_ucw=strtolower($linkname);
$linkname_ucw=ucwords($linkname_ucw);
echo "
<li><a href='index.php?menuitem=$linkname&menuname=$menu#$linkname'   >$linkname_ucw</a>";
$result3= $sqlB->tmp_create_tb("SELECT * FROM `baby_sub_item` WHERE name_of_subitem='$linkname' LIMIT 0,10");
$result33= $sqlB->tmp_create_tb("SELECT * FROM `baby_sub_item`  WHERE name_of_subitem='$linkname' AND name_of_babysubitem='' LIMIT 0,10");
$check_row=mysqli_num_rows($result33);
if($check_row!==10)
{
echo "<ul class='sub-menu'>
";
}
while ($all2 = mysqli_fetch_array($result3))
{  
$name_of_babysubitem=$all2['name_of_babysubitem']; 
if($name_of_babysubitem!=="")
{
$name_of_babysubitem_ucf=ucwords($name_of_babysubitem);
echo "							
<li ><a href='index.php?menuitem=$name_of_babysubitem&menuname=$menu#$name_of_babysubitem'  >$name_of_babysubitem_ucf</a></li>					
";
}					
}
if($check_row!==10)
{
echo "</ul>
";
}
echo "</li>";
}
}
//mysql_close($con);
?>