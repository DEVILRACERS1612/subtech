<?php 
require '../config/config.inc.php';
//error_reporting(E_ALL);
require '../Model/class.master.php';
require '../Model/class.sms.php';


    $objmaster->rdate=date("Y-m-d H:i:s");
	$objmaster->name = $_POST['name'];
	$objmaster->c_type = $_POST['c_type'];
	$objmaster->job = $_POST['job'];
	$objmaster->visitin = $_POST['visitin'];
	$objmaster->blog_id = $_POST['blog_id'];
	$objmaster->mobile = $_POST['mobile'];
	$objmaster->email = $_POST['email'];
	$objmaster->subject = $_POST['subject'];
    $objmaster->message = $_POST['message'];
	$objmaster->language = $_POST['language'];
	$objmaster->otp    = $_POST['otp'];
	$objmaster->fname    = $_POST['fname'];
	$objmaster->lname    = $_POST['lname'];
	$objmaster->dob    = $_POST['dob'];
	$objmaster->refid    = base64_decode($_POST['refid']);
	$objmaster->state    = $_POST['state'];
	$objmaster->city     = $_POST['city'];
	$objmaster->address  = $_POST['address'];
	$objmaster->selfie   = $_POST['selfie'];
    $objmaster->ctype   = $_POST['ctype'];
	$objmaster->serial_no   = $_POST['serial_no'];
	$objmaster->prd_id   = $_POST['prd_id'];
	$objmaster->prd_name   = $_POST['prd_name'];
	$objmaster->qty   = $_POST['qty'];

	$objmaster->data_id = $_POST['data_id'];
	
	$objmaster->resume = $_FILES['resume'];
	$objmaster->image = $_FILES['image'];
	
	
	
	
	$cpost_id=$_POST['_token'];
	$method=$_POST['method'];
	
	if($post_id==$cpost_id)
	{
		if($method=='JobApply'){
		    $ok=$objmaster->apply_job();
		    if($ok){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">Job Apply Successful</div>"}';
		    }else{
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Something Went Wrong</div>"}';
		    }
		}else if($method=='Complains'){
		    $ok=$objmaster->update_complain();
		    if($ok){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">Complaints Registered Successful</div>"}';
		    }else{
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Something Went Wrong</div>"}';
		    }
		}else if($method=='order'){
		    $ok=$objmaster->update_order();
		    if($ok){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">Order Send Successful</div>"}';
		    }else{
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Something Went Wrong</div>"}';
		    }
		}else if($method=='warranty_check'){
		    $ok=$objmaster->warranty_check();
		    if($ok==1){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">Your product Warranty till '.date("d-M-Y",strtotime($objmaster->exp_date)).'</div>"}';
		    }else if($ok==2){
				echo '{"type":"success","message":"<div class=\"alert alert-success\">Product Found Claim Your warranty Here </div><a href=\"https://www.subtech.in/srverify/qrc/'.base64_encode($objmaster->serial_no).'\" target=\"_blank\" class=\"btn btn-danger\">Click Here</a>"}';
			}else{	
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Product Not Found</div>"}';
		    }
		}else if($method=='Subscribe'){
		    $ok=$objmaster->update_subscriber();
		    if($ok==1){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">Your Subscription has been Successful</div>"}';
		    }else if($ok==2){
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">You are already subscribed here</div>"}';
		    }else{
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Something Went Wrong</div>"}';
		    }
		}else if($method=='Contact'){
		    $ok=$objmaster->update_contact();
		    if($ok){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">Your Detail has been Sent Successful</div>"}';
		    }else{
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Something Went Wrong</div>"}';
		    }
		}else if($method=='registration'){
		    $ok=$objmaster->update_registration();
		    if($ok=='1'){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">Thank You For Interest in Subtech. Your Detail has been Sent Subtech</div>"}';
		    }else if($ok=='2'){
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">You are already Registered here</div>"}';
		    }else{
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Please Wait!... Something Went Wrong</div>"}';
		    }
		}else if($method=='Visitor'){
		    $ok=$objmaster->update_visitor();
		    if($ok){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">Thank You For Interest in Subtech. Your Detail has been Sent Subtech</div>"}';
		    }else{
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Please Wait!... Something Went Wrong</div>"}';
		    }
		}else if($method=='Enquiry'){
		    $ok=$objmaster->update_enquiry();
		    if($ok){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">Your Enquiry has been Sent Successful</div>"}';
		    }else{
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Something Went Wrong</div>"}';
		    }
		}else if($method=='Comment'){
		    $ok=$objmaster->update_comment();
		    if($ok){
		        echo '{"type":"success","message":"<div class=\"alert alert-success\">Your Comment has been Sent Successful</div>"}';
		    }else{
		        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Something Went Wrong</div>"}';
		    }
		}else if($method=="verify_otp"){
			$ok=$objmaster->check_otp();
			if($ok=='1'){
				$data=[
					'type'=>'success',
					'message'=>'<span class="text-success">Your Mobile Verified successfully</span>'
				];
			}else if($ok=='2'){
				$data=[
					'type'=>'fail',
					'message'=>'<span class="text-danger">Error! Your OTP is not valid</span>'
				];//'.$_SESSION['otp'].'
				
			}
			echo json_encode($data);
		}else if($method=='sendOTP'){
				$ok=$objmaster->send_otp();
				if($ok==1){
					$data=[
						'type'=>'success',
						'message'=>'<span class="alert alert-success">OTP Send Successfully </span>'
					];
				   
				}else if($ok==2){
					$data=[
						'type'=>'fail',
						'message'=>'<span class="alert alert-danger">You are already Registered</span>'
					];
				}else{
				$data=[
					'type'=>'fail',
					'message'=>'<span class="alert alert-danger">OTP Not Send Due to Error. Try After Sometimes. </span>'
				];
			}
			echo json_encode($data);
		}else if($method=="update_electrician"){
			if($objmaster->update_electrician()){
				$reflink=base64_encode($objmaster->mobile);
				//$objsms->mobile=$objmaster->mobile;
				//$objsms->message="Become a Subtech Soldier! Refer your Electrician friends using your link & earn up to Rs.50 for every successful referral. Share your link now: https://subtech.in/electrician_register?refid=".$reflink;
				//$objsms->send_sms();
				if($objmaster->language=="en"){

					$data=[
						'type'=>'success',
						'message'=>'<span class="text-success"> ✅ Thanks, '.$objmaster->fname.'. Your profile is under review. We will update you within 24 Hrs.Share your link now: https://subtech.in/electrician_register?refid='.$reflink.'</span>'
					];
				}else if($objmaster->language=='hi'){
					$data=[
						'type'=>'success',
						'message'=>'<span class="text-success"> ✅ धन्यवाद, '.$objmaster->fname.'. आपकी प्रोफ़ाइल समीक्षा में है। हम आपको 24 घंटों के भीतर अपडेट करेंगे। Share your link now: https://subtech.in/electrician_register?refid='.$reflink.'</span>'
					];
				}
			}else{
				$data=[
					'type'=>'fail',
					'message'=>'<span class="text-danger">Soldiers not updated </span>'
				];
			}
			echo json_encode($data);
		}else if($method=='Download'){
			$ok=$objmaster->update_download();
			if($ok==1){
				$data=[
					'type'=>'success',
					'message'=>'<span class="alert alert-success">Download Successfully </span>'
				];
			   
			}else if($ok==2){
				$data=[
					'type'=>'fail',
					'message'=>'<span class="alert alert-danger">You are already Registered</span>'
				];
			}
		}
		
	}
