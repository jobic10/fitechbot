<?php
ini_set("auto_detect_line_endings",true);
//$sub_in_array=explode("\n",file_get_contents("subject_list_test.php"));
sort($sub_in_array);
$sub_len=count($sub_in_array);
for($j=0;$j<$sub_len;$j++)
{
$index_sub=$sub_in_array[$j];
echo "<option value='$index_sub'>$index_sub</option>";
}
?>