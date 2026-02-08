<?php 
require '../config/config.inc.php';
require '../Model/class.permission.php';
	
	$objpermission->rdate = date("Y-m-d H:i:s");
	$objpermission->emp_id = $db->filterVar($_POST['emp_id']);
	$objpermission->module = $_POST['module'];
	$objpermission->rr_page_code = $_POST['page'];
	$objpermission->rr_create = $_POST['rr_create'];
	$objpermission->rr_edit = $_POST['rr_edit'];
	$objpermission->rr_delete = $_POST['rr_delete'];
	$objpermission->rr_view = $_POST['rr_view'];
	
    $objpermission->edit_id = $db->filterVar($_POST['edit_id']);
	$objpermission->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
    
	if($post_id==$cpost_id)
	{
		if(empty($objpermission->edit_id))
		{
			if($objpermission->find_id() )
			{
				echo '{"type":"fail","message":"Permission  Already Exists"}';
			}
			else
			{
				if($objpermission->insert()){
					echo '{"type":"success","message":"Permission Save Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Permission Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if(!empty($_POST['edit_id']))
		{
			if($objpermission->find_id() )
			{
				echo '{"type":"fail","message":"Permission Already Exists"}';
			}
			else
			{
				if($objpermission->insert()){
					echo '{"type":"success","message":"Permission Update Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Permission Not Save Due to Some Internal Error"}';
				}
			}
		}
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>