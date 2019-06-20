<?php
    require_once 'redir_admin.php';
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    $con=$sqlB->con;
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    echo "
    <script type='text/javascript'>
    function resize_window()
    {
    window.resizeTo(250,400);
    window.moveTo(300,150);
    window.focus();
    }
    setTimeout('resize_window()',100);
    </script>
    ";
    $menuname=$gUI->getInputVal('menuname');
    require_once "../msg.php";
    $msg=$gUI->ppbs($msg);
    $msg=  mysqli_real_escape_string($con,$msg);
    $result2=$sqlB->tmp_create_tb("SELECT * FROM `$menuname`");
    $x=0;
    $sql="";
    while ($all = $result2->fetch_array())
    {
    if($all['linkname']!=='')
    {
    $x=$
    $menuname=$all['menu'];
    $linkname=$all['linkname'];
    $mbaid=$menuname."_".$all['menubarID'];
    $mbaid=preg_replace('/\s+/','',$mbaid);
    $new_menuitem=$gUI->getInputVal($mbaid);
    //$sqlB->tmp_create_tb("UPDATE `$menuname` SET linkname = '$new_menuitem' WHERE menubarID='$id1'");
    /*
    $result5=mysql_query("SELECT * FROM `baby_sub_item` WHERE name_of_subitem='$linkname'");
    $all8 = mysql_fetch_array($result5);
    $test_id=$all8['subitemID'];
    $test_id2=$test_id+9;
    */
    $result3=$sqlB->tmp_create_tb("SELECT * FROM `baby_sub_item` where name_of_subitem='$linkname' limit 10");//subitemID BETWEEN $test_id AND $test_id2 ");
    while ($all2 = $result3->fetch_array())
    {   
    $x+=1;
    $name_of_babysubitem=$all2['name_of_babysubitem'];
    $id=$all2['subitemID'];
    $mnitemid=$x+$all2['subitemID'];
    $mnitemid="go_".$mnitemid."_h";
    $new_subitem=$gUI->getInputVal($mnitemid);
    
    $sql.="UPDATE `baby_sub_item` SET contents = '$new_subitem \n $msg', name_of_babysubitem = '$new_subitem',name_of_subitem='$linkname' WHERE subitemID='$id' ;\n";
    //$sqlB->tmp_create_tb("UPDATE `baby_sub_item` SET contents = '$new_subitem \n $msg', name_of_babysubitem = '$new_subitem',name_of_subitem='$linkname' WHERE subitemID='$id'");
    }
    }  //end of if $linkname
    }
    $sqlB->importDb($sql);
    echo "<font color='green' size='10'>Menu has been successfully Updated !</font>";
    $gUI->closeWin();

?>