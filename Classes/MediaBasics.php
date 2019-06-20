<?php
/**
 * Description of MediaBasics
 *
 * @author Bertola
 */

class MediaBasics
{
    var $allowed_photo_type=array();
    protected $file_default_name;
    protected $file_temp_dir;
    protected $file_type;
    protected $file_default_size;
    protected $file_error_code;
    private $gUI;
    private $sessionB;
    public $baseDir; 
    private $DAF;

    public function MediaBasics () 
    {    
    $path_separator = DIRECTORY_SEPARATOR;
    $thisConfigFolder2 = __DIR__ . $path_separator;
    $baseDir=str_replace($path_separator.'Classes', '', $thisConfigFolder2);
    require_once $baseDir."\Classes\GetUserInputs.php";
    require_once $baseDir."\Classes\sessionBasics.php";
    $this->sessionB =new sessionBasics();
    $this->gUI =new GetUserInputs();
    require_once $baseDir.'\Classes\DirAndFiles.php';
    $this->DAF =new DirAndFiles();
    $this->baseDir =$baseDir;
    $this->allowed_photo_type=array("image/jpeg","image/pjpeg","image/gif","image/png");
    $this->allowed_audio_type=array("audio/mpeg","audio/ogg","audio/wav");
    $this->allowed_video_type=array("video/ogg","video/mp4","video/3gpp");
    if(isset($_FILES["file"]["name"]))
    {
    if(is_array($_FILES["file"]["name"]) )
    {
    
    foreach ($_FILES["file"]["name"] as $index_name => $store_value)
    {
    $this->file_default_name=$_FILES["file"]["name"][$index_name];
    $this->file_temp_dir=$_FILES["file"]["tmp_name"][$index_name];
    $this->file_type=$_FILES["file"]["type"][$index_name];
    $this->file_default_size=$_FILES["file"]["size"][$index_name];
    $this->file_error_code=$_FILES["file"]["error"][$index_name]; 
    }
    }
    else
    {
    $this->file_default_name=$_FILES["file"]["name"];
    $this->file_temp_dir=$_FILES["file"]["tmp_name"];
    $this->file_type=$_FILES["file"]["type"];
    $this->file_default_size=$_FILES["file"]["size"];
    $this->file_error_code=$_FILES["file"]["error"];
    }
    }
    ini_set('post_max_size','200M'); 
    ini_set('upload_max_filesize','200M');
    ini_set('max_file_uploads','100');
    }
    
    public function getUpldPrgr() 
    {
    $key = ini_get("session.upload_progress.prefix")."123";
    if (!empty($_SESSION[$key]) OR isset($_SESSION[$key])) 
    {
    $current = $_SESSION[$key]["bytes_processed"];
    $total = $_SESSION[$key]["content_length"];
    $percent=$current < $total ? ceil($current / $total * 100) : 100;
    }
    else 
    {
    $percent=100;
    }
    echo " <div class=\"progress\">
    <div class=\"progress-bar progress-bar-striped active\" role=\"progressbar\"
    aria-valuenow=\"40\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:".$percent."%\">".
    $percent."%
    </div>
    </div>";
    }
    
    private function resizeImage($image,$width,$height,$scale) 
    {
    list($imagewidth, $imageheight, $imageType) = getimagesize($image);
    $imageType = image_type_to_mime_type($imageType);
    //method_exists($imageType, $method_name)
    //mime_content_type($imageType);
    $newImageWidth = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    switch($imageType) 
    {
    case "image/gif":
    $source=imagecreatefromgif($image); 
    break;
    case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
    $source=imagecreatefromjpeg($image); 
    break;
    case "image/png":
    case "image/x-png":
    $source=imagecreatefrompng($image); 
    break;
  }
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
         if($imageType=='image/gif' || $imageType=='image/png' || $imageType=='image/x-png')
            {
        imagealphablending($newImage, false);
        imagesavealpha($newImage,true);
        $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
        imagefilledrectangle($newImage, 0, 0, $newImageWidth, $newImageHeight, $transparent);
            }
        
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	switch($imageType) 
        {
		case "image/gif":
	imagegif($newImage,$image); 
			break;
      	        case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
        imagepng($newImage,$image);  
			break;
       }
	
	chmod($image, 0777);
	return $image;
}

function getHeight($image) 
{
	$size = getimagesize($image);
	$height = $size[1];
	return $height;
}
function getWidth($image) 
{
	$size = getimagesize($image);
	$width = $size[0];
        return $width;
}
public function fitech_upload_file($username,$upload_dir)
{
      /*
      if (in_array($this->file_type, $this->allowed_audio_type) || in_array($this->file_type, $this->allowed_video_type) && $this->file_default_size >0 && $this->file_default_size < 11000000 )
      {
          
      }
      */
      
      $rename=uniqid($username);
      $ext=pathinfo($this->file_default_name,PATHINFO_EXTENSION);
      $ext=strtolower($ext);
      $fileloc="$upload_dir/$rename".".$ext";
      if(!file_exists($upload_dir))
      {
      mkdir($upload_dir, 0755, true);   
      }
      if(!move_uploaded_file($this->file_temp_dir,$fileloc))
      {
      echo "<font color='red' size='5'>File could not be Uploaded!</font>";
      $this->gUI->closeWin();
      exit;  
      }  
      return $fileloc;
}

public function fitech_upload_img($username,$upload_dir,$max_width,$cp=FALSE,$rname=TRUE)
{
      if($cp===TRUE)
      {
      $width =$this-> getWidth($this->file_temp_dir);
      $height =$this-> getHeight($this->file_temp_dir);
      if($width<600 | $height<300 | $height>500)
      {
      echo "<font color='red' size='5'>".$height."px and ".$width."px of Photo did not pass the allowed dimesions of 300px by 800px , Upload an Image of atleast 300px by 800px!</font>";
      $this->gUI->closeWin();
      exit();
      }
      }
    
      
      $wtmrk=  $this->gUI->getInputVal('water_mark');
      if (in_array($this->file_type, $this->allowed_photo_type) && $this->file_default_size >0 && $this->file_default_size < 11000000 )
      {     
      if($rname)
      {
      $rename=uniqid($username);
      }
      else
      {
      $rename=$username;
      }
      $ext=pathinfo($this->file_default_name,PATHINFO_EXTENSION);
      $ext=strtolower($ext);
      $passloc="$upload_dir/$rename".".$ext";
      $passloc_thumb="$upload_dir/thumb".$rename.".$ext";
      if(!file_exists($upload_dir))
      {
      mkdir($upload_dir, 0755, true);   
      }
      if(!move_uploaded_file($this->file_temp_dir,$passloc))
      {
      echo "<font color='red' size='5'>Photo could not be moved to this directory $passloc !</font>";
      //$this->gUI->closeWin();
      exit();  
      }
      $width =$this-> getWidth($passloc);
      $height =$this-> getHeight($passloc);
      if ($width > $max_width)
      {
      $scale = $max_width/$width;
      $this-> resizeImage($passloc,$width,$height,$scale);
      copy($passloc,$passloc_thumb);
      }
      else
      {
      $scale = 1;
      $this-> resizeImage($passloc,$width,$height,$scale);
      copy($passloc,$passloc_thumb);
      }
      $width =$this-> getWidth($passloc_thumb);
      $height =$this-> getHeight($passloc_thumb);
      if($width>250)
      {
      $scale_thumb= 0.1;
      }
      else if ($width>100)
      {
      $scale_thumb= 0.3;
      }
      else
      {
      $scale_thumb= 0.6;
      }
      $this-> resizeImage($passloc_thumb,$width,$height,$scale_thumb);
      if($wtmrk!==false)
      {
       $this-> writeWaterMark($passloc); 
      }
      return array("resized"=>"$passloc","thumb"=>"$passloc_thumb");
      }
      else
      {  
      echo "<font color='red' size='5'>Unrecognized Photo Type!</font>";
      $this->gUI->closeWin();
      exit;  
      }
}

private function colorAllocImg($color,$im)
{
	switch($color) 
        {
		 case "black":
       return imagecolorallocate($im, 0, 0, 0);
			break;
      	                   case "white":
      return imagecolorallocate($im, 255, 255, 255);
			break;
		case "grey":
       return imagecolorallocate($im, 128, 128, 128);
			break;
                                      case "red":
      return imagecoloralocate($im,255,0,0);
                                                      break;
                                    case "green":
      return imagecoloralocate($im,0,255,0);
                                                      break;
                                   case "blue":
      return imagecoloralocate($im0,0,255);
                                                      break;
       }


}

public function writeWaterMark($passloc)
    {
    $im=  imagecreatefromjpeg($passloc);
    $y =$this-> getHeight($passloc);
    $y=$y-4;
    //$im = imagecreatetruecolor(400, 30);
    // Create some colors,there are well over sixteen billion colors to fuck with ! 
    $white = imagecolorallocate($im, 255, 255, 255);
    $grey = imagecolorallocate($im, 128, 128, 128);
    $black = imagecolorallocate($im, 0, 0, 0);
    //imagefilledrectangle($im, 0, 0, 399, 29, $white);
    // The text to draw
    $text = 'HeLLOTRiO';
    // Replace path by your own font path if you fucking like.
   $font = 'ayobot.ttf';
   // Add some shadow to the text, not compulsory though.
   imagettftext($im, 17, 0, 0,  $y , $black, $font , $text);
   //imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);
   // Add the text
   //imagettftext($im, 20, 0, 10, 20, $black, $font, $text);
   // Using imagepng() results in clearer text compared with imagejpeg()
   imagepng($im,$passloc);
   imagedestroy($im);
}

public function genFavicon($passloc)
{
    $filename=basename($passloc);
    $valid_exts = array("jpg","jpeg","gif","png");
    $filename=strtolower($filename);
    //$ext = end(explode(".",strtolower(trim($_FILES["image"]["name"]))));
    $ext=pathinfo($filename,PATHINFO_EXTENSION);
    $directory = "favicon/"; 
    $size = filesize($passloc);
    if($size <= 179200){
    if(in_array($ext,$valid_exts))
    {
    if($ext == "jpg" || $ext == "jpeg")
    {
    $image = imagecreatefromjpeg($passloc);
    }
    else if($ext == "gif")
    {
    $image = imagecreatefromgif($passloc);
    }
    else if($ext == "png")
    {
    $image = imagecreatefrompng($passloc);
    }

    if($image)
    {
    list($width,$height) = getimagesize($passloc);
    $newwidth = 32;
    $newheight = 32;
    $tmp = imagecreatetruecolor($newwidth,$newheight);
    if($ext=='gif' || $ext=='png')
    {
    imagealphablending($tmp, false);
    imagesavealpha($tmp,true);
    $transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
    imagefilledrectangle($tmp, 0, 0, $newwidth, $newheight, $transparent);
    }
    imagecopyresampled($tmp,$image,0,0,0,0,$newwidth,$newheight,$width,$height);

    if(!is_dir($directory))
    {
    mkdir($directory, 0755, true);
    }
    if(is_writable($directory))
    {
    $rand = rand(1000,9999);
    $filename = $rand.$filename;
    imagejpeg($tmp,$directory.$filename,100) or die('Could not make image file');
    $ext_pos = strpos($filename,"." . $ext);
    $strip_ext = substr($filename,0,$ext_pos);
    rename($directory.$filename,$directory.$strip_ext.".ico");
    rename($directory.$strip_ext.".ico",$directory."favicon".".ico");
    $new_icon_link="$directory"."favicon" .".ico";
    }  
    else
    {
    echo'The directory: "'.$directory.'" is not writable.';
    }
    imagedestroy($image);
    imagedestroy($tmp);
    } 
    else 
    {
    echo"Could not create image file.";
    exit();
    }
    } 
    else 
    {
    echo"The  size of the website logo is too large. Max allowed file size is 175kb.";
    exit();
    }
    } 
    else 
    {
    echo"Website logo   must comply with these extesions-(jpg, jpeg, gif, png).";
    exit();
    }
}

    public function sndCaptch()
    {
    $data=$this->genCaptcha();
    header( "Content-type: image/png");
    //header('Content-Type: application/png');
    //header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
    //header('Pragma: public');
    //header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    //header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
    //header('Content-Disposition: inline; filename="FitechNig.png";');
    
    return $data;
    }

    public function genCaptcha()
    {
    //require_once '../../Classes/sessionBasics.php';
    //$sessionB =new sessionBasics();
    //$ext_dir=$DAF->captchasrc;
    $x= mt_rand(1,20);
    $y= mt_rand(21,40);
    $captcha_ans= $x +  $y;
    //$captcha_val= $x. " + " . $y . "= $captcha_ans";
    $captcha_val= $x. " + " .$y;
    if (isset($_SESSION['captcha'])) //great
    {
       
    $ext_dir=$this->DAF->captchasrc.$_SESSION['captcha'].".png";
    if(file_exists($ext_dir))
    {
    unlink($ext_dir);   
    }
    }
     
    $_SESSION['captcha']=$captcha_ans;
    //echo $captcha_ans;exit();
    $font=$this->baseDir."font";
    $font .= "\ayobot.ttf";
    $my_img = imagecreatetruecolor( 80, 20 );
    $background = imagecolorallocate( $my_img, 0, 0, 255 );
    $text_colour = imagecolorallocate( $my_img, 255, 255, 0 );
    $line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
    imagettftext($my_img, 17, 0, 0,  16 , $text_colour, $font , $captcha_val);
    imagesetthickness ( $my_img, 100);
    imageline( $my_img, 30, 45, 165, 45, $line_colour );
    //header( "Content-type: image/png");
    ////////////////////////////////////////////////////////////////////////////////////////
    $domainDir=$this->baseDir."Classes";
    $domainDir.="\get_site_domain_url.php";
    //require_once "$domainDir";
    $captch_src=$this->gUI->get_site_domain_url(NULL,"addons/captcha/captcha_imgs"); 
    $ext_dir2=$captch_src.$captcha_ans.".png";//$ext_dir="captcha_imgs/".$captcha_ans.".png";
    $ext_dir=$this->DAF->captchasrc.$captcha_ans.".png";
    imagepng($my_img,$ext_dir);
    ///////////////////////////////////////////////////////////////////////////////////////
    $captch_ext=$this->gUI->getInputVal('captcha');
    if ($captch_ext!==FALSE && $captch_ext=='CAPTCHA')
    {
    echo $ext_dir2;
    exit();
    }
    else
    {
    return $ext_dir2;
    //exit();
    }
    }


}
