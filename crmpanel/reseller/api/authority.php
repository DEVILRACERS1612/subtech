<?php 
require '../config/config.inc.php';
require '../Model/class.authority.php';
	
	$objmodauth->rdate = date("Y-m-d H:i:s");
	$objmodauth->reseller_id = $db->filterVar($_POST['reseller_id']);
	$objmodauth->cmp_id = $db->filterVar($_POST['cmp_id']);
	$objmodauth->module = $db->filterVar($_POST['module']);
	$objmodauth->feature = $db->filterVar($_POST['feature']);
	$objmodauth->edit_id = $_POST['edit_id'];
	
    $cpost_id=$db->filterVar($_POST['post_id']);
    
	if($post_id==$cpost_id)
	{
		if(empty($_POST['edit_id']))
		{
			if($objmodauth->find_id() )
			{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Authority Already Exists</div>"}';
			}
			else
			{
				if($objmodauth->insert()){
					echo '{"type":"success","message":"<div class=\"alert alert-success\">Authority Updated Successfully </div>"}';
				}
				else{
					echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Authority Not Save Due to Some Internal Error</div>"}';
				}
			}
		}
		else if(!empty($_POST['edit_id']))
		{
			if($objmodauth->find_id() )
			{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Authority Already Exists</div>"}';
			}
			else
			{
				if($objmodauth->update()){
					echo '{"type":"success","message":"<div class=\"alert alert-success\">Authority Update Successfully</div>"}';
				}
				else{
					echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Authority Not Save Due to Some Internal Error</div>"}';
				}
			}
		}
    }else{
		echo '{"type":"fail","message":"<span class=\"alert alert-danger\">Invalid User</span>"}';
	}

?>