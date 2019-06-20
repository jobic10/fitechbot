<?php


function ayobot_hex_colors()

{
    
$vals=array('00','33','66','99','cc','ff');
    
$colors=array();
    
foreach ($vals as $r) 
{
        
foreach ($vals as $g)
        
{
            
foreach ($vals as $b)
                
{
            
$colors[]='#'.$r.$g.$b;    
        
}
        
}
    
}
    
return $colors;

}

?>