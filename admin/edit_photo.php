    <?php
    require_once 'redir_admin.php';
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    ?>

    <html>
    <head>
    <?php echo "<title>Edit photo captions</title>";
    require_once "../jss_css_dir.php.php";
    ?> 
    </head>  
    <body>
    <div class="container">   
    <row>
    <div class="col-sm-12" >
    <div class="hold_sms_login_form">
    <form role='form'  action="edit_photo_processor.php" method="post" enctype="multipart/form-data">
    <div class="form-group" id='edit_photo'>
    <?php
    $result = $sqlB->tmp_create_tb("SELECT * FROM `owe_photo`")  or die(mysql_error());
    while($validate = $result-> fetch_array())
    {
    $photoid=$validate['photoID'];
    $caption=$validate['caption'];
    $menu_description=$validate['menuname'];
    $photo=$validate['photo'];
    $photo=str_replace("owe/FITECH_BOT/","owe/FITECH_BOT/thumb",$photo);
    echo"
    <img width='50' class='img-responsive' height='50' title='under $menu_description' src='$photo'/>
    <textarea class='form-control' name='$photoid' rows='2' cols='10'> $caption</textarea>
    <input type='hidden' value='$photo'/>";
    }
    ?>
    </div>
    <?php 
    if($result->num_rows>0)
    {
    echo "
    <div class='form-group'>
    <input type='submit' class='btn btn-primary btn-sm btn-block' value='update page' name='submit'/>
    </div>";
    }
    ?>  
    </form>
    </div>
    </div>    
    </row>
    </div>
    </body>
    </html>