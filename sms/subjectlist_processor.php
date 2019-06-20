<?php
$return_con= db_connection("rsp");
$con=$return_con[0];

$db_psubtotal_stored_in_array=array();
 
/*
$db_psubjects_stored_in_array=array();
$db_pft_stored_in_array=array();
$db_pst_stored_in_array=array();
$db_pe_stored_in_array=array();
$db_subjects_list_stored_in_array=array();
*/


function complete_reg ($sub_index,$ft_index,$st_index,$e_index,$con,$both,$fc,$fd,$name,$regno,$regis)
{
    
    $sub=$_REQUEST[$sub_index];

//echo $sub.'<br/>';

    if($sub=="")
    {
    $ft=0;
    $st=0;
    $e=0;
    }
else
    {
    //$ft_index=  filter_input(INPUT_POST,  $ft_index);
    $ft=$_REQUEST[$ft_index];
    $st=$_REQUEST[$st_index];
    $e=$_REQUEST[$e_index];
    }
    
  $subtotal=($ft + $st +$e);
  
  
  
$insert99 = "INSERT INTO `hlam$both` (subject,class,classdivision,mark,name,regno,firstca,sencondca,exam) VALUES
('$sub','$fc','$fd','$subtotal','$name','$regno','$ft','$st','$e')";
if (!mysql_query($insert99,$con))
{
 die("Error:your form could not be submitted".mysql_error());
}
/*
$insert33 = "INSERT INTO `a_$regis$both` (subject,firstca,sencondca,exam) VALUES
('$sub','$ft','$st','$e')";
if (!mysql_query($insert33,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 
*/
return $subtotal;
}


$sql="CREATE TABLE IF NOT EXISTS `studentinfo` (PINID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(PINID),`name` varchar(300),`regno` varchar(300),`class` varchar(200),`classdivision` varchar(100),`passport` varchar(300),`promotion_info` varchar(255))";
if (!mysql_query($sql,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 

$insert = "INSERT INTO `studentinfo` (name,regno,class,classdivision,passport,promotion_info) VALUES('$fullname','$regno','$class','$cd','$passloc','')";
if (!mysql_query($insert,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 
$result=mysql_query("SELECT PRESENTTERM,PRESENTYEAR FROM `schinfo` ") or die("");
$validate= mysql_fetch_array($result);
$year=$validate['PRESENTYEAR'];
//$term=$validate['PRESENTTERM'];

$termuse="FIRST TERM";
$term=$termuse;
$term=strtolower($term);
$both="_".$year."_".$term;

$both1="_".$year."_first term";

$both2="_".$year."_second term";
$regno=$regno;
$regnosession=strtolower($regno);
$regis=strtolower($regno);

/*
$sql="CREATE TABLE IF NOT EXISTS `a_$regis$both` (PINID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(PINID),subject varchar(50),firstca int(50),sencondca int(50),exam int(50))";
if (!mysql_query($sql,$con))
  {
echo "error bro";
exit;
  }
  */
 

  
$sqly="CREATE TABLE IF NOT EXISTS `hlam$both` (markID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(markID),subject varchar(50),class varchar(10),classdivision varchar(5),mark int(50),name varchar(100),regno varchar(200),firstca int(50),sencondca int(50),exam int(50))";
if (!mysql_query($sqly,$con))
  {
echo "error bro";
exit;
  }
 
  $r=mysql_num_rows(mysql_query("SHOW columns from `hlam$both` where field='firstca'"));
if ($r==0)
    { 
   
     mysql_query("alter table `hlam$both` add  `firstca` int(50)");
     mysql_query("alter table `hlam$both` add  `sencondca` int(50)");
     mysql_query("alter table `hlam$both` add `exam` int(50)");
     
    }
  
  
$checkclass=mysql_query("SELECT * FROM `studentinfo` WHERE regno='$regno'");
$validateclass=mysql_fetch_array($checkclass);
$name=$validateclass['name'];
$fc=$validateclass['class'];
$fd=$validateclass['classdivision'];
$rc=$fc.$fd;
$rc=strtolower($rc);

$sub1="ENGLISH LANGUAGE";
$sub2="MATHEMATICS";
$ft1=$_REQUEST['ft1'];
$st1=$_REQUEST['st1'];
$e1=$_REQUEST['e1'];
$ft2=$_REQUEST['ft2'];
$st2=$_REQUEST['st2'];
$e2=$_REQUEST['e2'];
$sub1total=($ft1 + $st1 +$e1);
$sub2total=($ft2 + $st2 +$e2);
$insert2 = "INSERT INTO `hlam$both` (subject,class,classdivision,mark,name,regno,firstca,sencondca,exam) VALUES
('$sub1','$fc','$fd','$sub1total','$name','$regno','$ft1','$st1','$e1'),
('$sub2','$fc','$fd','$sub2total','$name','$regno','$ft2','$st2','$e2')";

if (!mysql_query($insert2,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 
/*
$insert34 = "INSERT INTO `a_$regis$both` (subject,firstca,sencondca,exam) VALUES
('$sub1','$ft1','$st1','$e1'),
('$sub2','$ft2','$st2','$e2')";
if (!mysql_query($insert34,$con))
{ 
 die("Error:your form could not be submitted".mysql_error());
} 
*/

for($u=3;$u<=30;$u++)
{
 $sub_index="sub".$u;
 $sub_index="$sub_index";                                           //$db_psubjects_stored_in_array[]=$sub_index;
 $ft_index="ft".$u;
 $st_index="st".$u;
 $e_index="e".$u;


$returned_subtotal=complete_reg ($sub_index,$ft_index,$st_index,$e_index,$con,$both,$fc,$fd,$name,$regno,$regis);
$db_psubtotal_stored_in_array[]=$returned_subtotal;
}

$all22=array_sum($db_psubtotal_stored_in_array);
$all22=($all22 + $sub1total + $sub2total);

$tab1="CREATE TABLE IF NOT EXISTS `all_$rc$both`(allID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(allID),name varchar(50),regno varchar(50),allmarks int(50))";
if (!mysql_query($tab1,$con))
{ 
 die("Error:table could not be created".mysql_error());
} 
$insertall = "INSERT INTO `all_$rc$both` (`name`,`regno`,`allmarks`) VALUES ('$name','$regno','$all22')";
if (!mysql_query($insertall,$con))
{ 
 die("Error:values not inserted".mysql_error());
} 

mysql_close($con);

?>