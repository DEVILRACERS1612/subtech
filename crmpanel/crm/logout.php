<?php 
	
	include './config/config.inc.php';
	$sch=$_SESSION[SITE_NAME]['MICMP_cmpid'];
	$_SESSION[SITE_NAME]['MICMP_cmpid']='';
	$_SESSION[SITE_NAME]['MICMP_mobile']='';
	$_SESSION[SITE_NAME]['MICMP_name']='';
	$_SESSION[SITE_NAME]['MICMP_email']='';
	$_SESSION[SITE_NAME]['MICMP_userid']= '';
	$_SESSION[SITE_NAME]['MICMP_usertype']= '';
	$_SESSION[SITE_NAME]['PAGE_PERMISSION']='';
	$_SESSION[SITE_NAME]['MICMP_loginid']= '';
	$_SESSION[SITE_NAME]['MICMP_Profile']= '';
	
	//session_destroy();
	header('Location:'.MAIN_PATH."crmsoft/".$sch."");
?>