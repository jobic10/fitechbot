<?php
    require_once 'redir_admin.php';
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    $menuname=$gUI->getInputVal('menuname');
    ?>
    <html>
    <head>
    <title>
    CREAT MENU
    </title>
    <style type="text/css">
    input[readonly]
    {
    background:#CCC;color:#333;border:1px solid #666
    }
    </style>
    <?php 
    require_once "../jss_css_dir.php.php";
    ?>    
    </head>
    <body bgcolor="000066">
    <div class="container">
    <row>
    <div class="col-sm-12">
    <div  class="table table-responsive">
    <form role='form' action='editmenuprocessor.php' method='post'>
    <table>
    <tr>
    <td>
    <?php echo "
    <input type='text' size='15' class='form-control' value='$menuname' name='menuname'  readonly/>
    </td></tr>";
    
    $result2=$sqlB->tmp_create_tb("SELECT * FROM `$menuname`");
    $x=0;
    while ($all =$result2->fetch_array())
    {
    if($all['linkname']!=='')
    {
    $menuname=$all['menu'];
    $linkname=$all['linkname'];
    ///$mbaid=$all['menubarID'];
    $mbaid=$menuname."_".$all['menubarID'];
    $mbaid=preg_replace('/\s+/','',$mbaid);
    echo "
    <tr>
    <td>
    <input type='text' class='form-control' size='15'value='$linkname' name='$mbaid'  readonly/>
    </td>";
    $result5=$sqlB->tmp_create_tb("SELECT * FROM `baby_sub_item` WHERE name_of_subitem='$linkname'");
    $all8 = $result5->fetch_array();
    $test_id=$all8['subitemID'];
    $test_id2=$test_id+9;
    $result3=$sqlB->tmp_create_tb("SELECT * FROM `baby_sub_item` where name_of_subitem='$linkname' limit 10");//subitemID BETWEEN $test_id AND $test_id2 ");
    while ($all2 = $result3->fetch_array())
    {  
    $x+=1;
    $name_of_babysubitem=$all2['name_of_babysubitem'];
    //$id=$all2['subitemID'];
    $mnitemid=$x+$all2['subitemID'];
    $mnitemid="go_".$mnitemid."_h";
    echo "
    <td>
    <input type='text' size='5' placeholder='sub-menuitem' class='form-control' value='$name_of_babysubitem' name='$mnitemid'/>
    </td>";
    }
    echo "
    </tr>";
    }
    }
    ?>
    <tr>
    <td>
    <input type='submit' class="btn btn-primary"  value='submit Menu' name='submit'/>
    </td>
    </tr>
    </table>
    </form>
    </div>
    </div>
    </row>
    </div>               
    </body>
    </html>