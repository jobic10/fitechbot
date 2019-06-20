<?php
 session_start();
?>
<html>
<head>
<title>
Commentary For Principal,Form Teacher & House Master
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
$term=$_REQUEST['term_to_check'];

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



$result_term=mysql_query("SELECT PRESENTTERM,PRESENTYEAR FROM `schinfo` ") or die("");

$validate_term= mysql_fetch_array($result_term);

$year=$validate_term['PRESENTYEAR'];
//$term=$validate_term['PRESENTTERM'];

$_SESSION['term_to_check']=$term;

$term=  strtolower($term);
$both="_".$year."_".$term;

$new_msg="CREATE TABLE IF NOT EXISTS `remarks$both`(remarksID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(remarksID),name varchar(200),regno varchar(50),class varchar(10),classdivision varchar(10),premarks varchar(500),fremarks varchar(500),sremarks varchar(50),ndp varchar(10),ndpt varchar(10),nda varchar(10))";
if (!mysql_query($new_msg,$con))

{ 
 die("Error:table could not be created".mysql_error());
} 




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
      Commentary For Principal,Form Teacher & House Master   <br/>          
                    
<?php echo " There are $check Students registered in $class $cd"; ?>
                    
                </span></div>
            <div class="table table-responsive">

<table class='table table-bordered'>

<tr>

<th>Fullname</th>

<th>Principal's Comment</th>
<th>Form Teacher's Comment</th>
<th>Sport Master's Comment</th>

<th>No of Days  Present</th>
<th>No of Days  Punctual</th>
<th>No of Days  Absent</th>

<th>View Student's Reportsheet</th>

</tr>";

<form method="post" action='remarks_comment_processor.php'>
      
 <?php
while($row = mysql_fetch_array($result))
  {


$sn=$row['name'];
$c=$row['class'];
$cd=$row['classdivision'];
$id=$row['regno'];

$sn=  strtolower($sn);
$sn=  ucwords($sn);
$p_info=$row['promotion_info'];



$result_rmks = mysql_query("SELECT * FROM `remarks$both` where regno='$id' ");
$row_rmks = mysql_fetch_array($result_rmks);
$ndp=$row_rmks['ndp'];
$ndpt=$row_rmks['ndpt'];
$nda=$row_rmks['nda'];
$premarks=$row_rmks['premarks'];
$fremarks=$row_rmks['fremarks'];
$sremarks=$row_rmks['sremarks'];

if($p_info==null || $p_info=="")
    {
$p_info=get_promo_info($class);
    }
    

$delete="delete_".$id;

$block="promotion_info_".$id;

$link="<a href='../RESULT_PROCESSOR/reportprocessor.php?regno=$id&session_to_check=$session_to_check' target='_blank' title='$p_info'><font color='green'>View Reportsheet</font></a>";

  echo "<tr align=center id='$delete' class='alt'>
  <td style='vertical-align: middle;' ><b> $sn </b></td>
  
  
  
  <td><textarea name='premarks_$id' placeholder='Principal Should Comment Here' class='form-control' rows='2' >$premarks</textarea></td>
  <td><textarea name='fremarks_$id' placeholder='Form Teacher Should Comment Here' class='form-control' rows='2' >$fremarks</textarea></td> 
<td>
<textarea name='sremarks_$id' placeholder='Sport Master Should Comment Here' class='form-control' rows='2' >$sremarks</textarea>

<input type='hidden' name='regno_$id' value='$id' />
<input type='hidden' name='sn_$id' value='$sn' />

</td>
         
       <td><textarea name='ndp_$id' placeholder='No of Days Present' class='form-control' rows='2' >$ndp</textarea></td>    
        <td><textarea name='ndpt_$id' placeholder='No of Days Punctual' class='form-control' rows='2' >$ndpt</textarea></td>    
          
           <td><textarea name='nda_$id' placeholder='No of Days Absent' class='form-control' rows='2' >$nda</textarea></td>
  
<td style='vertical-align: middle;'> <b><div id='$block'>$link </div></b></td>
  

  </tr>";
  }
mysql_close($con);
echo "<input type='hidden' name='class' value='$class' />
<input type='hidden' name='cd' value='$cd' />

";
?> 
      <tr>
          <td colspan="8">
              <input type='submit' style="float: right" class="btn btn-primary btn-small" name='submit' value='Submit Comments' />    
         </td>
      </tr>     
</form>
</table>
             </div>
        </div>
    </row>
</div>
</body>
</html
