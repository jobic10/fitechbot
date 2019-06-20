<?php
$result =$sqlB->tmp_create_tb($con,"SELECT * FROM `media_files`  ORDER BY RAND() LIMIT 0,5 ;")  or die(mysqli_error($con));
while($validate = mysqli_fetch_array($result))
  {
$media_url=$validate['media_url'];
$media_caption=$validate['media_caption'];
$time = $validate['time'];
$time2 = $validate['time2'];
$date = $validate['date'];
echo " <a href='$media_url'>download file</a>";
  }
?>