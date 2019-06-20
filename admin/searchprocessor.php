<?php

$name=$_REQUEST['stdname'];

if($_REQUEST['stdname']=="")
{

setcookie("notallowed","Sorry! You have not entered any name.",time()+5);

header("location:search.php");
exit;

}


require_once "../secreet/confidential/config.php";
$result = mysql_query("SELECT * FROM `students` where FullName LIKE'%$name%' ")  or die(mysql_error());

$check=mysql_num_rows($result);
if($check<1)
{

setcookie("namenotfound","Sorry! There is no student with that name, Please try again",time()+5);


header("location:search.php");
exit;


}







$result = mysql_query("SELECT * FROM `students` where FullName LIKE'%$name%' ")  or die(mysql_error());



//$validate=mysql_fetch_array($result);
//$dbname=$validate['name'];















while($validate = mysql_fetch_array($result))
  {

$regno=$validate['RegNo'];
$link="<a href='avauf.php?id=$regno'>click here to view full profile</a>";
$passport=$validate['Passport'];

  echo "<table border='1' align=center bgcolor='#00aaff'>
<tr>

  <td width=200>FullName: " .$validate['FullName']."<br/>REG NO: ".$regno.  "<br/>Class: ".$validate['Class'] .$validate['classdivision'] ."<br/>".$link. "</td>
<td width=100><img width=100 height=80 src='../$passport'/>
</td>
</tr>


   </table><br/>";


  }



//echo $dbname;

/*

SELECT * FROM Persons
WHERE City LIKE '%nes%'

*/



?>