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


$regnosession=strtolower($regno);



require_once "../../secreet/confidential/db_connection.php";

$return_con= db_connection("sms");
$con=$return_con[0];



$result = mysql_query("SELECT * FROM `students` WHERE RegNo='$regno'");
$check_username=mysql_fetch_array($result);


$student_username=$check_username['UserName'];

$dbclass=$check_username['Class'];


$cd=$check_username['classdivision'];

$dbsurname=$check_username['FullName'];

$rc=$dbclass.$cd;
$rc=strtolower($rc);



$photo_directory="../uploads/$student_username/";


//Delete($photo_directory);


$result =mysql_query("DELETE  FROM `students` WHERE RegNo='$regno' ");




mysql_close($con);


$return_con= db_connection("chat");
$con=$return_con[0];

$result34 = mysql_query("SELECT postID FROM `all_post` WHERE `post_owner`='$student_username'");

while($post_identitiy=mysql_fetch_array($result34))
{

$tblid=$post_identitiy['postID'];

$result =mysql_query("DROP TABLE IF EXISTS   `post_$tblid` ") or die(mysql_error());



}

$result =mysql_query("DROP TABLE IF EXISTS   `new_msg_$student_username` ") or die(mysql_error());

$result =mysql_query("DROP TABLE IF EXISTS   `read_msg_$student_username` ") or die(mysql_error());


$result =mysql_query("DROP TABLE IF EXISTS   `gallery_$student_username` ") or die(mysql_error());


$result =mysql_query("DROP TABLE IF EXISTS   `newnotice_$student_username` ") or die(mysql_error());


$result =mysql_query("DROP TABLE IF EXISTS   `post_$student_username` ") or die(mysql_error());


$result =mysql_query("DROP TABLE IF EXISTS   `readnotice_$student_username` ") or die(mysql_error());







$result =mysql_query("DELETE  FROM `check_refresh_time` WHERE `username`='$student_username' ");



$result =mysql_query("DELETE  FROM `all_fans` WHERE `username`='$student_username' ");

$result =mysql_query("DELETE  FROM `all_post` WHERE `post_owner`='$student_username' ");


mysql_close($con);


$return_con= db_connection("rsp");
$con=$return_con[0];



$result=mysql_query("SELECT PRESENTTERM,PRESENTYEAR FROM `schinfo` ") or die("");

$validate= mysql_fetch_array($result);

$year=$validate['PRESENTYEAR'];

$term=$validate['PRESENTTERM'];
$termuse=$term;

$term=strtolower($term);



$both="_".$year."_".$term;


$both1="_".$year."_first term";

$both2="_".$year."_second term";


$result =mysql_query("DELETE  FROM `studentinfo` WHERE `regno`='$regno' ");




$result =mysql_query("DELETE  FROM `hlam$both` WHERE `regno`='$regno' ");



$result =mysql_query("DELETE  FROM `all_$rc$both` WHERE `regno`='$regno' ");


$result =mysql_query("DROP TABLE IF EXISTS   `a_$regnosession$both` ") or die(mysql_error());


//echo "<font size='2'color='green'> $dbsurname has been successfully Deleted from the School portal</font>";


?>