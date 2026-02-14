<?php 
require '../config/config.inc.php';
require '../Model/class.feeslip.php';
	
	$objfeeslip->title = $db->filterVar($_POST['title']);
		
	$objfeeslip->image = $_FILES['image'];
    $objfeeslip->description = $_POST['description'];

    $objfeeslip->edit_id = $_POST['edit_id'];
    
	if(empty($_POST['edit_id']))
	{
		if($objfeeslip->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Fee Slip Already Exists</div>"}';
		}
		else
		{
			if($objfeeslip->insert()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Fee Slip Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Fee Slip Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	else if(!empty($_POST['edit_id']))
	{
		if($objfeeslip->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Fee Slip Already Exists</div>"}';
		}
		else
		{
			if($objfeeslip->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Fee Slip Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Fee Slip Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
   
?>