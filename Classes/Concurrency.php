<?php
Class Concurrency
{

    public function Concurrency () 
    {    
    
    }
    
    private function check_grammer($length) 
    {
    if($length>1)
    {
    return "s";
    }
    else 
    {
    return ''; 
    }
    }
    
    private function fitech_cast_time_float($in_value) 
    {
    $var_b=explode(".",$in_value);
    $decimal = end($var_b);
    $decimal="0.".$decimal;
    $decimal=(float)$decimal;
    return $decimal;
    }

    private function fitech_get_minutes($in_sec)
    {
    $ty=$in_sec/60;
    $tym=floor($ty);
    return $tym;  
    }

    private function fitech_get_hours($in_sec)
    {
    $ty=$in_sec/3600;
    if(is_float($ty))
    {
    $tyh= (int)current(explode(".",$ty));
    }
    else
    {
    $tyh=$ty;
    }
    $decimal = $this->fitech_cast_time_float($ty) ;
    $decimal=$decimal * 60;
    if(is_float($decimal))
    {
    $tym= (int)current(explode(".",$decimal));
    }
    else 
    {
    $tym=$decimal;   
    }    
    $hrs_full=array("hr"=>"$tyh" ,"mn"=>"$tym");
    return $hrs_full;
    }

    private function fitech_get_days($in_sec)
    {
    $ty=$in_sec/86400;
    if(is_float($ty))
    {
    $tyd= (int)current(explode(".",$ty));
    }
    else
    {
    $tyd=$ty;
    }
    $decimal = $this->fitech_cast_time_float($ty) ;
    $decimal=$decimal * 24;
    if(is_float($decimal))
    {
    $tyh= (int)current(explode(".",$decimal));
    }
    else
    {
    $tyh=$decimal;   
    }
    $decimal = $this->fitech_cast_time_float($decimal) ;
    $decimal=$decimal * 60;
    if(is_float($decimal))
    {
    $tym= (int)current(explode(".",$decimal));
    }
    else 
    {
    $tym=$decimal;   
    }
    $dys_full=array("dy"=>"$tyd" ,"hr"=>"$tyh","mn"=>"$tym");
    return $dys_full;
    }
    
    private function fitech_get_weeks($in_sec)
    {
    $ty=$in_sec/604800;
    $tyw=floor($ty);
    if($tyw>=4)
    {
    return fitech_get_months($in_sec);
    }
    return $tyw;    
    }

    private function fitech_get_months($in_sec)
    {
    $ty=$in_sec/2592000;
    if(is_float($ty))
    {
    $tymnt= (int)current(explode(".",$ty));
    }
    else
    {
    $tymnt=$ty;
    }
    $decimal = $this->fitech_cast_time_float($ty) ;
    $decimal=$decimal * 30;
    if(is_float($decimal))
    {
    $tyd= (int)current(explode(".",$decimal));
    }
    else
    {
    $tyd=$decimal;   
    }
    $decimal = $this->fitech_cast_time_float($decimal) ;
    $decimal=$decimal * 24;
    if(is_float($decimal))
    {
    $tyh= (int)current(explode(".",$decimal));
    }
    else 
    {
    $tyh=$decimal;   
    }
    $decimal = $this->fitech_cast_time_float($decimal);
    $decimal=$decimal * 60;
    if(is_float($decimal))
    {
    $tym= (int)current(explode(".",$decimal));
    }
    else 
    {
    $tym=$decimal;   
    }
    $mnt_full=array("mt"=>"$tymnt","dy"=>"$tyd" ,"hr"=>"$tyh","mn"=>"$tym");
    return $mnt_full;
    }

    private function fitech_get_years($in_sec)
    {
    $ty=$in_sec/31104000;
    if(is_float($ty))
    {
    $tyy= (int)current(explode(".",$ty));
    }
    else
    {
    $tyy=$ty;
    }
    $decimal = $this->fitech_cast_time_float($ty) ;
    $decimal=$decimal * 12;
    if(is_float($decimal))
    {
    $tymnt= (int)current(explode(".",$decimal));
    }
    else
    {
    $tymnt=$decimal;   
    }
    $decimal = $this->fitech_cast_time_float($decimal) ;
    $decimal=$decimal * 30;
    if(is_float($decimal))
    {
    $tyd= (int)current(explode(".",$decimal));
    }
    else 
    {
    $tyd=$decimal;   
    }
    $decimal = $this->fitech_cast_time_float($decimal);
    $decimal=$decimal * 24;
    if(is_float($decimal))
    {
    $tyh= (int)current(explode(".",$decimal));
    }
    else 
    {
    $tyh=$decimal;   
    }
    $decimal = $this->fitech_cast_time_float($decimal);
    $decimal=$decimal * 60;
    if(is_float($decimal))
    {
    $tym= (int)current(explode(".",$decimal));
    }
    else 
    {
    $tym=$decimal;   
    }
    $yr_full=array("yr"=>"$tyy","mt"=>"$tymnt","dy"=>"$tyd" ,"hr"=>"$tyh","mn"=>"$tym");
    return $yr_full; 
    }

    public function fitech_timing($ty,$time=NULL,$date=NULL)
    {
     if($time==null || $date==null)
     {
     date_default_timezone_set('Africa/Lagos');
     $date=date('l: Y-m-d ');
     $time=date('h:i:s A');
     //$time2=time();
     }
    if($ty<59)
    {    
    //$ty=$rtime2-$time2;
    if(isset($comment_time2))
    {
    $ty=$rtime2-$comment_time2;
    }
    if($ty<5)
    {
    $ty=" just now";
    return $ty;
    exit;
    }
    else
    {
    $ty=" $ty  seconds ago";
    return $ty;
    exit;
    }
    }
    else if($ty>59 && $ty<3600)
    {
    //$ty=$ty/60;
    $tym=  $this->fitech_get_minutes($ty);
    if($ty!=="0")
    {
    $s=  $this->check_grammer($tym);
    $ty=" $tym minute$s ago";
    }
    else 
    {
    $ty=" ";    
    }
    return $ty;
    exit;
    }
    elseif($ty>3599 && $ty<86400)
    {
    $tyh=  $this->fitech_get_hours($ty);
    $hr=$tyh['hr'];
    $s=  $this->check_grammer($hr);
    $ty1=" $hr hour$s";
    $ty2=$tyh['mn'];
    if($ty2!=="0")
    {
    $s=$this->check_grammer($ty2);
    $ty2=" $ty2 minute$s ago";
    }
    else
    {
    $ty2="ago @ $time";
    }
    $ty="$ty1 $ty2 ";
    return $ty;
    exit;
    }
    elseif($ty>86399 && $ty< 2592000)
    {
    //$tyd=$tyh/24;
    $tyd=$this->fitech_get_days($ty);  //getdaysFRomTimestamp
    $dy=$tyd['dy'];
    $s=$this->check_grammer($dy);
    $ty1=" $dy day$s";
    $ty2=$tyd['hr'];
    $ty3=$tyd['mn'];
    if($ty2!=="0")
    {
    $s=$this->check_grammer($ty2);
    $ty2=" $ty2 hour$s ";
    }
    else 
    {
    $ty2=" ";    
    }
    if($ty3!=="0")
    {
    $s=$this->check_grammer($ty3);
    $ty3=" $ty3 minute$s ";
    }
    else 
    {
    $ty3=" ";    
    }
    $ty="$ty1 $ty2 $ty3 ago";
    return $ty;
    exit;
    }
    /*
    elseif ($ty>604799 && $ty< 2592000) 
    {
    //$tym=$tyd/30;
    $tyw=$this->fitech_get_weeks($ty);
    $s=$this->check_grammer($tyw);
    $ty1=" $tyw week$s";
    $ty2=$this->fitech_get_days($ty)%30;
    $s=$this->check_grammer($ty2);
    if($ty2==" 0 day")
    {
    $ty2=" ago at $time";  
    }
    else
    {
    $ty2=" $ty2 day$s ago  at $time";
    }
    $ty="$ty1 $ty2";
    return $ty;
    exit;
    }
    */
    elseif ($ty>2591999 && $ty< 31104000) 
    {
    //$tym=$tyd/30;
    $tym=$this->fitech_get_months($ty);
    $mnt=$tym['mt'];
    $s=$this->check_grammer($mnt);
    $ty1=" $mnt month$s";
    $ty2=$tym['dy'];
    $ty3=$tym['hr'];
    $ty4=$tym['mn'];
    if($ty2!=="0")
    {
    $s=$this->check_grammer($ty2);
    $ty2=" $ty2 day$s ";
    }
    else 
    {
    $ty2=" ";    
    }
    if($ty3!=="0")
    {
    $s=$this->check_grammer($ty3);
    $ty3=" $ty3 hour$s ";
    }
    else 
    {
    $ty3=" ";    
    }
    if($ty4!=="0")
    {
    $s=$this->check_grammer($ty4);
    $ty4=" $ty4 minute$s ";
    }
    else 
    {
    $ty4=" ";    
    }
    $ty="$ty1 $ty2 $ty3 $ty4 ago on $date";
    return $ty;
    exit;
    }
    else 
    {
    //$tyy=$tym/12;
    $tyy=$this->fitech_get_years($ty);
    $yr=$tyy['yr'];
    $s=$this->check_grammer($yr);
    $ty1=" $yr year$s";
    $ty2=$tyy['mt'];
    $ty3=$tyy['dy'];
    $ty4=$tyy['hr'];
    $ty5=$tyy['mn'];
    if($ty2!=="0")
    {
    $s=$this->check_grammer($ty2);
    $ty2=" $ty2 month$s ";
    }
    else 
    {
    $ty2=" ";    
    }
    if($ty3!=="0")
    {
    $s=$this->check_grammer($ty3);
    $ty3=" $ty3 day$s ";
    }
    else 
    {
    $ty3=" ";    
    }
    if($ty4!=="0")
    {
    $s=$this->check_grammer($ty4);
    $ty4=" $ty4 hour$s ";
    }
    else 
    {
    $ty4=" ";    
    }
    if($ty5!=="0")
    {
    $s=$this->check_grammer($ty4);
    $ty5=" $ty5 minute$s ";
    }
    else 
    {
    $ty5=" ";    
    }
    $ty="$ty1 $ty2 $ty3 $ty4 $ty5 ago on $date";
    return $ty;
    }
    }



}
?>