<?php
    function get_site_domain_url($site_domain=NULL,$dir_name=NULL)
    {
    if($site_domain==NULL)
    {
    $site_domain=$_SERVER['SERVER_NAME'];
    }
    if (strpos($site_domain,"www.")!==false)
    {
    if($dir_name==null)
    {
    $site_domain_url="http://$site_domain/";
    }
    else
    {
    $site_domain_url="http://$site_domain/$dir_name/";
    }
    }
    else 
    {
    if($dir_name==null)
    {
    $site_domain_url="http://$site_domain/fitechbot/";
    }
    else
    {
    $site_domain_url="http://$site_domain/fitechbot/$dir_name/"; 
    }
    }
    return $site_domain_url;
}
