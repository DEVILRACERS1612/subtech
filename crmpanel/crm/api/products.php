<?php 
session_start();
date_default_timezone_set("Asia/Kolkata");
require '../config/config.inc.php';
require '../Model/class.product.php';
	
	$objprd->cat = $_POST['cat'];
	$objprd->dor = date("Y-m-d");
	$objprd->color = $_POST['color'];
	$objprd->pname = $_POST['pname'];
	$objprd->uom = $_POST['uom'];
	$objprd->price = $_POST['price'];
	$objprd->op_qty = $_POST['op_qty'];
	$objprd->image = $_FILES['image'];
    $objprd->description = $_POST['description'];

    $objprd->edit_id = $_POST['edit_id'];
    
	if(empty($_POST['edit_id']))
	{
		if($objprd->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Product  Already Exists</div>"}';
		}
		else
		{
			if($objprd->insert()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Product Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Product Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	else if(!empty($_POST['edit_id']))
	{
		if($objprd->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Product Already Exists</div>"}';
		}
		else
		{
			if($objprd->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Product Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Product Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
    

?>