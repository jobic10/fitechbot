<?php
    require_once 'redir_admin.php';
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    $menuname=$gUI->getInputVal('menuname');
    require_once '../fbt_codes.php';
?>
    <!DOCTYPE html>
    <html>
    <head>
    <?php echo "<title>$banner-Update news_and_adverts_page</title>";
    require_once "../jss_css_dir.php.php";
    ?>
    </head>
    <body>
    <!-- TOP NAV WITH LOGO -->  
    <header>
    <div id='welcome_to_school'>
    <?php echo "$banner -PLEASE USE THE FORM BELOW TO UPDATE (<em>news_and_adverts_page </em> )" ;?> 
    </div>
    <div id='school_slogan'>
    <marquee>   <?php echo " $tray_contents_overlay" ;?> </marquee>
    </div>
    </header>
    <div class="container">
    <row>
    <div class="col-sm-12">
    <div class="hold_sms_login_form">
    <form role='form' action='news_and_adverts_contents_processor.php' method='post'>
    <div class="form-group">
    <textarea name='contents' placeholder="Enter the contents to be added to the news_and_adverts page here" class="form-control" rows='30' cols='80'></textarea>
    </div>
    <div class="form-group">
    <input  class="btn btn-primary" type='reset' value='clear all'/>
    <input class="btn btn-primary"  type='submit' value='Update' name='submit'/>   
    </div>
    </form>
    </div>
    </div>
    </row>
    </div>
    <?php require_once '../footer.php'; ?>       
    </body>
    </html>