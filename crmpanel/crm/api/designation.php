<?php 
require '../config/config.inc.php';
require '../Model/class.designation.php';
	
	$objdesignation->rdate = date("Y-m-d H:i:s");
	$objdesignation->desig_level = $db->filterVar($_POST['desig_level']);
	$objdesignation->designation = $db->filterVar($_POST['designation']);
	$objdesignation->description = $db->filterVar($_POST['description']);
	$objdesignation->department_name = $db->filterVar($_POST['department_name']);
	$objdesignation->authority = (isset($_POST['authority']) and $_POST['authority']!="")?$db->filterVar($_POST['authority']):0;
	
	$objdesignation->desig_id = $db->filterVar($_POST['desig_id']);
	$objdesignation->module = $db->filterVar($_POST['module']);
	$objdesignation->feature = $db->filterVar($_POST['feature']);
	
	$objdesignation->permission = json_decode($_POST['pg_pmsn'],true);
    $objdesignation->edit_id = $db->filterVar($_POST['edit_id']);
    $objdesignation->del_id = $db->filterVar($_POST['del_id']);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
    
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objdesignation->find_id() )
			{
				echo '{"type":"fail","message":"Designation  Already Exists"}';
			}else{
				if($objdesignation->insert()){
					echo '{"type":"success","message":"Designation Save Successfully"}';
				}else{
					echo '{"type":"fail","message":"Designation Not Save Due to Some Internal Error"}';
				}
			}
		}
		if($method=='Department')
		{
			if($objdesignation->find_department() )
			{
				echo '{"type":"fail","message":"Department  Already Exists"}';
			}else{
				if($objdesignation->insert_department()){
					echo '{"type":"success","message":"Department Updated Successfully"}';
				}else{
					echo '{"type":"fail","message":"Department Not Updated Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			if($objdesignation->find_id() )
			{
				echo '{"type":"fail","message":"Designation Already Exists"}';
			}
			else
			{
				if($objdesignation->update()){
					echo '{"type":"success","message":"Designation Update Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Designation Not Save Due to Some Internal Error"}';
				}
			}
		}else if($method=='Delete')
		{
			if($objdesignation->deleteme()){
				echo '{"type":"success","message":"Designation Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='DeleteDepartment')
		{
			if($objdesignation->deletedepartment()){
				echo '{"type":"success","message":"Department Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objdesignation->view().'"}';
		}
		else if($method=='ViewDepartment')
		{
			echo '{"type":"success","message":"'.$objdesignation->view_department().'"}';
		}
		else if($method=='ViewAuthority')
		{
			echo '{"type":"success","message":"'.$objdesignation->view_authority().'"}';
		}
		else if($method=='Finddesi')
		{
			echo $objdesignation->desig_list($objdesignation->desig_level,$objdesignation->designation);
		}else if($method=='Authority')
		{
			if($objdesignation->authority_update()){
				echo '{"type":"success","message":"Authority Update Successfully"}';
			}else{
				echo '{"type":"fail","message":"Authority Not Save Due to Some Internal Error"}';
			}
		}
		
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>