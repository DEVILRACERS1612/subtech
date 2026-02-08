<?php 
if(!isset($_SESSION[SITE_NAME]['MICMP_cmpid']) or empty($_SESSION[SITE_NAME]['MICMP_cmpid']))
{
	$fl=explode('/',$_SERVER['SCRIPT_NAME']);
	if(empty($_SERVER['QUERY_STRING']))
		{
		$fullname=$fl[count($fl)-1];
		}else{
		$fullname=$fl[count($fl)-1].'?'.$_SERVER['QUERY_STRING'];	
		}
	
	$_SESSION['NT_doc']=$fullname;		
	header('location:https://subtech.in/crmpanel/crmsoft/subtech');
	die();
}


?>