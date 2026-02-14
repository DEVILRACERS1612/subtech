<?php 
session_start();
error_reporting(0);
require '../config/config.inc.php';
require '../Model/class.sms.php';
date_default_timezone_set("Asia/Kolkata");
	
	$objsms->mobile = $_POST['mobile'];
    $objsms->message = $_POST['message'];
	
	
	if(($_FILES["csvfile"]["name"])!='')
	{
		$validextensions = array("csv");
		$temporary = explode(".", $_FILES["csvfile"]["name"]);
		$file_extension = end($temporary);
		if ( in_array($file_extension, $validextensions))
		{
						
			$vlv='';
			$file = $_FILES['csvfile']['tmp_name'];
			$handle = fopen($file, "r");
			$filesop = fgetcsv($handle, 1000, ",");
			$id='0';
			while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
			{
				for($d=0;$d<1;$d++)
				{
					$vlv.=$filesop[$d].",";
				}
			}
			$vlv=rtrim($vlv,",");
			//echo $vlv;
			echo '{"type":"success","message":"<div class=\"alert alert-success\">Mobile Number Uploaded Successfully</div>","mob":"'.$vlv.'"}';
		}
		else
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">File Type Not Supported, Select Only .csv File</div>"}';
			
		}
	}
	
	
	if(!empty($objsms->mobile) and !empty($objsms->message) )
	{
		if($objsms->send_sms())
		{
			echo '{"type":"success","message":"<div class=\"alert alert-success\">Message Sent Successfully</div>"}';
		}
		else
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Message not Sent due to '.$objsms->error.'</div>"}';
		}	
	}
	

?>