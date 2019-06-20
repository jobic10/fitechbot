<?php
function Delete($path)
{
    if (is_dir($path) === true)
    {
        $files = array_diff(scandir($path), array('.', '..'));

        foreach ($files as $file)
        {
            Delete(realpath($path) . '/' . $file);
        }

        return rmdir($path);
    }

    else if (is_file($path) === true)
    {
        return unlink($path);
    }

    return false;
}

$regno=$_REQUEST['regno'];




require_once "../../secreet/confidential/db_connection.php";

$return_con= db_connection("sms");
$con=$return_con[0];




$result = mysql_query("SELECT * FROM `staff` WHERE `staff_reg_id`='$regno'");
$check_username=mysql_fetch_array($result);


$staff_username=$check_username['UserName'];


$dbsurname=$check_username['FullName'];



$photo_directory="../uploads_staff/$staff_username/";


//Delete($photo_directory);


$result =mysql_query("DELETE  FROM `staff` WHERE `staff_reg_id`='$regno' ");


$result =mysql_query("DELETE  FROM `course_reg` WHERE `regno`='$regno' ");




mysql_close($con);


$return_con= db_connection("chat");
$con=$return_con[0];

$result34 = mysql_query("SELECT postID FROM `all_post` WHERE `post_owner`='$staff_username'");

while($post_identitiy=mysql_fetch_array($result34))
{

$tblid=$post_identitiy['postID'];

$result =mysql_query("DROP TABLE IF EXISTS   `post_$tblid` ") or die(mysql_error());



}

$result =mysql_query("DROP TABLE IF EXISTS   `new_msg_$staff_username` ") or die(mysql_error());

$result =mysql_query("DROP TABLE IF EXISTS   `read_msg_$staff_username` ") or die(mysql_error());


$result =mysql_query("DROP TABLE IF EXISTS   `gallery_$staff_username` ") or die(mysql_error());


$result =mysql_query("DROP TABLE IF EXISTS   `newnotice_$staff_username` ") or die(mysql_error());


$result =mysql_query("DROP TABLE IF EXISTS   `post_$staff_username` ") or die(mysql_error());


$result =mysql_query("DROP TABLE IF EXISTS   `readnotice_$staff_username` ") or die(mysql_error());







$result =mysql_query("DELETE  FROM `check_refresh_time` WHERE `username`='$staff_username' ");



$result =mysql_query("DELETE  FROM `all_artiste` WHERE `username`='$staff_username' ");

$result =mysql_query("DELETE  FROM `all_post` WHERE `post_owner`='$staff_username' ");


mysql_close($con);



echo "<font size='2'color='green'> $dbsurname has been successfully Deleted from the School portal</font>";


?>