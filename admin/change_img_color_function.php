<?php
    function html2rgb($color)
    {
    if ($color[0] == '#')
    $color = substr($color, 1);
    if (strlen($color) == 6)
    list($r, $g, $b) = array($color[0].$color[1],
    $color[2].$color[3],
    $color[4].$color[5]);
    elseif (strlen($color) == 3)
    list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
    else
    return false;
    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
    return array($r, $g, $b);
    }


    function updateThumb($image, $newColor) 
    {
    if (!extension_loaded('gd') && !extension_loaded('gd2')) {
    trigger_error("GD is not loaded", E_USER_WARNING);
    return false;
    }
    $ext=pathinfo($image,PATHINFO_EXTENSION);
    $ext=strtolower($ext);
    if($ext=='png')
    {
    $img = imagecreatefrompng($image);
    }
    elseif($ext=='jpg' || $ext=='jpeg' )
    {
     $img = imagecreatefromjpeg($image);  
    }
    else 
    {
    $img=  imagecreatefromgif($image);
    }
    $w = imagesx($img);
    $h = imagesy($img);
    // Work through pixels
    for($y=0;$y<$h;$y++) 
    {
    for($x=0;$x<$w;$x++) 
    {
            // Apply new color + Alpha
    $rgb = imagecolorsforindex($img, imagecolorat($img, $x, $y));
    $transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
    imagesetpixel($img, $x, $y, $transparent);
    // Here, you would make your color transformation.
    $red_set=$newColor[0]/100*$rgb['red'];
    $green_set=$newColor[1]/100*$rgb['green'];
    $blue_set=$newColor[2]/100*$rgb['blue'];
    if($red_set>255)$red_set=255;
    if($green_set>255)$green_set=255;
    if($blue_set>255)$blue_set=255;
    $pixelColor = imagecolorallocatealpha($img, $red_set, $green_set, $blue_set, $rgb['alpha']);
    imagesetpixel ($img, $x, $y, $pixelColor);
    }
    }
    // Restore Alpha
    imageAlphaBlending($img, true);
    imageSaveAlpha($img, true);
    return $img;
    }

    function makeThumb($path, $top,$bottom=FALSE) 
    {
    $width = imagesx($top);
    $height = imagesy($top);
    $thumbHeight = $bottom != FALSE ? $height * 2 : $height;
    // Create Transparent PNG
    $thumb = imagecreatetruecolor($width, $thumbHeight);
    $transparent = imagecolorallocatealpha($thumb, 0, 0, 0, 127);
    imagefill($thumb, 0, 0, $transparent);
    // Copy Top Image
    imagecopy($thumb, $top, 0, 0, 0, 0, $width, $height);
    // Copy Bottom Image
    if ($bottom != FALSE) {
        imagecopy($thumb, $bottom, 0, $height, 0, 0, $width, $height);
    }
    // Save Image with Alpha
    imageAlphaBlending($thumb, true);
    imageSaveAlpha($thumb, true);
    //header("Cache-Control: no-cache");
   //header('Content-Type: image/'.$ext);
   // header("Content-Disposition:attachment;filename='$save_here'");
    $ext=pathinfo($path,PATHINFO_EXTENSION);
    $ext=strtolower($ext);
    $ext=strtolower($ext);
    if($ext=='png')
    {
    imagepng($thumb, $path);
    }
    elseif($ext=='jpg' || $ext=='jpeg' )
    {
    imagejpeg($thumb, $path); 
    }
    else 
    {
    imagegif($thumb, $path); 
    }
    }

?>