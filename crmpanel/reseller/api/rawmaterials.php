<?php 
session_start();
require '../config/config.inc.php';
require '../Model/class.raw.php';
	
	$objraw->cat = $_POST['cat'];
	$objraw->color = $_POST['color'];
	$objraw->rname = $_POST['rname'];
	$objraw->uom = $_POST['uom'];
	$objraw->price = $_POST['price'];
	$objraw->op_qty = $_POST['op_qty'];
	$objraw->image = $_FILES['image'];
    $objraw->description = $_POST['description'];

    $objraw->edit_id = $_POST['edit_id'];
    
	if(empty($_POST['edit_id']))
	{
		if($objraw->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Raw Material  Already Exists</div>"}';
		}
		else
		{
			if($objraw->insert()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Raw Material Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Raw Material Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	else if(!empty($_POST['edit_id']))
	{
		if($objraw->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Raw Material Already Exists</div>"}';
		}
		else
		{
			if($objraw->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Raw Material Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Raw Material Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
    

?>