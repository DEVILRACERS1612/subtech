<?php 
require '../config/config.inc.php';
require '../Model/class.region.php';
	
	$objregion->rdate = date("Y-m-d H:i:s");
	$objregion->region_name = $db->filterVar($_POST['region_name']);
	$objregion->head_name = $db->filterVar($_POST['head_name']);
	$objregion->address = $db->filterVar($_POST['address']);
	$objregion->phone = $db->filterVar($_POST['phone']);
	$objregion->fax = $db->filterVar($_POST['fax']);
	$objregion->email = $db->filterVar($_POST['email']);
	$objregion->description = $db->filterVar($_POST['description']);
	
    $objregion->edit_id = $db->filterVar($_POST['edit_id']);
	$objregion->del_id = $db->filterVar($_POST['del_id']);
	$objregion->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objregion->find_id() )
			{
				echo '{"type":"fail","message":"Region  Already Exists"}';
			}
			else
			{
				if($objregion->insert()){
					echo '{"type":"success","message":"Region Save Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Region Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			if($objregion->find_id() )
			{
				echo '{"type":"fail","message":"Region Already Exists"}';
			}
			else
			{
				if($objregion->update()){
					echo '{"type":"success","edit":"ok","message":"Region Update Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Region Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Delete')
		{
			if($objregion->deleteme()){
				echo '{"type":"success","message":"Region Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objregion->view().'"}';
			
		}
		
		
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>