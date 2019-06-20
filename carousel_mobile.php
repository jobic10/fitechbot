<div id="owl-demo" class="owl-carousel owl-theme">
<?php   
$result_slide = $sqlB->tmp_create_tb("SELECT * FROM `owe_photo` WHERE menuname='home' ORDER BY RAND() LIMIT 0,4")  or die(mysqli_error());
while($validate =$result_slide-> fetch_array())
    {
     $slide_caption=$validate['caption'];
     $photo_url=$validate['photo'];
     echo "<div class='item'>
     <img  src='admin/$photo_url' alt='$slide_caption' width='100%' height='300px' class='img-responsive' /> 
     <div class='carousel-text'>
     <div class='line'>
     <div class='s-12 l-9'>
     <p>
     $slide_caption
     </p>
     </div>
     </div>
     </div>
     </div>";
   }
   //exit();
?>                        
</div>




     