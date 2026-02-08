<?php 
require '../config/config.inc.php';
require '../Model/class.student.php';
require '../Model/class.class.php';
require '../Model/class.section.php';
require '../Model/class.import.php';
	
	//$objimport->dor = date("Y-m-d");
	$objimport->image = $_FILES['image'];
	$objimport->import_file=$_FILES['import_file'];
	$objimport->permission = json_decode($_POST['pg_pmsn'],true);
	
	$cpost_id=$db->filterVar($_POST['post_id']);
	$method = $db->filterVar($_POST['method']);
    if($post_id==$cpost_id)
	{
		if($method=='ImportStudent')
		{
			$er=$objimport->upload();
			/*echo $er;*/
			if($er==1)
			{
				echo '{"type":"fail","message":"Data file Must be in .csv Format"}';
			}else if($er==2){
				echo '{"type":"fail","message":"Admission No or App Login ID may be duplicate"}';	
			}else if($er==3)
			{
				echo '{"type":"fail","message":"Something went Wrong During Internal Error"}';
			}else if($er==4){
				echo '{"type":"success","message":"Student Data Uploaded Successfully"}';
			}else if($er==5){
				echo '{"type":"fail","message":"Permission Fail"}';
			}else if($er==6){
				echo '{"type":"fail","message":"CSV File Not Found"}';
			}
		}elseif($method=='ImportStudentPhoto')
		{
			if($objimport->upload_photo())
			{
				echo '{"type":"success","message":"Student Photo Uploaded Successfully"}';
			}else {
				echo '{"type":"fail","message":"Image File(s) Not Found"}';
			}
		}
		
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>