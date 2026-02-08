<?php 
require '../config/config.inc.php';
require '../Model/class.profile.php';
	
	$objprofile->rdate = date("Y-m-d H:i:s");
	$objprofile->regno = $db->filterVar($_POST['regno']);
	$objprofile->affiliation = $db->filterVar($_POST['affiliation']);
	$objprofile->address = $db->filterVar($_POST['address']);
	$objprofile->mobile = $db->filterVar($_POST['mobile']);
	$objprofile->emails = $db->filterVar($_POST['emails']);
	$objprofile->web_url = $db->filterVar($_POST['web_url']);
	$objprofile->image= $_FILES['image'];
	$objprofile->cmp_name = $db->filterVar($_POST['cmp_name']);
	$objprofile->description = $db->filterVar($_POST['description']);
	
    $objprofile->edit_id = $db->filterVar($_POST['edit_id']);
	$objprofile->del_id = $db->filterVar($_POST['del_id']);
	$objprofile->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objprofile->find_id() )
			{
				echo '{"type":"fail","message":"Company Profile  Already Exists"}';
			}
			else
			{
				if($objprofile->insert()){
					echo '{"type":"success","message":"Company Profile Save Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Company Profile Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			if($objprofile->find_id() )
			{
				echo '{"type":"fail","message":"Company Profile Already Exists"}';
			}
			else
			{
				if($objprofile->update()){
					echo '{"type":"success","message":"Company Profile Update Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Company Profile Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Delete')
		{
			if($objprofile->deleteme()){
				echo '{"type":"success","message":"Company Profile Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objprofile->view().'"}';
			
		}
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>