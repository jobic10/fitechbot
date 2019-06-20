<?php
@session_start();
class AjaxFileuploader {
	// PHP 4.x users replace "PRIVATE" from the following lines with "var". Also remove all the PUBLIC, PRIVATE and PROTECTED Kaywords from the class
	private $uploadDirectory='';
	private $uploaderIdArray=array();

	/**
	 * Constructor Function
	 * 
	 */
	public function AjaxFileuploader($uploadDirectory) 
        {
		if (trim($uploadDirectory) != '' && is_dir($uploadDirectory)) 
                {
			$this->uploadDirectory=trim($uploadDirectory);
		}
	}
	
	public function showFileUploader($uploaderId) 
                {
                $track_upload= ini_get("session.upload_progress.name");
		if (in_array($uploaderId, $this->uploaderIdArray)) 
                {
			die($uploaderId." already used. please choose another id.");
			return '';
                        exit;
		}
		else 
                {
		$this->uploaderIdArray[] = $uploaderId;
		return '<form id="formName'.$uploaderId.'" method="post" enctype="multipart/form-data" action="imageupload.php?dirname='.$this->uploadDirectory.'" target="iframe'.$uploaderId.'">			
                <input type="hidden" name="'. $track_upload.'" value="123" />
                <input  class="form-control" type="hidden" name="id" value="'.$uploaderId.'" />							
	        <span id="uploader'.$uploaderId.'" style="font-family:verdana;font-size:10;">
		<label  class="text-primary" for="usr">Upload File:</label> 
                <input name="'.$uploaderId.'" type="file"  class="form-control" value="'.$uploaderId.'" onchange=\'return uploadFile(this,"'.$this->uploadDirectory.'")\' /></span>
		<span id="loading'.$uploaderId.'"></span>						
	        <iframe name="iframe'.$uploaderId.'" src="imageupload.php" width="400" height="100" style="display:none"> </iframe>
		      </form>';
		}
	        }
}
?>