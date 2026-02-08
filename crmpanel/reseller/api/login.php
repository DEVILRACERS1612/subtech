<?php 
require '../config/config.inc.php';
require '../Model/class.login.php';

    $login->uname = $db->filterVar($_POST['username']);
    $login->pass = $db->filterVar($_POST['pass']);
	$method=$db->filterVar($_POST['method']);
	$cpost_id=$db->filterVar($_POST['post_id']);
	
	if($post_id==$cpost_id)
	{
		if($method=='RSL'){
			$res=$login->login_check();
			if($res==0)
			{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Invalid Credential</div>"}';
			}else if($res==1)
			{
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Login SuccessFull</div>"}';
			}else if($res==2)
			{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Your Reseller Vailidy is Expired, Please Contact your Administrator.</div>"}';
			}else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Invalid Command</div>"}';
			}
			
		}
		else{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Invalid Credential</div>"}';
		}
	}else{
		echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Invalid User</div>"}';
	}

?>