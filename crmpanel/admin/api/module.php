<?php 
require '../config/config.inc.php';
require '../Model/class.module.php';
	
	$objmodule->m_grp_code = $db->filterVar($_POST['m_grp_code']);
	$objmodule->m_grp_name = $db->filterVar($_POST['m_grp_name']);
	$objmodule->m_code = $db->filterVar($_POST['m_code']);
	$objmodule->m_name = $db->filterVar($_POST['m_name']);
	$objmodule->m_page_name = $db->filterVar($_POST['m_page_name']);
	

    $objmodule->edit_id = $_POST['edit_id'];
    
	if(empty($_POST['edit_id']))
	{
		if($objmodule->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">MODULE Already Exists</div>"}';
		}
		else
		{
			if($objmodule->insert()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">MODULE Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">MODULE Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	else if(!empty($_POST['edit_id']))
	{
		if($objmodule->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">MODULE Already Exists</div>"}';
		}
		else
		{
			if($objmodule->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">MODULE Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">MODULE Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
    

?>