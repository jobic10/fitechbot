<?php
    require_once 'redir_admin.php';
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    $menuname=$gUI->getInputVal('menuname');
    $result123 = $sqlB->tmp_create_tb("SELECT `linkname` FROM `$menuname`");
    while($validate = $result123->fetch_array())
    {
    $linkname=$validate['linkname'];
    if($linkname!=="")
    {
    $result2 = $sqlB->tmp_create_tb("SELECT * FROM `owe_photo` where menuname='$linkname'");
    while($validate = $result2->fetch_array())
    {
    $photo=$validate['photo'];
    $thumb_photo=str_replace("owe/FITECH_BOT/","owe/FITECH_BOT/thumb",$photo);
    $result =$sqlB->tmp_create_tb("DELETE  FROM `owe_photo` where menuname='$linkname'");
    unlink($photo);
    unlink($thumb_photo);
    }
    $result3 =$sqlB->tmp_create_tb("SELECT * FROM `baby_sub_item` where name_of_subitem='$linkname'");
    while($all7 = $result3->fetch_array())
    {
    $name_of_babysubitem=$all7['name_of_babysubitem'];
    $result20 =$sqlB->tmp_create_tb("SELECT * FROM `owe_photo` where menuname='$name_of_babysubitem'");
    while($validated = $result20->fetch_array())
    {
    $photo=$validated['photo'];
    $thumb_photo=str_replace("owe/FITECH_BOT/","owe/FITECH_BOT/thumb",$photo);
    $result =mysql_query("DELETE  FROM `owe_photo` where menuname='$name_of_babysubitem'");
    unlink($photo);
    unlink($thumb_photo);
    }
    $sqlB->tmp_create_tb("DELETE  FROM `baby_sub_item` where name_of_subitem='$linkname'");
    }
    }
    }
    $result =$sqlB->tmp_create_tb("DELETE  FROM `menubar` where name_of_menubar='$menuname'");
    $result =$sqlB->tmp_create_tb("drop table `$menuname`");
    echo "this menu and all associated documents have been successfuly deleted";
?>




