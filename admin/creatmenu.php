<?php
    require_once 'redir_admin.php';
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    ?>
    <html>
    <head>
    <title>
    CREAT MENU
    </title>
    <?php 
    require_once "../jss_css_dir.php.php";
    ?>    
    </head>
    <body bgcolor="000066">
    <div class="container">
    <?php
    if(isset($_COOKIE['namenotfound']))
    {
    $logout_portal=$_COOKIE['namenotfound'];
    echo  "  
    <row> <div id='logout_portal' class='hold_sms_login_form'><div class='login_error'>
    $logout_portal
    </div></div></row> ";
    } 
    ?>
    <row>
    <div class="col-sm-12">
    <div  class="table table-responsive">
    <form  role="form" action='creatmenuprocessor.php' method='post'>
    <table class="table table-bordered">
    <tr>
    <td>
    <b><font color=green>Menu:</font></b>
    <input type='text' class='form-control' size='20' name='menuname'/>
    </td>
    </tr>
    <?php
    for($e=1;$e<=10;$e++)
    {
    echo "<tr>";
    $subitem="subitem ".$e;
    $subitem_index="subitem".$e;
    echo "<td>
    <b><font color=green>$subitem:</font></b>
    <input type='text' class='form-control' size='15' name='$subitem_index'/>
    </td>";
    for($g=1;$g<=10;$g++)
    {
    //$babysubitem="subitem ".$e;
    $babysubitem_index="baby".$g."subitem".$e;
    echo "<td>
    <b><font color=green></font></b>
    <input type='text' class='form-control' size='5' name='$babysubitem_index'/>
    </td>
    ";
    }
    echo "</tr>";
    }
    ?>
    <tr>
    <td>
    <input type='submit' class="btn btn-primary" value='creat Menu' name='submit'/>
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