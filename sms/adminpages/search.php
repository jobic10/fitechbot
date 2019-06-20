<?php 
    require_once "redir_admin_sms.php";
?>
    <html>
    <head>
    <title>
    SEARCH FOR STUDENTS OR STAFF
    </title>
    <?php
    require_once '../../jss_css_dir.php.php';
    ?>
    </head>
    <body>
    <div class="container">     
    <row>
    <div class="col-sm-12" >
    <?php
    require_once "../../error_report.php";
    ?>
    <div class="hold_sms_login_form">
    <form role="form" action='searchprocessor.php' method='post'>       
    <div class='form-group'>
    <label class="text-primary" for='sel1'>Search For:</label>
    <select class="form-control" id="sel1" name="tb_name" >
    <option value="students">STUDENT</option>
    <option value="staff">STAFF</option>
    </select>
    </div>             
    <div class='form-group'>
    <label class="text-primary" for="usr">Surname, Username, Phone Number or Email of Student Or Staff:</label>
    <input type="text" class="form-control" placeholder="Enter The Surname, Username, Phone Number or Email of Student Or Staff here" size="34" name="stdname"/>
    </div>                
    <div class='form-group'>
    <input class="btn btn-primary"  type="submit" value="Search" name="submit"/>
    </div>
    </form>
    </div>
    </div>    
    </row>
    </div>
    </body>
    </html>