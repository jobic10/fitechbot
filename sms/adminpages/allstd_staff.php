<?php
session_start();
if (!isset($_SESSION["role"]))                                
{
header("location:../index.php");
}

require_once "../../secreet/confidential/db_connection.php";
$return_con= db_connection("cms");
$con=$return_con[0];
$result = mysql_query("SELECT * FROM `fbt`")  or die(mysql_error());
$validate = mysql_fetch_array($result);
$banner=$validate['banner'];
$footer=$validate['footer'];
$tray_contents=$validate['tray_contents'];
$tray_contents_overlay=$validate['tray_contents_overlay'];
$logo=$validate['site_logo'];
$banner=strtoupper($banner);
$footer=strtoupper($footer);
$tray_contents=strtoupper($tray_contents);
?>


<!DOCTYPE html>
<html>
<head>
<?php echo "<title>all Staff @ $banner</title>";?>
<script type="text/javascript" src="../javascript/printprofileadmin.js"></script>
<?php
  require_once '../header_sub_sms.php';  
?>
</head>





<body>




<div class="container">
    <row>
        <div class="col-sm-12">

            <div class="login_form_sms_header"><span>
                
Bio-Data of All Registered Student 
                    
                </span></div>
            <div class="table table-responsive">
                <div class="color_tb_text">
<table  class='table table-bordered'>





<?php

$return_con= db_connection("sms");
$con=$return_con[0];
$result = mysql_query("SELECT * FROM `staff`");
$many=mysql_num_rows($result);
 if ($many<=50)
{
echo "
<tr>
<th>FULLNAME</th>
<th>USERNAME</th>
<th>PASSWORD</th>
<th>PHONE NUMBER</th>
<th>REGISTRATION NUMBER</th>
<th>Date of Birth</th>
</tr>";
while($row = mysql_fetch_array($result))
  {
$sn=$row['FullName'];
$id=$row['RegNo'];
$link="<a href='#' title='click to vie more profile about $sn' id='$id' onclick='win( this.id)'><font color='green'> $sn</a></font></a>";
  echo "<tr align=center class='alt'>";
  echo "<td>" .'<b>'. $link .'</b>'. "</td>";
  echo "<td>" . '<b>'. $row['UserName'] .'</b>' . "</td>";
  echo "<td>" .'<b>'. $row['PassWord'] .'</b>' . "</td>";
echo "<td>" .'<b>'. $row['PhoneNumber'] .'</b>' . "</td>";
echo "<td>" .'<b>'. $row['staff_reg_id'] .'</b>' . "</td>";
echo "<td>" .'<b>'. $row['BirthDate'] .'</b>' . "</td>";
  echo "</tr>";
  }
mysql_close($con);
}
else
{

if (!isset($_SESSION['return_row_staff']))
{
$result = mysql_query("SELECT * FROM `staff` limit 0,50");
$result2 = mysql_query("SELECT * FROM `staff` limit 0,100000");

}


if (isset($_SESSION['return_row_staff']))
{

$row=$_SESSION['return_row_staff'];
$intersect_student_id=$row;
$y=$row-50;

$result = mysql_query("SELECT * FROM `staff` limit $y,$row");
$result2 = mysql_query("SELECT * FROM `staff` limit $y,100000");

}


$many2=mysql_num_rows($result2);



echo "
<tr>

<th>FULLNAME</th>


<th>USERNAME</th>

<th>PASSWORD</th>
<th>PHONE NUMBER</th>
<th>REGISTRATION NUMBER</th>
<th>Date of Birth</th>

</tr>";

while($row = mysql_fetch_array($result))
  {


$sn=$row['FullName'];

$id=$row['staff_reg_id'];


$link="<a href='#' title='click to vie more profile about $sn' id='$id' onclick='win( this.id)'><font color='green'> $sn</a></font>";








  echo "<tr align=center class='alt'>";
  echo "<td>" .'<b>'. $link .'</b>'. "</td>";
  echo "<td>" . '<b>'. $row['UserName'] .'</b>' . "</td>";
  echo "<td>" .'<b>'. $row['PassWord'] .'</b>' . "</td>";
echo "<td>" .'<b>'. $row['PhoneNumber'] .'</b>' . "</td>";
echo "<td>" .'<b>'. $row['staff_reg_id'] .'</b>' . "</td>";
echo "<td>" .'<b>'. $row['BirthDate'] .'</b>' . "</td>";


  echo "</tr>";
  }
mysql_close($con);
}







?>


    <tr><td valign="top" colspan="6" align="center">

<?php
if(isset($many2) && $many2>50)
{
               
echo "<div class='login_form_sms_header'><span>
       <a href='setsession_staff.php?p=$many2'>view more staff</a>            
 </span></div>

";

}
else
{
echo "<div class='login_form_sms_header'><span>
<font color='red'>There are no more staff to view</font>
</span></div>
";
unset($_SESSION['return_row_staff']);
}
?>

</td></tr>

<tr><td valign="top" colspan="6" align="center">
<div class='login_form_sms_header'><span>
<a href='admin.php'>go back to the control Panel</a>
</span></div>

</table>
                    </div>
             </div>
        </div>
    </row>
    
</div>
    
     <footer>
         <div class="line">
            <div class="s-12 l-6">
                <?php $year=date('Y')?>
               <p> <?php echo "Copyright $year, $banner";?>
               </p>
            </div>
              
            </div>
             
            <div class="s-12 l-6">
               <p class="right">
               <div id='fitech_ng'></div>
                  <a class="right" href="#fitech_ng" title="Responsee - lightweight responsive framework">POWERED BY <?php echo "$footer";?></a>
               </p>
            </div>
         
      </footer> 
</body>
</html>