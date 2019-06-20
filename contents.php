<?php
$result2=$sqlB->tmp_create_tb("SELECT * FROM `home` LIMIT 0,5");
while ($all = mysqli_fetch_array($result2))
{
$menu=$all['menu'];
$linkname=$all['linkname'];
$id=$all['menubarID'];
if($linkname!=="")
{
$result =$sqlB->tmp_create_tb("SELECT * FROM `owe_photo` WHERE `menuname`='$linkname' ORDER BY RAND() LIMIT 0,2;")  or die(mysql_error());
echo "<div class='all_uploads_home'>";
while($validate = mysqli_fetch_array($result))
{
$fullname=$validate['caption'];
$profilepix=$validate['photo'];
$pix_actual_loc="admin/$profilepix";
//list($width,$height)=getimagesize($pix_actual_loc);
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
$homepage=$all['contents'];
$homepage=$gUI ->ppbd($homepage);
echo "
<div id='post_wraper'>
";
echo $gUI->splitPost($homepage);
$link=$site_domain."virtual_index.php?menuitem=$linkname&menuname=home";
$buttons=new social("$link","$linkname - home ","$site_sharer");
echo $buttons->createCode('default');
echo
"<br/><br/></div>";
$result3=$sqlB->tmp_create_tb("SELECT * FROM `baby_sub_item` where name_of_subitem='$linkname' LIMIT 0,10");
while ($all2 = mysqli_fetch_array($result3))
{  
$name_of_babysubitem=$all2['name_of_babysubitem'];
if($name_of_babysubitem!=="")
{
$result = $sqlB->tmp_create_tb("SELECT * FROM `owe_photo` WHERE `menuname`='$name_of_babysubitem' ORDER BY RAND() LIMIT 0,2;")  or die(mysql_error());
echo "<div class='all_uploads_home'>";
while($validate = mysqli_fetch_array($result))
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

$ids=$all2['subitemID'];
$homepage=$all2['contents'];
$homepage=$get_class_handle->ppbd($homepage);
echo "
<div id='post_wraper'>";

echo $get_class_handle->splitPost($homepage);
$link=$site_domain."virtual_index.php?menuitem=$name_of_babysubitem&menuname=$linkname";
$buttons=new social("$link","$name_of_babysubitem - $linkname ","$site_sharer");
echo $buttons->createCode('default');

echo "
<br/><br/></div>
    ";
}

}

}
}
//mysql_close($con);
?>