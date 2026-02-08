<?php 
require '../config/config.inc.php';
require '../Model/class.bonafide.php';
	
	$objbona->title = $db->filterVar($_POST['title']);
		
	$objbona->image = $_FILES['image'];
    $objbona->description = $_POST['description'];

    $objbona->edit_id = $_POST['edit_id'];
    
	if(empty($_POST['edit_id']))
	{
		if($objbona->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Certificate Already Exists</div>"}';
		}
		else
		{
			if($objbona->insert()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Certificate Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Certificate Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	else if(!empty($_POST['edit_id']))
	{
		if($objbona->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Certificate Already Exists</div>"}';
		}
		else
		{
			if($objbona->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Certificate Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Certificate Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
   
?>