<?php
    require_once 'redir_admin.php';
    require_once '../Classes/SqlBasics.php';
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    $sqlB =new SqlBasics("cms");
    $result = $sqlB->tmp_create_tb("SELECT * FROM `menubar`");
    while($validate = $result->fetch_array())
    {
    $menuname=$validate['name_of_menubar'];
    $menuitem=$validate['default_menubar_item'];
    $result2=$sqlB->tmp_create_tb("SELECT * FROM `$menuname`");
    while ($all = $result2->fetch_array())
    {
    $menuname=$all['menu'];
    $linkname=$all['linkname'];
    if($linkname!=="")
    {
    echo "
    <span class='admin_tools_con'>
    <a href='#' id='$menuname'  name='$linkname' onclick='update_page(this.id,this.name)'>update $linkname page</a>
    </span>  
    <span class='admin_tools_con'>
    <a href='#' id='$menuname'  name='$linkname' onclick='addphoto_to_page(this.id,this.name)'>Upload photo to $linkname page</a>
    </span> ";
    
    
    $result3=$sqlB->tmp_create_tb("SELECT * FROM `baby_sub_item` where name_of_subitem='$linkname'");
    while ($all2 =  $result3->fetch_array())
    {  
    $name_of_babysubitem=$all2['name_of_babysubitem'];
    if($name_of_babysubitem!=="")
    {
    echo "
    <span class='admin_tools_con'>
    <a href='#' id='$menuname'  name='$name_of_babysubitem' onclick='update_page(this.id,this.name)'>update $name_of_babysubitem page</a>
    </span>  
    <span class='admin_tools_con'>
    <a href='#' id='$menuname'  name='$name_of_babysubitem' onclick='addphoto_to_page(this.id,this.name)'>Upload photo to $name_of_babysubitem page</a>
    </span> ";
    }					
    }
    }
    }
    }
?>
