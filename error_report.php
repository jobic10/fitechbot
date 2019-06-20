<?php
if(isset($_COOKIE['error_report']))
{
$logout_portal=$_COOKIE['error_report'];
echo  "  
<div id='logout_portal' class='hold_sms_login_form'>
<div class='login_error'>
$logout_portal
</div>
</div>
 ";
unset($_COOKIE['error_report']);
} 

?>
<script>
setTimeout("close_div('logout_portal')",10000);
</script>