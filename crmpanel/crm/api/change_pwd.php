<?php 
session_start();
require '../config/config.inc.php';
require '../Model/class.change_pwd.php';
	
	$objpwd->pdate = date("Y-m-d");
	
    $objpwd->user_id = $db->filterVar($_POST['user_id']);
	$objpwd->oldpwd = $db->filterVar($_POST['oldpwd']);
	$objpwd->newpwd = $db->filterVar($_POST['newpwd']);
	$objpwd->cnfpwd = $db->filterVar($_POST['cnfpwd']);
	

    $objpwd->edit_id = $_POST['edit_id'];
    

	if(!$objpwd->find_pwd())
	{
		
		echo '{"type":"fail","message":" Old Password Not matched. Try Again "}';
	}
	else
	{
		if($objpwd->cnf_pwd()){
			$objpwd->update();
			echo '{"type":"success","message":"Password Changed Successfully"}';
		}else{
			echo '{"type":"fail","message":"Confirm Password Not Matched"}';
		}
	}
?>