<html>
<head>
<title>
SEARCH FOR STUDENTS
</title>
</head>
<body bgcolor="000066">


<table align=center>
<tr>
<td>


<form action='searchprocessor.php' method='post'>
<table>
<th><font color="white">ENTER THE NAME OF THE STUDENT BELOW AND CLICK ON  SEARCH</font></th>
<tr>
<td>
<b><font color=yellow>Name of Student:</font></b><br />
<input type='text' size='20' name='stdname'/>
</td></tr>

<tr><td>
<input type='submit'  onclick='win()' value='search' name='submit'/>
</td></tr>
<tr><td>



<?php

if (isset($_COOKIE["notallowed"]))
{
  echo  "<font size=3 color=red>".$_COOKIE["notallowed"]."</font>";

setcookie("regnotvalid", "", time()-300);

echo "<br/>";
}





if (isset($_COOKIE["namenotfound"]))
{
  echo  "<font size=3 color=red>".$_COOKIE["namenotfound"]."</font>";

setcookie("regnotvalid", "", time()-300);

echo "<br/>";
}







?>







</td>
</tr>

</table>
</form>
</td>
</tr>
</table>

</body>
</html>