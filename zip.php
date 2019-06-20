<?php
function extractZip( $zipFile = '', $dirFromZip = '' )
{   
    define(DIRECTORY_SEPARATOR, '/');
    $zipDir = getcwd() . DIRECTORY_SEPARATOR;
    $zip = zip_open($zipDir.$zipFile);
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
    }
    }
    }
    zip_close($zip);
    }
    return true;
}



?>