<?php
session_start();
if(!isset($_SESSION['session_to_check']))
{
    echo 'error occured';
    exit;
}

$regno=$_REQUEST['regno'];
$regnosession=strtolower($regno);

$promo_info=$_REQUEST['promo_info'];
$session_to_check=$_SESSION['session_to_check'];
require_once "../../secreet/confidential/db_connection.php";
if($session_to_check=="rsp")
{
$return_con= db_connection("rsp");
}
else
{
  $return_con= db_connection($session_to_check);  
}
$con=$return_con[0];

    
require_once "../remarks_and_grades_function.php";

$checkclass=mysql_query("SELECT * FROM studentinfo WHERE regno='$regno'");
$validateclass=mysql_fetch_array($checkclass);
$passport=$validateclass['passport'];
$fc=$validateclass['class'];
$name=$validateclass['name'];
$student_class=$fc;
$fd=$validateclass['classdivision'];
$rc=$fc.$fd;
$rc=strtolower($rc);

if($promo_info=="PROMOTED")
{


$promo_info=get_promo_info($student_class);

}
if ($promo_info=="REPEATED")
{
    
  $promo_info="TO REPEAT";  
  
}
       
      //$result = mysql_query("AlTER TABLE `studentinfo` DROP `promotion_info`");
 

      //$result = mysql_query("AlTER TABLE `studentinfo` ADD `promotion_info` VARCHAR(255)");
 
    
 mysql_query("UPDATE `studentinfo` SET `promotion_info`='$promo_info' WHERE regno = '$regno'") or die("error");
     if($session_to_check=="rsp")
{
$return_con= db_connection("rsp");
}
else
{
  $return_con= db_connection($session_to_check);  
}

$con=$return_con[0];

$result=mysql_query("SELECT PRESENTTERM,PRESENTYEAR FROM `schinfo` ") or die("");

$validate= mysql_fetch_array($result);

$year=$validate['PRESENTYEAR'];

$term=$validate['PRESENTTERM'];
$termuse=$term;

if($termuse=="THIRD TERM")
{
$term=strtolower($term);

  
//$year=date("Y");

$both="_".$year."_".$term;

$both1="_".$year."_first term";

$both2="_".$year."_second term";

$cacheFile ="../portal_student/reportsheet/$regnosession".$both.".html";


$dir="../portal_student/reportsheet";
 if(!file_exists($dir))
       {
          mkdir($dir, 0755, true);
       }

require_once "../RESULT_PROCESSOR/update_changes_on_html_report.php";



    ob_start();
    // write content
    require "../portal_student/done.php";
    $content = ob_get_contents();
    ob_end_clean();
    file_put_contents($cacheFile,$content);
   //echo $content;


}





//unset($_SESSION['session_to_check']);

     
     echo "This student has been successfully $promo_info ";


/*
$promo_info="TO REPEAT";

$resultall = mysql_query("SELECT regno FROM `studentinfo` WHERE promotion_info='REPEATED'") or die(mysql_error());
while($update_p_info=mysql_fetch_array($resultall))
{

$regno=$update_p_info['regno'];

mysql_query("UPDATE `studentinfo` SET `promotion_info`='$promo_info' WHERE regno='$regno'") or die("error");

     

}
*/


?>