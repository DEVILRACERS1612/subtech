<?php 
require '../config/config.inc.php';
require '../Model/class.reseller.php';
	
	$objreseller->user_id = $db->filterVar($_POST['user_id']);
	$objreseller->pwd = $db->filterVar($_POST['pwd']);
	$objreseller->user_name = $db->filterVar($_POST['user_name']);
	$objreseller->email = $db->filterVar($_POST['email']);
	$objreseller->mobile = $db->filterVar($_POST['mobile']);
	$objreseller->company = $db->filterVar($_POST['company']);
	$objreseller->address = $db->filterVar($_POST['address']);
	$objreseller->city = $db->filterVar($_POST['city']);
	$objreseller->amount = $db->filterVar($_POST['amount']);
	$objreseller->exp_date = date("Y-m-d",strtotime($db->filterVar($_POST['exp_date'])));
	$objreseller->renew_amt = $db->filterVar($_POST['renew_amt']);
	
	$objreseller->image = $_FILES['image'];
    $objreseller->description = $_POST['description'];

    $objreseller->edit_id = $_POST['edit_id'];
    
	if(empty($_POST['edit_id']))
	{
		if($objreseller->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">User Already Exists</div>"}';
		}
		else
		{
			if($objreseller->insert()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">User Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">User Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	else if(!empty($_POST['edit_id']))
	{
		if($objreseller->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">User Already Exists</div>"}';
		}
		else
		{
			if($objreseller->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">User Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">User Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
    

?>