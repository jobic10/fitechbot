<table class="table table-bordered" >
<tr valign=top>
<td  align=center>
<font color="white"><b>SUBJECTS</b></font>
</td>
<td  align=center>
<font color="white"><b>1st CA</b></font>
</td>
<td  align=center>
<font color="white"><b>2nd CA</b></font>
</td>
<td  align=center>
<font color="white"><b>EXAM</b></font>
</td>
</tr>
<tr valign=top>
<td  >
<font color="black"><b>ENGLISH LANGUAGE</b></font>
</td>
<td >
<select class="form-control" id="sel1" name="ft1" size="1">
<option value="">Select score below</option>
<?php 
require "scores_loop.php";
?>
</select>
</td>
<td >
<select class="form-control" id="sel1" name="st1" size="1">
<option value="">Select score below</option>
<?php 
require "scores_loop.php";
?>
</select>
</td>
<td >
<select class="form-control" id="sel1" name="e1" size="1">
<option value="">Select score below</option>
<?php 
require "scores_loop.php";
?>
</select>
</td>
</tr>
<tr valign=top>
<td >
<font color="black"><b>MATHEMATICS</b></font>
</td>
<td >
<select class="form-control" id="sel1" name="ft2" size="1">
<option value="">Select score below</option>
<?php 
require "scores_loop.php";
?>
</select>
</td>
<td >
<select class="form-control" id="sel1" name="st2" size="1">
<option value="">Select score below</option>
<?php 
require "scores_loop.php";
?>
</select>
</td>
<td >
<select class="form-control" id="sel1" name="e2" size="1">
<option value="">Select score below</option>
<?php 
require "scores_loop.php";
?>
</select>
</td>
</tr>
<?php
$sub_in_array=file("subject_list.php",FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
for($e=3;$e<=30;$e++)
{
$sub_index="sub".$e;
$ft_index="ft".$e;
$st_index="st".$e;
$e_index="e".$e;
echo "
<tr valign=top>
<td>
<select class='form-control' id='sel1' name='$sub_index' size='1'>
<option value=''>Select Subject Below</option>";
require "real_subject_list.php";

echo "</select>
</td>
<td >
<select class='form-control' name='$ft_index' size='1'>
<option value=''>Select score below</option>";

require "scores_loop.php";

echo "</select>
</td>
<td>
<select class='form-control' id='sel1' name='$st_index' size='1'>
<option value=''>Select score below</option>";

require "scores_loop.php";

echo "</select>
</td>
<td>
<select class='form-control' id='sel1' name='$e_index' size='1'>
<option value=''>Select score below</option>";

require "scores_loop.php";

echo "</select>
</td>
</tr>";
}


?>
</tr>
</table>

