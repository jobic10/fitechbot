<div id='post_wraper'>
<div class="jumbotron">
<?php        
require_once 'error_report.php';    
?>  
<form  role="form" method="post" action="improve_on_us.php">
    <p class="text-success"> PLEASE FILL AND SUBMIT THE FORM BELOW</p>
<div class="form-group">
    <label class="text-primary" for="usr">Your Name in Full:</label>
<input type="text"  class="form-control" id="usr" placeholder="Enter Your Name" name="guest_name"/>
</div>
<div class="form-group">
<label class="text-primary" for="usr">Your Email or Phone Number:</label>
<input  type="text" class="form-control" id="email" name="guest_title" placeholder="Enter Your Email Address or Phone Number Here"/>
</div>
<div class="form-group">
<label class="text-primary" for="comment">Your Suggestion/Complaint:</label>
<textarea name="guest_post" class="form-control" rows="5" id="comment"></textarea>
</div>
<div class="form-group">
<button type="submit" style='float:right;'  name="post_submit" class="btn btn-primary">Submit</button>
</div>
</form>
</div>
</div>