<?php




include("secreet/confidential/config.php");

$sql="CREATE TABLE IF NOT EXISTS `owe_photo` (photoID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(photoID),menuname varchar(100),caption varchar(2000),photo varchar(500))";

if (!mysql_query($sql,$con))
  {
  

echo "error bro";
exit;


  }



$sql="CREATE TABLE IF NOT EXISTS `menubar`(menubarID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(menubarID),name_of_menubar varchar(500),`default_menubar_item` varchar(500))";

if (!mysql_query($sql,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 






$result=mysql_query("SELECT * FROM `news_and_adverts` ORDER BY RAND() LIMIT 0,3 ");
$outcome=mysql_num_rows($result);
if($outcome!==0)
{
while($validate = mysql_fetch_array($result))
  {
//$validate = mysql_fetch_array($result);
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
  

if($length<=170)

{


echo "
<div id='post_wraper_adverts'>
</script>
<noscript>Either your browser does not support JavaScript or its is disabled 
</noscript>
<b><font color='white'>on $date</font> </b><br/><br/>
$homepage2
</div>";
}
else
{

$break=substr($homepage2,0,170);


       //$wrap=wordwrap($break,90,"<br/>",true);
$linkname="";
$menu="";
  echo "
<div id='post_wraper_adverts'>

</script>
<noscript>Either your browser does not support JavaScript or its is disabled 
</noscript>
<b><font color='white'>on $date</font> </b><br/><br/>

$break
  <div id='$news_and_advertsID' style='display:none;'><span class='float_css'>$homepage2</span></div>
 

<a href='#FITECH_BOT' name='home' id='getcontent.php?menuitem=$linkname&menuname=$menu&news_id=$news_and_advertsID' onclick='getcontent(this.id,this.name)'>read all</a>


</div>";
}

}//end of while statement

}//end of mysql_num_rows

else
{

}






$result = mysql_query("SELECT * FROM `owe_photo` WHERE menuname='news_and_adverts' ORDER BY RAND() LIMIT 0,1 ;")  or die(mysql_error());


function getHeight2($image) 
{

	$image="admin/$image";  
	$size = getimagesize($image);
         

	$height = $size[1];
	return $height;
}
//You do not need to alter these functions
function getWidth2($image) 
{
        $image="admin/$image";  
	
	$size = getimagesize($image);
	$width = $size[0];
        return $width;
}

echo "<div class='all_uploads' id='all_uploads_adverts'>";

while($validate = mysql_fetch_array($result))
  {



$fullname=$validate['caption'];
$profilepix=$validate['photo'];

$width = getWidth2($profilepix);
$height= getHeight2($profilepix);



if($profilepix!=="")
{
echo "	

<a href='#img_con' onclick='large_image(this.id,this.name)' name='$width' id='admin/$profilepix'>

<span class='tooltip' id='$fullname' onmouseover='tooltip.pop(this,this.id)'><img width='100%' id='latest_adverts'  height='100%' src='admin/$profilepix'/></span>

</a>
<input type='hidden' value='$height' id='admin/$profilepix"."_height' />

";
}

}
echo "</div>";


?>



</div><!--end of news_and_adverts-->


