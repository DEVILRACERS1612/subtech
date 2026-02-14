<?php 
require '../config/config.inc.php';
require '../Model/class.character.php';
	
	$objchar->title = $db->filterVar($_POST['title']);
		
	$objchar->image = $_FILES['image'];
    $objchar->description = $_POST['description'];

    $objchar->edit_id = $_POST['edit_id'];
    
	if(empty($_POST['edit_id']))
	{
		if($objchar->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Certificate Already Exists</div>"}';
		}
		else
		{
			if($objchar->insert()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Certificate Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Certificate Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	else if(!empty($_POST['edit_id']))
	{
		if($objchar->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Certificate Already Exists</div>"}';
		}
		else
		{
			if($objchar->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Certificate Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Certificate Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
   
?>