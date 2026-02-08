<?php 
require '../config/config.inc.php';
require '../Model/class.task_type.php';
	
	$objtask->rdate = date("Y-m-d H:i:s");
	$objtask->task_type = $_POST['task_type'];
	
    $objtask->edit_id = $db->filterVar($_POST['edit_id']);
	$objtask->del_id = $db->filterVar($_POST['del_id']);
	$objtask->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			$ok=$objtask->insert();
			if($ok==1){
				echo '{"type":"success","edit":"ok","message":"Task Type Save Successfully"}';
			}else if($ok==2){
				echo '{"type":"fail","message":"Error: Duplicate Entry"}';
			}else{
				echo '{"type":"fail","message":"Task Type Not Save Due to Some Internal Error"}';
			}
		}
		else if($method=='Edit')
		{
			$ok=$objtask->update();
			if($ok==1){
				echo '{"type":"success","edit":"ok","message":"Task Type Update Successfully"}';
			}else if($ok==2){
				echo '{"type":"fail","message":"Error: Duplicate Entry"}';
			}else{
				echo '{"type":"fail","message":"Task Type Not Save Due to Some Internal Error"}';
			}
		}
		else if($method=='Delete')
		{
			if($objtask->deleteme()){
				echo '{"type":"success","message":"Task Type Delete Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objtask->view().'"}';
			
		}
		
		
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>