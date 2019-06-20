<?php
function fitechbot_order($str)
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

 function fitech_array_map($in_arr)
{
    $r_arr=array();
    
    foreach ($in_arr as $in_value)
    {
    $r_arr[]=$this->fitechbot_order($in_value);  
    }
    return $r_arr;
    print_r($r_arr);
    exit;
}

 function mindTxt($str)
{
   $str_ar=explode(" ",$str);
   $ad="fitechbot_order";
   $str_ar=array_map($ad,$str_ar);
   //$str_ar=  $this->fitech_array_map($str_ar);
   $str=implode(" ",$str_ar);
   return $str;
}
?>