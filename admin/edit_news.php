   <?php
    require_once 'redir_admin.php';
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    ?>
    <html>
    <head>
    <title>Edit News</title>
    <?php
    require_once "../jss_css_dir.php.php";
    ?> 
    </head>
    <body>
    <div class="container">
    <row>
    <div class="col-sm-12">
    <div class="login_form_sms_header"><span>Edit News Below</span></div>
    <div  class="hold_sms_login_form">
    <form action="edit_photo_processor.php" method="post" enctype="multipart/form-data">
    <div class="form-group" id='edit_photo'>
    <?php
    $url="ajax_edit_news.php";
    $result = $sqlB->tmp_create_tb("SELECT * FROM `news_and_adverts`");
    while($validate = $result-> fetch_array())
    {
    $news_and_advertsID=$validate['news_and_advertsID'];
    $contents=$validate['contents'];
    $end_report="img_".$news_and_advertsID;
    echo"
    <div class='form-group' id='$end_report'>
    <textarea  id='content_$news_and_advertsID' rows='4' cols='20' class='form-control'  > $contents</textarea>
    <input type='button' class='btn btn-primary' onclick=\"getContent('$url',this.id)\" id='$news_and_advertsID' name='$news_and_advertsID' value='Update'  />
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