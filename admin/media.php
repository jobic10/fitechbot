<?php
ob_start();
require_once 'redir_admin.php';
require_once '../Classes/HtmlGen.php';
$htmlgen =new HtmlGen();
?>
<!DOCTYPE html>
<html>
<head>
<?php echo "<title>choose A File to Upload</title>";
 require_once "../jss_css_dir.php.php";
?>   
</head>  

<body>

<div class="container">   
<div class="row">
<div class="col-sm-12" >
 <?php
 $htmlgen->uploadFileForm("media_processor.php","Choose A File to upload","Say something about this File","[mp3,mp4,ogg,txt,pdf,html,js,css,exe]","upload File");
 ?>
 </div>    
 </div>
 </div>
</body>
</html>