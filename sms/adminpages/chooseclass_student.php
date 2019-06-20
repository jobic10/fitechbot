    <?php 
    require_once "redir_admin_sms.php";
    require_once '../../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    ?>
    <html>
    <head>
    <title>
    Choose the students to PROMOTE,REPEAT, WITHDRAWN OR RESIT
    </title>
    <script type="text/javascript" src="../javascript/changeeventspix.js"></script>
    <?php 
    require_once "../../jss_css_dir.php.php";
    ?>
    </head>
    <body>  
    <div class="container">
    <row>
    <div class="col-sm-12">
    <div class="login_form_sms_header"><span>
    Choose a class below    
    </span></div>
    <div class="hold_sms_login_form">
    <!----<span class='login_form_sms'>--->
    <form action="view_students_in_a_class.php" method="post">
    <?php 
    //require_once '../class_list_sec.php';
     $htmlgen->GenClassList();
    ?>
    <span class='login_form_sms'>
    <input type="submit" style='float: right;'  class="btn btn-primary" value="view students" >
    </span>
    </form>
    </div>
    </div>
    </row>
    </div>
    </body>
    </html>