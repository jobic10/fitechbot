<html>
<head>
<title>
Choose the term, class and the session for the processor to load students
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
          Choose the term, class and the session for the processor to load students     
                </span></div>
            <div class="hold_sms_login_form">

                <form action="remarks_view.php" method="post">
     <label class="text-primary" for="sel1">Select Session:</label>
                    <select class="form-control" id="sel1" name="session_to_check" >
            <option size=34 value="rsp">2015/2016 SESSION</option>";
            <option size=34 value="rsp14">2014/2015 SESSION</option>";

</select>
     <select class="form-control" id="sel1" name="term_to_check" >
<option size=34 value="FIRST TERM">1st TERM</option>";

<option size=34 value="SECOND TERM">2nd TERM</option>";

<option size=34 value="THIRD TERM">3rd TERM</option>";




</select>
<?php 
require_once '../class_list_sec.php';

?>
         <input type="submit" class="btn btn-primary" value="load students" >
    
</form>
             </div>
        </div>
    </row>
</div>
</body>
</html>