<?php
    $path_separator = DIRECTORY_SEPARATOR;
    $thisConfigFolder2 = __DIR__ . $path_separator;
    $baseDir=str_replace($path_separator.'Classes', '', $thisConfigFolder2);
     
    include_once $baseDir."Classes\Portal_Class.php";
    $get_class_handle =new Portal_Class();
    $j_nd_s_class=$get_class_handle->getClassList();
    $class_arms_alpha=$get_class_handle->getClassArms();
?>

    <div class="form-group">
    <label class="text-primary" for="sel1"> Select Class:</label>
    <select class="form-control" id="sel1"  name="class" size="1">
    <?php
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
    ?>
    </select>
    </div>

    <div class="form-group">
    <?php
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
    ?>
    </div>