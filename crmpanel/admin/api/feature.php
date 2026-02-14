<?php 
require '../config/config.inc.php';
require '../Model/class.feature.php';
	
	$objfeature->f_code = $db->filterVar($_POST['f_code']);
	$objfeature->m_code = $db->filterVar($_POST['m_code']);
	$objfeature->f_name = $db->filterVar($_POST['f_name']);
	$objfeature->f_page_name = $db->filterVar($_POST['f_page_name']);
	

    $objfeature->edit_id = $_POST['edit_id'];
    
	if(empty($_POST['edit_id']))
	{
		if($objfeature->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Feature Already Exists</div>"}';
		}
		else
		{
			if($objfeature->insert()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Feature Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Feature Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	else if(!empty($_POST['edit_id']))
	{
		if($objfeature->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Feature Already Exists</div>"}';
		}
		else
		{
			if($objfeature->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Feature Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Feature Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
    

?>