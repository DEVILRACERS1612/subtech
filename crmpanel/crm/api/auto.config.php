<?php 
require './Model/class.session.php';
require './Model/class.profile.php';
	
	if(!isset($_SESSION['MISCHOOL_Session']) or $_SESSION['MISCHOOL_Session']['session_txt']=="")
	{
		$objsession->school_session();
		$objsession->session_month();
	}
	if(!isset($_SESSION['MISCHOOL_Profile']) or $_SESSION['MISCHOOL_Profile']['shift']=="")
	{
		$objprofile->school_profile();
	}
	if(!isset($_SESSION['MISCHOOL_Session']) or $_SESSION['MISCHOOL_Session']['session_txt']=="")
	{
		$permission_error="Session Not Set for School please Set the Session";
		header("Refresh:2;url=".BASE_PATH."all-session/");
	}
	
	

?>