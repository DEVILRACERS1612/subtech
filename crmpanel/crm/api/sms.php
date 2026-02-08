<?php 

require '../config/config.inc.php';
require '../Model/class.sms.php';

	
	$objsms->mobile = $_POST['mobile'];
    $objsms->message = $db->filterVar($_POST['message']);
	$cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	
	
	if($post_id==$cpost_id)
	{
		if($method=='SENDSMS')
		{
	
			if(!empty($objsms->mobile) and !empty($objsms->message) )
			{
				if($objsms->send_sms())
				{
					echo '{"type":"success","message":"<div class=\"alert alert-success\">Message Sent Successfully</div>"}';
				}else{
					echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Message not Sent due to '.$objsms->error.'</div>"}';
				}	
			}
		}
		else if($method=='SENDSMS2')
		{
	
			if(!empty($objsms->mobile) and !empty($objsms->message) )
			{
				if($objsms->send_sms2())
				{
					echo '{"type":"success","message":"Message Sent Successfully"}';
				}else{
					echo '{"type":"fail","message":"Message not Sent due to '.$objsms->error.'"}';
				}	
			}
		}
		else if($method=='CSVFILE'){
			
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
		}
	}else{
		echo '{"type":"fail","message":"Invalid User"}';
	}
	

?>