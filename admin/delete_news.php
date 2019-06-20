 <?php
    require_once 'redir_admin.php';
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
?>
    <html>
    <head>
    <title>delete News</title>
    <?php
    require_once "../jss_css_dir.php.php";
    ?> 
    </head>
    <body>
    <div class="container">
    <row>
    <div class="col-sm-12">
    <div class="login_form_sms_header"><span>Delete News Below</span></div>
    <div  class="hold_sms_login_form">
    <form action="edit_photo_processor.php" method="post" enctype="multipart/form-data">
    <div id='edit_photo'>
    <?php
    $url="ajax_delete_news.php";
    $result = $sqlB->tmp_create_tb("SELECT * FROM `news_and_adverts`");
    while($validate = $result-> fetch_array())
    {
    $news_and_advertsID=$validate['news_and_advertsID'];
    $contents=$validate['contents'];
    $end_report="img_".$news_and_advertsID;
    echo"
    <div class='form-group'id='$end_report'>
    <textarea  class='form-control' name='$news_and_advertsID' rows='2' cols='10'> $contents</textarea>
    <input type='button' class='btn btn-primary' onclick=\"delFile('$url',this.name,this.id)\" name='fitechNig' id='$news_and_advertsID' value='Delete'  />
    </div>
    ";
    }
    ?>
    </div>
    </form>
    </div>
    </div>
    </row>
    </div>              
    </body>
    </html>