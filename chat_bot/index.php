<?php
ini_set('max_execution_time',600);

if(file_exists('bot.zip'))
 {
  require_once "../zip.php";
  extractZip( 'bot.zip', '' );
  require_once "import_db.php";
 }
$site_domain_fb_link="";
$contents="Hello WORLD!My name is FITECHBOT,I'm  autonomous cybernetic chatbot programmed by Olorunlogbon Ayo Samuel using AIML language and A.L.I.C.E and Dr. Wallace AIML brain stored in MYSQL DATABASE via PHP.The more you chat with me,the more I LEARN,so let the FUN BEGIN";
  
  $display = "";
  $thisFile = __FILE__;
  //require_once ('../bot/config/global_config.php');
  require_once ('../bot/chatbot/conversation_start.php');
  $get_vars = (!empty($_GET)) ? filter_input_array(INPUT_GET) : array();
  $post_vars = (!empty($_POST)) ? filter_input_array(INPUT_POST) : array();
  $form_vars = array_merge($post_vars, $get_vars); // POST overrides and overwrites GET
  $bot_id = (!empty($form_vars['bot_id'])) ? $form_vars['bot_id'] : 1;
  $convo_id = session_id();
  $format = (!empty($form_vars['format'])) ? $form_vars['format'] : 'html';
?>

<!DOCTYPE html>
<html >
<head>
<title> <?php  echo " $contents";?> </title>
<meta property='fb:admins' content='100006695830100'/>
<meta property='fb:app_id' content='215519668658462'/>
<meta name="robots" content="index, follow"> 
<meta name="robots" content="index, follow"/> 
<meta name="revisit-after" content="1 day"/> 
<meta name="language" content="English"/> 
<meta name="generator" content="N/A"/> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php  
echo "<meta name='description' content='$contents'/>
<meta property='og:url' content='$site_domain_fb_link'/>
<meta property='og:title' content='$contents'/>
<meta property='og:type' content='article'/>
<meta property='og:description' content='$contents'/>
<meta property='og:site_name' content='Online cybernetic organism'/>
<meta property='og:image' content='$site_domain_fb'/>
";
$tray_contents=str_replace(","," ",$contents);
$tray_contents=trim($tray_contents);
$tray_contents=preg_replace('/\s+/',',',$tray_contents);
//$tray_contents=str_replace(" ",",",$tray_contents);
//echo $contents;
 echo " <meta name='keywords' content='$tray_contents'/> "
;?>
   
    <style type="text/css">
     body{
        height:100%;
        margin: 0;
        padding: 0;
        background: black;
      }

      h2 {
        text-align: center;
        color:yellow;
      }
      #responses {
        width: 90%;
        min-width: 515px;
        height: auto;
        min-height: 150px;
        max-height: 500px;
        overflow: auto;
        border: 3px inset #666;
        margin-left: auto;
        margin-right: auto;
        padding: 5px;
        color:green;
      }
      #input {
        width: 90%;
        min-width: 535px;
        margin-bottom: 15px;
        margin-left: auto;
        margin-right: auto;
        color:red;
      }
      #shameless_plug {
        position: absolute;
        right: 10px;
        bottom: 10px;
        border: 1px solid red;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-shadow: 2px 2px 2px 0 #808080;
        padding: 5px;
        border-radius: 5px;
        color:yellow;
      }
    </style>
  </head>
  <body onload="document.getElementById('say').focus()">
    <h2>WELCOME TO THE WORLD OF FITECH BOT</h2>
    <form method="get" action="index.php#end">
      <div id="input">
        <label for="say">Say:</label>
        <input type="text" name="say" id="say" size="70" />
        <input type="submit" name="submit" id="say" value="say" />
        <input type="hidden" name="convo_id" id="convo_id" value="<?php echo $convo_id;?>" />
        <input type="hidden" name="bot_id" id="bot_id" value="<?php echo $bot_id;?>" />
        <input type="hidden" name="format" id="format" value="<?php echo $format;?>" />
      </div>
    </form>
    <div id="responses">
<?php echo $display . '<a id="end"/>' ?>
    </div>
    <div id="shameless_plug">
        this chatbot was created by  <a href="http://www.ayologbon.wordpress.com/ayologbon">Ayologbon</a>!
    </div>

<?php

$link=$site_domain_fb_link;
$buttons=new social("$link","$contents  ");


echo $buttons->createCode('default');



?>

<style>

.social_buttons li

{ 

float:left;
margin-right:10px;


list-style-type:none;
}


</style>
</body>
</html>
