<?php
    require_once "redir_admin_sms.php";
    require_once '../../Classes/SqlBasics.php';
    //$sqlB =new SqlBasics("cms");
    //$result = $sqlB->tmp_create_tb("SELECT * FROM `fbt`");
    require_once '../../fbt_codes.php';
    $tray_contents=strtoupper($tray_contents);
    $sqlB =new SqlBasics("sms");
    $result = $sqlB->tmp_create_tb("SELECT Class FROM `students` where class!='GRADUATED' ");
    $student_no=$result->num_rows;
    $result = $sqlB->tmp_create_tb("SELECT UserName FROM `staff`");
    $staff_no=$result->num_rows;
?>
    <!DOCTYPE html>
    <html>
    <head>
    <?php echo "<title>SUBORDINATE CONTROL PANEL OF $banner</title>";
    require_once "../../jss_css_dir.php.php";
    ?>
    </head>
    <body>
    <!-- TOP NAV WITH LOGO -->  
    <header>
    <div id='welcome_to_school'>
    <?php echo "SUBORDINATE CONTROL PANEL OF $banner " ;?> 
    </div>
    <div id='school_slogan'>
    <marquee>   <?php echo "<em>You are logged in as <b>$role</b>.Here is the latest news:</em> $tray_contents_overlay" ;?> </marquee>
    </div>
    </header>
    <div class="container">
    <row>
    <div id='logout_portal' class='hold_sms_login_form'><div class='login_welcome_msg'>  
    <?php  
    echo "Welcome in, $role ! <a href='../../admin/admin.php' ><font color='green'>Click here to go back to the Main control Panel </font></a>";     
    ?>          
    </div>
    </div>
    </row>
    <row>
    <div class="login_form_sms_header"><pan>ADMIN TOOLS</pan></div>        
    <div class='admin_tools_overall_con'>
    <span class="admin_tools_con">
    <a href="search.php" onclick="serch()" target="_blank">Search For Students Or STAFF </a>
    </span>                  
    <span class="admin_tools_con">
    <a href="chooseclass_student.php" target="_blank" onclick='del_student()'><b>DEACTIVATE OR DELETE A STUDENT</b></a>
    </span>
    <span class="admin_tools_con">
    <a href="#" onclick="promote_student()"><em>PROMOTE OR REPEAT A STUDENT</em></a>
    </span>

    <span class="admin_tools_con">
    <a href="#" onclick="del_staff()"><em>DELETE A STAFF</em></a>
    </span>                  
    <span class="admin_tools_con">
    <a href="remarks_class.php" target="_blank">Remarks for Reportsheet</a>
    </span>              
    <span class="admin_tools_con">
    <a href="allstd.php">view the bio-data of all registered Students</a> <br/> <?php    echo "( $student_no)";?>
    </span>
    <span class="admin_tools_con">
    <a href="allstd_staff.php">view the bio-data of all registered Staff </a> <br/> <?php    echo "( $staff_no)";?>
    </span>
    <span class="admin_tools_con">
    <a href="../RESULT_PROCESSOR"><span>Result processor</span></a>
    </span>                  
    </div>       
    </row>    
    </div>
    <?php
    require_once '../../footer.php';
    ?>  
    </body>
    </html>