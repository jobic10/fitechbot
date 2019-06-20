    <?php
    require_once '../Classes/HtmlGen.php';
    require_once '../Classes/SqlBasics.php';
    $htmlgen =new HtmlGen();
    $sqlB =new SqlBasics("cms");
    require_once '../fbt_codes.php';
    ?>
    <!DOCTYPE html>
    <html lang="en-US">
    <head>
    <?php echo "<title>Admin Login @ $banner</title>";
    require_once "../jss_css_dir.php.php";
    ?>
    </head>
    <body >
    <!-- TOP NAV WITH LOGO -->  
    <header>
    <div id='welcome_to_school'>
    <?php echo "ADMIN LOGIN AT $banner" ;?> 
    </div>
    <div id='school_slogan'>
    <marquee>   <?php echo "$tray_contents_overlay" ;?> </marquee>
    </div>
    <a class="logo" href="#"><a id="menu-toggle" class="button dark" href="#"><i class="icon-reorder"></i></a></a>
    <nav id="navigation">
    <ul id="main-menu">
    <li><a href="../">GO BACK TO THE HOMEPAGE</a></li> 
    </ul>
    </nav>
    </header>

    <div class="container">
    <div class="row">
    <div class="col-sm-12">    
    <?php
    //echo "$site_domain_scrp_img_chat";
    $htmlgen->createLoginPage($site_domain_scrp_img_chat,"validate_admin_login.php","PLEASE ENTER IN THE FORM BELOW THE ADMIN USERNAME AND PASSWORD","NILL");
    ?>
    </div>
    </div>
    </div>    
    <?php
    require_once '../footer.php';
    ?>  
    </body>
    </html>