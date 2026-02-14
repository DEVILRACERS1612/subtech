<?php 
require '../config/config.inc.php';
require '../Model/class.party.php';
	
	$objparty->rdate=date("Y-m-d H:i:s");
	$objparty->party_name = $db->filterVar($_POST['party_name']);
	$objparty->party_type = $db->filterVar($_POST['party_type']);
	$objparty->gstin = $db->filterVar($_POST['gstin']);
	$objparty->email = $db->filterVar($_POST['email']);
	$objparty->mobile = $db->filterVar($_POST['mobile']);
	$objparty->address = $db->filterVar($_POST['address']);
	$objparty->other_detail = $db->filterVar($_POST['other_detail']);
	$objparty->image = $_FILES['image'];
    
    $objparty->edit_id = $_POST['edit_id'];
    $objparty->del_id = $db->filterVar($_POST['del_id']);
	$objparty->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objparty->find_id() )
			{
				echo '{"type":"fail","message":"Party  Already Exists"}';
			}
			else
			{
				if($objparty->insert()){
					echo '{"type":"success","message":"Party Save Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Party Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			if($objparty->find_id() )
			{
				echo '{"type":"fail","message":"Party Already Exists"}';
			}
			else
			{
				if($objparty->update()){
					echo '{"type":"success","message":"Party Update Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Party Not Update Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Delete')
		{
			if($objparty->deleteme()){
				echo '{"type":"success","message":"Class Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objparty->view().'"}';
			
		}
    }else{
		echo '{"type":"fail","message":"Invalid Party"}';
	}

?>