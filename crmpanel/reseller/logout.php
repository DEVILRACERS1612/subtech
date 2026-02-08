<?php 
	include './config/config.inc.php';
	session_start();
		$_SESSION[SITE_NAME]['MI_reseller_id']='';
		$_SESSION[SITE_NAME]['MI_username']='';
		$_SESSION[SITE_NAME]['MI_Role']='';
		
	//session_destroy();
	header('Location:'.WEB_PATH);
?>