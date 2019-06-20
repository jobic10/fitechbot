<div id="sitemap_head">
<?php 
echo "
<img id='voll' width='35px' class='img-circle' style='float:left;' height='35px' src='admin/".$logo_thumb."'/>
<span id='sitemap_headtext'>   
LATEST NEWS
</span>
<img id='volr' width='35px' height='35px' style='float:right;' class='img-circle' src='admin/$logo_thumb'/>
";?>
 </div>
<?php
$result=$sqlB->tmp_create_tb("SELECT * FROM `news_and_adverts` ORDER BY `time2` DESC LIMIT 0,3 ");
$outcome=mysqli_num_rows($result);
if($outcome!==0)
{
while($validate = mysqli_fetch_array($result))
{
$homepage2=$validate['contents'];
$time=$validate['time'];
$date=$validate['date'];
$news_and_advertsID=$validate['news_and_advertsID'];
$length=strlen($homepage2);
while(strpos($homepage2,"\n\n")!==false)
{
$homepage2=str_replace("\n\n","\n",$homepage2);
}
$arr=array("\r\n","\r","\n");
$homepage2=str_replace($arr,"<br/>",$homepage2);
$idex_news='new_'.$news_and_advertsID;
if($length<=170)
{
echo "
<div id='post_wraper_news'>
<noscript>Either your browser does not support JavaScript or its is disabled 
</noscript>
<b><font color='brown'>On $date</font> </b><br/>
$homepage2
</div>";
}
else
{
$break=substr($homepage2,0,170);
$linkname="fitechbot_news";
$menu="fitechbot_news";
echo "
<div id='post_wraper_news'>
</script>
<noscript>Either your browser does not support JavaScript or its is disabled 
</noscript>
<b><font  color='brown'>On $date</font></b><br/>
$break
  <div id='$news_and_advertsID' style='display:none;'><span class='float_css'>$homepage2</span></div>
<a href='index.php?menuitem=$linkname&menuname=$menu&news_id=$news_and_advertsID#$idex_news' name='home' >read all</a>
</div>";
}

}//end of while statement

}//end of mysql_num_rows

else
{

}



?>

 <br/><div class='fb-like' data-href='https://www.facebook.com/Ayologbon' data-width='220' data-layout='standard' data-action='like' data-show-faces='true' data-share='true'></div>
