<?php
ini_set('max_execution_time',600);

/***************************************
  * http://www.program-o.com
  * PROGRAM O
  * Version: 2.4.2
  * FILE: index.php
  * AUTHOR: Elizabeth Perreau and Dave Morton
  * DATE: 07-23-2013
  * DETAILS: This is the interface for the Program O JSON API
  ***************************************/
  $cookie_name = 'Program_O_JSON_GUI';
  $botId = filter_input(INPUT_GET, 'bot_id');
  $convo_id = (isset($_COOKIE[$cookie_name])) ? $_COOKIE[$cookie_name] : get_convo_id();
  $bot_id = (isset($_COOKIE['bot_id'])) ? $_COOKIE['bot_id'] :($botId !== false && $botId !== null) ? $botId : 1;
  setcookie('bot_id', $bot_id);
  // Experimental code

/*
  $base_URL  = 'http://' . $_SERVER['HTTP_HOST'];                                   
  $this_path = str_replace(DIRECTORY_SEPARATOR, '/', realpath(dirname(__FILE__)));  


      echo $this_path;
  $this_path = str_replace($_SERVER['DOCUMENT_ROOT'], $base_URL, $this_path);       // transform it from a file path to a URL
  $url = str_replace('gui/jquery', 'chatbot/conversation_start.php', $this_path);   // and set it to the correct script location

  Example URL's for use with the chatbot API
  $url = 'http://api.program-o.com/v2.3.1/chatbot/';
  $url = 'http://localhost/fitech_bot/bot/chat_bot/conversation_start.php';
  $url = 'chat.php';

*/

  $url = 'http://localhost/fitechbot/bot/chatbot/conversation_start.php';
  $display = "The URL for the API is currently set as:<br />\n$url.<br />\n";
  $display .= 'Please make sure that you edit this file to change the value of the variable $url in this file to reflect the correct URL address of your chatbot, and to remove this message.' . PHP_EOL;
  #$display = '';

  function get_convo_id()
  {
    global $cookie_name;
    session_name($cookie_name);
    session_start();
    $convo_id = session_id();
    session_destroy();
    setcookie($cookie_name, $convo_id);
    return $convo_id;
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="main.css" media="all" />
    <link rel="icon" href="../admin/favicon/favicon.ico" type="image/x-icon" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>FITECHBOT AIML PHP Chatbot</title>
    <meta name="Description" content="A Free Open Source AIML PHP MySQL Chatbot called FITECH_BOT" />
    <meta name="keywords" content="Open Source, AIML, PHP, MySQL, Chatbot, FITECH_BOT, Version2,ayologbon" />
    
    <style type="text/css">
      h2 {
        text-align: center;
        color:lightgreen;
      }
      hr {
        width: 80%;
        color: green;
        margin-left: 0;
      }

      .user_name {
        color: rgb(16, 45, 178);
      }
      .bot_name {
        color: rgb(204, 0, 0);
      }
      #shameless_plug, #urlwarning {
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
      #urlwarning {
        right: auto;
        left: 10px;
        width: 50%;
        font-size: large;
        font-weight: bold;
        background-color: white;
      }
      .leftside {
        text-align: right;
        float: left;
        width: 48%;
      }
      .rightside {
        text-align: left;
        float: right;
        width: 48%;
      }
      .centerthis {
        width: 90%;
      }
      #chatdiv {
        margin-top: 20px;
        text-align: center;
        width: 100%;
      }

    </style>
  </head>
  <body bgcolor="black">
    <h2>WELCOME TO THE WORLD OF FITECH BOT</h2>
    
      <div class="centerthis">

      <div class="rightside">
      <div class="manspeech">
      <div  class="triangle-border bottom blue">
      <div class="botsay">Hello World! My Name Is FITECHBOT.</div>
      </div>
      </div>
      <div class="man"></div>
      </div>

      <div class="leftside">
      <div class="dogspeech">
      <div  class="triangle-border-right bottom orange">
      <div class="usersay">&nbsp;</div>
     </div>
     </div>
     <div class="dog"></div>
    </div>

    </div>

    <div class="clearthis"></div>
    <div class="centerthis">
        <form method="post" onsubmit="checkSubmit(event)" name="talkform" id="talkform" action="#">
        <div id="chatdiv">
          <label for="submit">Say:</label>
          <input type="text" onkeyup="checkSubmit(event)" name="say" id="say" size="60"/>
          <input type="button" id="submit" onclick="queryBot(null)" class="submit" value="sayyes" / > 
          <input type="hidden" name="convo_id" id="convo_id" value="<?php echo $convo_id;?>" />
          <input type="hidden" name="bot_id" id="bot_id" value="<?php echo $bot_id;?>" />
          <input type="hidden" name="format" id="format" value="html" />
          <input type="hidden" name="fitechbotjquery" id="fitechbotjquery" value="YES" />
        </div>
      </form>
        
       <!----
       <button type="button"
       onclick="document.getElementById('demo').innerHTML = Date()">Click me to display Date and Time.</button>
       <p id="demo"></p>
       ---->
          
    </div>


    <div id="shameless_plug">
      this chatbot was created by  <a href="http://www.ayologbon.wordpress.com/ayologbon">Ayologbon</a>!
    </div>

<!----<div id="urlwarning"><?php echo $display ?></div>---->

    <script type="text/javascript" src="jquery-1.9.1.min.js"></script>
    <script type="text/javascript" >
  function checkSubmit(evt)
  {
    evt.preventDefault();
    var x = evt.keyCode;
    if(x===13)
    {
        queryBot(null);
    }
  }
   function queryBot(in_query)
   {
  var url='http://localhost/fitechbot/bot/chatbot/conversation_start.php';
  var say,bot_id,convo_id,format,fitechbotjquery;
   if(in_query===null)
   {
   say=$('#say').val();
   }
   else
   {
    say=in_query;   
   }
   $('.usersay').text(say);
   //convo_id=$('#convo_id').val(); bot_id=$('#bot_id').val(); format=$('#format').val(); fitechbotjquery=$('#fitechbotjquery').val();
   //var formdata ={say:say,convo_id:convo_id,bot_id:bot_id,format:format,fitechbotjquery:fitechbotjquery};
   var formdata2 = $("#talkform").serialize();
    $('#say').val('');
    $('#say').focus();
    $.post(url,
     formdata2,
    function(server_response,server_status,xhr_request_object)
    {
    if (xhr_request_object.readyState===4 && xhr_request_object.status===200 && server_status==="success")
    { 
      $('.botsay').html(server_response);
     //alert(server_response);
    }
    }, 'html');
    }

exit;

     $(document).ready(function() 
{

   

      // put all your jQuery goodness in here.
        $('#talkform').submit(function(e) {
          e.preventDefault();
          user = $('#say').val();
          $('.usersay').text(user);
          formdata = $("#talkform").serialize();
          $('#say').val('')
          $('#say').focus();
          
          $.post('<?php echo $url ?>', formdata, function(data)
          {
            alert(data);
            var b = data.botsay;
            if (b.indexOf('[img]') >= 0) b = showImg(b);
            if (b.indexOf('[link') >= 0) b = makeLink(b);

            var usersay = data.usersay;
            if (user != usersay) $('.usersay').text(usersay);

            $('.botsay').html(b);
            //alert(b);

          }, 'html').fail(function(xhr, textStatus, errorThrown)
          {
            $('#urlwarning').html("Something went wrong! Error = " + errorThrown);
          });
          return false;
        });
      });

      function showImg(input) {
        var regEx = /\[img\](.*?)\[\/img\]/;
        var repl = '<br><a href="$1" target="_blank"><img src="$1" alt="$1" width="150" /></a>';
        var out = input.replace(regEx, repl);
        console.log('out = ' + out);
        return out
      }
      function makeLink(input) {
        var regEx = /\[link=(.*?)\](.*?)\[\/link\]/;
        var repl = '<a href="$1" target="_blank">$2</a>';
        var out = input.replace(regEx, repl);
        console.log('out = ' + out);
        return out;
      }
    </script>
  </body>
</html>
