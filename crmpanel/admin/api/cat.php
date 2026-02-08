<?php 
session_start();
require '../config/config.inc.php';
require '../Model/class.cat.php';
	
	$objcat->cat = $_POST['cat'];
	$objcat->urlname = $_POST['urlname'];
	$objcat->pagetitle = $_POST['pagetitle'];
	$objcat->pagecontent = $_POST['pagecontent'];
    $objcat->description = $_POST['description'];
	$objcat->ptitle = $_POST['ptitle'];
    $objcat->edit_id = $_POST['edit_id'];
    
	if(empty($_POST['edit_id']))
	{
		if($objcat->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Category  Already Exists</div>"}';
		}
		else
		{
			if($objcat->insert()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Category Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Category Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	else if(!empty($_POST['edit_id']))
	{
		if($objcat->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Category Already Exists</div>"}';
		}
		else
		{
			if($objcat->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Category Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Category Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
    

?>