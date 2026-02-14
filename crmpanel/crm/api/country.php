<?php 
require '../config/config.inc.php';
require '../Model/class.country.php';
	
	$objcountry->rdate = date("Y-m-d H:i:s");
	$objcountry->country = $_POST['country'];
	$objcountry->state = $_POST['state'];
	$objcountry->location = $_POST['location'];
	
    $objcountry->edit_id = $db->filterVar($_POST['edit_id']);
	$objcountry->del_id = $db->filterVar($_POST['del_id']);
	$objcountry->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			$ok=$objcountry->insert();
			if($ok==1){
				echo '{"type":"success","edit":"ok","message":"Country Save Successfully"}';
			}else if($ok==2){
				echo '{"type":"fail","message":"Error: Duplicate Entry"}';
			}else{
				echo '{"type":"fail","message":"Country Not Save Due to Some Internal Error"}';
			}
		}
		else if($method=='Edit')
		{
			$ok=$objcountry->update();
			if($ok==1){
				echo '{"type":"success","edit":"ok","message":"Country Update Successfully"}';
			}else if($ok==2){
				echo '{"type":"fail","message":"Error: Duplicate Entry"}';
			}else{
				echo '{"type":"fail","message":"Country Not Save Due to Some Internal Error"}';
			}
		}
		else if($method=='Delete')
		{
			if($objcountry->deleteme()){
				echo '{"type":"success","message":"Country Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='DeleteState')
		{
			if($objcountry->delete_state()){
				echo '{"type":"success","message":"Delete State Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='State')
		{
			if($objcountry->state_update()){
				echo '{"type":"success","message":"State Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objcountry->view().'"}';
			
		}
		else if($method=='ViewState')
		{
			echo '{"type":"success","message":"'.$objcountry->view_state().'"}';
			
		}
		else if($method=='Location')
		{
			if($objcountry->location_update()){
				echo '{"type":"success","message":"Location Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='ViewLocation')
		{
			echo '{"type":"success","message":"'.$objcountry->view_location().'"}';
			
		}
		else if($method=='DeleteLocation')
		{
			if($objcountry->delete_location()){
				echo '{"type":"success","message":"Delete Location Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='SearchState')
		{
			echo $objcountry->state_list($objcountry->country,'');
			
		}
		else if($method=='SearchLocation')
		{
			echo $objcountry->location_list($objcountry->state,'');
			
		}
		
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>