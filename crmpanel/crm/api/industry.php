<?php 
require '../config/config.inc.php';
require '../Model/class.industry.php';
	
	$objindustry->rdate = date("Y-m-d H:i:s");
	$objindustry->industry = $_POST['industry'];
	$objindustry->segment = $_POST['segment'];
	
    $objindustry->edit_id = $db->filterVar($_POST['edit_id']);
	$objindustry->del_id = $db->filterVar($_POST['del_id']);
	$objindustry->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			$ok=$objindustry->insert();
			if($ok==1){
				echo '{"type":"success","edit":"ok","message":"Industry Save Successfully"}';
			}else if($ok==2){
				echo '{"type":"fail","message":"Error: Duplicate Entry"}';
			}else{
				echo '{"type":"fail","message":"Industry Not Save Due to Some Internal Error"}';
			}
		}
		else if($method=='Edit')
		{
			$ok=$objindustry->update();
			if($ok==1){
				echo '{"type":"success","edit":"ok","message":"Industry Update Successfully"}';
			}else if($ok==2){
				echo '{"type":"fail","message":"Error: Duplicate Entry"}';
			}else{
				echo '{"type":"fail","message":"Industry Not Save Due to Some Internal Error"}';
			}
		}
		else if($method=='Delete')
		{
			if($objindustry->deleteme()){
				echo '{"type":"success","message":"Industry Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='DeleteSegment')
		{
			if($objindustry->delete_segment()){
				echo '{"type":"success","message":"Delete Segment Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='Segment')
		{
			if($objindustry->segment_update()){
				echo '{"type":"success","message":"Segment Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objindustry->view().'"}';
			
		}
		else if($method=='SearchSegment')
		{
			echo $objindustry->segment_list($objindustry->industry,'');
			
		}
		else if($method=='ViewSegment')
		{
			echo '{"type":"success","message":"'.$objindustry->view_segment().'"}';
			
		}
		
		
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>