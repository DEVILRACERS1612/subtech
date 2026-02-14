<?php 
	error_reporting(0);
	include './config/config.inc.php';
	session_start();
		$_SESSION['NT_mobile']='';
		$_SESSION['NT_email']='';
		$_SESSION['NT_webid']='';

	session_destroy();
	header('Location:'.WEB_PATH);
?>