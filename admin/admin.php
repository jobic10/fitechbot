<?php
    require_once 'redir_admin.php';
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    require_once '../fbt_codes.php';
    if(isset($_SESSION['welcome_admin']))
    {
    $_SESSION['welcome_admin']=$_SESSION['welcome_admin']+1;
    }
    else
    {
    $_SESSION['welcome_admin']=1;
    }
    if ($_SESSION['welcome_admin']<2)
    {
    $name_of_site=filter_input(INPUT_SERVER,'SERVER_NAME',FILTER_SANITIZE_STRING);
    $admin_mail_add="ayologbon4@gmail.com";
    $msg_subject="Website Security Alert from". strtoupper($name_of_site)." .";
    $guest_msg="Attention Admin, Someone has just Logged in into your Control Panel !:"  ."\r\n"."This message is to alert you of any unlawful attempt to login into the Control Panel of your Site,and can thus  be ignored if you are the one";
    $sqlB->send_mail($admin_mail_add, $msg_subject, $guest_msg);
    }
?>

    <!DOCTYPE html>
    <html>
    <head>
    <?php echo "<title>Welcome, ".$role." !</title>";
    require_once "../jss_css_dir.php.php";
    ?>
    </head>  
    <body>
    <!-- TOP NAV WITH LOGO -->  
    <header>
    <div id='welcome_to_school'>
    <?php echo "$banner -ADMINISTRATOR BACK-END AND CONTROL PANEL" ;?> 
    </div>
    <div id='school_slogan'>
    <marquee>   <?php echo "<em>You are logged in as <b>$role</b>.Here is the latest news:</em> $tray_contents_overlay" ;?> </marquee>
    </div>
    </header>
    <div class="container">
    <row>
    <div id='logout_portal' class='hold_sms_login_form'><div class='login_welcome_msg'>    
    <?php  echo "Welcome in, $role ! <a href='adminlogout.php'><font color='red'>click here to log out</font></a>";     ?>        
    </div>
    </div>
    </row>
    <row>
    <div class="login_form_sms_header"><pan>ADMIN TOOLS</pan></div>        
    <div class='admin_tools_overall_con'>
    <span class="admin_tools_con">
    <a href="slide_show_pix_.php" target="_blank" >Upload photo the homepage slide show</a>
    </span>
    <spa class="admin_tools_con">
    <a href="media.php" target="_blank" >Upload FILES to the Media Centers</a>
    </spa>
    <span class="admin_tools_con">
    <a href="creatmenu.php" target="_blank">Create MENU</a>
    </span>          
    <span class="admin_tools_con">
    <a href="editmenu.php" target="_blank">Edit MENU</a>
    </span>      
    <span class="admin_tools_con">
    <a href="delete_menu.php" target="_blank" ><span>Delete MENU</span></a>
    </span>
    <span class="admin_tools_con">
    <a href="#" onclick="fbt()">EDIT Banner&Footer,Upper tray,change website logo </a>
    </span>
    <span class="admin_tools_con">
    <a href="#" onclick="edit_photo()">Edit Photo Captions </a>
    </span>
    <span class="admin_tools_con">
    <a href="#" onclick="delete_photo()">delete Photos</a>
    </span>     
    <span class="admin_tools_con">
    <a href="#" onclick="delete_media_file()">delete Media Files</a>
    </span>
    <span class="admin_tools_con">
    <a href="news_and_adverts_contents.php"  target="_blank">add contents to Adverts and daily news page</a>
    </span>
    <span class="admin_tools_con">
    <a href="#" onclick="edit_news()">Edit some news and adverts</a>
    </span>
    <span class="admin_tools_con">
    <a href="#" onclick="delete_news()">delete some news and adverts</a>
    </span>             
    <?php require_once 'pull_menu_from_db.php'; ?>            
    <span class="admin_tools_con">
    <a href="#"  onclick='website_color()'><b>Change website Theme</b></a>
    </span>
    <span class="admin_tools_con">
    <a href="#" onclick="change_pass()"><em>change Admin Password</em></a>
    </span>
    <span class="admin_tools_con">
    <a href="../sms/etransact/">E-transact For School Portal</a>
    </span>
    <span class="admin_tools_con">
    <a href="../chat/etransact/">E-transact for Chat</a>
    </span>
    <span class="admin_tools_con">
    <a href="../sms/adminpages/admin.php" target="_blank">Go to to the subordinate Control panel </a>
    </span>    
    </div>   
    </row>    
    </div>
    <?php require_once '../footer.php'; ?>  
    </body>
    </html>