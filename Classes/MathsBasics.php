<?php
/**
 * Description of MathsBasics
 * Handles all mathematical computations
 * @author Kemi Bello
 */
class MathsBasics
{
    public function MathsBasics() 
    {
        
    }
    public function setPosSuFrmNums($num)
    {
    $step=10;
    $a=  range(1, 9991, $step);
    $b=  range(2, 9992, $step);
    $c=  range(3, 9993, $step);    
    if(in_array($num,$a))
    {
        return $num."st";  
    }
    elseif (in_array($num,$b)) 
    {
        return $num."nd";
    }
    elseif (in_array($num,$c)) 
    {
        return $num."rd";
    }
    else
    {
        return $num."th";
    }
    }

    private function my_sort($a,$b)
    {
    if ($a==$b){ return 0;}
    return ($a<$b)?-1:1;
    }

    public function setPosFrmNums($num)
    {
    //usort($num,$this->my_sort);
    rsort($num);
    foreach ($num as $key => $value) 
    {
    $keys[]=$this->setPosSuFrmNums($key+1);
    $values[]=$value;
    }
    return array_combine($keys, $values);
    }
    public function getPosFrmNum($num,$inArr)
    {
    $pos=array_search($num,$inArr);
    return (!$pos===FALSE)? $pos:"Undefined Position";
   
    }
    
    private function RaiseToPower($base,$power) 
    {
     $nwNum=1;
     for($index=0;$index<$power;$index++)
     {
     $nwNum*=$base;    
     }
     return $nwNum;
    }
    
    public function baseTenToAnyBase($instr,$base=2)
    {
    $x = 1;
    $b=$instr;
    $c=array();
    do 
    {
    $a=$b%$base;
    $c[]=$a;
    $b= ($b/$base);
    } 
    while ($b>=$x);
    $c=array_reverse($c,false);
    $c=implode('', $c);
    return $c;
    }
    
    public function base64encode($inArr,$encodedkey=NULL)
    {
    //$encodedkey=array();
    $base64Tb=array();
    $encrptedContent=array();
    
    if($encodedkey===NULL)
    {
    $base64Tb=  $this->base64TableRandKey();
    $encodedkey=$base64Tb["randkey"];
    }
    else
    {
     $base64Tb=  $this->base64TableRandKey($encodedkey);   
     $encodedkey=$base64Tb["randkey"];
    }
    //$base64Tb=$this->base64Table();
    
    for ($index=0;$index<strlen($inArr);$index++)
    {
    $a=$inArr[$index];
    $b=array_search($a, $base64Tb["baseTb"]);
    
    if($b===FALSE){$b=$a;}
    if($b==="0"){$b="***";}
    if(is_numeric($b))
    {
    
    $b=$this->baseTenToAnyBase($b,$base=2);
    }
    $nwArr[]=$b;
    }   
    $encrptedContent["content"]=$nwArr;
    $encrptedContent["encodedKey"]=$encodedkey;
    return $encrptedContent;
    //return json_encode($encrptedContent);
    }
    
    public function base64decode($inArr,$decode_key=NULL)
    {
    //$inArr=json_decode($inArr);
    $base64Tb=$this->base64Table();
    if($decode_key===NULL)
    {
    $decode_key=array_keys($base64Tb);
    }
    $v=  array_values($base64Tb);
    $base64TbRv=  array_combine($v, $decode_key);
    $c="";
    foreach ($inArr as $value) 
    {
    $value="$value";
    
    if(is_numeric($value))
    {
    $index=  $this->anyBaseToBaseTen($value,2);  
    $b=array_search($index, $base64TbRv);
    }
    else 
    {
     $b= $value;  
    }
    if($b==="***"){$b="0";}
    $c.=$b;
    //$nwArr[]=$b;
    }
    return $c;
    //echo $c; exit();
    //print_r(implode(' ', $nwArr));
    }
    public function base64TableRandKey($ranKeys=NULL)
    {
    if($ranKeys===NULL)
    {
    $ranKeys=$this->base64Table();
    $ranKeys= array_keys($ranKeys);
    shuffle($ranKeys);
    }
    $az=array();
    $AZ=array();
    $zeroNine=array();
    $base64Tb=array();
    $az=  range("a", "z");
    $AZ=  range("A","Z");
    $zeroNine=  range(1, 9);
    $values= array_merge($az,$AZ,$zeroNine);
    $base64Tb["baseTb"]=array_combine($ranKeys, $values);
    $base64Tb["randkey"]=$ranKeys;
    return $base64Tb;
    }
    public function base64Table()
    {
    $az=array();
    $AZ=array();
    $zeroNine=array();
    $base64Tb=array();
    $az=  range("a", "z");
    $AZ=  range("A","Z");
    $zeroNine=  range(1, 9);
    $base64Tb= array_merge($az,$AZ,$zeroNine);
    return $base64Tb;
    }
    
    public function anyBaseToBaseTen($inArr,$base=2)
    {
    $nwArr=array();
    $nwBase=0;
    $powerIndex=1;
    for ($index=0;$index<strlen($inArr);$index++)
    {
    $power=(strlen($inArr)-$powerIndex);
    $nwArr[]=$inArr[$index];
    $nwBase+=($inArr[$index]) * ($this->RaiseToPower($base,$power));
    $powerIndex++;
    }
    //$len=count($nwArr);
    return $nwBase;
    //print_r($nwArr);
    // exit();
    }
    
    
    
    
    
}









?>
