<?php 
require '../config/config.inc.php';
require '../Model/class.branch.php';
require '../Model/class.region.php';
	
	$objbranch->rdate = date("Y-m-d H:i:s");
	$objbranch->region_id = $db->filterVar($_POST['region_id']);
	$objbranch->branch_name = $db->filterVar($_POST['branch_name']);
	$objbranch->head_name = $db->filterVar($_POST['head_name']);
	$objbranch->address = $db->filterVar($_POST['address']);
	$objbranch->phone = $db->filterVar($_POST['phone']);
	$objbranch->fax = $db->filterVar($_POST['fax']);
	$objbranch->email = $db->filterVar($_POST['email']);
	$objbranch->description = $db->filterVar($_POST['description']);
	
    $objbranch->edit_id = $db->filterVar($_POST['edit_id']);
	$objbranch->del_id = $db->filterVar($_POST['del_id']);
	$objbranch->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objbranch->find_id() )
			{
				echo '{"type":"fail","message":"Branch  Already Exists"}';
			}
			else
			{
				if($objbranch->insert()){
					echo '{"type":"success","message":"Branch Save Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Branch Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			if($objbranch->find_id() )
			{
				echo '{"type":"fail","message":"Branch Already Exists"}';
			}
			else
			{
				if($objbranch->update()){
					echo '{"type":"success","edit":"ok","message":"Branch Update Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Branch Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Delete')
		{
			if($objbranch->deleteme()){
				echo '{"type":"success","message":"Branch Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objbranch->view().'"}';
			
		}
		else if($method=='ViewBranchList')
		{
			echo $objbranch->branch_list($objbranch->region_id,'');
			
		}
		
		
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>