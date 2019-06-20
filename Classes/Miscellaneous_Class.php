<?php
/**
 *Description of Miscellaneous_Class
 *This class by its name is  paradoxical
 * @author Ayologbon
 */

class Miscellaneous_Class 
{  
  public $err_f_cookie_name;  
  public function __construct()
{
  $this->err_f_cookie_name="error_report";
  
}
   
private function fitechbot_order($str)
{
   $str=trim($str);
   $len=strlen($str);
   if($len>=4 && strpos($str,"\n")===FALSE && strpos($str,"<br>")===FALSE && strpos($str,"&amp;amp;#39;")===FALSE && strpos($str,"&amp;amp;#34;")===FALSE && strpos($str,'"')===FALSE && strpos($str,"'")===FALSE)
   {
   $fchar=substr($str,0,1);
   if(substr($str,-1,1)===".")
   {
   $lcha=substr($str,-2);
   $mstr=substr($str,1,$len-3);
   }
 else 
   {
   $lcha=substr($str,-1);
   $mstr=substr($str,1,$len-2);   
   }
   
   //$mstr2=$mstr;
   $mstr=str_shuffle($mstr);
   $str=$fchar.$mstr.$lcha;

}
return $str;

}

private function fitech_array_map($in_arr)
{
    $r_arr=array();
    
    foreach ($in_arr as $in_value)
    {
    $r_arr[]=$this->fitechbot_order($in_value);  
    }
    return $r_arr;
}

public function mindTxt($str)
{
   $str_ar=explode(" ",$str);
   $str_ar=  $this->fitech_array_map($str_ar);
   $str=implode(" ",$str_ar);
   return $str;
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
   

 public  function fitech_sanitate_str($in_str)
{ 
   $a=$this->fitech_http_method();
   if(!$rt_str =  filter_input($a,$in_str, FILTER_SANITIZE_STRING))
   {
   return FALSE;
   }
   else
   {
   return $rt_str;
   }
   
   //filter_input_array($type, $rt_str, $add_empty)
   //filter_has_var(INPUT_COOKIE, $variable_name)
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
    return $in_str;
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

public function fitechDialogBox($in_msg,$in_id)
{    
    return "<div id='confirm_d_$in_id' class='confirm_d' >
    <div class='text-primary'  for='Dialog_box'> $in_msg </div><br/>
    <button onclick=delete_post(event,'$in_id') title='YES' style='float:left;' name='YES' id='$in_id' class='btn btn-primary btn-xs'>YES</button>
    <button onclick=delete_post(event,'$in_id')  title='NO'  style='float:right;' name='NO' id='$in_id' class='btn btn-primary btn-xs'>NO</button>
    </div>";
}




public function fitech_custom_input($in_str)
{
    if (is_array($in_str))
    {   
    foreach ($in_str as $key=>$in_value)
    {
    $in_str[$key]=htmlentities($in_value,ENT_QUOTES,'UTF-8');
    }
    }
    else
    {
     $in_str=  htmlentities($in_str,ENT_QUOTES,'UTF-8'); 
    } 
    return $in_str;
    exit;
}

public  function fitech_validate_email($in_str)
{ 
   
  if(!$rt_str=  filter_input(INPUT_POST,$in_str, FILTER_SANITIZE_EMAIL))
    {
      return FALSE;
    }
else
   {
    if(!$rt_str=  filter_input(INPUT_POST,$in_str, FILTER_VALIDATE_EMAIL))
    {
      return FALSE;
    }
 else {
        return $rt_str;
      }
    }
 }

   
public function fitech_bot_redir($in_name,$in_msg,$in_loc)
{
       $in_name=$this->err_f_cookie_name; 
       if(isset($_COOKIE[$in_name]))
       {
        unset($_COOKIE[$in_name]);
       }
       setcookie($in_name,$in_msg,time()+5);
       ob_end_clean();
       header("location:$in_loc");
       exit;
}


}
?>