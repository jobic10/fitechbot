<?php
/**
 * Description of HtmlGen
 *
 * @author Kingsley
 */
class HtmlGen 
{
    public $gUI; 
    public $get_class_handle;
    public $baseDir;
    protected $mB; 
    public function HtmlGen()
    {
    $path_separator = DIRECTORY_SEPARATOR;
    $thisConfigFolder2 = __DIR__ . $path_separator;
    $baseDir=str_replace($path_separator.'Classes', '', $thisConfigFolder2);
    require_once $baseDir."\Classes\GetUserInputs.php";
    $this->gUI =new GetUserInputs();
    require_once $baseDir."\Classes\Portal_Class.php";
    $this->get_class_handle =new Portal_Class();
    require_once $baseDir."\Classes\MediaBasics.php";
    $this->mB =new MediaBasics();
    $this->baseDir =$baseDir;
    }
 
private function input($type,$name,$phd,$id,$cpf="NO")
{
    echo "<input ";
    if($cpf==="YES")
    {
    if(isset($_COOKIE['cpf']) && $_COOKIE['cpf']>=2)
    {
    echo "type='text'";
    }
    else 
    {
    echo "type='password'";   
    }
    }
    else 
    {
    echo "type='$type' "; 
    }
    echo "class='form-control' id='$id' placeholder='$phd' name='$name'/>";
}
    
public function createLoginPage($sqtn_scrpt_loc,$actn_url,$login_header,$login_icon="YES",$iconType="default")
{
   require $this->baseDir."error_report.php";
   $local_host=$this->gUI ->get_site_domain_url();
   echo " <div class='login_form_sms_header'><span>$login_header</span></div>
   <div class='hold_sms_login_form'>";
   if($login_icon==="YES")
   {
   if($iconType=="default")
   {
   echo"<img src='".$local_host."images/student_login.png' width='100%' class='img-responsive' height='160px'/>";
   }
   else
   {
   echo"<img src='$iconType' width='100%' class='img-responsive' height='160px'/>";
   }
   }      
   echo "<span class='login_form_sms'>
   <form  role='form' action='$actn_url' method='post'>
   <div class='form-group'>
   <label class='text-primary' for='usr'>Username:</label>";
   $this->input("text","username","Enter Your Username","usr"); 
   echo "</div>
   <div class='form-group'>
   <label class='text-primary' for='pwd'>Password:</label>";
   $this->input("text","password","Enter Your Password" ,"pwd","YES"); 
   echo "</div>";
   if(isset($_COOKIE['cpf']) && $_COOKIE['cpf']>=4)
   {
   //$data=$this->mB->genCaptcha(); sndCaptch() 
   echo "<div class='form-group'>
   <label class='text-primary' for='usr'>Security Question:<span id='security_question' > <img src='";
    echo $data=$this->mB->genCaptcha();
    echo "' /></span> 
    <span onclick=captcha('$sqtn_scrpt_loc"."create_img_from_scrap.php','security_question','CAPTCHA')>Reload Captcha</span>
   </label>
   <input type='text' class='form-control' id='captcha' name='captcha' placeholder='Enter the answer to the security question above here'/>
   </div>";
   //require_once "create_img_from_scrap.php"; 
  //$cpsrc=fitech_captcha($x,$y,$captcha_name);
   }
   echo "
   <div class='form-group'>
   <label class='text-primary' for='usr'><input type='checkbox' name='remember_login' value='YES'";
    if(isset($_COOKIE['remember_login'])) 
    {
    echo "checked";
    }   
    echo "    > keep me logged in</label> 
    <input class='btn btn-primary' style='float:right;' type='submit' value='login' name='submit'/>
    </div>
    </form>
    </span>
    </div>";
      

}
public function createSignupPage($actn_url,$signup_header,$login_icon="YES",$iconType="default") 
{
   require $this->baseDir."error_report.php";
   $local_host=$this->gUI ->get_site_domain_url();
   echo "<div class=\"login_form_sms_header\"><span>$signup_header</span></div>           
   <div class='hold_sms_login_form'>";
   if($login_icon==="YES")
   {
   if($iconType=="default")
   {
   echo"<img src='".$local_host."images/staff_login.png' width='100%' class='img-responsive' height='160px'/>";
   }
   else
   {
   echo"<img src='$iconType' width='100%' class='img-responsive' height='160px'/>";
   }
   }    
   echo "<span class=\"login_form_sms\">
   <form role='form' action='$actn_url' method=\"POST\" >
   <div class=\"form-group\">
   <label class=\"text-primary\" for='usr'>Fullname:</label>
   <input class=\"form-control\" id=\"fname\" type=\"text\"  name=\"full_name\" placeholder=\"Your Name in Full\" /><h6 class=\"ok\" id=\"fullname_hint\"></h6>
   </div>
   <div class=\"form-group\">      
   <label class=\"text-primary\" for='usr'>Username:<span class=\"ok\" id=\"username\"></span></label>
   <input class=\"form-control\"  type=\"text\" placeholder=\"Choose a username\" id=\"ajax_check.php\" name=\"username\" maxlength=\"10\"  onfocus=\"chat_perform_action(this.id,this.value,this.name)\" onblur=\"chat_perform_action(this.id,this.value,this.name)\" onkeyup=\"chat_perform_action(this.id,this.value,this.name)\"/>
   </div>
   <div class=\"form-group\">
   <label class=\"text-primary\" for='usr'>Gender: Male: 
   <input type=\"radio\" value=\"MALE\" name=\"sex\" id=\"sex\"  checked> Female: 
   <input type=\"radio\" value=\"FEMALE\" name=\"sex\" />
   </label>
   </div>
   <div class=\"form-group\">
   <label class=\"text-primary\" for='usr'>Password:<span class=\"mid\" id=\"mid\"></span></label> 
   <input class=\"form-control\" id=\"pass1\" type=\"password\" placeholder=\"Choose a Password\"  onkeyup=\"check_pass(this.value)\" onkeydown=\"check_pass(this.value)\" name=\"password\" onfocus=\"check_pass(this.value)\" />
   </div>
   <div class=\"form-group\">
   <label class=\"text-primary\" for='usr'>Confirm Password:<span class=\"ok\" id=\"match_pass\"></span></label> 
   <input class=\"form-control\"  type=\"password\" placeholder=\"Confirm Password\" id=\"pass2\"  onkeyup=\"check_pass(this.value)\" name=\"cpassword\" onfocus=\"check_pass(this.value)\" onkeyup=\"check_pass(this.value)\"/>
   </div>  
   <div class=\"form-group\">
   <label class=\"text-primary\" for='usr'>Password Hint:</label> 
   <input class=\"form-control\"  type=\"text\" placeholder=\"Password Hint\" name=\"pass_hint\"/>
   </div>
   <div class=\"form-group\">
   <label class=\"text-primary\" for='usr'>e-mail:<span class=\"ok\" id=\"email\" > </span></label> 
   <input class=\"form-control\"  type=\"text\" placeholder=\"Enter your email\" id=\"ajax_check.php\" name=\"email\" onfocus=\"chat_perform_action(this.id,this.value,this.name)\" onblur=\"chat_perform_action(this.id,this.value,this.name)\" onkeyup=\"chat_perform_action(this.id,this.value,this.name)\"/>
   </div>
   <div class=\"form-group\">
   <label class=\"text-primary\" for='usr'>Mobile Number:<span class=\"ok\" id=\"number\"> </span></label> 
   <input class=\"form-control\" id=\"ajax_check.php\" type=\"text\"  placeholder=\"Enter Your Phone Number\" name=\"phone_no\" maxlength=\"14\"  onkeypress=\"return check_no(event,this.value,this.name)\" onkeydown=\"return check_no(event,this.value,this.name)\" onkeyup=\"return check_no(event,this.value,this.name)\"/>
   </div>
   <div class=\"form-group\">
   <label class=\"text-primary\" for='usr'>State/Local Government:</label> <input class=\"form-control\" id=\"lg\" type=\"text\" placeholder=\"Kogi/Yagba West\" name=\"state\" />
   </div>
   <div class=\"form-group\">
   <input type=\"submit\" class=\"btn btn-primary\" style=\"float: right;\" id=\"sbutton\"  value=\"SUBMIT\" name=\"submit\"/>
   </div>
   </form>
   </span>
   </div>";   
}
    public function siteMapHeadText($thumbpix,$in_str)
    {
    echo "<img id='voll' width='35px' class='img-circle' style='float:left;' height='35px' src='$thumbpix'/>
    <span id='sitemap_headtext'>   
    $in_str
    </span>
    <img id='volr' width='35px' height='35px' style='float:right;' class='img-circle' src='$thumbpix'/>
    ";  
    }

    public function genMetaData($desc,$title,$type,$url,$stname,$imageBg="Default")
    {
    /*
    if($imageBg=="Default")
    {
     $imageBg="FitechNig.jpg";
    }
    */
    $kywrds=str_replace(","," ",$desc);
    $kywrds=trim($kywrds);
    $kywrds=preg_replace('/\s+/',',',$kywrds);
    echo "
    <meta name='description' content='$desc'/>
    <meta property='og:title' content='$title'/>
    <meta property='og:type' content='$type'/>
    <meta property='og:url' content='$url'/>
    <meta property='og:image' content='$imageBg'/>
    <meta property='og:description' content='$desc'/>
    <meta property='og:site_name' content='$stname'/>
    <meta name='keywords' content='$kywrds'/>
    <meta property='fb:admins' content='100006695830100'/>
    <meta property='fb:app_id' content='215519668658462'/>
    <meta name='robots' content='index, follow'/> 
    <meta name='robots' content='index, follow'/> 
    <meta name='revisit-after' content='1 day'/> 
    <meta name='language' content='English'/> 
    <meta name='generator' content='N/A'/> 
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    ";
    }

public function uploadFileForm($action_url,$file_label,$txtArea_label,$allowed_file_type,$btn_label,$username="FitechNig",$water_mark="INTJ")
{
    $menuname=$this->gUI->getInputVal('menuname');
    $linkname=$this->gUI->getInputVal('linkname');
    echo " <div class='hold_sms_login_form'>
    <span class='login_form_sms'>
    <form action='$action_url' method='post' enctype='multipart/form-data'>
    <div class='form-group'>
    <input type='hidden' name=' ini_get('session.upload_progress.name')' value='123' />
    <label  class='text-primary' for='usr'>$file_label:</label>
    <input type='file' class='form-control' size='34' name='file' id='file'/><font color='green'>&nbsp*&nbsp.$allowed_file_type only</font>
    </div>              
    <div class='form-group'>
    <label  class='text-primary' for='usr'>$txtArea_label:</label>
    <textarea name='caption' class='form-control' placeholder='$txtArea_label' rows='5' cols='37'></textarea>
    </div>";
    if  (isset($menuname) && isset($linkname)) 
    {
    echo " <input type='hidden'  class='btn btn-primary btn-xs' value='$menuname' name='menuname'/>
    <input type='hidden'  class='btn btn-primary btn-xs' value='$linkname' name='linkname'/>";
    }
    if($username!="FitechNig")
    {
    echo " <label class='text-primary' for='usr'><input id='pr2' title='Anonymous' type='radio' name='post_privacy' value='anon' >&nbsp;<button title='Anonymous'     class='btn btn-primary btn-xs'><i class='icon-eye-close'> </i></button></label>&nbsp;&nbsp;
    <label class='text-primary' for='usr'><input  id='pr1' type='radio' title='Only me' name='post_privacy' value='$username' >&nbsp;<button title='Only me' class='btn  btn-primary btn-xs'><i class='icon-eye-open'> </i> </button></label>&nbsp;&nbsp;
    <label class='text-primary' for='usr'><input id='pr2' title='Followers only' type='radio' name='post_privacy' value='followers' >&nbsp;<button title='Followers only' class='btn btn-primary btn-xs'><i class='icon-user'> </i></button></label>&nbsp;&nbsp;

<label class='text-primary' for='usr'><input id='pr3' title='Public' type='radio' name='post_privacy' value='public' checked>&nbsp;<button title='Public' class='btn btn-primary btn-xs'><i class='icon-globe'> </i></button></label>&nbsp;&nbsp; ";
}

if($water_mark!="INTJ")
{
echo "<label class='text-primary' for='usr'><input id='water_mark' title='If you check this,it will print Hello Trio water mark at the bottom left of the picture to be uploaded' type='checkbox' name='water_mark' value='water_mark' >&nbsp;<span class='label label-primary' title='If you check this,it will print Hello Trio water mark at the bottom left of the picture to be uploaded' ><i class='icon-barcode'> </i></span></label>&nbsp;&nbsp; 
";
}
echo " <input type='submit' style='float: right;' class='btn btn-primary btn-xs' value='$btn_label' name='submit'/>
   
</form>

    </span>
    </div>";


}
public function genFileCation($num_pix,$url,$info_div,$watermark=NULL,$privacy=NULL,$group_codename=NULL) 
{
//$info_div="img_info";
//$url="move_tuf.php";
if(isset($num_pix) && ($num_pix==1 || $num_pix==0))
{
 $sst="Say something about this photo";   
}
 else 
{
 $sst="Say something about these photos";      
}
echo "
<div id='file_caption'>
<div class='form-group' id='d_caption'>
<label  class='text-primary' for='usr'>$sst:</label>
<textarea id='caption' name='caption' class='form-control' placeholder='$sst' rows='5' cols='37'></textarea>
</div>";
if($privacy!=Null)
{
echo "<span id='privacy_group' >
<label class='text-primary' for='usr'><input id='pr2' title='Anonymous' type='radio' name='post_privacy' value='anon' >&nbsp;<span class='label label-primary' title='Anonymous' ><i class='icon-eye-close'> </i></span></label>&nbsp;&nbsp;
<label class='text-primary' for='usr'><input  id='pr1' type='radio' title='Only me' name='post_privacy' value='$username' >&nbsp;<span class='label label-primary'title='Only me' ><i class='icon-eye-open'> </i> </span></label>&nbsp;&nbsp;
<label class='text-primary' for='usr'><input id='pr2' title='Followers only' type='radio' name='post_privacy' value='followers' >&nbsp;<span class='label label-primary' title='Followers only' ><i class='icon-user'> </i></span></label>&nbsp;&nbsp;
<label class='text-primary' for='usr'><input id='pr3' title='Public' type='radio' name='post_privacy' value='public' checked>&nbsp;<span class='label label-primary'title='Public'><i class='icon-globe'> </i></span></label>&nbsp;&nbsp; 
</span>";
}
if($watermark!=null)
{
echo "<span id='s_water_mark' >
<label class='text-primary' for='usr'><input id='water_mark' title='If you check this,it will print Hello Trio water mark at the bottom left of the picture to be uploaded' type='checkbox' name='water_mark' value='water_mark' >&nbsp;<span class='label label-primary' title='If you check this,it will print Hello Trio water mark at the bottom left of the picture to be uploaded' ><i class='icon-barcode'> </i></span></label>&nbsp;&nbsp; 
</span>";
}
if($group_codename!=null)
{
echo "<input type='hidden' name='group_codename' value='$group_codename' id='$group_codename'/>";
}
echo "<input type='button' id='submit_btn' style='float: right;'  onclick=move_uf('".$url."','".$info_div."') class='btn btn-primary btn-xs' value='upload photo' name='submit'/>

</div>
"; 
//<button type='button' onclick=move_uf('".$url."','".$info_div."') class='btn btn-primary btn-xs' >upload photo</button>

}

public function GenClassList()
{
    $j_nd_s_class=$this->get_class_handle->getClassList();
    $class_arms_alpha=$this->get_class_handle->getClassArms();

    echo "<div class='form-group'>
    <label class='text-primary' for='sel1'> Select Class:</label>
    <select class='form-control' id='sel1'  name='class' size='1'>";
    foreach ($j_nd_s_class as $key => $in_class) 
    { 
    echo "<option value='$in_class'";
    if(isset($_SESSION['pin_student']))
    { 
    if($confirm_pin != 0)
    { 
    if($dbclass=='$in_class')
    {
    echo 'selected';     
    }            
    }         
    } 
    echo " >$in_class</option>";
    }
    echo "</select>
    </div>
    <div class='form-group'>";
    foreach ($class_arms_alpha as $key => $value) 
    {
    echo "<label class='radio-inline'>
    <input type='radio' name='cd' value='$value'";
    if(isset($_SESSION['pin_student']))
    { 
    if($confirm_pin != 0)
    { if($cd==$value)
    {
    echo 'checked';
    }      
    }
    }  
    else 
    {
    echo "checked";
    } 
    echo ">$value</label>";
    }
    echo "</div>";
    }

    public  function  mimeType($image)
    {
    list($imagewidth, $imageheight, $imageType) = getimagesize($image);
    return $imageType = image_type_to_mime_type($imageType);
    }

}
