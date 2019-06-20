<?php
/**
 * Description of ChatL * @author Ayologbon
   oggedInInterface
 * This class implements or acts as the Interface between logged-in users and the Network
 * ChatLoggedInInterface
 */

class ChatLoggedInInterface 
{
  var $stars_username_in_array=array();
  var $stars_fullname_in_array=array();
  var $sqlB;
  var $DAF;
  var $mC;
  var $sessionB;
  var $username_in_session;
public function ChatLoggedInInterface($username)//__construct() 
{   
    ob_start();
    //require_once 'DirAndFiles.php';
    //$this->DAF =new DirAndFiles();   
    require_once 'sessionBasics.php';
    $this->sessionB =new sessionBasics();
    require_once "Miscellaneous_Class.php";
    $this->mC =new Miscellaneous_Class ();
    require_once "SqlBasics.php";
    $this->sqlB =new SqlBasics("chat");
    $this->username_in_session=$username;
    $this->starsFans($username,"star_username","star_fullname");
}
private function starsFans($username,$col_name1,$col_name2) 
{
    $result_loaded_users=$this->sqlB->tmp_create_tb("SELECT `$col_name1`,`$col_name2` FROM `followers_and_stars` where followers_username='$username'");  //star_username
    while($check_loaded_users = $result_loaded_users->fetch_array())
    {
    $this->stars_username_in_array[]=$check_loaded_users[$col_name1];
    $this->stars_fullname_in_array[]=$check_loaded_users[$col_name2];
    }
    //return $this->stars_username_in_array;
} 

   private function isUrl($url) 
   { 
   //echo substr(htmlentities(trim($url),ENT_QUOTES,'UTF-8'),0,10);exit;
   if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) 
   {
   return FALSE;
   }
   else 
   {
   if(substr(trim(strtolower($url)),0,4)!=="http" )
   {
   return FALSE;   
   }
   else 
   {
   return TRUE;  
   }  
   
   }
   }
   //////////////////////////////////////////////////////////////////    
  private function file_get_contents_curl($url)
    {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
    }
    private function getMetadata($html)
    {
    //$html = $this->file_get_contents_curl("http://example.com/");
    $html = $this->file_get_contents_curl($html);
    //parsing begins here:
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $nodes = $doc->getElementsByTagName('title');
    //get and display what you need:
    //var_dump($nodes);
    $metas = $doc->getElementsByTagName('meta');
    if($metas->length!=0)
    {
    $title = $nodes->item(0)->nodeValue;
    }
    else
    {
    $title=" "; //to avoid flagging of errors in case the node item-title was not properly indexed
    }

    for ($i = 0; $i < $metas->length; $i++)
    {
    $meta = $metas->item($i);
    $metaDataContent=$meta->getAttribute('content');
    $metaDataName=$meta->getAttribute('name');
    $metaDataProperty=$meta->getAttribute('property');
    if($metaDataName!="")
    {
     $metaDataIndex=$metaDataName;
    }
    else if($metaDataProperty!="")
    {
     $metaDataIndex=$metaDataProperty;
    }
    else
    {
     $metaDataIndex=$i;
    }
    $metaContents["$metaDataIndex"]=$metaDataContent;

    if($meta->getAttribute('name') == 'description')
    $description = $meta->getAttribute('content');
    if($meta->getAttribute('name') == 'keywords')
    $keywords = $meta->getAttribute('content');
    }
    $metaContents["title"]=$title;
    return $metaContents;
    //print_r($metaContents);exit();
    }
    /////////////////////////////////////////////////////////////////
    public function getUrl($in_str) 
    {
    if(stripos($in_str,"http://")!==FALSE)
    {
    //$in_str=urlencode($in_str);
    $a=explode(" ", $in_str);
    $b=array();
    $c=array();
    foreach ($a as $value) 
    {
    //$value=urldecode($value);
    if($this->isUrl($value)) 
    {
    //gethostname();print_r(get_browser(NULL,true));exit();
    //$value=urlencode($value);
    $defaultags=$this->getMetadata($value);
    //$defaultags=get_meta_tags($value);
    if(isset($defaultags["og:site_name"]) && isset($defaultags["og:url"]) && isset($defaultags["og:title"])&& isset($defaultags["og:image"]))
    {
    //$desc=$defaultags["description"];
    $img=$defaultags["og:image"];
    $c[]="<table width='100%'><tr width='100%' ><td width='80%'>".$defaultags["title"]."<br/>".$defaultags["og:url"]."-".$defaultags["og:site_name"]."</td><td width='20%'>
    <img   width='90px' style='float:right;' height='90px' src=\"$img\"/></td> </tr></table>    

    ";
    }
    /*else if(isset($defaultags["description"]))
    {
    $c[]=$defaultags["description"];
    }*/
    else
    {
    $c[]=$defaultags["title"];
    }

    $link="<a target='_blank' href=\"".strtolower($value)."\"><font color='black'><b>".strtolower($value)."</b></font></a>";
    $value=  str_ireplace($value, $link, $value);
    }
    $b[]=$value;
    }
    if(count($c)>0)
    {
    $ret=implode(" ", $b);
    $ret.="<br/><div class='url_desc'>$c[0]</div>";
    return $ret;  
    }  
    else 
    {
    return implode(" ", $b);
    }
    }
    else 
    {
    return $in_str;  
    }
    }
    public function mN($in_str,$decorate_name,$dp,$post_key) 
    {
    $sqlpatt= "INSERT INTO `newnotice` (`notice_content`,`date`,`by_who`,`fullname`,`dp`,`post_id`,`notice_owner`,`timestamp`) VALUES";// ('$content','$date_notice','$username','$decorate_name','$dp','$post_key','$ppuser','$time2')";
    $cm=",";$x=1;$sql="";
    $time2=time();
    $date_notice=date('l: Y-m-d ')." at ".date('h:i:s A');
    $a=  array_combine($this->stars_username_in_array, $this->stars_fullname_in_array);
    foreach ($a as $star_username => $star_fullname) 
    {
    if(stripos($in_str,$star_fullname)!==false)
    {
    if($x!==1)
    {
    $sql.=$cm;
    }
    if($star_username===$this->username_in_session)
    {
     $content="you mentioned  your  own name in a ";
    }
    else
    {
    $content="mentioned your name in a  ";
    }
    $sql.= "('$content','$date_notice','$this->username_in_session','$decorate_name','$dp','$post_key','$star_username','$time2')";
    $x++;
    }
    } 
    if($sql!=="")
    {
    $sqlpatt.=$sql;
    $this->sqlB->tmp_create_tb($sqlpatt);
    }
    }

    public function repNameUrl($in_str) 
    {
    $a=  array_combine($this->stars_username_in_array, $this->stars_fullname_in_array);
    //print_r($a);
    $matched=array();
    $matched_fullname=array();
    foreach ($a as $star_username => $star_fullname) 
    {
    if(stripos($in_str,$star_fullname)!==false)
    {
    $matched[]=urldecode($this->userProfile($this->username_in_session,$star_username,$star_fullname));
    $matched_fullname[]=$star_fullname;
    }
    }
    if(count($matched)>0)
    {
    return str_ireplace($matched_fullname,$matched,$in_str);
    }
    else 
    {
    return $in_str;  
    }
    
    }
    

private function checkMf($username,$col_name) 
{   
    $a=array();
    $result_loaded_users=$this->sqlB->tmp_create_tb("SELECT `$col_name` FROM `followers_and_stars` where followers_username='$username'");  //star_username
    while($check_loaded_users = $result_loaded_users->fetch_array())//mysqli_fetch_array($result_loaded_users))
    {
    $a[]=$check_loaded_users[$col_name];
    }
    return $a;
} 

 public function Mf($username,$username2,$col_name) 
{   
    if(count($this->stars_username_in_array)===0)
    {
    $arr1=  $this->checkMf($username,$col_name);
    $this->stars_username_in_array=$arr1;
    }
    else
    {
    $arr1=$this->stars_username_in_array;
    }
    $arr2=  $this->checkMf($username2,$col_name);
    $a=count(array_intersect($arr1, $arr2));
    if ($a>0)
    {
    return $a;  
    }
    else 
    {
    return NULL;  
    }
   
}    

public function isUserOnline($username)
{
$howlong=time()-30; 
$check_refresh = $this->sqlB->tmp_create_tb("SELECT `time` FROM `all_fans` WHERE username='$username' AND time > $howlong UNION ALL SELECT `time` FROM `all_artiste` WHERE username='$username'  AND time > $howlong");
if($check_refresh->num_rows > 0)
{
   return "YES";
}  
else 
{
   return "NO"; 
}
}

public function checkRefrehTb($username,$rtime=null,$groupcodename=null)
{
if($rtime==null)
{
$rtime=date('h:i:s A');
}
$rtime2=time();

$check_refresh =$this->sqlB->tmp_create_tb("SELECT `time2` FROM `check_refresh_time` WHERE username='$username' AND group_codename='$groupcodename'");
if($check_refresh->num_rows ==0)
{
$sql= "INSERT INTO `check_refresh_time` (`username`,`time`,`time2`,`group_codename`) VALUES ('$username','$rtime','$rtime2','$groupcodename')";
$this->sqlB->tmp_create_tb($sql);
}
else 
{
$comfirm_refresh =$check_refresh-> fetch_array();
return $last_refresh=$comfirm_refresh['time2']-7;
}
}

public function updateRefrehTb($username,$groupcodename=null)
{
$time=time();
$this->sqlB->tmp_create_tb("UPDATE `check_refresh_time` SET time2='$time' WHERE username ='$username' AND group_codename='$groupcodename'");
}

public function qryLmt($f_index=10) 
{
$first_index=$f_index;
$nxt=$this->mC->fitech_sanitate_str('nxt');
$prev=$this->mC->fitech_sanitate_str('prev');
$almp=$this->mC->fitech_sanitate_str('almp');
if(($nxt!==FALSE || $prev!==FALSE) && isset($_SESSION['return_row']))
{
$begin_index=$_SESSION['return_row']-$first_index;
}
else if(($nxt!==FALSE || $prev!==FALSE) && $almp!==FALSE)
{
$begin_index=$almp-$first_index;    
}
else 
{
$begin_index=0;
}
session_write_close();
return array($first_index,$begin_index);
}


public function isUserAfollower($username,$star_username)
{
$result=$this->sqlB->tmp_create_tb("SELECT star_username FROM `followers_and_stars` where followers_username='$username' AND star_username='$star_username'");
if ($result->num_rows>0)
{
   return "YES";
}  
else 
{
   return "NO"; 
}
}


public function numOfUsersOnline($q_or_r="numrows",$db_name="chat")
{
$howlong=time()-30;
$check_refresh =$this->sqlB->tmp_create_tb("SELECT `time` FROM `all_fans` WHERE  time > $howlong UNION ALL SELECT `time` FROM `all_artiste` WHERE time > $howlong");
if($q_or_r==="numrows")
{
return $check_refresh->num_rows;//mysqli_num_rows($check_refresh);
}
 else 
{
return $check_refresh;
}
}

public function searchDb($input,$col_names,$tb_name="all_fans",$qry_lmt="10")
    {
    $col_names=array_fill_keys($col_names,$input);
    $num_col=count($col_names);
    if(is_array($col_names))
    {   
    $query_str="SELECT * from `$tb_name` WHERE ";
    $track_col=1;
    foreach ($col_names as $key=>$in_value)
    {
    $in_value=  trim($in_value);
    $query_str.= "`".$key."` LIKE '%$in_value%'";     
    if($num_col!==$track_col)
    {
    $query_str.= " OR "  ; 
    }
    $track_col++;
    }  
    //require_once "qry_lmt_bg_nd.php";
    $rLmt= $this->qryLmt($qry_lmt); //$rLmt[0],$rLmt[1]   $begin_index,$first_index
    $query_str.= " LIMIT $rLmt[1],$rLmt[0]"  ; 
    return $query_str; 
    }
    }

public function searchDb_chat($input,$col_names,$tb_name="all_fans",$qry_lmt="10")
    {
    $col_names=array_fill_keys($col_names,$input);
    $num_col=count($col_names);
    if(is_array($col_names))
    {   
    $query_str="SELECT * from `$tb_name` WHERE ";
    $track_col=1;
    foreach ($col_names as $key=>$in_value)
    {
    $in_value=  trim($in_value);
    $query_str.= "`".$key."` LIKE '%$in_value%'";     
    if($num_col!==$track_col)
    {
    $query_str.= " OR "  ; 
    }
    $track_col++;
    }  
    $rLmt= $this->qryLmt($qry_lmt);
    $query_str.= " LIMIT $rLmt[1],$rLmt[0]"  ; 
    $search_qry=$this->sqlB->tmp_create_tb($query_str); 
    if($search_qry->num_rows <1)
    {
    return NULL;
    }
    else 
    {
    return $search_qry; 
    }
    }
    }


public function numNewMsgs($username,$session_name,$db_name="chat") 
{
$check_msg =$this->sqlB->tmp_create_tb("SELECT `msg_sender` FROM `new_msg` WHERE `msg_sender`='$username' AND `msg_rcver`='$session_name' AND `seen_msg`='NO'  ") ;
return $check_msg->num_rows;//return mysqli_num_rows($check_msg);
}


public function conSF($dp,$username,$fullname,$session_name,$btnType="FOLLOW",$pass="NO",$fn="follow_user",$group_codename=NULL) 
{
//$this->isUserOnline($username)==="YES"
$pass2=$pass;
$fullname= strtolower($fullname);
$fullname= ucwords($fullname);

if($pass2==="NO")
{
$pass=uniqid(rand());
echo "
<div class='follow_individual_con' id='follow_individual_con_$pass' >
";
}

if($btnType=="MESSAGE" )
{
$fullname2="<a href='#' ><font color='black'><b >$fullname</b></font></a>";
}
else
{
$fullname2=$this->userProfile($session_name,$username,$fullname);
}

echo "
<table>
<tr>
<td style='padding-right:5px;'>
<img  src='$dp' width='30px' height='30px' >
</td>
<td width='90%'>
$fullname2";

$msgcolor="black";
$msgTitle="Message $fullname";
$msgValue="Message";
if($btnType=="MESSAGE")
{
$nummsgs=$this->numNewMsgs($username,$session_name) ;
if($nummsgs>0)
{
$msgTitle="You Have $nummsgs New Message/s From $fullname";
$msgcolor="gold";
$msgValue="New Msg/s ( $nummsgs )";
}
}
else
{
$mf=$this->Mf($session_name,$username,"star_username");
if($mf!==NULL)
{
echo "&nbsp;&nbsp;".$mf;  
}
}
echo
"</td>
<td>";
if($group_codename==NULL)
{
$fn=$fn."(event)";
}
else
{
$fn=$fn."(event,'".$group_codename."')";   
}
$msgbtn="<button class='btn btn-default btn-xs' style='max-height:30px;float:right;color:$msgcolor' id='$pass' name='$username'  title='$msgTitle'  onclick=crtMsgCon(event,'ALL')>$msgValue</button>";
if($btnType==="MESSAGE")
{
$this->msgCon($username,$fullname,$pass);
echo $msgbtn;
}
elseif($btnType==="FOLLOW" && $this->isUserAfollower($session_name,$username)==="YES")
{
$this->msgCon($username,$fullname,$pass);
echo $msgbtn;
}
else 
{
$btnType=  strtolower($btnType);
$btnType=  ucwords($btnType);
echo "<button class='btn btn-default btn-xs' style='max-height:30px;float:right;' id='$pass' name='$username'  title='$btnType $fullname'  onclick=\"$fn\" >$btnType</button>";
}
echo 
"</td>
</tr>
</table>"; 
if($pass2==="NO")
{
echo "</div>";
}

}

public function userProfile($username,$usernamedb,$fullnamedb,$in_color="black" ,$db_name="chat") 
{
$check = $this->sqlB->tmp_create_tb("SELECT hashed_username FROM `all_fans` WHERE username = '$usernamedb' UNION ALL SELECT hashed_username FROM `all_artiste` WHERE username = '$usernamedb'" );
$check2= $check->fetch_array();
$h_username=$check2['hashed_username'];
////////////////////////Just testing the output////////////////////////////
$decorate_name=strtolower($fullnamedb);
$decorate_name=ucwords($decorate_name);
if($username===$usernamedb)
{
$link="<a href='my_profile.php' target='_blank'><font color='$in_color'><b>$decorate_name</b></font></a>";
}
else
{
$link="<a href='guest_users_profile.php?user=$h_username' target='_blank'><font color='$in_color'><b>$decorate_name</b></font></a>";
}

return $link;
}


public function msgCon($in_username,$in_fullname,$id="NO",$msgCont=" ")
{
    if($id==="NO")
    {
    $id=uniqid(rand());
    }
    $url="sndMsg.php"; //ondblclick=setTimeout($('#msg_con_$id').fadeOut(2000),100000);
    echo "
    <div id='msg_con_$id' class='msg_con'>
    <div class='close' title='double click to close' ondblclick=closeConMsg('msg_con_$id','$in_username');>X</div>
    <div id='msg_header_$id' class='msg_header'>$in_fullname</div>
    <div class='msg_con_inner'>";
    if($msgCont!=" ")
     {
      echo "<div class='talk-bubble tri-right round  right-top'>
      <div class='talktext'>
      $in_fullname
      <br>
      $msgCont
      </div>
      </div>";  
      }
      $inFileName="FitechReader";
      $info_div="img_info_$id";
      $url="sendFileOverNtwrk.php";
      $fileid="file_$id";
      
     echo "<div id='almm_$id' class='almm'></div>
     </div>
     <div class='msg_footer'>
     <span style='display:none;' id='pub_key_$id'></span>
     <span  id='$info_div'></span>
     <input type='text' id='$id' name='$in_username' onkeyup=sndMsg(event,'$url') placeholder='your msg Here...' class='form-control' style=\"width:84%;float: left;\"/>
     <div style=\"background: url('images/update.png') repeat-x scroll 0% 0% transparent;color: black;border: 1px solid #ccc;width:15%;height:30px;float:right;\">
     <input class=\"form-control input-sm \"  style=\"width:100%;opacity:.0;filter:alpha(opacity=.0);margin:auto;\" type=\"file\" id=\"$fileid\" name=\"$fileid\" multiple=\"true\" onchange=fuf(this,\"$url\",\"$info_div\",\"$inFileName\") />
     </div> 
    </div>
    </div>";
}

}