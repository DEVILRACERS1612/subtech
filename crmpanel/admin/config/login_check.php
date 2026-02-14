<?php 
if(!isset($_SESSION[SITE_NAME]['MI_admin_id']) or empty($_SESSION[SITE_NAME]['MI_admin_id']))
{
	$fl=explode('/',$_SERVER['SCRIPT_NAME']);
	if(empty($_SERVER['QUERY_STRING']))
		{
		$fullname=$fl[count($fl)-1];
		}else{
		$fullname=$fl[count($fl)-1].'?'.$_SERVER['QUERY_STRING'];	
		}
	
	$_SESSION['NT_doc']=$fullname;		
	header('location:'.BASE_PATH.'Login/');
	die();
}
?>