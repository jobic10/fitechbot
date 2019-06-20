    <?php
    require_once 'redir_admin.php';
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    ?>
    <html>
    <head>
    <title>
    EDIT MENU
    </title>
    <?php 
    require_once "../jss_css_dir.php.php";
    ?>    
    </head>
    <body bgcolor="000066">
    <div class="container">
    <row>
    <div class="col-sm-12">
    <div class="hold_sms_login_form">
    <form role='form'  action='editmenuprocessor.php' method='post'>
    <?php
    $result =$sqlB->tmp_create_tb("SELECT * FROM `menubar`");
    while($validate =$result-> fetch_array())
    {
    $menuname=$validate['name_of_menubar'];
    $menuitem=$validate['default_menubar_item'];
    //$menuname6=preg_replace('/\s+/','',$menuname);<input type='hidden'value='$menuname' class='form-control' size='10' name='$menuname6' readonly/>
    echo "<div class='form-group'>
    <input type='button'  class='btn btn-primary btn-sm btn-block' onclick='call_editmenu_overlay(this.name)' value='click to edit $menuname Menu' name='editmenu_overlay.php?menuname=$menuname' />
    </div>
    ";
    }
    ?>
    </form>
    </div>
    </div>
    </row>
    </div>
    </body>
    </html>