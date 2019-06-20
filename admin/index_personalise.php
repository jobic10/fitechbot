<?php
require_once 'site_prerequisites.php';
?>
<!DOCTYPE html>
 <html>
  <head>

<?php
require_once 'head_tag_codes.php';
?>
  

</head>
  <body>

<?php

require_once 'fb_like_share_java_plugins.php';
?>
  


<!---------body div starts here------------!>
  <div id="body">




<?php

require "media_file_codes.php";



?>

<!---------con0 div starts here-------------!>
  <div id="con0">
   





<div id='img_con' onclick='large_image_close()'>

<img id='change_img'  src='images/owelogo.jpg'/>
<div id='read_more_content'></div>
</div>

 
<div id="overlay" ></div> 





<!------bana Div Starts------!>
    <div id="bana">
   
     


<?php

require "banner_codes_2.php";



?>
 

    </div>
<!------bana Div End------!>




     
<?php




require_once "homepage_menu.php";


?>
<!------cover picture start------!>
   <div id="cpcon">
   <div id="coverpix">

<?php require_once "cover_picture_codes.php";?>


    <!------<div id="coveroverlay"></div>------!>
   
 
    
</div>
</div>  <!------cover picture end------!>

  </div><!---------con0 div ends here---------------!>

<!--------con1 start---------!>

<div id="con1">


<!------fans contaner start------!>
    <div id="fanscon">
     




<?php require_once "fans_con_codes.php";?>



     

    </div><!------fans contaner end------!>


</div><!---------con1 end------------!>


<!------con2 contaner start------!>

<div id="con2">

<!------post starts------!>

    <div id="ajax_post"> 
     
    </div>



<div id="waiting_for_server_response"></div>


     <div id="returned_pst">

<?php   
require_once 'testing_noni.php';
//require_once 'load_homepage_contents.php';
?>


</div>




    </div><!------con2 contaner end------!>






<!------artist contaner start------!>

    <div id="artistcon">


<?php   
require_once 'artist_con_codes.php';

?>






    </div><!------artist contaner end------!>











  </div><!---------body div ends here---------------!>


<!-----------------last contaner start-----------!>
    <div id="footercon">
     <h1><?php echo "$footer";?></h1>
    </div><!----------last contaner end------------!>



  </body>
  </html>