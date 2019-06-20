<?php
require_once "../../start_custom_session.php";
if (!isset($_SESSION["role"]))                                
{
header("location:../index.php");
}
require_once "../../secreet/confidential/db_connection.php";
$return_con= db_connection("cms");
$con=$return_con[0];
require_once "../../fbt_codes.php";
?>
<!DOCTYPE html>
<html>
<head>
<?php echo "<title>all students @ $banner</title>";?>
<script type="text/javascript" src="../javascript/printprofileadmin.js"></script>
<?php
 require_once '../../get_site_domain_url.php';
 require_once '../../jss_css_dir.php.php';
?>
</head>
<body>
<div class="container">
<row>
<div class="col-sm-12">
<div class="login_form_sms_header"><span>          
Bio-Data of All Registered Students                
</span></div>
<div class="table table-responsive">
<div class="color_tb_text">
<table  class='table table-bordered'>
<?php
$return_con= db_connection("sms");
$con=$return_con[0];
$result = mysql_query("SELECT FullName FROM `students` where sc=1");
$many=mysql_num_rows($result);
 if ($many<=50)
{
$result = mysql_query("SELECT * FROM `students` where sc=1 ORDER BY FullName ASC");
}
else
{
if (!isset($_SESSION['return_row']))
{
$result = mysql_query("SELECT * FROM `students` ORDER BY FullName ASC limit 0,50");
$result2 = mysql_query("SELECT FullName FROM `students` ORDER BY FullName ASC limit 0,100000");
}
else
{
$row=$_SESSION['return_row'];
$y=$row-50;
$result = mysql_query("SELECT * FROM `students` ORDER BY FullName ASC limit $y,$row");
$result2 = mysql_query("SELECT FullName FROM `students` ORDER BY FullName ASC limit $y,100000");
}
$many2=mysql_num_rows($result2);
}

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


$link="<a href='#' title='click to vie more profile about $sn' id='$id' onclick='win( this.id)'><font color='green'> $sn</a></font>";








  echo "<tr align=center class='alt'>";
  echo "<td>" .'<b>'. $link .'</b>'. "</td>";
  echo "<td>" . '<b>'. $row['UserName'] .'</b>' . "</td>";
  echo "<td>" .'<b>'. $row['PassWord'] .'</b>' . "</td>";
echo "<td>" .'<b>'. $row['PhoneNumber'] .'</b>' . "</td>";
echo "<td>" .'<b>'. $row['RegNo'] .'</b>' . "</td>";
echo "<td>" .'<b>'. $row['BirthDate'] .'</b>' . "</td>";


  echo "</tr>";
  }
mysql_close($con);








?>


    <tr><td valign="top" colspan="6" align="center">

<?php
if(isset($_SESSION['return_row']) && $_SESSION['return_row']>=100)
{
    
               
echo "<div class='login_form_sms_header'><span>
      <a href='setsession_student.php?prev=$many2'> << Back </a>            
     </span></div>
";  
}

if(isset($many2) && $many2>50)
{
              
echo "<div class='login_form_sms_header'><span>
      <a href='setsession_student.php?nxt=$many2'>view more student>> </a>            
     </span></div>
";

}
else
{
echo "<div class='login_form_sms_header'><span>
<font color='red'>There are no more students to view</font>
</span></div>
";
unset($_SESSION['return_row']);
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
    <?php
 require_once '../../footer.php';
    ?>
</body>
</html>