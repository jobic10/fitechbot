    <?php
    require_once 'redir_admin.php';
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    ?>
    <html>
    <head>
    <?php 
    echo "<title>Delete photo </title>";
    require_once "../jss_css_dir.php.php";
    ?> 
    </head>  
    <body>
    <div class="container">   
    <row>
    <div class="col-sm-12" >
    <div class="hold_sms_login_form">
    <form action="edit_photo_processor.php" method="post" enctype="multipart/form-data">
    <table>
    <tr>
    <div id='edit_photo'>
    <?php
    $url="ajax_delete_photo.php";
    $result = $sqlB->tmp_create_tb("SELECT * FROM `owe_photo`")  or die(mysql_error());
    while($validate = $result-> fetch_array())
    {
    $photoid=$validate['photoID'];
    $caption=$validate['caption'];
    $menu_description=$validate['menuname'];
    $menu_description=strtoupper($menu_description);
    $photo=$validate['photo'];
    $photo2=$validate['photo'];
    $photoname=basename($photo);
    $photo=str_replace("owe/FITECH_BOT/","owe/FITECH_BOT/thumb",$photo);
    $end_report="img_".$photoid;
    echo"
    <span id='$end_report'>
    <img width='50' height='50'  title='$caption UNDER $menu_description' src='$photo'/>
    <input type='button' class='btn btn-primary'  onclick=\"delFile('$url',this.name,this.id)\" id='$photoid' value='Delete photo' name='$photo2' />
    <input type='hidden' value='$photo'/>
    </span>
    ";
    }
    ?>
    </div>
    </tr>
    </table>
    </form>
    </div>
    </div>    
    </row>
    </div>
    </body>
    </html>