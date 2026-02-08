<?php 
require '../config/config.inc.php';
require '../Model/class.company.php';
	
	$objcmp->cmp_id = $db->filterVar($_POST['cmp_id']);
	$objcmp->cmp_pwd = $db->filterVar($_POST['cmp_pwd']);
	$objcmp->cmp_url="https://www.microelectra.in/crmpanel/crmsoft/".$objcmp->cmp_id;
	$objcmp->cmp_name = $db->filterVar($_POST['cmp_name']);
	$objcmp->mobile = $db->filterVar($_POST['mobile']);
	$objcmp->email = $db->filterVar($_POST['email']);
	$objcmp->shift = $db->filterVar($_POST['shift']);
	
	$objcmp->other_contact = $db->filterVar($_POST['other_contact']);
	$objcmp->other_email = $db->filterVar($_POST['other_email']);
	$objcmp->regno = $db->filterVar($_POST['regno']);
	$objcmp->gst_no = $db->filterVar($_POST['gst_no']);
	$objcmp->address = $db->filterVar($_POST['address']);
	$objcmp->amount = $db->filterVar($_POST['amount']);
	$objcmp->renew_amt = $db->filterVar($_POST['renew_amt']);
	$objcmp->image = $_FILES['image'];
	$objcmp->exp_date = date("Y-m-d",strtotime($db->filterVar($_POST['exp_date'])));
	$objcmp->edit_id = $_POST['edit_id'];
	
    $cpost_id=$db->filterVar($_POST['post_id']);
    
	if($post_id==$cpost_id)
	{
		if(empty($_POST['edit_id']))
		{
			if($objcmp->find_id() )
			{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">School Already Exists</div>"}';
			}
			else
			{
				if($objcmp->insert()){
					echo '{"type":"success","message":"<div class=\"alert alert-success\">School Save Successfully</div>"}';
				}
				else{
					echo '{"type":"fail","message":"<div class=\"alert alert-danger\">School Not Save Due to Some Internal Error</div>"}';
				}
			}
		}
		else if(!empty($_POST['edit_id']))
		{
			if($objcmp->find_id() )
			{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">School Already Exists</div>"}';
			}
			else
			{
				if($objcmp->update()){
					echo '{"type":"success","message":"<div class=\"alert alert-success\">School Update Successfully</div>"}';
				}
				else{
					echo '{"type":"fail","message":"<div class=\"alert alert-danger\">School Not Save Due to Some Internal Error</div>"}';
				}
			}
		}
    }else{
		echo '{"type":"fail","message":"<span class=\"alert alert-danger\">Invalid User</span>"}';
	}

?>