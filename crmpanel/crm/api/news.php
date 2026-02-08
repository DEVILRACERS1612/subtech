<?php 
session_start();
error_reporting(0);
require '../config/config.inc.php';
require '../Model/class.news.php';
date_default_timezone_set("Asia/Kolkata");
	
	$objnews->title = $db->filterVar($_POST['title']);
	$objnews->dop = date("Y-m-d");
	$objnews->top = date("H:i:s");
	$objnews->urlname = $db->filterVar($_POST['urlname']);
    $objnews->news = $db->filterVar($_POST['news']);
	$objnews->image = $_FILES['image'];
	$objnews->cat1 = $db->filterVar($_POST['cat']);
	$objnews->subcat1 = $db->filterVar($_POST['subcat']);
	$objnews->cat = $db->filterVar($_POST['cat1']);
	$objnews->subcat = $db->filterVar($_POST['cat2']);
	$objnews->ocat = $db->filterVar($_POST['cat3']);
	$objnews->tags = $db->filterVar($_POST['tags']);
	$objnews->ndes = $db->filterVar($_POST['ndes']);
	$objnews->nkeywords = $db->filterVar($_POST['nkeywords']);
	$objnews->ntitle = $db->filterVar($_POST['ntitle']);
    $objnews->edit_id = $_POST['edit_id'];
    
	if(empty($_POST['edit_id']))
	{
		if($objnews->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Post  Already Exists</div>"}';
		}
		else
		{
			if($objnews->insert()){//echo "ok";
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Post Save Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Post Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
	else if(!empty($_POST['edit_id']))
	{
		if($objnews->find_id() )
		{
			echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Post Already Exists</div>"}';
		}
		else
		{
			if($objnews->update()){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Post Update Successfully</div>"}';
			}
			else{
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Post Not Save Due to Some Internal Error</div>"}';
			}
		}
	}
    

?>