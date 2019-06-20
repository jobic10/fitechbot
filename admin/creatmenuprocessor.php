<?php
    require_once 'redir_admin.php';
    require_once '../Classes/SitemapGenerator.php';
    require_once '../Classes/DirAndFiles.php';
    $DAF =new DirAndFiles();
    require_once "../Classes/functions/get_site_domain_url.php";
    $site_domain=get_site_domain_url(NULL); 
    $sitemap = new SitemapGenerator($site_domain,$DAF->baseDir);
    require_once '../Classes/HtmlGen.php';
    $htmlgen =new HtmlGen();
    require_once '../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    $con=$sqlB->con;
    //$postVars=$gUI->getInputArrs();   
    $menuname=$gUI->getInputVal('menuname');//$_REQUEST['menuname'];
    $menuname=strtolower($menuname);
    $menuname=  mysqli_real_escape_string($con,$menuname);
    if($menuname=="" | empty($menuname))
    {
    echo "<font color='red' size='5'>Sorry! You have not entered any menuname</font>";//setcookie("notallowed","",time()+5);
    $gUI->closeWin();
    }
    require_once "../time_and_date.php";
    require_once "../msg.php";
    $msg=$gUI->ppbs($msg);
    $msg=  mysqli_real_escape_string($con,$msg);
    $result =$sqlB->tmp_create_tb("SELECT * FROM `menubar` where name_of_menubar='$menuname' ");
    if($result->num_rows>0)
    {
    echo "<font color='red' size='10'>Sorry Menu is already existing,try with a different name !</font>";
    exit;
    }
    $sqlB->tmp_create_tb("INSERT INTO `menubar`(name_of_menubar,default_menubar_item,time,time2,date) VALUES ('$menuname','sub-item 1','$time','$time2','$date')");
    $sqlB->tmp_create_tb("CREATE TABLE IF NOT EXISTS `$menuname` (menubarID int NOT NULL AUTO_INCREMENT,PRIMARY KEY(menubarID),contents text(20000),`menu` varchar(100),`linkname` varchar(100))");
    //exit;
    $holdmitems=array();
    $menusql="";
    for($e=1;$e<=10;$e++)
    {
    $subitem="subitem ".$e;
    $subitem_index="subitem".$e;
    $menuitem=$gUI->getInputVal($subitem_index);
    $menuitem=  mysqli_real_escape_string($con,$menuitem);
    
    if($menuitem!=='')
    {
    $holdmitems[]=$menuitem;
    $smsg="$menuitem \n $msg";
    }
    else
    {
    $smsg=" ";
    }
    if($e==10 && count($holdmitems)<1)
    {
    $menuitem="$menuname";
    $smsg="$menuitem \n $msg";
    }
   // $insert =$sqlB->tmp_create_tb("INSERT INTO `$menuname`(contents,menu,linkname) VALUES ('$smsg','$menuname','$menuitem')");
    $menusql.="INSERT INTO `$menuname`(contents,menu,linkname) VALUES ('$smsg','$menuname','$menuitem');\n";
    for($g=1;$g<=10;$g++)
    {
    //$babysubitem="subitem ".$e;
    $babysubitem_index="baby".$g."subitem".$e;
    $babysubitem=$gUI->getInputVal($babysubitem_index);
    $babysubitem=  mysqli_real_escape_string($con,$babysubitem);
    if($menuitem!=='')
    {
    $smsg="$babysubitem \n $msg";
    }
    else
    {
    $smsg=" ";
    }
    //$insert = $sqlB->tmp_create_tb("INSERT INTO `baby_sub_item`(contents,name_of_subitem,name_of_babysubitem) VALUES ('$smsg','$menuitem','$babysubitem')");
    $menusql.="INSERT INTO `baby_sub_item`(contents,name_of_subitem,name_of_babysubitem) VALUES ('$smsg','$menuitem','$babysubitem');\n";
    
    }
   
    }
    $sqlB->importDb($menusql);
    
    $result = $sqlB->tmp_create_tb("SELECT * FROM `menubar` ORDER BY `menubarID` DESC;");
    while($validate = $result->fetch_array())
    {
    $menuname=$validate['name_of_menubar'];
    $menuitem=$validate['default_menubar_item'];
    $menuname=strtolower($menuname);
    $result2=$sqlB->tmp_create_tb("SELECT * FROM `$menuname`");
    while ($all = $result2->fetch_array())
    {
    $menu=$all['menu'];
    $linkname=$all['linkname'];
    $link=$site_domain."virtual_index.php?menuitem=$linkname&menuname=$menu";
    if($linkname!=="")
    {
    $sitemap->addUrl("$link",date('c'),'daily','1');
    $result3=$sqlB->tmp_create_tb("SELECT * FROM `baby_sub_item` where name_of_subitem='$linkname' LIMIT 0,10");
    while ($all2 = $result3->fetch_array())
    {  
    $name_of_babysubitem=$all2['name_of_babysubitem'];
    if($name_of_babysubitem!=="")
    {
    $link=$site_domain."virtual_index.php?menuitem=$name_of_babysubitem&menuname=$menu";
    $sitemap->addUrl("$link",                date('c'),  'daily',    '1');
    }					
    }
    }
    }
    }
    $sitemap->createSitemap();
    $sitemap->writeSitemap();
    $sitemap->updateRobots();
    $sitemap->submitSitemap();
    echo "<font color='green' size='10'>Menu has been successfully created !</font>";
    $gUI->closeWin();
?>
