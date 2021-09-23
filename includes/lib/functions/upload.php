<?php
function upload($ctlname,$dest,$filter,&$err){
	$file = $_FILES[$ctlname]['name'];
	if($file!=''){
		if($filter!=''){
			$arrfilter = explode(",",$filter);
			$ext = substr($file,strpos($file,".")+1);
			if(!in_array($ext,$arrfilter)){
				$err='1';
				return '';
			}
		}
		
		$file = str_replace(" ", "_", $file);
		move_uploaded_file($_FILES[$ctlname]['tmp_name'], $dest.$file);
		return $file;
	}
}

function hasuploadfile($ctlname){
	$file = $_FILES[$ctlname]['name'];
	return $file!=''?true:false;
}
?>