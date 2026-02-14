<?php 
session_start();
require '../config/config.inc.php';
require '../Model/class.color.php';
	
	$objcolor->cname = $_POST['cname'];
    $objcolor->description = $_POST['description'];

    $objcolor->edit_id = $_POST['edit_id'];
    
	if(empty($_POST['edit_id']))
	{
		if($objcolor->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Color  Already Exists</div>"}';
		}
		else
		{
			if($objcolor->insert()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Color Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Color Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	else if(!empty($_POST['edit_id']))
	{
		if($objcolor->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Color Already Exists</div>"}';
		}
		else
		{
			if($objcolor->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Color Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Color Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
    

?>