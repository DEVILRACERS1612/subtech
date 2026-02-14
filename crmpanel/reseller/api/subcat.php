<?php 
error_reporting(0);
session_start();
require '../config/config.inc.php';
require '../Model/class.subcat.php';
	
	$objscat->cat = $_POST['cat'];
	$objscat->subcat = $_POST['subcat'];
	$objscat->urlname = $_POST['urlname'];
	$objscat->ptitle = $_POST['ptitle'];
	
    $objscat->description = $_POST['description'];

    $objscat->edit_id = $_POST['edit_id'];
    $method=$_POST['method'];
	
	if(empty($_POST['edit_id']) and empty($method))
	{
		if($objscat->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Sub-Category  Already Exists</div>"}';
		}
		else
		{
			if($objscat->insert()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Sub-Category Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Sub-Category Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	else if($method=='Findsubcat')
	{
		echo '{"type":"success","message":"'.$objscat->findsubcatlist($objscat->cat).'"}';
	}
	else if(!empty($_POST['edit_id']) and $method=='')
	{
		if($objscat->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Sub-Category Already Exists</div>"}';
		}
		else
		{
			if($objscat->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Sub-Category Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Sub-Category Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	
    

?>