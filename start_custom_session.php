<?php
    $path="G:\go_fitech_online_session_dir";
    session_save_path($path); 
    if(!file_exists($path))
    {
    if(is_dir($path))
    {
    mkdir($path, 0755, true);  
    }
    }
    
    //function start_custom_sesion()
    //{
    if(version_compare(phpversion(),"5.4.0")!= -1)
    {
    if(session_status()==PHP_SESSION_NONE || session_status()!==PHP_SESSION_ACTIVE)
    {
    session_start();
    }
    else     
    {
    if(session_id()=='' || strlen(session_id())<1 || !session_id() || !isset($_SESSION))
    {
    session_start();
    }
    }
    }
    //}
    /*start_custom_sesion();
    
    function set_custom_sesion($inArr)
    {
    foreach ($inArr as $key => $value) 
    {
    $_SESSION[$key]=$value;      
    }
    session_write_close();
    }
    */
   //session_set_cookie_params(30);
  //session_unregister($name);
  
  ?>