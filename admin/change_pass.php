    <?php
    require_once 'redir_admin.php';
    ?>
    <!DOCTYPE html>
    <html>
    <head>
    <title>
    CHANGE ADMIN CREDENTIALS
    </title>
    <?php
    require_once "../jss_css_dir.php.php";
    ?>
    </head>
    <body>
    <div class="container">
    <row>
    <div class="col-sm-12" >
    <div class="login_form_sms_header"><span>ENTER YOUR NEW ADMIN CREDENTIALS BELOW</span></div>
    <?php
    require_once "../error_report.php";
    ?>
    <div class="hold_sms_login_form">
    <form role="form" action='change_admin_pass_processor.php' method='post'>
    <div class="form-group">
    <label class="text-primary" for='usr'>Current Admin password:</label>
    <input type='text' placeholder="Present admin Password" class="form-control"  size='20' name='admin_password_old'/>
    </div>
    <div class="form-group">
    <label class="text-primary" for='usr'>Admin Username:</label>
    <input type='text' placeholder="new admin username" class="form-control"  size='20' name='admin_username'/>
    </div>
    <div class="form-group">
    <label class="text-primary" for='usr'>New Admin Password:</label>
    <input type='password' placeholder="new password" class="form-control"  size='20' name='admin_password'/>
    </div>
    <div class="form-group">
    <label class="text-primary"  for='usr'>Confirm Password:</label>
    <input type='password' placeholder="Re-enter new password" class="form-control"  size='20' name='admin_password_second'/>
    </div>
    <div class="form-group">
    <input type='submit'  class="btn btn-primary" value='change' name='submit'/>
    </div>
    <?php
    ?>
    </form>
    </div>
    </div>
    </row>
    </div>    
    </body>
    </html>