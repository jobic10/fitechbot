    <?php
    require_once 'redir_admin.php';
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    require_once '../fbt_codes.php';
    ?>
    <html>
    <head>
    <?php 
    echo "<title>change banner,footer and many more...</title>";
    require_once "../jss_css_dir.php.php";
    ?>
    </head>  
    <body>
    <div class="container">   
    <row>
    <div class="col-sm-12" >
    <div class="hold_sms_login_form">
    <form action="fbt_processor.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label  class="text-primary" for="usr">change website  logo:</label>
    <input type='file' class='form-control' size='20' name='file' id='file'/><font color='green'>&nbsp*&nbsp.jpeg .png .gif</font>
    </div>
    <div class="form-group">
    <label  class="text-primary" for="usr">banner:</label>
    <?php echo "<textarea class='form-control' name='banner' rows='5' cols='37'> $banner</textarea>";?>
    </div>
    <div class="form-group">
    <label  class="text-primary" for="usr">footer:</label>
    <?php echo "<textarea class='form-control' name='footer' rows='5' cols='37'> $footer</textarea>";?>
    </div>
    <div class="form-group">
    <label  class="text-primary" for="usr">Welcome title bar:</label>
    <?php echo "<textarea class='form-control' name='uptray' rows='5' cols='37'> $tray_contents </textarea>";?>
    </div>
    <div class="form-group">
    <label  class="text-primary" for="usr">Website Description:</label>
    <?php echo "<textarea class='form-control' name='uptray_float' rows='5' cols='37'>$tray_contents_overlay</textarea>";?>
    </div>
    <div class="form-group">
    <label  class="text-primary" for="usr">Chat welcome Banner:</label>
   <?php echo "<textarea class='form-control' name='chat_banner' rows='5' cols='37'>$chat_banner</textarea>";?>
   </div>
   <div class="form-group">
   <label  class="text-primary" for="usr">Chat Icon:</label>
   <?php echo "<textarea class='form-control' name='chat_icon' rows='5' cols='37'>$chat_icon</textarea>";?>
   </div>
   <div class="form-group">
   <label  class="text-primary" for="usr">About chat:</label>
   <?php echo "<textarea class='form-control' name='about_chat' rows='5' cols='37'>$about_chat</textarea>";?>
   </div>
   <div class="form-group">
   <label  class="text-primary" for="usr">Site Slogan/watch Word:</label>
   <?php echo "<textarea class='form-control' name='slogan' rows='5' cols='37'>$slogan</textarea>";?>
   </div>
   <div class="form-group">
   <input type="submit"  class='btn btn-primary' value="update page" name="submit"/>
  </div>
  </form>
  </div>
  </div>    
  </row>
  </div>
  </body>
  </html>