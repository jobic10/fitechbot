<?php
session_start();

if (!isset($_SESSION['role'])) 
{

echo '<font color=red size=20>ACCESS DENIED !</font>';
exit;

}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css//print.css" />










</head>






<body>
<?php

require_once "../../secreet/confidential/db_connection.php";

$return_con= db_connection("sms");
$con=$return_con[0];

if(!isset($_REQUEST['id']))
{
echo '<font color=red size=20>ACCESS DENIED !</font>';
exit;

}
//$id = intval($_REQUEST['id']);

$id=$_REQUEST['id'];






$result=mysql_query("SELECT * FROM students where RegNo='$id'");
$check=mysql_num_rows($result);
if($check<1)
{
$result=mysql_query("SELECT * FROM staff where staff_reg_id='$id'");


$validate = mysql_fetch_array($result);




$dbsurname=$validate['FullName'];

$dbclass=$validate['Class_taught'];

$cd=$validate['classdivision'];
if($dbclass=="Non-teaching staff")
{
  $cd="";
}

$dbaddress=$validate['Address'];
$dbemail=$validate['Email'];
$dbnumber=$validate['PhoneNumber'];
$dbsex=$validate['Sex'];
$dbbirth=$validate['BirthDate'];
$dblocalgov=$validate['LocalGov'];

$dbpassport=$validate['Passport'];

$dbusername=$validate['UserName'];

$dbpassword=$validate['PassWord'];
$dbsubmitdate=$validate['SubmitDate'];

$pw=$validate['Role'];

$pn=$validate['Subject_taught'];

$nationality=$validate['Nationality'];

$state=$validate['State'];
$disability=$validate['Disability'];
$date=$validate['SubmitDate'];
$regno=$validate['staff_reg_id'];


//$sc=$validate['Sc'];
}


else
{
$result=mysql_query("SELECT * FROM students where RegNo='$id'");

$validate = mysql_fetch_array($result);




$dbsurname=$validate['FullName'];

$dbclass=$validate['Class'];

$cd=$validate['classdivision'];

$dbaddress=$validate['Address'];
$dbemail=$validate['Email'];
$dbnumber=$validate['PhoneNumber'];
$dbsex=$validate['Sex'];
$dbbirth=$validate['BirthDate'];
$dblocalgov=$validate['LocalGov'];

$dbpassport=$validate['Passport'];

$dbusername=$validate['UserName'];

$dbpassword=$validate['PassWord'];
$dbsubmitdate=$validate['SubmitDate'];

$pw=$validate['Pw'];

$pn=$validate['Pn'];

$nationality=$validate['Nationality'];

$state=$validate['State'];
$disability=$validate['Disability'];
$date=$validate['SubmitDate'];
$regno=$validate['RegNo'];


$sc=$validate['Sc'];
}
?>









<!--<div class=welcomemsg><?php echo $dbusername.', welcome to your personal portal !';?></div>-->




<TABLE class="print" width="653" align=center border=0 bordercolorlight="#C0C0C0" cellspacing=7 cellpadding=7 bordercolordark="#808080">







<TR valign=center>
<TD  colspan=2 width=653>

<?php
if($check<1)
{
 echo "
<img  alt='banner' src='../images/banner_staff.png' width='650' height='120'/>

";
}
else
{ echo"


<img  alt='banner' src='../images/banner.png' width='650' height='120'/>



";
}
?>






</TD>
</TR>








<TR valign=center>
<TD 









width=500>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font color=red size=6>Personal details</font>

</TD>
<TD rowspan=4 width=100 align=center>
  <?php echo "<img width='150' height='160'src='../$dbpassport'/>";?>

</TD>
</TR>
<TR valign=center>




<TR valign=top>
<TD colspan=2 width=400>
<b>REGISTRATION NUMBER:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<font size=4>$regno</font>"; ?>

</TD>

</TR>










<TD width=400>















<b>NAME:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo "<font size=4>$dbsurname</font>"; ?>


</TD>
</TR>
<TR valign=center>
<TD width=400>
<?php
if($check<1)
{
 echo "<b>CLASS TAUGHT:</b>";
}
else
{ echo"
<b>CLASS:</b>
";
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<font size=4> $dbclass $cd</font>";?>

</TD>
</TR>
<TR valign=center>
<TD width=370>
<b>GENDER:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<font size=4> $dbsex</font>"; ?>
</TD>
</TR>
<TR valign=center>

<TD colspan=2 width=370>
<b>DATE OF BIRTH:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<font size=4>$dbbirth</font>"; ?>


</TD>

</TR>
<TR valign=center>
<TD colspan=2 width=600>
<b>ADDRESS:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<font size=4> $dbaddress</font>"; ?>


</TD>


</TR>
<TR valign=center>
<TD colspan=2 width=400>
<b>LOCAL GOVERNMENT:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<font size=4> $dblocalgov</font>"; ?>

</TD>

</TR>
<TR valign=top>
<TD colspan=2 width=400>
<b>PHONE NUMBER:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<font size=4> $dbnumber</font>"; ?>

</TD>

</TR>
<TR valign=center>
<TD colspan=2 width=400>
<b>EMAIL:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<font size=4>$dbemail</font>"; ?>

</TD>

</TR>
<TR valign=top>
<TD width="653" colspan=2>


<b>Date Submitted:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<font size=4>$date</font>"; ?>
</TD>
</TR>



<TR valign=top>
<TD colspan=2 width=400>
<?php
if($check<1)
{
 echo "<b>SUBJECT TAUGHT:</b>";
}
else
{ echo"
<b>Parent/Guardian Phone Number:</b>
";
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<font size=4> $pn</font>"; ?>

</TD>

</TR>







 <TR valign=top>
<TD colspan=2 width=400>
<?php
if($check<1)
{
 echo "<b>ROLE IN SCHOOL:</b>";
}
else
{ echo"
<b>Parent/Guardian Profession :</b>
";
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<font size=4> $pw</font>"; ?>

</TD>

</TR>











 <TR valign=top>
<TD colspan=2 width=400>
<b>State Of Origin :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<font size=4> $state</font>"; ?>

</TD>

</TR>



<TR valign=top>
<TD colspan=2 width=400>
<b>Disability :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<font size=4> $disability</font>"; ?>

</TD>

</TR>







<TR valign=top>
<TD width="653"colspan=2>
<?php
if($check<1)
{
 echo "<b>NOTE: <em>You are to submit a copy of this e-slip to the school authority.Your application will NOT be processed should you failed to do so. You are also adviced to make a copy of this e-slip for reference purposes.</em></b>";
}
else
{ echo"

<b>NOTE: <em>You are adviced to submit a copy of this e-slip to  your form master.Your application will NOT be processed should  you failed to do so.
You are also adviced to make a copy of this e-slip for reference purposes.</em></b>

";
}
?>


</TD>
</TR>






</TABLE>



<script type="text/javascript" src="../javascript//print.js"></script>







<!--<a href="../loginportal.php">go back to the control Panel</a>-->











</TD>

<TD width=3 height=69 valign=top align=right>
                                




</body>
</head>