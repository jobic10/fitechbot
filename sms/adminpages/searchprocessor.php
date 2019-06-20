<?php 
    require_once "redir_admin_sms.php";
    require_once '../../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("sms");
    $con=$sqlB->con;
    require_once '../../Classes/GetUserInputs.php';
    $gUI =new GetUserInputs();
    $name=$gUI->getInputVal('stdname');
    $search_param=$name;
    $tb_name=$gUI->getInputVal('tb_name');
    $qry_lmt=9000;
    if(!$name || $name=="")
    {
    $f_cookie_msg="<font color='red'>Sorry! You have not entered any name.</font>";
    $gUI->redirPage($f_cookie_msg,"search.php#logout_portal"); 
    exit();  
    }
    require_once '../../Classes/ChatLoggedInInterface.php';
    $get_CLI =new ChatLoggedInInterface($role);
    $tb_cols=array("UserName","FullName","Email","PhoneNumber");
    $query_str=$get_CLI->searchDb($search_param,$tb_cols,$tb_name,$qry_lmt);
    //var_dump($query_str);exit;
    $search_qry=$sqlB->tmp_create_tb($query_str); 
    if($search_qry->num_rows <1)
    {
    $f_cookie_msg="<font color='red'>Sorry! There is no student with that Name, Please try again.</font>";
    $gUI->redirPage($f_cookie_msg,"search.php#logout_portal"); 
    exit(); 
    }
    else 
    {
     while($validate =$search_qry->fetch_array())
     {
     $regno=$validate['RegNo'];
     $link="<a href='avauf.php?id=$regno'>click here to view full profile</a>";
     $passport=$validate['Passport'];
     echo "<table border='1' align=center bgcolor='#00aaff'>
     <tr>
     <td colspan='2' width=300>Username: " .$validate['UserName']."<br/>Password: ".$validate['PassWord']  ."</td>
     </tr>
     <tr>
     <td width=200>FullName: " .$validate['FullName']."<br/>REG NO: ".$regno.  "<br/>Class: ".$validate['Class'] .$validate['classdivision'] ."<br/>".$link. "</td>
     <td width=100><img width=100 height=80 src='../$passport'/>
     </td>
     </tr>
     </table>
     <br/>";
     }
     }
    /*
    SELECT * FROM Persons
    WHERE City LIKE '%nes%'
    */

?>