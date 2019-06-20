<?php
if(!isset($_REQUEST['cookie_username_etranzact_rip']))
{
header("location:index.php");
exit;
}
else
{

$username_for_e_tranzact_processor=$_REQUEST['cookie_username_etranzact_rip'];


}

$check_outcome=$_REQUEST['SUCCESS'];
if(!$check_outcome)
{
setcookie("etranzact_failure_msg","<p><font color=red size='2'>Sorry! Your transaction was not successful,as you did not enter any pin</font></p>",time()+5);
header("location:demo_etransact.php");
exit;


}
parse_str($check_outcome, $output);

$failure_or_not=$output['SUCCESS'];

if($failure_or_not== "-1")
{
setcookie("etranzact_failure_msg","<p><font color=red size='2'>Sorry! Your transaction was not successful,Please Try again</font></p>",time()+5);
header("location:demo_etransact.php");
exit;



}
else
{




//require "secreet/confidential/config.php";


//$myfile=fopen("header.txt","w") or die ("unable to open file");


//$txt=var_dump($_SESSION);

//fwrite($myfile,$txt);
//fclose($myfile);





//print_r($_SESSION);
//print_r($_COOKIE,TRUE);
$host_server= shell_exec('hostname');

$host_server=trim($host_server);
$host_server=strtolower($host_server);

//echo $_SERVER["SERVER_ADDR"];

//echo $host_server;


$site_domain=$_SERVER["SERVER_NAME"];


//echo $site_domain;


//$site_domain="www.".$site_domain.".com";

$site_domain=trim($site_domain);

$site_domain=strtolower($site_domain);




if (strpos($site_domain,"www.")!==false)
{
$site_domain=str_replace("www.","",$site_domain);
}


if ($host_server===$site_domain)
{

//echo "$site_domain";





if (strpos($site_domain,"www.")!==false)
{
$site_domain=str_replace("www.","",$site_domain);
}


if (strpos($site_domain,".")!==false)
{
$site_domain=str_replace(".","",$site_domain);
}


$site_domain=trim("localhost");
$site_domain=substr($site_domain,0,8);

//echo "$site_domain";


$site_domain=$site_domain."_";
$user=$site_domain."fitech";
}
else
{
//echo "$host_server";



if (strpos($site_domain,"www.")!==false)
{
$site_domain=str_replace("www.","",$site_domain);
}


if (strpos($site_domain,".")!==false)
{
$site_domain=str_replace(".","",$site_domain);
}

$site_domain=trim($site_domain);
$site_domain=substr($site_domain,0,8);


//echo "$site_domain";


$site_domain=$site_domain."_";
$user=$site_domain."fitech";
}
$con = mysql_connect('localhost', $user, '^%_&Fg_2');




if (!$con)
  {


  die('Could not connect: ' . mysql_error());
  


   }
   //$db_name="smckabba_schooldb";

   $db_name=$site_domain."rsp";
   mysql_query("CREATE DATABASE IF NOT EXISTS $db_name",$con);
   mysql_select_db("$db_name", $con) or die("cannot select database:".msql_error());
   $db_name=$site_domain."bot";
   mysql_query("CREATE DATABASE IF NOT EXISTS $db_name",$con);
 


//$parts = parse_url($check_outcome);
//parse_str($parts['query'], $query);
//$st=$query['PAYMENT_CODE']; 



$result=mysql_query("SELECT PRESENTTERM,PRESENTYEAR FROM schinfo ") or die("error".mysql_error());

$validate= mysql_fetch_array($result);


$term=$validate['PRESENTTERM'];
$termuse=$term;


$term=strtolower($term);

$pyear=$validate['PRESENTYEAR'];

$pyear=trim($pyear);

$table_name_one="e_tranzact_student_".$pyear."_".$term;


$table_name_two="e_tranzact_info_".$pyear."_".$term;

$e_param=array(RECEIPT_NO,
PAYMENT_CODE,
MERCHANT_CODE,
TRANS_AMOUNT,
TRANS_DATE,
TRANS_DESCR,
CUSTOMER_ID,
BANK_CODE,
BRANCH_CODE,
SERVICE_ID,
CUSTOMER_NAME,
CUSTOMER_ADDRESS,
TELLER_ID,
USERNAME,
PASSWORD,
BANK_NAME,
BRANCH_NAME,
CHANNEL_NAME,
PAYMENT_METHOD_NAME,
PAYMENT_CURRENCY,
TRANS_TYPE,
TRANS_FEE,
TYPE_NAME,
LEAD_BANK_CODE,
LEAD_BANK_NAME
);

$input_values_etranzact=array();


//echo "<font color='blue' size='8'>Your transaction has been successfully processed and below are the transaction details !</font><br/>";


parse_str($check_outcome, $output);

$param_num=count($e_param);

for($v=0;$v<$param_num;$v++)
{
$name_e=$e_param[$v];

$rn="'".$output[$name_e]."'";

$input_values_etranzact[]=$rn;

//echo "<font color='green' size='5'>$name_e: $rn </br></font>";

}
$comma_separated = implode(" varchar(200),",$e_param);

$comma_separated2 = implode(",",$e_param);


$comma_separated3 = implode(',',$input_values_etranzact);


$e_param_query_db= $comma_separated." varchar(200)";


$e_param_query_db=strtolower($e_param_query_db);



$e_param_query_db2=strtolower($comma_separated2);

$e_param_query_db3=strtolower($comma_separated3);


function E_tranzact_info_create_tb($query_db,$tb_name,$con)
{
$new_user="CREATE TABLE IF NOT EXISTS `$tb_name` (etranzactinfoID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(etranzactinfoID),$query_db)";


if (!mysql_query($new_user,$con))

{ 
 die("Error:table could not be created".mysql_error());
}


}

E_tranzact_info_create_tb($e_param_query_db,$table_name_two,$con);



function E_tranzact_info_insert_dt($query_db,$query_db2,$tb_name,$con)
{


mysql_query("INSERT INTO `$tb_name` ($query_db) VALUES ($query_db2)") or die("datas could not be inserted".mysql_error());

//mysql_query($new_user)or print('Error performing query');

}

E_tranzact_info_insert_dt($e_param_query_db2,$e_param_query_db3,$table_name_two,$con);




$rn_e=$output['RECEIPT_NO'];

$pc=$output['PAYMENT_CODE'];

$ti=$output['TELLER_ID'];

$ta=$output['TRANS_AMOUNT'];

$td=$output['TRANS_DATE'];

$ca=$output['CUSTOMER_ADDRESS'];


$check = mysql_query("SELECT `UserName` FROM `$table_name_one` WHERE UserName = '$username_for_e_tranzact_processor'") or die(mysql_error());

$check2 = mysql_num_rows($check);//if the name exists it gives an error

if ($check2> 0) 
{

mysql_query("UPDATE `$table_name_one` SET amount_paid='$ta',paid_or_not='YES',term='$termuse',time='$td',reg_status='cp' WHERE UserName = '$username_for_e_tranzact_processor'") or die("error");


mysql_query("UPDATE `$table_name_two` SET username='$username_for_e_tranzact_processor' WHERE payment_code = '$pc'") or die("error detected");



if(isset($_COOKIE['cookie_username_etranzact_rip']))
{

setcookie("cookie_username_etranzact_rip",'',time()-36000);


setcookie("sp","<font color='green'>Your transaction was successfully processed</font>",time()+5);



$title="PAYMENT ALERT FROM, $username_for_e_tranzact_processor";
  
$toay="ayologbon@gmail.com";
$subjectay="$title ";
$msgay="Attention Boss,$username_for_e_tranzact_processor has just paid Her School Fees:"  ."\r\n"."Amount:$ta"."\r\n"."On:$td" ."\r\n"."Student Address:$ca"."\r\n"."Teller No:$ti"."\r\n"."RECEIPT NO:$rn_e"."\n\r"."PAYMENT CODE:$pc";
$headersay="From:FGGC KABBA"."\r\n"."cc:FGGC KABBA E-TRANZACT";

 mail($toay,$subjectay,$msgay,$headersay);


header("location:portal_student/portal.php");
exit;
}
}

}


?>