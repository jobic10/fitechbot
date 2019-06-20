    <?php
    require_once 'redir_admin.php';
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    ?>
    <html>
    <head>
    <title>delete Media Files</title>
    <?php
    require_once "../jss_css_dir.php.php";
    ?> 
    </head>
    <body>
    <div class="container">   
    <row>
    <div class="col-sm-12" >
    <div class="hold_sms_login_form">
    <table>
    <tr>
    <div id='edit_photo'>
    <?php
    $url="ajax_delete_media.php";
    $result = $sqlB->tmp_create_tb("SELECT * FROM `media_files`");
    while($validate =$result->fetch_array())
    {
    $mediaid=$validate['mediaID'];
    //$caption=$validate['caption'];
    $media_url=$validate['media_url'];
    $media_name=basename($media_url);
    $end_report="img_".$mediaid;
    echo"
    <div class='form-group' id='$end_report'>
    <input type='button' class='btn btn-primary btn-sm btn-block' onclick=\"delFile('$url',this.name,this.id)\" id='$mediaid' value='Delete $media_name' name='$media_url' />
    </div>
    ";
    }
    ?>
    </div>
    </tr>
    </table>
    </div>
    </div>    
    </row>
    </div>
    </body>
    </html>