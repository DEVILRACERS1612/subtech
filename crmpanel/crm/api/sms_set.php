<?php 
require '../config/config.inc.php';
require '../Model/class.sms_setting.php';
	
	$objsmsset->rdate = date("Y-m-d H:i:s");
	$objsmsset->user_id = $db->filterVar($_POST['user_id']);
	$objsmsset->page_code = $_POST['page'];
	
    $objsmsset->edit_id = $db->filterVar($_POST['edit_id']);
	$objsmsset->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
    
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			/*if($objsmsset->find_id() )
			{
				echo '{"type":"fail","message":"SMS Setting Already Exists"}';
			}
			else
			{*/
				if($objsmsset->insert()){
					echo '{"type":"success","message":"SMS Setting Save Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"SMS Setting Not Save Due to Some Internal Error"}';
				}
			//}
		}
		else if($method=='Edit')
		{
			if($objsmsset->find_id() )
			{
				echo '{"type":"fail","message":"SMS Setting Already Exists"}';
			}
			else
			{
				if($objsmsset->insert()){
					echo '{"type":"success","message":"SMS Setting Update Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"SMS Setting Not Save Due to Some Internal Error"}';
				}
			}
		}
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>