    require_once '../Classes/SqlBasics.php';
    $sqlB =new SqlBasics("cms");
    require_once "../fbt_codes.php";
   <!DOCTYPE html>
<html>
<head>
<?php
echo "<title>STUDENT LOGIN@$banner</title>";
    require_once "../jss_css_dir.php.php";
    ?>

</head>


<body>



<table class="bodycontrol">

<tr valign="center" align="center">
<td>



<div class="banner">

<?php echo" <h1 class='sname'>$banner-STUDENT LOGIN</h1>";?>



</div>


<div class='welcomemsg'>


<font size=6 color=yellow>Please enter in the form below your username and password and then click on login</font>
</div>
<hr/>

<br/>

<div style="float:left; width:100%; margin-top:30px;">
<form action='loginportal_student.php' method='post'>
<table bgcolor="#00aaff" style="border:2px groove #0a0a0a;" width="300px">
<tr>













<?php
if(isset($_COOKIE['blank']))
{

echo "<td bgcolor='white' style='border:2px groove #0a0a0a;' bordercollapse='collapse'>";
echo "<font color='red'>".$_COOKIE['blank']."</font>";
echo "</td>";
}





if(isset($_COOKIE['incorrect']))
{

echo "<td bgcolor='white' style='border:2px groove #0a0a0a;' bordercollapse='collapse'>";
echo "<font color='red'>". $_COOKIE['incorrect']."</font>";
"</td>";
}





?>
















</tr>



<tr>
<td bgcolor="#000066" style="border:2px groove #0a0a0a;">
<font color="white"><b>Student Username:</b><br /></font>
<input class="resultt" type='text' size='60' name='username'/>
</td></tr>
<tr><td bgcolor="000066" style="border:2px groove #0a0a0a;">
<font color="white"><b>Password:</b><br /></font>
<input class="resultt" type='password' size='60' name='pass'/>
</td></tr>
<tr><td>
<input class="resultb" type='submit' value='login' name='submit'/>
</td></tr>
</table>
</form>
</div>


</td>
</tr>

</table>
<?php echo "<div class='footing' align='center'><h1>$footer</h1></div>";?>

</body>

</html>