<?php 
session_start();
require '../config/config.inc.php';
require '../Model/class.ocat.php';
	
	$objocat->cat = $_POST['cat'];
	$objocat->urlname = $_POST['urlname'];
    $objocat->description = $_POST['description'];
	$objocat->ptitle = $_POST['ptitle'];
    
    $objocat->edit_id = $_POST['edit_id'];
    
	if(empty($_POST['edit_id']))
	{
		if($objocat->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Category  Already Exists</div>"}';
		}
		else
		{
			if($objocat->insert()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Category Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Category Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	else if(!empty($_POST['edit_id']))
	{
		if($objocat->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Category Already Exists</div>"}';
		}
		else
		{
			if($objocat->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Category Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Category Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
    

?>