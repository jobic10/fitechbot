<?php
require_once '../Classes/Portal_Class.php';
$get_class_handle =new Portal_Class();
//$getremarks=$get_class_handle->getRemarks();

  //$getremarks=$get_class_handle->getRemarks($in_class,$in_scores); 


echo $get_class_handle->getRemarksAndGrades("SSS 3","90","GRADE");
exit();
function grades($in_scores,$in_class)
{




if($in_scores<40 )
{
 return "F<sub>9</sub>"; exit;
}


if (strpos($in_class,"JSS")!==false)
{

if($in_scores>39 && $in_scores<50)
{
return "P"; exit;
}


if($in_scores>49 && $in_scores<75)
{
return "C"; exit;
}


}

else
{

if($in_scores>39 && $in_scores<45)
{
return "E<sub>8</sub>"; exit;
}


if($in_scores>44 && $in_scores<50)
{
return "D<sub>7</sub>"; exit;
}






if($in_scores>49 && $in_scores<55)
{
 return "C<sub>6</sub>"; exit;
}

if($in_scores>54 && $in_scores<60)
{
 return "C<sub>5</sub>"; exit;
}


if($in_scores>59 && $in_scores<65)
{
 return "C<sub>4</sub>"; exit;
}


if($in_scores>64 && $in_scores<70)
{
 return "B<sub>3</sub>"; exit;
}


if($in_scores>69 && $in_scores<75)
{
 return "B<sub>2</sub>"; exit;
}

}

if($in_scores>74 && $in_scores<200)
{
 return "A<sub>1</sub>"; 
 exit;
}


}


function get_promo_info($in_class)
{

     if($in_class=="JSS 1" ) 

     {

      return "PROMOTED TO JSS 2";
exit;

     }

      if($in_class=="JSS 2" ) 

     {

      return "PROMOTED TO JSS 3";
       exit;
     }

     if($in_class=="JSS 3" ) 

     {

      return "PROMOTED TO SSS 1";
      exit;

     }

     
     if($in_class=="SSS 1" ) 

     {

      return "PROMOTED TO SSS 2";
      
       exit;
     }



     if($in_class=="SSS 2" ) 

     {

      return "PROMOTED TO SSS 3";
      exit;

     }


     
     if($in_class=="SSS 3" ) 

     {

      return " ";
      exit;

     }


}






?>
