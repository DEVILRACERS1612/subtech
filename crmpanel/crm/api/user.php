<?php 
require '../config/config.inc.php';
require '../Model/class.user.php';
require '../Model/class.designation.php';
require '../Model/class.branch.php';
	
	$objuser->rdate=date("Y-m-d H:i:s");
	$objuser->username = $db->filterVar($_POST['username']);
	$objuser->user_type = $db->filterVar($_POST['user_type']);
	$objuser->emp_id = $db->filterVar($_POST['emp_id']);
	$objuser->emp_code = $db->filterVar($_POST['emp_code']);
	$objuser->report_to = $db->filterVar($_POST['report_to']);
	$objuser->division = $db->filterVar($_POST['division']);
	$objuser->region = $db->filterVar($_POST['region']);
	$objuser->branch = $db->filterVar($_POST['branch']);
	$objuser->designation = $db->filterVar($_POST['designation']);
	$objuser->dob = date("Y-m-d",strtotime($db->filterVar($_POST['dob'])));
	$objuser->doj = date("Y-m-d",strtotime($db->filterVar($_POST['doj'])));
	$objuser->gender = $db->filterVar($_POST['gender']);
	$objuser->experience = $db->filterVar($_POST['experience']);
	$objuser->smtp_pwd = $db->filterVar($_POST['smtp_pwd']);
	$objuser->smtp_email = $db->filterVar($_POST['smtp_email']);
	$objuser->email = $db->filterVar($_POST['email']);
	$objuser->pwd = $db->filterVar($_POST['pwd']);
	$objuser->email1 = $db->filterVar($_POST['email1']);
	$objuser->email2 = $db->filterVar($_POST['email2']);
	$objuser->mobile = $db->filterVar($_POST['mobile']);
	$objuser->phone = $db->filterVar($_POST['phone']);
	$objuser->address = $db->filterVar($_POST['address']);
	$objuser->other_detail = $db->filterVar($_POST['other_detail']);
	$objuser->juniors = $db->filterVar($_POST['juniors']);
	
	$objuser->image = $_FILES['image'];
    
    $objuser->edit_id = $_POST['edit_id'];
    $objuser->del_id = $db->filterVar($_POST['del_id']);
	$objuser->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objuser->find_id() )
			{
				echo '{"type":"fail","message":"User  Already Exists"}';
			}
			else
			{
				$ok=$objuser->insert();
				if($ok=='1'){
					echo '{"type":"success","message":"User Save Successfully"}';
				}else if($ok=='2'){
					echo '{"type":"fail","message":"Employee Code Already Exists"}';
				}else{
					echo '{"type":"fail","message":"User Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			if($objuser->find_id() )
			{
				echo '{"type":"fail","message":"User Already Exists"}';
			}
			else
			{	
				$ok=$objuser->update();
				if($ok=='1'){
					echo '{"type":"success","message":"User Updated Successfully"}';
				}else if($ok=='2'){
					echo '{"type":"fail","message":"Employee Code Already Exists"}';
				}else{
					echo '{"type":"fail","message":"User Not Updated Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Delete')
		{
			if($objuser->deleteme()){
				echo '{"type":"success","message":"Class Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='Juniors')
		{
			if($objuser->add_juniors()){
				echo '{"type":"success","message":"Juniors Updated Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objuser->view().'"}';
			
		}
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>