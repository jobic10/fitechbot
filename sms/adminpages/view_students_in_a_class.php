    <?php
    require_once "redir_admin_sms.php";
    require_once '../../Classes/SqlBasics.php';
    require_once '../../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    ?>
    <html>
    <head>
    <title>
    Choose the students to Delete
    </title>
    <script type="text/javascript" src="../javascript/changeeventspix.js"></script>
    <?php
    require_once "../../jss_css_dir.php.php"; 
    ?>
    </head>
    <?php
    $class=$gUI->getInputVal('class');
    $cd=$gUI->getInputVal('cd');
    $check=$gUI->getInputVal('cd');
    $sqlB =new SqlBasics("sms");
    $result = $sqlB->tmp_create_tb("SELECT * FROM `students` where class='$class' AND classdivision='$cd' ORDER BY `FullName` ASC ");
    if($result->num_rows==0)
    {
    echo "<font color=yellow>Sorry, there are no registered students in $class $cd  yet !Please try again</font>";
    exit;
    }
    ?>
    <body>
    <div class="container">
    <row>
    <div class="col-sm-12">
    <div class="login_form_sms_header"><span>            
    <?php echo " There are $check Students registered in $class $cd"; ?>    
    </span></div>
    <div class="table table-responsive">
    <table class='table table-bordered'>
    <?php
    echo "
    <tr>
    <th>FULLNAME</th>
    <th>USERNAME</th>
    <th>PASSWORD</th>
    <th>DEACTIVATE ACCOUNT</th>
    <th>DELETE ACCOUNT</th>
    </tr>";
    while($row =$result->fetch_array())
    {
    $sn=$row['FullName'];
    $id=$row['RegNo'];
    $user=$row['UserName'];
    $pass=$row['PassWord'] ;
    $sn=strtoupper($sn);
    $delete="delete_".$id;
    $block="deactivate_".$id;
    $out_pass=$row['PassWord'];
    $link="<a href='#' id='$id' name='$sn' title='click to delete $sn' onclick='delete_account( this.id,this.name)'><font color='navy'>delete account</font></a>";
    if (strpos($out_pass,"_ex_5%*j")!==false)
    {
    $link_deactivate="<a href='#' id='$id' name='$sn'  title='$out_pass' onclick='deactivate_account( this.id,this.name,this.title)'><font color='navy'>Activate Account Back</font></a>";    
    }
    else  
    {  
    $link_deactivate="<a href='#' id='$id' name='$sn'  title='$out_pass' onclick='deactivate_account( this.id,this.name,this.title)'><font color='navy'>Deactivate Account</font></a>";
    }     
    $login_into_acct="<a href='../loginportal_student.php?username=$user&pass=$pass' target='_blank' id='$id' name='$sn' title='click to login into  $sn account' ><font color='navy'>$sn</font></a>";
    echo "<tr id='$delete' class='alt'>";
    echo "<td>" .'<b>'. $login_into_acct .'</b>'. "</td>";
    echo "<td>" . '<b>'.$user.'</b>' . "</td>";
    echo "<td>" .'<b>'. $pass.'</b>' . "</td>";
    echo "<td>" .'<b>'. $link_deactivate .'</b>' . "</td>";
    echo "<td>" .'<b>'. $link .'</b>' . "</td>";
    echo "</tr>";
    }
    ?>  
    </table>
    </div>
    </div>
    </row>
    </div>
    </body>
    </html>