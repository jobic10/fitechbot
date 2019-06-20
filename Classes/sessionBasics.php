<?php
/**
 * Description of SqlBasics
 *
 * @author Prophet TbJoshua
 */
class sessionBasics 
{ 
    public $rand_key;
    var $user;
    var $dAF;
    protected $session_name;
    public $chatSessionVars=array();
    public function sessionBasics($sessionname="FITECHBOT_SESSION")//__construct()
    {
    require_once 'DirAndFiles.php';
    $this->dAF =new DirAndFiles();
    $this->session_name=$sessionname;
    $this->chatSessionVars=array('user_fullname_stored_in_session','dp_in_session','gender');//'user');
    session_name($this->session_name);
    $this->start_custom_sesion();
    
    }
    
    private function start_custom_sesion()
    {
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
    $this->user=session_id();
    array_push($this->chatSessionVars,$this->user);
    //print_r($this->chatSessionVars);
    //exit();
    }
    //session_set_cookie_params(30);
    //session_unregister($name);
    }
   
    public function set_custom_sesion($inArr)
    {
    foreach ($inArr as $key => $value) 
    {
    $_SESSION[$key]=$value;      
    }
    session_write_close();
    }
    
    public function get_custom_sesion($inArr)
    {
    $sesval=array();
    foreach ($inArr as $key => $value) 
    {
    if (isset($_SESSION[$value])) 
    {
    $sesval[]=$_SESSION[$value];
    }    
    }
    //session_write_close();
    return $sesval;
    }
}
