<html>
<head>
<title>
Choose the staff to Delete
</title>
<script type="text/javascript" src="../javascript/changeeventspix.js"></script>
<?php
  require_once '../header_sub_sms.php';  
?>
</head>




<body>

<?php
require_once "../../secreet/confidential/db_connection.php";
$return_con= db_connection("sms");
$con=$return_con[0];
$result = mysql_query("SELECT * FROM `staff`  ORDER BY `FullName` ASC ");
$check=mysql_num_rows($result);
if($check==0)
{
echo "<font color=yellow>Sorry, there are no registered staff yet !Please try again</font>";
exit;
}

?>



<div class="container">
    <row>
        <div class="col-sm-12">

            <div class="login_form_sms_header"><span>
                
                    
<?php echo " There are $check Staffs registered on the portal"; ?>
                    
                </span></div>
            <div class="table table-responsive">

<table class='table table-bordered'>

<?php
echo "
<tr>

<th>FULLNAME</th>


<th>USERNAME</th>

<th>PASSWORD</th>
<th>SEX</th>
<th>PHONE NUMBER</th>
<th>ACTION</th>

</tr>";

while($row = mysql_fetch_array($result))
  {


$sn=$row['FullName'];

$id=$row['staff_reg_id'];

$sn=strtoupper($sn);


$delete="delete_".$id;



$link="<a href='#' id='$id' name='$sn' title='click to delete $sn' onclick='delete_account_staff( this.id,this.name)'>delete account</a>";




  echo "<tr align=center id='$delete' class='alt'>";
  echo "<td>" .'<b>'. $sn .'</b>'. "</td>";
  echo "<td>" . '<b>'. $row['UserName'] .'</b>' . "</td>";
  echo "<td>" .'<b>'. $row['PassWord'] .'</b>' . "</td>";
echo "<td>" .'<b>'. $row['Sex'] .'</b>' . "</td>";
echo "<td>" .'<b>'. $row['PhoneNumber'] .'</b>' . "</td>";
echo "<td>" .'<b>'. $link .'</b>' . "</td>";


  echo "</tr>";
  }
mysql_close($con);
?>  

</table>
             </div>
        </div>
    </row>
    
</div>
    
</body>
</html>