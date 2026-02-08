<?php 
session_start();
error_reporting(0);
require '../config/config.inc.php';
require '../Model/class.gallery.php';
date_default_timezone_set("Asia/Kolkata");
	
	//$objgallery->ltitle = $db->filterVar($_POST['ltitle']);
	$objgallery->dop = date("Y-m-d");
	
    //$objgallery->llink = $db->filterVar($_POST['llink']);
	$objgallery->image = $_FILES['image'];
	
    $objgallery->edit_id = $_POST['edit_id'];
    
	if(empty($_POST['edit_id']))
	{
		
			if($objgallery->insert()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Gallery Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Gallery Not Save Due to Some Internal Error</div>"}';
			}
		
	}
	else if(!empty($_POST['edit_id']))
	{
		
			if($objgallery->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Gallery Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Gallery Not Save Due to Some Internal Error</div>"}';
			}
		
	}
    

?>