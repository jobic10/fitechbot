<?php
 session_start();
?>
<html>
<head>
<title>
Choose the students to PROMOTE,REPEAT, WITHDRAWN OR RESIT
</title>
<script type="text/javascript" src="../javascript/changeeventspix.js"></script>


<?php
  require_once '../header_sub_sms.php';  
?>
</head>




<body>



<?php




if(!isset($_POST['class']))
{

exit;
}

$class=$_REQUEST['class'];
$cd=$_REQUEST['cd'];

require_once "../remarks_and_grades_function.php";
$session_to_check=$_REQUEST['session_to_check'];
require_once "../../secreet/confidential/db_connection.php";
if($session_to_check=="rsp")
{
$return_con= db_connection("rsp");
$_SESSION['session_to_check']="rsp";
}
else
{
  $return_con= db_connection($session_to_check);  
  $_SESSION['session_to_check']=$session_to_check;
}




$con=$return_con[0];

$result = mysql_query("SELECT * FROM `studentinfo` where class='$class' AND classdivision='$cd' ORDER BY `name` ASC ");
$check=mysql_num_rows($result);

if($check==0)
{

echo "<font color=yellow>Sorry, there are no registered students in $class $cd  yet !Please try again</font>";


exit;

}
?>




<div class="container">
    <row>
        <div class="col-sm-12">

            <div class="login_form_sms_header"><span>
                
                    
<?php echo " There are $check Students registered in $class $cd"; ?>
                    
                </span></div>
            <div class="table table-responsive">

<table class='table table-bordered'>

<tr>
<td>
<?php

echo "

<tr>

<th>FULLNAME</th>



<th>ACTION TO PERFORM</th>

<th>PROMOTION INFO</th>

</tr>";

while($row = mysql_fetch_array($result))
  {


$sn=$row['name'];

$id=$row['regno'];

$sn=strtoupper($sn);
$p_info=$row['promotion_info'];

if($p_info==null || $p_info=="")
    {
$p_info=get_promo_info($class);
    }
    

$delete="delete_".$id;

$block="promotion_info_".$id;


$link= "<select class='form-control' id='sel1' title='$sn' name='$id' size='1' onchange='promote_resit_repeat_withdrawn(this.value,this.name,this.title)'>
<option value='stop_bot'>CHOOSE ACTION TO PERFORM BELOW</option>
<option value='PROMOTED'>PROMOTE $sn</option>
    <option value='TO REPEAT'>REPEAT $sn</option>
<option value='TO RESIT'>RESIT $sn</option>
<option value='WITHDRAWN'>WITHDRAW $sn</option>
</select>";


  echo "<tr align=center id='$delete' class='alt'>";
  echo "<td>" .'<b>'. $sn .'</b>'. "</td>";
  
  echo "<td>" .'<b>'. $link .'</b>' . "</td>";

echo "<td>" . " <b><div id='$block'>". $p_info ."</div></b>" . "</td>";
  

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