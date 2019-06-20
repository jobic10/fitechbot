<?php
/**
 * Description of SqlBasics
 *
 * @author Prophet TbJoshua
 */
class GetUserInputs 
{ 
    var $pass=array();
    protected $dAF;
    public $err_f_cookie_name;
    public function GetUserInputs() //__construct()
    {
    $this->err_f_cookie_name="error_report";
    require_once 'DirAndFiles.php';
    $this->dAF =new DirAndFiles();
    }

   private function fitech_http_method()
   { 
   $http_method=filter_input(INPUT_SERVER,'REQUEST_METHOD',FILTER_SANITIZE_STRING);
   if($http_method==="POST")
   {
   return INPUT_POST;   
   }
   elseif ($http_method==="GET") 
   {
   return INPUT_GET;
   }
   else 
   {
   return INPUT_REQUEST;  
   }

   }
    public function ppbs($in_str)
    {   
    $in_str=addslashes($in_str);
    $arr=array("\r\n","\r","\n","\n\n");
    $in_str=htmlspecialchars($in_str, ENT_QUOTES); 
    $in_str= strip_tags($in_str);
    $in_str= htmlentities($in_str,ENT_QUOTES,'UTF-8');
    $in_str=str_replace("<br>","\n",$in_str);       
    if(strpos($in_str,"\n\n")!==false)
    {
    $in_str=str_replace($arr,"\n",$in_str);
    }
    $in_str=preg_replace("/\s\s+\t/"," ",$in_str);
    $in_str=trim($in_str);
    return $in_str;
    }

    public function ppbd($in_str)
    {    
    $in_str=htmlspecialchars_decode($in_str,ENT_QUOTES);
    $in_str=html_entity_decode($in_str,ENT_QUOTES,'UTF-8');
    $arr=array("\r\n","\r","\n","\n\n");
    $in_str=str_replace($arr," <br/> ",$in_str);
    $in_str=ucfirst($in_str);
    return stripslashes($in_str);
    }
    public  function fitech_remove_all_white_spaces($in_str)
    {
    $in_str=trim($in_str);
    $in_str=preg_replace('/\s+/','',$in_str);
    if(strpos($in_str," ")!==false)
    {
    $in_str=str_replace(" ","",$in_str);
    }
    $arr=array("\r\n","\r","\n","\t","\n\n",""," ");
    $in_str=str_replace($arr,"",$in_str);
    return $in_str ;
    }

    public  function isPostEmpty($in_str)
    {
    $str=$this->fitech_remove_all_white_spaces($in_str);
    if (strlen($str)===0 || $str==="")
    {
    return true;
    }
    else
    {
    return false;  
    }
    }

   public function fitech_cookie($cookie_name)
   {
   if(!$rt_str=filter_input(INPUT_COOKIE,$cookie_name,FILTER_SANITIZE_STRING))
   {
   return FALSE;
   }
   else
   {
   return $rt_str;
   }
   }

   public function closeWin() 
   {
   echo "<script type='text/javascript'>
   function close_window()
   {
   window.close();
   }
   setTimeout('close_window()',5000);
   </script>"; 
   }
   
   public function redirPage($cookie_content,$in_loc)
   {
   $cookie_name=$this->err_f_cookie_name; 
   if(isset($_COOKIE[$cookie_name]))
   {
   unset($_COOKIE[$cookie_name]);
   }
   setcookie($cookie_name,$cookie_content,time()+5);
   ob_end_clean();
   header("location:$in_loc");
   exit;
   }
 
   public function fitech_session($session_name)
   {
   if(!$rt_str=filter_input(INPUT_SESSION,$session_name,FILTER_SANITIZE_STRING))
   {
   return FALSE;
   }
   else
   {
   return $rt_str;
   }
   }
   public function fitechDialogBox($in_msg,$in_id)
   {    
    return "<div id='confirm_d_$in_id' class='confirm_d' >
    <div class='text-primary'  for='Dialog_box'> $in_msg </div><br/>
    <button onclick=delete_post(event,'$in_id') title='YES' style='float:left;' name='YES' id='$in_id' class='btn btn-primary btn-xs'>YES</button>
    <button onclick=delete_post(event,'$in_id')  title='NO'  style='float:right;' name='NO' id='$in_id' class='btn btn-primary btn-xs'>NO</button>
    </div>";
   }

   public function trigCaptcha() 
   {
   if(isset($_COOKIE['cpf']))
   {
   $cpf_val=$_COOKIE['cpf'] + 1;
   unset($_COOKIE['cpf']);
   setcookie("cpf",$cpf_val, time() + 3600, "/");
   }
   else
   {
   $cpf_val=1;
   setcookie("cpf",$cpf_val, time() + 3600, "/");
   } 
   }
   
   public function rmbaLogin($hashed_usr) 
   {
   if(isset($_COOKIE['cpf']))
   {
   unset($_COOKIE['cpf']);
   setcookie("cpf"," ", time() - 3600, "/");
   }
   if($this-> getInputVal('remember_login')!==FALSE)
   {
   $remember_login=$this-> getInputVal('remember_login');
   if(!isset($_COOKIE['remember_login'])) 
   {
   setcookie("remember_login", $hashed_usr, time() + (86400 * 30), "/");
   }
   }
   else
   {
   $remember_login="NO";
   if(isset($_COOKIE['remember_login'])) 
   {
   unset($_COOKIE['remember_login']);
   setcookie("remember_login", "", time() - 3600,'/');
   }
   } 
   return $remember_login;
   }
   public function captchaAns()
   {

    if(isset($_SESSION['captcha']))
    {
    $s_ans=$this-> getInputVal('captcha');
    $captcha_ans=$_SESSION['captcha'];
    if($s_ans!=$captcha_ans)
    {
    $f_cookie_msg="<font color='red'>Your Answer to the Security Question is Incorrect.Please try again</font>";
    $this->redirPage($f_cookie_msg,"index.php#logout_portal");
    }
    else
    {
    //$ext_dir="captcha_imgs/".$_SESSION['captcha'].".png";
    $ext_dir=$this->dAF->captchasrc.$_SESSION['captcha'].".png";
    if(file_exists($ext_dir))
    {
     unlink($ext_dir);   
    }
    unset($_SESSION['captcha']);
    }
    }
    }
   
   private function isNumber($in_str) 
   {
   $pattern="/[0-9]/"; 
   if(preg_match($pattern, $in_str))
   {
   return TRUE;
   }
   else 
   {
   return FALSE;
   }
   }
    private function isAlphabet($in_str) 
   {
   $az=range("a","z");
   $zeroNinerange=range(1,9);
   $az=  array_merge($az,$zeroNinerange);
   for ($index=0;$index<strlen($in_str);$index++)
   {
   if(in_array(strtolower($in_str[$index]), $az) && !is_numeric($in_str[0]))
   {
   $comfirm[]=$in_str[$index];
   }
   else 
   {
   $comfirm[]="NO";
   }
   }
   //var_dump($comfirm);exit();
   if(in_array("NO", $comfirm))
   {
   return FALSE;
   }
   else 
   {
    return TRUE;   
   }
   
   }
    private function isNumOrChar($in_str) 
   {
   $pattern2="/([0-9]|[a-z])/im";//$pattern2="/[a-z0-9]/im";
   if(preg_match($pattern2, strtolower($in_str)))
   {
   return TRUE;
   }
   else 
   {
   return FALSE;
   }
   }
   public  function email($in_str)
   { 
   $http_method=$this->fitech_http_method();
   if(!$rt_str=  filter_input($http_method,$in_str, FILTER_SANITIZE_EMAIL))
   {
   return FALSE;
   }
   else
   {
   if(!$rt_str=  filter_input($http_method,$in_str, FILTER_VALIDATE_EMAIL))
   {
   return FALSE;
   }
   else 
   {
   return $rt_str;
   }
   }
   }
   public  function phone_no($phone_no="phone_no")
   {
   $clnphoneno=$this-> getInputVal($phone_no);
   if(! is_numeric($clnphoneno) )
   {
   return FALSE;
   }
   else   
   {
   $num_len=  strlen($clnphoneno);
   if($num_len <1 || $num_len > 14)
   {
   return FALSE;
   }
   else 
   {
   return $clnphoneno; 
   }
   }
   }
   public  function password($password="password")
   {
   $clnpassword=$this-> getInputVal($password);
   if(count($this->pass)===0)
   {
   $this->pass[0]=$clnpassword;  
   return $clnpassword;
   }
   else 
   {
   if ($this->pass[0]!==$clnpassword)
   {
   //print_r($this->pass);exit;
   return FALSE;
   }
   else 
   {
   return $clnpassword; 
   }
   }
   }
   public  function getInputVal($in_str)
   {
   $http_method=$this->fitech_http_method();
   if(!$rt_str =  filter_input($http_method,$in_str, FILTER_SANITIZE_STRING))
   {
   return FALSE;
   }
   else
   {
   return $rt_str;
   }
   }
   
   public  function username($username="username")
   {
   $clnusername=$this-> getInputVal($username);
   if($clnusername!==FALSE)
   {
   if($this->isNumber(substr(trim($clnusername),0,1))) //is_numeric
   {
   return FALSE; 
   }
   else 
   {
   if($this->isAlphabet($clnusername))
   {
   return strtolower(trim($this->fitech_remove_all_white_spaces($clnusername)));    
   }
   else 
   {
   return FALSE;  
   }
   }
   }
   }
   public  function getInputArrs()
   { 
   $http_method=$this->fitech_http_method();
   if(!$rt_str = filter_input_array($http_method, FILTER_SANITIZE_STRING))
   {
   return FALSE;
   }
   else
   {
   //ksort($rt_str);
   return $rt_str;
   }
   }
   public function testRegKeys($key) 
   {
   switch ($key)
   {
   case "phone_no":
   return $this->phone_no($key);
   break;
   case "username":
   return $this->username($key);
   break;
   case "email":
   return $this->email($key);
   break;
   case "password":
   case "cpassword":
   return $this->password($key);
   break;
   default:
   return $this->getInputVal($key);
   break;
   }    
   }
   //filter_input_array($type, $rt_str, $add_empty)
   //filter_has_var(INPUT_COOKIE, $variable_name)

   public function get_site_domain_url($site_domain=NULL,$dir_name=NULL)
    {
    if($site_domain==NULL)
    {
    $site_domain=$_SERVER['SERVER_NAME'];
    }
    if (strpos($site_domain,"www.")!==false)
    {
    if($dir_name==null)
    {
    $site_domain_url="http://$site_domain/";
    }
    else
    {
    $site_domain_url="http://$site_domain/$dir_name/";
    }
    }
    else 
    {
    if($dir_name==null)
    {
    $site_domain_url="http://$site_domain/fitechbot/";
    }
    else
    {
    $site_domain_url="http://$site_domain/fitechbot/$dir_name/"; 
    }
    }
    return $site_domain_url;
}
    public function getIP()
    {
    if(!$in_ip=  filter_input(INPUT_SERVER,'REMOTE_ADDR',FILTER_VALIDATE_IP))
    {
    if(!$in_ip=filter_input(INPUT_SERVER,'REMOTE_ADDR', FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
    {
    return null;
    }
    else
    {
    return $in_ip;
    }
    }
    else
    {
    return $in_ip;
    }
    }
    public function splitPost($in_str,$brk_len=null,$in_str_id=null)
    { 
    if($in_str_id==null)
    {
    $in_str_id=md5(uniqid(rand(),TRUE));
    $in_str_id=Substr($in_str_id,0,15);
    }
    if($brk_len===null)
    {
    $brk_len=1000;
    }
    $in_str_length=strlen($in_str);
    if($in_str_length>$brk_len)
    {
    $break=substr($in_str,0,$brk_len);
    $breakmore=substr($in_str,$brk_len,50000);
    return "<span><font color='black'>$break</span><span style='display:none;' id='hidepost_$in_str_id'>$breakmore</font></span><span>
    <a href='#hidepost_$in_str_id-1'  id='hidepost_$in_str_id' onclick=hidepost(this.id)></span><span id='changenav_hidepost_$in_str_id'>...read all>></span></a>
    "; 
    }
    else
    {
    return "<font color='black'>$in_str</font>";
    }
    }
    
    public function ptc($in_src,$in_url,$in_time,$in_url2=null) //post tc
    {    
    return "<table>
    <tr>
    <td rowspan=2> <span ><img class='frndpix' src='$in_src' width='40px' height='40px' > </span></td>
    <td><span style='min-width:50px; vertical-align:top;' >&nbsp;&nbsp;" .$in_url."&nbsp; $in_url2</span></td>
    </tr>
    <tr>
    <td>&nbsp;<font color='gray'>" .$in_time."</font></td>
    <td></td>
    </tr>
    </table>";
    }
    
}

