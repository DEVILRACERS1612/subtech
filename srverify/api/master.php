<?php 
require '../config/config.inc.php';
require '../Model/class.master.php';
require '../Model/class.sms.php';

    $objmaster->rdate=date("Y-m-d H:i:s");
	$objmaster->fname = $db->filterVar($_POST['fname']);
	$objmaster->cfname = $db->filterVar($_POST['cfname']);
	$objmaster->gen_name = $db->filterVar($_POST['gen_name']);
	$objmaster->lname = $db->filterVar($_POST['lname']);
	$objmaster->mobile = $db->filterVar($_POST['mobile']);
	$objmaster->mobile2 = $db->filterVar($_POST['mobile2']);
	$objmaster->clname = $db->filterVar($_POST['clname']);
	$objmaster->cmobile = $db->filterVar($_POST['cmobile']);
	$objmaster->message = $db->filterVar($_POST['message']);
    $objmaster->state = $db->filterVar($_POST['state']);
    $objmaster->city = $db->filterVar($_POST['city']);
    $objmaster->address = $db->filterVar($_POST['address']);
    $objmaster->cstate = $db->filterVar($_POST['cstate']);
    $objmaster->ccity = $db->filterVar($_POST['ccity']);
    $objmaster->caddress = $db->filterVar($_POST['caddress']);
    $objmaster->pdate = date("Y-m-d",strtotime($_POST['pdate']));
    $objmaster->prd_id = $db->filterVar($_POST['prd_id']);
    $objmaster->usertype = $db->filterVar($_POST['userType']);
    $objmaster->serial_no = $db->filterVar($_POST['serial_no']);
    $objmaster->language = $db->filterVar($_POST['language']);
    $objmaster->warranty = $db->filterVar($_POST['warranty']);
    $objmaster->otp = $db->filterVar($_POST['otp']);
    
	$objmaster->video = $_FILES['video'];
	
	$objmaster->selfie = $_FILES['selfie'];
	$objmaster->bill_img = $_FILES['bill_img'];
	$objmaster->install_img = $_FILES['install_img'];
	$objmaster->selfie_prd_img = $_FILES['selfie_prd_img'];
	$objmaster->amf_img = $_FILES['amf_img'];
	$objmaster->amf_con_img = $_FILES['amf_con_img'];
	$objmaster->gen_con_img = $_FILES['gen_con_img'];
	
	
	$objsms->otp = $db->filterVar($_POST['otp']);
	$objsms->mobile = $db->filterVar($_POST['mobile']);
	
		
	$cpost_id=$db->filterVar($_POST['_token']);
	$method=$db->filterVar($_POST['method']);
	/*echo "<pre>";
print_r($_FILES);
exit;*/
	if($post_id==$cpost_id)
	{
		if($method=='sendotp'){
		    $ok=$objmaster->send_otp();
		    if($ok==1){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">OTP Send Successfully Successful</div>"}';
		    }elseif($ok==2){
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Something Went Wrong</div>"}';
		    }else if($ok==3){
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Mobile Already Exist</div>"}';
			}
		}else if($method=='sendcotp'){
		    $ok=$objmaster->send_cotp();
		    if($ok==1){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">OTP Send Successfully Successful</div>"}';
		    }elseif($ok==2){
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Something Went Wrong</div>"}';
		    }else if($ok==3){
				echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Mobile Already Exist</div>"}';
			}
		}else if($method=='checkotp'){
		    $ok=$objmaster->check_otp();
		    if($ok){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">OTP is Valid</div>"}';
		    }else{
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Something Went Wrong</div>"}';
		    }
		}else if($method=='step1'){
		    $ok=$objmaster->update_step1();
		    if($ok){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">Data has been Sent Successful</div>"}';
		    }else{
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Something Went Wrong</div>"}';
		    }
		}else if($method=='step2'){
		    $ok=$objmaster->update_step2();
		    if($ok){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">Data has been Sent Successful</div>"}';
		    }else{
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Something Went Wrong</div>"}';
		    }
		}else if($method=='step3'){
		    $ok=$objmaster->update_step3();
			/*echo $ok;*/
		    if($ok){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">Data has been Sent Successful</div>"}';
		    }else{
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Something Went Wrong</div>"}';
		    }
		}else if($method=='step4'){
		    $ok=$objmaster->update_step4();
		    if($ok){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">Data has been Sent Successful</div>"}';
		    }else{
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Something Went Wrong</div>"}';
		    }
		}
		
	}
