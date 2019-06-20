
<div id="specialBoxreg">
<button id="close_reg" onclick="toggleOverlayreg()">close</button>




<diV id="error" style="border-radius:10px;color:white;background:black;padding-left:50px;display:block"><font color="green" size="4"></font></div>





<div id="reg_form">

<diV id="reg_details">Media Files:</div>





<table cellpadding="10px" cellspacing="10px">
<tr>
<td>
<?php
require_once 'Classes/SqlBasics.php';
$sqlB =new SqlBasics("chat");

$sql5="CREATE TABLE IF NOT EXISTS `media_files` (mediaID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(mediaID),media_url varchar(500),`media_caption` varchar(500),`time` varchar(500),`time2` varchar(500),`date` varchar(500))";
$sqlB->tmp_create_tb($sql5);


$result = $sqlB->tmp_create_tb("SELECT * FROM `media_files`  ORDER BY RAND() LIMIT 0,10 ;");

while($validate =$result->fetch_array())
  {



$media_url=$validate['media_url'];
$media_caption=$validate['media_caption'];

$time = $validate['time'];
$time2 = $validate['time2'];
$date = $validate['date'];
$ext1=pathinfo($media_url,PATHINFO_EXTENSION);
 

echo "
<div class='media_files'>
 <a href='admin/$media_url'><font color='black'>$media_caption  Uploaded on $date at $time</font></a>
</div>
";

}

?>
</td>
</tr>
</table>



</div><!-- end of error-->


</div>  <!-- end of specialBoxreg -->


