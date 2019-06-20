   <?php
   require_once 'redir_admin.php';
   require_once '../Classes/SqlBasics.php';
   $sqlB =new SqlBasics("cms");
   ?>
   <html>
   <head>
   <title>
   Delete MENU
   </title>
   <?php 
   require_once "../jss_css_dir.php.php";
   ?> 
   </head>
   <body bgcolor="000066">
   <div class="container">
   <row>
   <div class="col-sm-12">
   <div class="hold_sms_login_form">
   <form action='#' role='form' method='post'>
   <?php
   $result = $sqlB->tmp_create_tb("SELECT * FROM `menubar` ORDER BY menubarID ASC");
   while($validate =$result-> fetch_array())
   {
   $menuname=$validate['name_of_menubar'];
   $end_report="menu_".$menuname;
   $menuname2=strtolower($menuname);
   //$menuitem=$validate['default_menubar_item'];

   if($menuname2!=="home" && $menuname2!=="contacts" && $menuname2!=="about us")
   {
   echo "
   <div class='form-group' id='$end_report'>
   <input  type='hidden' value='$menuname' size='10' name='$menuname' readonly/>
   <input  type='button'  class='btn btn-primary btn-sm btn-block' onclick='call_editmenu_overlay(this.name)'   value='Delete $menuname menu' name='ajax_delete_menu.php?menuname=$menuname'/>
   </div>
   ";
   }
   }
   ?>
   </form>
   </div>
   </div>
   </row>
   </div>
   </body>
   </html>