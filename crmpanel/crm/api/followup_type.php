<?php 
require '../config/config.inc.php';
require '../Model/class.followup_type.php';
	
	$objfollowup->rdate = date("Y-m-d H:i:s");
	$objfollowup->followup_type = $_POST['followup_type'];
	
    $objfollowup->edit_id = $db->filterVar($_POST['edit_id']);
	$objfollowup->del_id = $db->filterVar($_POST['del_id']);
	$objfollowup->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			$ok=$objfollowup->insert();
			if($ok==1){
				echo '{"type":"success","edit":"ok","message":"Followup Type Save Successfully"}';
			}else if($ok==2){
				echo '{"type":"fail","message":"Error: Duplicate Entry"}';
			}else{
				echo '{"type":"fail","message":"Followup Type Not Save Due to Some Internal Error"}';
			}
		}
		else if($method=='Edit')
		{
			$ok=$objfollowup->update();
			if($ok==1){
				echo '{"type":"success","edit":"ok","message":"Followup Type Update Successfully"}';
			}else if($ok==2){
				echo '{"type":"fail","message":"Error: Duplicate Entry"}';
			}else{
				echo '{"type":"fail","message":"Followup Type Not Save Due to Some Internal Error"}';
			}
		}
		else if($method=='Delete')
		{
			if($objfollowup->deleteme()){
				echo '{"type":"success","message":"Followup Type Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objfollowup->view().'"}';
			
		}
		
		
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>