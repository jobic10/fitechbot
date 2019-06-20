<?php
if($deviceType == "computer" || $deviceType == "tablet")
{

$dd=mt_rand(1,3);


require "slideshow$dd.php";
}
else
{

$result_slide = mysql_query("SELECT * FROM `owe_photo` WHERE menuname='home' ORDER BY RAND() LIMIT 0,1")  or die(mysql_error());

while($validate = mysql_fetch_array($result_slide))
{



$slide_caption=$validate['caption'];
$photo_url=$validate['photo'];
echo "
<img id='coverimg' src='admin/$photo_url' alt=' $slide_caption ' title='$slide_caption' width='100%' height='300px'> ";


}

}
?>