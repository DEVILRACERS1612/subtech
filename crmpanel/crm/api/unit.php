<?php 
require '../config/config.inc.php';
require '../Model/class.unit.php';
	
	$objunit->rdate = date("Y-m-d H:i:s");
	$objunit->cl_code = $db->filterVar($_POST['cl_code']);
	$objunit->unit_name = $db->filterVar($_POST['unit_name']);
	$objunit->description = $db->filterVar($_POST['description']);
	
    $objunit->edit_id = $db->filterVar($_POST['edit_id']);
	$objunit->del_id = $db->filterVar($_POST['del_id']);
	$objunit->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objunit->find_id() )
			{
				echo '{"type":"fail","message":"Unit  Already Exists"}';
			}
			else
			{
				if($objunit->insert()){
					echo '{"type":"success","message":"Unit Save Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Unit Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			if($objunit->find_id() )
			{
				echo '{"type":"fail","message":"Unit Already Exists"}';
			}
			else
			{
				if($objunit->update()){
					echo '{"type":"success","message":"Unit Update Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Unit Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Delete')
		{
			if($objunit->deleteme()){
				echo '{"type":"success","message":"Unit Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objunit->view().'"}';
			
		}
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>