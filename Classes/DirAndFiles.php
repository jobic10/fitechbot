<?php
/**
 * Description of DirAndFiles
 *
 * @author Coker Caroline
 */
class DirAndFiles
{   
    var $sessionpath;
    var $errorlogpath;
    public $baseDir;
    protected $rootDir;
    protected $php_error_log;
    protected $upload_tmp_dir;
    var $sqlFiles;
    var $addonspath;
    var $captchasrc;
    var $fileDirs=array();

    public function DirAndFiles() 
    {
    $path_separator = DIRECTORY_SEPARATOR;
    $thisConfigFolder2 = __DIR__ . $path_separator;
    $this->rootDir= __DIR__ . $path_separator;
    $this->rootDir=str_replace($path_separator.'xampp'.$path_separator.'htdocs'.$path_separator.'fitechbot'.$path_separator.'Classes', '', $thisConfigFolder2);
    $this->baseDir=str_replace($path_separator.'Classes', '', $thisConfigFolder2);
    $this->sessionpath=$this->baseDir."go_fitech_online_session_dir";
    $this->php_error_log=$this->baseDir."php_error_log".$path_separator;
    $this->upload_tmp_dir=$this->baseDir."upload_tmp_dir".$path_separator;
    $this->errorlogpath=$this->baseDir."error".$path_separator;
    $this->addonspath=$this->baseDir."addons".$path_separator;
    $this->captchasrc=$this->baseDir."addons".$path_separator."captcha".$path_separator."captcha_imgs".$path_separator;
    $this->sqlFiles=$this->baseDir."FitechFiles".$path_separator."sqls".$path_separator;
    array_push($this->fileDirs,$this->sqlFiles,$this->errorlogpath,$this->sessionpath,$this->addonspath,$this->captchasrc,$this->php_error_log,$this->upload_tmp_dir);
   
    foreach($this->fileDirs as $dir)
    {
    if(!file_exists($dir))
    {
    $this->mkDir($dir);  
    }    
    }
    if(is_dir($this->sessionpath))
    {
    //ini_set('session.save_path', $this->sessionpath);
    session_save_path($this->sessionpath); 
    }
    ini_set('max_execution_time',6000);
    /*
    $sys_mem_limit = ini_get('memory_limit');
    $quantifier = preg_match('~\D~', $sys_mem_limit,$matches);
    $quantifier = strtolower($matches[0]);
    $mem_limit = str_replace($quantifier, '', $sys_mem_limit);
    switch ($quantifier)
    {
      case 'g':
      $mem_limit *= 1024;
      case 'm':
      $mem_limit *= 1024;
      case 'k':
      $mem_limit *= 1024;
      default:
      $mem_limit *= 0.5; // half of the memory limit set by PHP
    }
    //print_r($mem_limit);exit;*/
    //define('MEM_TRIGGER', $mem_limit);
    ini_set('memory_limit','200M'); 
    ini_set('log_errors',TRUE);
    ini_set('error_log',$this->errorlogpath."error.log");
    ini_set('html_errors',FALSE);
    ini_set('include_path',$this->rootDir.'xampp'.$path_separator.'php'.$path_separator.'PEAR');  
    ini_set('browscap',$this->rootDir.'xampp'.$path_separator.'php'.$path_separator.'extras'.$path_separator.'browscap.ini');  
    ini_set('extension_dir',$this->rootDir.'xampp'.$path_separator.'php'.$path_separator.'ext');
    ini_set('upload_tmp_dir',$this->upload_tmp_dir);
    ini_set('sys_temp_dir',$this->upload_tmp_dir);
    //echo $this->rootDir.'xampp'.$path_separator.'php'.$path_separator.'PEAR';exit();
    }
    
    
     function zipFile($files = array(),$destination,$overwrite = FALSE) 
     {

     
     if(file_exists($destination)) 
     { 
     $overwrite=TRUE; 
     }
     
     /*
     if(file_exists($destination) && $overwrite==FALSE) 
     { 
     unlink($destination); 
     }
     */
    
     $valid_files = array();
     if(is_array($files)) 
     {
     foreach($files as $file) 
     {
     if(file_exists($file))
     {
     $valid_files[] = $file;
     }
     }
     }
     if(count($valid_files)>0) 
     {

     $zip = new ZipArchive();

     if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) 
     {
     return false;
     }

     foreach($valid_files as $file) 
     {
     $zip->addFile($file,$file);
     //$zip->addFile($file);
     }
     //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
      //print_r($zip);
     //exit;
     //close the zip -- done!
     $zip->close();
     
     if(file_exists($destination))
     {
     return $destination;   
     }
     }
     else
     {
     return False;
     }
     }

    public function extractZip($zipDir, $zipFile = '', $dirFromZip = '' )
    {   
    define(DIRECTORY_SEPARATOR, '/');
    //$zipDir = getcwd() . DIRECTORY_SEPARATOR;
    //$zipDir=$dirFromZip;
    //$zip = zip_open($zipDir.$zipFile); 
    $zip = zip_open($zipFile);   
    if ($zip)
    {
    while ($zip_entry = zip_read($zip))
    {
    $completePath = $zipDir . dirname(zip_entry_name($zip_entry));
    $completeName = $zipDir . zip_entry_name($zip_entry);
    if(!file_exists($completePath) && preg_match( '#^' . $dirFromZip .'.*#', dirname(zip_entry_name($zip_entry)) ) )
    {
    $tmp = '';
    foreach(explode('/',$completePath) AS $k)
    {
    $tmp .= $k.'/';
    if(!file_exists($tmp) )
    {
    @mkdir($tmp, 0777);
    }
    }
    }
    if (zip_entry_open($zip, $zip_entry, "r"))
    {
    if( preg_match( '#^' . $dirFromZip .'.*#', dirname(zip_entry_name($zip_entry)) ) )
    {
    if ($fd = @fopen($completeName, 'w+'))
    {
    fwrite($fd, zip_entry_read($zip_entry, zip_entry_filesize($zip_entry)));
    fclose($fd);
    }
    else
    {
    //We think this was an empty directory, then create it.
    mkdir($completeName, 0777);
    }
    zip_entry_close($zip_entry);
    $rtnFiles[]=$completeName;
    }
    }
    }
    zip_close($zip);
    }
    return $rtnFiles;
}


     public function mkDir($path)
     {
     if(is_dir($path))
     {
     return $path;
     }
     else
     {
     return mkdir($path, 0755, true);
     }
     }
     
     private function confirmDir($dirOnServer) 
     {
     if (trim($dirOnServer) != '' && is_dir($dirOnServer)) 
     {
     $cleanDir=trim($dirOnServer);
     }
     return $cleanDir;
     }
     public function getFilesInServerDir($in_dir) 
     {
     return $this->scanServerDirectory($this->confirmDir($in_dir));
     }
     private function scanServerDirectory($dir) 
     {
     $returnArray = array();
     if ($handle = opendir($dir)) 
     {
     while (false !== ($file = readdir($handle))) 
     {
     if (is_file($dir."/".$file)) 
     {
     $returnArray[] = $file;
     }
     }
     closedir($handle);
     }
     else 
     {
     die("<b>ERROR: </b> Could not read directory : ". $dir);
     }
     return $returnArray;
     }
     
}
?>
