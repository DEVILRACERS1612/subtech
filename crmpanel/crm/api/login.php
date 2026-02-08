<?php 
require '../config/config.inc.php';
require '../Model/class.login.php';
require '../Model/class.sms.php';

	$login->cmp_id = $db->filterVar($_POST['cmp_id']);
    $login->uname = $db->filterVar($_POST['username']);
	$login->mobile = $db->filterVar($_POST['mobile']);
	$login->otp = $db->filterVar($_POST['otp']);
    $login->pass = $db->filterVar($_POST['pass']);
	$cpost_id=$db->filterVar($_POST['post_id']);
	$method=$db->filterVar($_POST['method']);
	
	if($post_id==$cpost_id)
	{
		if($method=='SchL'){
			$res=$login->login_check();
			if($res==1)
			{
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Login SuccessFull</div>"}';
			}else if($res==2)
			{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Your Software Vailidy is Expired, Please Contact your Provider.</div>"}';
			}else if($res==3)
			{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\"> Invalid Credential</div>"}';
			}else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\"> Invalid Command</div>"}';
			}
		}
		else if($method=='sendotp'){
			$res=$login->mobile_login_check();
			//echo $res;
			if($res==3)
			{
				echo '{"type":"success","message":"<div class=\"alert alert-success\">OTP Sent SuccessFull</div>"}';
			}else if($res==2)
			{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">OTP Not sent due to Wrong Mobile or sms services Error</div>"}';
			}else if($res==1)
			{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Mobile Number not registered</div>"}';
			}else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\"> Invalid Command</div>"}';
			}
		}
		else if($method=='otp-login'){
			$res=$login->mobile_otp_check();
			if($res==1)
			{
				echo '{"type":"success","message":"<div class=\"alert alert-success\">OTP Verified, Login SuccessFull</div>"}';
			}else if($res==2)
			{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">School Profile Not Set, Contact Reseller</div>"}';
			}else if($res==3)
			{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Mobile Number not registered</div>"}';
			}else if($res==4)
			{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">OTP not Matched</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\"> Invalid Command</div>"}';
			}
		}
		else{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Invalid Login</div>"}';
		}
	}else{
		echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Invalid User</div>"}';
	}
?>