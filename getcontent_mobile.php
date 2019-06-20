<?php
$menuname=$gUI->getInputVal('menuname');
$menuname=strtolower($menuname);
$gallery_check=strtolower($menuname);
$menuitem=$gUI->getInputVal('menuitem');
$menuitem2=strtolower($menuitem);
if($menuname==="home" && $menuitem==="Welcome Remarks" )
{
$link=$site_domain;
}
else
{
$link=$site_domain."index.php?menuitem=$menuitem&menuname=$menuname";
}
if($gallery_check==="gallery")
{
$pix_length=10;
}
else
{
$pix_length=2;
} 
$result = $sqlB->tmp_create_tb("SELECT * FROM `owe_photo` WHERE `menuname`='$menuitem' ORDER BY RAND() LIMIT 0,$pix_length ;")  or die(mysqli_error($con));
echo "<div class='all_uploads' id='all_uploads'>";
while($validate = $result->fetch_array())
{
$fullname=$validate['caption'];
$profilepix=$validate['photo'];
$pix_actual_loc="admin/$profilepix";
if($profilepix!=="")
{
echo "	
<a href='#img_con' title='$fullname' class='tooltipp' onclick=large_image(event) >
<span title='click to view the larger Version '>
<img alt='$fullname' id='hompage_img'    class='img-circle' width='200px' height='188px'   src='$pix_actual_loc'/>
</span>
</a>
";
}
}
echo "</div>";
$result=$sqlB->tmp_create_tb("SELECT * FROM `$menuname` where linkname='$menuitem'")  or die("<font size='10' color='red'>Sorry! The Parameter You Supplied does Not Match Any Post</font>");
$outcome=$result->num_rows;
if($outcome!==0)
{
$validate = $result->fetch_array();
$homepage=$validate['contents'];
$homepage=$gUI->ppbd($homepage);
echo "<div id='post_wraper'>";

echo $gUI->splitPost($homepage,6000);

if($menuname  !=="contacts")
{
$buttons=new social("$link","$menuitem -$menuname ",$site_sharer);
echo $buttons->createCode('default');
}
echo "<br/><br/></div>";
}//end of mysql_num_rows
else
{
$result=$sqlB->tmp_create_tb("SELECT * FROM `baby_sub_item` where name_of_babysubitem='$menuitem'");
$outcome2=$result->num_rows;
$validate = $result->fetch_array();
if($outcome2===0)
{
$homepage="<font size='10' color='red'>post not found !</font>";
}
else
{
$homepage=$validate['contents'];
$homepage=$gUI->ppbd($homepage);
echo "<div id='post_wraper'>";

echo $gUI->splitPost($homepage,6000);

if($menuname  !=="contacts")
{
$buttons=new social("$link","$menuitem -$menuname ",$site_sharer);
echo $buttons->createCode('default');
}
echo"<br/><br/></div>";
}
}
if($menuname==="contacts")
{
echo "<br/><br/><div id='article'>";
require_once "article.php";
echo "</div>";
}

?>


