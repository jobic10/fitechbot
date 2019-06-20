<?php

class FitechbotJsonInterface
{
    protected $cookie_name;

    public function  FitechbotJsonInterface($guiname="FITECHBOT_JSON_GUI")
    {
    $this->cookie_name=$guiname;
    //$botId = filter_input(INPUT_GET, 'bot_id');
    //$bot_id = (isset($_COOKIE['bot_id'])) ? $_COOKIE['bot_id'] :($botId !== false && $botId !== null) ? $botId : 1;
    $convo_id = (isset($_COOKIE[$this->cookie_name])) ? $_COOKIE[$this->cookie_name] :$this->get_convo_id();
    $bot_id = (isset($_COOKIE['bot_id'])) ? $_COOKIE['bot_id']: 1;
    setcookie('bot_id', $bot_id);
    $this->getFitechbotJsonGui($convo_id,$bot_id);
    }
    private function get_convo_id()
    {
    //global $cookie_name;
    //session_name($this->cookie_name);
    //session_start();
    $convo_id = session_id();
    //session_destroy();
    setcookie($this->cookie_name, $convo_id);
    return $convo_id;
    }
    
    private function getFitechbotJsonGui($convo_id,$bot_id)
    {
        echo "<div id='msg_con_bot' style='display: block' class='msg_con_bot'>
          <div class='close' title='double click to close' ondblclick=closeConMsg('msg_con_bot','FITECHBOT');>X</div>
          <div id='msg_header_bot' class='msg_header'>FITECHBOT</div>
          <div class='msg_con_inner'>
          <div id='almm_bot' class='almm'></div>
          </div>
          <form method='post' onsubmit='checkSubmit(event)' name='talkform' id='talkform' action='#'>
          <div class='msg_footer'>
          <input type='text' onkeyup='checkSubmit(event)' name='say' id='say' size='60' class='form-control'/>
          </div>
          <input type='hidden' name='convo_id' id='convo_id' value='$convo_id' />
          <input type='hidden' name='bot_id' id='bot_id' value='$bot_id' />
          <input type='hidden' name='format' id='format' value='html' />
          <input type='hidden' name='fitechbotjquery' id='fitechbotjquery' value='YES' />
         <!---<input type='button' id='submit' onclick='queryBot(null)' class='submit' value='sayyes' / >--->
          </form>
          </div>";
    }
}


?>