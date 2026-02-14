<?php 
require '../config/config.inc.php';
require '../Model/class.admform.php';
	
	$objtc->title = $db->filterVar($_POST['title']);
		
	$objtc->image = $_FILES['image'];
    $objtc->description = $_POST['description'];

    $objtc->edit_id = $_POST['edit_id'];
    
	if(empty($_POST['edit_id']))
	{
		if($objtc->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Fee Slip Already Exists</div>"}';
		}
		else
		{
			if($objtc->insert()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Fee Slip Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Fee Slip Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	else if(!empty($_POST['edit_id']))
	{
		if($objtc->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Fee Slip Already Exists</div>"}';
		}
		else
		{
			if($objtc->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Fee Slip Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Fee Slip Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
   
?>