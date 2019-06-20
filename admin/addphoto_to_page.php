    <?php
    ob_start();
    require_once 'redir_admin.php';
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    $menuname=$gUI->getInputVal('menuname');
    $linkname=$gUI->getInputVal('linkname');
    if (!isset($menuname) && !isset($linkname)) 
    {
    $gUI->closeWin();
    exit();
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
    <?php 
    echo "<title>choose a picture to upload to news and adverts page</title>";
    require_once "../jss_css_dir.php.php";
    ?>   
    </head>  
    <body>
    <div class="container">   
    <div class="row">
    <div class="col-sm-12" ><?php
    $htmlgen->uploadFileForm("addphoto_to_page_processor.php?linkname=$linkname&menuname=$menuname","choose a PHOTO to upload to $linkname","Enter a photo caption","[.jpeg, .png]","upload photo");
    ?>
    </body>
    </html>