<div id='fitechbot_media'></div>
<div id="post_wraper">
<div class='jumbotron'>

<table cellpadding="10px" cellspacing="10px">
<tr>
<td>
<?php
$result = $sqlB->tmp_create_tb("SELECT * FROM `media_files`  ORDER BY RAND() LIMIT 0,20 ;")  or die(mysqli_error($con));
while($validate = mysqli_fetch_array($result))
{
$media_url=$validate['media_url'];
$media_caption=$validate['media_caption'];
$time = $validate['time'];
$time2 = $validate['time2'];
$date = $validate['date'];
$ext1=pathinfo($media_url,PATHINFO_EXTENSION);
echo "
<div class='media_files'>
 <a href='admin/$media_url'><font color='black'>$media_caption Uploaded on $date at $time</font></a>
</div>
";
}
?>
</td>
</tr>
</table>
    
</div>
</div>