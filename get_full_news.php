<?php
If(isset($_REQUEST['news_id']))
{
$newsid=$_REQUEST['news_id'];
$newsid=  mysql_reali_escape_string($con,$newsid);
$result=$sqlB->tmp_create_tb($con,"SELECT * FROM `news_and_adverts` WHERE `news_and_advertsID`='$newsid'  ") or die("sorry news not found");
$outcome=mysqli_num_rows($result);
if($outcome!==0)
{
$validate = mysqli_fetch_array($result);
$homepage22=$validate['contents'];
while(strpos($homepage22,"\n\n")!==false)
{
$homepage22=str_replace("\n\n","\n",$homepage22);
}
$arr=array("\r\n","\r","\n");
$homepage22=str_replace($arr,"<br/>",$homepage22);
$idex_news='new_'.$newsid;
echo "<div id='$idex_news'></div>
<div id='post_wraper'>
$homepage22
</div>
";
}
 else 
 { 
   echo "<div id='post_wraper'><font size='10' color='red'>Sorry! The Parameter You Supplied does Not Match Any Post</font></div>"; 
 }
}
else 
{
 echo "<div id='post_wraper'><font size='10' color='red'>Sorry! The Parameter You Supplied does Not Match Any Post</font></div>"; 

}
?>    