<?php 
require '../config/config.inc.php';
require '../config/function.php';
require '../Model/class.class.php';
require '../Model/class.section.php';
require '../Model/class.transfer.php';
require '../Model/class.session.php';
require '../Model/class.feesubmit.php';
require '../Model/class.student.php';
	
	$objtransfer->rdate = date("Y-m-d H:i:s");
	$objtransfer->class_id = $db->filterVar($_POST['class_id']);
	$objtransfer->sess = $db->filterVar($_POST['sess']);
	$objtransfer->sec_id = $db->filterVar($_POST['sec_id']);
	$objtransfer->admno = $_POST['admno'];
	$objtransfer->transfer = $db->filterVar($_POST['transfer']);
	$objtransfer->prebal = $db->filterVar($_POST['prebal']);
	
	
	$objtransfer->permission = json_decode($_POST['pg_pmsn'],true);
    $objtransfer->edit_id = $db->filterVar($_POST['edit_id']);
    $objtransfer->del_id = $db->filterVar($_POST['del_id']);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
    
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objtransfer->find_id() )
			{
				echo '{"type":"fail","message":"Time table  Already Exists"}';
			}
			else
			{
				if($objtransfer->insert()){
					echo '{"type":"success","message":"Time table Save Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Time table Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			if($objtransfer->find_id() )
			{
				echo '{"type":"fail","message":"Time table Already Exists"}';
			}
			else
			{
				if($objtransfer->update()){
					echo '{"type":"success","message":"Time table Update Successfully"}';
				}else{
					echo '{"type":"fail","message":"Time table Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='FindList')
		{
			echo '{"type":"success","message":"'.$objtransfer->find_list().'"}';
		}
		else if($method=='SaveTransfer')
		{
			echo '{"type":"success","message":"<span style=\"font-size:18px;font-weight:bold\">'.$objtransfer->save_transfer().'</span>"}';
		}

		
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>