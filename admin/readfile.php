<?php 
    require_once "redir_admin.php";
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    $hex_color_code=$gUI->getInputVal('hex_color_code');
    $index="../index.php";
    $filename_index=file_get_contents($index);
    function change_dir_loc($old_dir,$new_dir)
    {
    if(!copy($old_dir,$new_dir))
    {
    echo "Fatal Error !";
    exit();
    } 
    }

    if($hex_color_code=='full_screen')
    {
    $filename_index=str_replace("class=\"container-fluid\"","class=\"container\"",$filename_index);
    file_put_contents($index,$filename_index);
    $filename='../images/bg/content_bg.jpg';
    $new_filename='../images/content_bg.jpg';
    change_dir_loc($filename,$new_filename);
    $filename='../images/bg/menu_bg.jpg';
    $new_filename='../images/menu_bg.jpg';
    change_dir_loc($filename,$new_filename);
    echo "<font color='green' size='5' >Theme has been successfully Loaded</font>";
    exit;
    }
    if($hex_color_code=='half_screen')
    {
    $filename_index=str_replace("class=\"container\"","class=\"container-fluid\"",$filename_index);
    file_put_contents($index,$filename_index);
    $filename='../images/bg/content_bg.jpg';
    $new_filename='../images/content_bg.jpg';
    change_dir_loc($filename,$new_filename);
    $filename='../images/bg/menu_bg.jpg';
    $new_filename='../images/menu_bg.jpg';
    change_dir_loc($filename,$new_filename);
    echo "<font color='green' size='5'>Theme has been successfully Loaded</font>";
    exit;
    }

    require_once 'change_img_color_function.php';
    $image='../images/bg/content_bg.jpg';
    $image2='../images/bg/menu_bg.jpg';
    $image3='../images/bg/student.png';
    $image4='../images/bg/student_login.png';
    $image5='../images/bg/staff_login.png';
    $img_list=array($image,$image2,$image3,$image4,$image5);
    $num_img=  count($img_list);
    for($j=0;$j<$num_img;$j++)
    {
    $image=$img_list[$j];
    process_img($image, $hex_color_code);    
    }
    function process_img($image,$hex_color_code)
    {
    $rgb_color_code=html2rgb($hex_color_code);  
    $thumbTop = updateThumb($image,$rgb_color_code);
    $name_of_file=  basename($image); 
    makeThumb('../images/'.$name_of_file, $thumbTop);
    }
    echo "<font color='green' size='5' >Theme has been successfully Loaded</font>";
?>