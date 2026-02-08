<?php 
require '../config/config.inc.php';
require '../Model/class.department.php';
	
	$objdep->rdate = date("Y-m-d H:i:s");
	$objdep->dep_code = $db->filterVar($_POST['dep_code']);
	$objdep->dep_name = $db->filterVar($_POST['dep_name']);
	$objdep->description = $db->filterVar($_POST['description']);
	
    $objdep->edit_id = $db->filterVar($_POST['edit_id']);
	$objdep->del_id = $db->filterVar($_POST['del_id']);
	$objdep->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objdep->find_id() )
			{
				echo '{"type":"fail","message":"Department  Already Exists"}';
			}
			else
			{
				if($objdep->insert()){
					echo '{"type":"success","message":"Department Save Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Department Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			if($objdep->find_id() )
			{
				echo '{"type":"fail","message":"Department Already Exists"}';
			}
			else
			{
				if($objdep->update()){
					echo '{"type":"success","message":"Department Update Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Department Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Delete')
		{
			if($objdep->deleteme()){
				echo '{"type":"success","message":"Department Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objdep->view().'"}';
			
		}
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>