<html>
<head>
<title>
Choose the students to PROMOTE,REPEAT, WITHDRAWN OR RESIT
</title>
<script type="text/javascript" src="../javascript/changeeventspix.js"></script>


<?php
  require_once '../header_sub_sms.php';  
?>
</head>




<body>
    
<div class="container">
    <row>
        <div class="col-sm-12">

            <div class="login_form_sms_header"><span>
                Choose a class below
                    
                </span></div>
            <div class="hold_sms_login_form">

<form action="choose_class_p_or_r_view.php" method="post">
     <label class="text-primary" for="sel1">Select Session:</label>
                    <select class="form-control" id="sel1" name="session_to_check" >
            <option size=34 value="rsp">2015/2016 SESSION</option>";
            <option size=34 value="rsp14">2014/2015 SESSION</option>";

</select>
<?php 
require_once '../class_list_sec.php';

?>
         <input type="submit" class="btn btn-primary" value="view students" >
    
</form>
             </div>
        </div>
    </row>
</div>
</body>
</html>