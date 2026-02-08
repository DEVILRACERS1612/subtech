<?php 
require '../config/config.inc.php';
//error_reporting(E_ALL);
require '../Model/class.source.php';
	
	$objsource->rdate = date("Y-m-d H:i:s");
	$objsource->source = $_POST['source'];
	$objsource->reference = $_POST['reference'];
	
    $objsource->edit_id = $db->filterVar($_POST['edit_id']);
	$objsource->del_id = $db->filterVar($_POST['del_id']);
	$objsource->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			$ok=$objsource->insert();
			if($ok==1){
				echo '{"type":"success","edit":"ok","message":"Source Save Successfully"}';
			}else if($ok==2){
				echo '{"type":"fail","message":"Error: Duplicate Entry"}';
			}else{
				echo '{"type":"fail","message":"Source Not Save Due to Some Internal Error"}';
			}
		}
		
		else if($method=='Delete')
		{
			if($objsource->deleteme()){
				echo '{"type":"success","message":"Source Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='DeleteReference')
		{
			if($objsource->delete_reference()){
				echo '{"type":"success","message":"Delete Reference Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='Reference')
		{
			if($objsource->reference_update()){
				echo '{"type":"success","message":"Reference Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objsource->view().'"}';
			
		}
		else if($method=='ViewReference')
		{
			echo '{"type":"success","message":"'.$objsource->view_reference().'"}';
			
		}
		else if($method=='SearchReference')
		{
			echo $objsource->reference_list($objsource->source,'');
			
		}else if($method=='ViewSource')
		{
			echo '{"type":"success","message":"'.$objsource->view_cmpl_source().'"}';
		}
		else if($method=='Complain')
		{
			if($objsource->edit_id!=""){
				$ok=$objsource->update_cmpl_source();
			}else{
				$ok=$objsource->insert_cmpl_source();
			}
			
			if($ok==1){
				echo '{"type":"success","edit":"ok","message":"Source Update Successfully"}';
			}else if($ok==2){
				echo '{"type":"fail","message":"Error: Duplicate Entry"}';
			}else{
				echo '{"type":"fail","message":"Source Not Save Due to Some Internal Error"}';
			}
		}else if($method=='DeleteSource')
		{
			if($objsource->delete_cmpl_source()){
				echo '{"type":"success","message":"Delete Source Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		
		
		
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>